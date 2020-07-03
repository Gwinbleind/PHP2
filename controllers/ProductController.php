<?php


namespace app\controllers;


use app\models\Cart;
use app\models\Product;
use app\models\repositories\Repository;
use app\services\TemplateRenderer;

class ProductController extends Controller
{
	protected string $defaultAction = 'catalog';

    public function actionCard()
    {
        $id = $_GET['id'];
		$repo = new Repository(Product::class);
		$this->params['item'] = $repo->getRowByID($id);
        echo $this->prepareParams()->actionRenderLayout('product');
    }
    public function actionCatalog()
    {
		$repo = new Repository(Product::class);
		$this->params['catalog'] = $repo->getFullTable();
        $this->params['menu'] = $this->menu;
        echo $this->actionRenderLayout('catalog');
    }
    public function actionAdd() {
		$data = json_decode(file_get_contents('php://input'));
		$productId = $data->id;
		$response = 0;

		$userController = new UserController(new TemplateRenderer());
		$cartRepository = new Repository(Cart::class);
		if ($userController->isAuthorised()) {
			$userId = $userController::getId();
			$cart = $cartRepository->getTableBySomeProps(['userId' => $userId, 'productId' => $productId])[0];
			if (!empty($cart)) {
				$cart->amount += 1;
				$response = $cartRepository->saveRowByID($cart);
			} else {
				$cart = new Cart($userId,$productId,1);
				$response = $cartRepository->createRow($cart);
			}
		}

		header('Content-type: application/json');
		echo json_encode($response);
	}
}