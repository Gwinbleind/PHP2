<?php


namespace app\controllers;


use app\models\Product;
use app\traits\TSingletonController;

class ProductController extends Controller
{
    use TSingletonController;
    protected $defaultAction = 'catalog';

    public function actionCard()
    {
        $id = $_GET['id'];
        $this->params['item'] = Product::getRowByID($id);
        $this->params['menu'] = $this->menu;
        $this->params['links'] = $this->links;
        $this->params['scripts'] = $this->scripts;
        echo $this->actionRenderLayout('product',$this->params);
    }
    public function actionCatalog()
    {
        $this->params['catalog'] = Product::getFullTable();
        $this->params['menu'] = $this->menu;
        $this->params['links'] = $this->links;
        $this->params['scripts'] = $this->scripts;
        echo $this->actionRenderLayout('catalog',$this->params);
    }
}