<?php


namespace app\controllers;


use app\interfaces\IUserController;
use app\models\User;

class UserController extends Controller implements IUserController
{
    protected string $defaultAction = 'try';
    protected User $user;

	protected function getLogin() :string {
		return $_SESSION['login'];
	}
	protected function isAuthorised() :bool {
		if (!isset($_SESSION['login'])) {
			if (isset($_COOKIE['hash'])) {
				$hash = $_COOKIE['hash'];
				//Запрос от БД на существование юзера с таким хэшем
				$this->user = User::getRowByProperty("session_hash",$hash);
				$login = $this->user->login;
//				TODO: не понял, почему, но напрямую эти варианты if не работают,
// 				Приходится создавать отдельную переменную
//				if (isset($this->user->login)) {
//				if (!empty($this->user->login)) {
				if (isset($login)) {
					$_SESSION['login'] = $this->user->login;
				} else {
					setcookie('hash','',time()-3600,'/');
				}
			}
		}
		return isset($_SESSION['login']);
	}
	protected function isInserted() :bool {
		return isset($_POST['login']) && isset($_POST['pass']);
	}
	protected function info() :void {
		$login = strip_tags($this->getLogin());
		$this->user = User::getRowByProperty('login',$login);
		$this->params['user'] = $this->user;
		$this->params['menu'] = $this->menu;
		$this->params['links'] = $this->links;
		$this->params['scripts'] = array_merge($this->scripts,$this->shopVueScript);
		echo $this->actionRenderLayout('user_info',$this->params);
	}
	protected function login() {
		$login = strip_tags($_POST['login']);
		$pass = strip_tags($_POST['pass']);
		$save = isset($_POST['save']);
		$this->user = User::getRowByProperty('login',$login);
		$this->user->pass = $pass;
		if ($this->user->validation()) {
			$_SESSION['login'] = $login;
			if ($save) {
				$this->user->session_hash = uniqid('',true);
				$this->user->saveRowByID();
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
		$this->params['menu'] = $this->menu;
		$this->params['links'] = $this->links;
        $this->params['scripts'] = array_merge($this->scripts,$this->shopVueScript);
        echo $this->actionRenderLayout('login_form',$this->params);
    }
	public function actionRegister() :void {
		$login = strip_tags($_POST['login']);
		$pass = strip_tags($_POST['pass']);
		if (empty(User::getTableByProperty('login',$login))) {
			$user = new User(null,$login,$pass);
			$user->password_hash = password_hash($pass,PASSWORD_DEFAULT);
			$user->session_hash = '';
			$user->createRow();
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
}