<?php


namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\Product;
use app\models\repositories\Repository;
use app\services\TemplateRenderer;

class CartController extends Controller
{
	protected Cart $cart;
	protected string $defaultAction = 'info';
    public function actionInfo() {
		session_start();
//		$userController = new UserController(new TemplateRenderer());
		$userController = new UserController(new TemplateRenderer());
		if ($userController->isAuthorised()) {
//			$userId = $_GET['userid'];
			$cartRepository = new Repository(Cart::class);
			$cart = $cartRepository->getTableByProperty('userId',$userController->getId());
			$totalCost = 0;
			$productRepository = new Repository(Product::class);
			if (!empty($cart)) {
				foreach ($cart as $item) {
					/** @var Cart $item */
					$item->product = $productRepository->getRowByID($item->productId);
					$item->product->amount = $item->amount;
					$totalCost += $item->product->getCost();
					$this->params['cart'] = $cart;
				}
			} else {
				$this->params['cart'] = $cart;
			}
        $this->params['totalCost'] = $totalCost;
        $this->prepareParams();
        echo $this->actionRenderLayout('cart');
		} else {
			header('Location: /?c=user');
		}
    }
    public function actionMini()
    {
        //TODO: Доделать выпадающую корзину
    }

	public function actionUpdate()
	{
		$data = json_decode(file_get_contents('php://input'));
		$id = $data->id;
		$amount = $data->amount;

		$repo = new Repository(Cart::class);
		$cart = $repo->getRowByID($id);
		$cart->amount = $amount;
		$response = $repo->saveRowByID($cart);

		header('Content-type: application/json');
		echo json_encode($response);
    }
	public function actionDelete()
	{
		$data = json_decode(file_get_contents('php://input'));
		$id = $data->id;

		$repo = new Repository(Cart::class);
		$cart = $repo->getRowByID($id);
		$response = $repo->deleteRowById($cart);

		header('Content-type: application/json');
		echo json_encode($response);
    }
	public function actionOrder()
	{
		//TODO: Order
		$data = json_decode(file_get_contents('php://input'));
		$userId = $data->userId;

		$repo = new Repository(Order::class);
		$user = $repo->getRowByID($userId);
		$response = $repo;

		header('Content-type: application/json');
		echo json_encode($response);
    }
}