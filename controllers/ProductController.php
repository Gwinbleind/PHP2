<?php


namespace app\controllers;


use app\models\Product;
use app\models\repositories\Repository;

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
}