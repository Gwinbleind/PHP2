<?php


namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\OrderInfo;
use app\models\Product;
use app\models\repositories\Repository;
use app\services\TemplateRenderer;

class CartController extends Controller
{
	protected array $cartArray;
	protected string $defaultAction = 'info';

	protected function getTotalCost()
	{
		$totalCost = 0;
		$productRepository = new Repository(Product::class);
		if (!empty($this->cartArray)) {
			foreach ($this->cartArray as $item) {
				/** @var Cart $item */
				$item->product = $productRepository->getRowByID($item->productId);
				$item->product->amount = $item->amount;
				$totalCost += $item->product->getCost();
			}
		}
		return $totalCost;
	}

	public function actionInfo() {
		$userController = new UserController(new TemplateRenderer());
		if ($userController->isAuthorised()) {
			$cartRepository = new Repository(Cart::class);
			$this->cartArray = $cartRepository->getTableByProperty('userId',$userController::getId());

			$totalCost = $this->getTotalCost();

			$this->params['cart'] = $this->cartArray;
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
	public function actionDelete() {
		$data = json_decode(file_get_contents('php://input'));
		$id = $data->id;

		$repo = new Repository(Cart::class);
		$cart = $repo->getRowByID($id);
		$response = $repo->deleteRowById($cart);

		header('Content-type: application/json');
		echo json_encode($response);
    }
	public function actionOrder() {
		$data = json_decode(file_get_contents('php://input'));
		$address = $data->address;
		$deliveryDate = $data->deliveryDate;

		$response = 0;
		$userController = new UserController(new TemplateRenderer());
		if ($userController->isAuthorised()) {
			$orderRepository = new Repository(Order::class);
			$orderInfoRepository = new Repository(OrderInfo::class);
			$cartRepository = new Repository(Cart::class);
			$productRepository = new Repository(Product::class);

			$userId = $userController::getId();
			$this->cartArray = $cartRepository->getTableByProperty('userId',$userId);
			$order = new Order($userId,$address,$deliveryDate,$this->getTotalCost());
			$response += $orderRepository->createRow($order);
			foreach ($this->cartArray as $cart) {
				/** @var Cart $cart */
				$cart->product = $productRepository->getRowByID($cart->productId);
				$orderInfo = new OrderInfo($order->id, $cart->productId, $cart->product->price, $cart->amount);
				$response += $orderInfoRepository->createRow($orderInfo);
			}
		}
		if ($response == count($this->cartArray)+1) {
			foreach ($this->cartArray as $cart) {
				$cartRepository->deleteRowById($cart);
			}
		}

		header('Content-type: application/json');
		echo json_encode($response);
    }
}