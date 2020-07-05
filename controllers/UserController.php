<?php


namespace app\controllers;


use app\interfaces\IUserController;
use app\models\Order;
use app\models\OrderInfo;
use app\models\Product;
use app\models\repositories\Repository;
use app\models\User;
use app\services\Request;

class UserController extends Controller implements IUserController
{
    protected string $defaultAction = 'try';
    protected User $user;

	protected static function getLogin() :string {
		return $_SESSION['login'];
	}

	public static function getId() {
		return $_SESSION['id'];
	}
	public function isAuthorised() :bool {
		if (!isset($_SESSION['login'])) {
			if (isset($_COOKIE['hash'])) {
				$hash = $_COOKIE['hash'];
				//Запрос от БД на существование юзера с таким хэшем
				$userRepository = new Repository(User::class);
				/** @var User $user */
				$user = $userRepository->getRowByProperty("session_hash", $hash);
				$this->setUser($user);
				$login = $this->user->login;
				if (isset($login)) {
					$_SESSION['login'] = $login;
					$_SESSION['id'] = $this->user->id;
				} else {
					setcookie('hash','',time()-3600,'/');
				}
			}
		} else {
			$userRepository = new Repository(User::class);
			$login = $_SESSION['login'];
			/** @var User $user */
			$user = $userRepository->getRowByProperty("login", $login);
			$this->setUser($user);
			//TODO: getlogin
		}
		return isset($_SESSION['login']);
	}
	protected function isInserted() :bool {
		$request = new Request();
		$login = $request->post('login');
		$pass = $request->post('pass');
		return isset($login) && isset($pass);
	}
	protected function info() :void {
		$login = strip_tags(static::getLogin());

		$userRepository = new Repository(User::class);
		$productRepository = new Repository(Product::class);
		$orderInfoRepository = new Repository(OrderInfo::class);
		$orderRepository = new Repository(Order::class);
		/** @var User $user */
		$user = $userRepository->getRowByProperty('login', $login);
		$this->setUser($user);
		$orders = $orderRepository->getTableByProperty('userId', self::getId());
		foreach ($orders as $order) {
			/** @var Order $order */
			$order->orderTable = $orderInfoRepository->getTableByProperty('orderId',$order->id);
			foreach ($order->orderTable as $orderInfo) {
				$orderInfo->product = $productRepository->getRowByID($orderInfo->productId);
			}
		}

		$this->params['user'] = $this->user;
		$this->params['orders'] = $orders;
		$this->prepareParams();
		echo $this->actionRenderLayout('user_info');
	}
	protected function login() {
		$request = new Request();
		$login = $request->post('login');
		$pass = $request->post('pass');
		$save = $request->post('save');
		$save = isset($save);
		$userRepository = new Repository(User::class);
		/** @var User $user */
		$user = $userRepository->getRowByProperty('login', $login);
		$this->setUser($user);
		$this->user->pass = $pass;
		if ($this->user->validation()) {
			$_SESSION['login'] = $login;
			$_SESSION['id'] = $this->user->id;
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
		$request = new Request();
		$login = $request->post('login');
		$pass = $request->post('pass');
		$repo = new Repository(User::class);
		if (empty($repo->getTableByProperty('login',$login))) {
			$user = new User($login,$pass);
			$user->password_hash = password_hash($pass,PASSWORD_DEFAULT);
			$user->session_hash = '';
			$repo->createRow($user);
		}
		header("Location: /?c=user");
	}
	public function actionLogout() :void {
		unset($_COOKIE['hash']);
		setcookie('hash','',time()-3600,'/');
		unset($_SESSION['login']);
		unset($_SESSION['id']);
		header("Location: /?c=user");
	}

	public function setUser(User $user): UserController
	{
		if (!isset($this->user)) {
			$this->user = $user;
		}
		return $this;
	}
}