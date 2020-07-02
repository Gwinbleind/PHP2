<?php


namespace app\controllers;


use app\interfaces\IUserController;
use app\models\Record;
use app\models\repositories\Repository;
use app\models\User;

class UserController extends Controller implements IUserController
{
    protected string $defaultAction = 'try';
    protected User $user;

	protected function getLogin() :string {
		return $_SESSION['login'];
	}

	public function getId() {
		return $this->user->id;
	}
	public function isAuthorised() :bool {
		if (!isset($_SESSION['login'])) {
			if (isset($_COOKIE['hash'])) {
				$hash = $_COOKIE['hash'];
				//Запрос от БД на существование юзера с таким хэшем
				$repo = new Repository(User::class);
				$this->setUser($repo->getRowByProperty("session_hash",$hash));
				$login = $this->user->login;
//				TODO: не понял, почему, но напрямую эти варианты if не работают,
// 				Приходится создавать отдельную переменную
//				if (isset($this->user->login)) {
//				if (!empty($this->user->login)) {
				if (isset($login)) {
					$_SESSION['login'] = $login;
				} else {
					setcookie('hash','',time()-3600,'/');
				}
			}
		} else {
			$repo = new Repository(User::class);
			$login = $_SESSION['login'];
			$this->setUser($repo->getRowByProperty("login", $login));
		}
		return isset($_SESSION['login']);
	}
	protected function isInserted() :bool {
		return isset($_POST['login']) && isset($_POST['pass']);
	}
	protected function info() :void {
		$login = strip_tags($this->getLogin());
		$userRepository = new Repository(User::class);
		$this->setUser($userRepository->getRowByProperty('login',$login));
		$this->params['user'] = $this->user;
		$this->prepareParams();
		echo $this->actionRenderLayout('user_info');
	}
	protected function login() {
		$login = strip_tags($_POST['login']);
		$pass = strip_tags($_POST['pass']);
		$save = isset($_POST['save']);
		$userRepository = new Repository(User::class);
		$this->setUser($userRepository->getRowByProperty('login',$login));
		$this->user->pass = $pass;
		if ($this->user->validation()) {
			$_SESSION['login'] = $login;
			if ($save) {
				$this->user->session_hash = uniqid('',true);
				$userRepository->saveRowByID($this->user);
				setcookie('hash',$this->user->session_hash,time()+3600,'/');
			}
			header("Location: /?c=user");
		} else {
			$this->actionForm();
		}
	}

	public function actionTry() :void
	{
		session_start();
		if ($this->isAuthorised()) {
			$this->info();
		} elseif ($this->isInserted()) {
			$this->login();
		} else {
			$this->actionForm();
		}
	}
	public function actionForm() :void {
		$this->prepareParams();
        echo $this->actionRenderLayout('login_form');
    }
	public function actionRegister() :void {
		$login = strip_tags($_POST['login']);
		$pass = strip_tags($_POST['pass']);
		$repo = new Repository(User::class);
		if (empty($repo->getTableByProperty('login',$login))) {
			$user = new User(null,$login,$pass);
			$user->password_hash = password_hash($pass,PASSWORD_DEFAULT);
			$user->session_hash = '';
			$repo->createRow($user);
		}
		header("Location: /?c=user");
	}
	public function actionLogout() :void {
		session_start();
		unset($_COOKIE['hash']);
		setcookie('hash','',time()-3600,'/');
		unset($_SESSION['login']);
		header("Location: /?c=user");
	}

	/**
	 * @param User $user
	 * @return UserController
	 */
	public function setUser(Record $user): UserController
	{
		if (!isset($this->user)) {
			$this->user = $user;
		}
		return $this;
	}
}