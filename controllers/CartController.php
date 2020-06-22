<?php


namespace app\controllers;


use app\models\Cart;
use app\models\Product;
use app\traits\TSingletonController;

class CartController extends Controller
{
    use TSingletonController;
    protected $defaultAction = 'info';
    public function actionInfo() {
        $userId = $_GET['userid'];
        $cart = Cart::getTableByProperty('userId',$userId);
        $totalCost = 0;
        foreach ($cart as $item) {
            /** @var Cart $item */
            $item->product = Product::getRowByID($item->productId);
            $item->product->amount = $item->amount;
            $totalCost += $item->product->getCost();
        }
        $this->params['cart'] = $cart;
        //TODO: Не очень красиво передавать общую сумму отдельной переменной?
        $this->params['totalCost'] = $totalCost;
        $this->params['menu'] = $this->menu;
        $this->params['links'] = $this->links;
        $this->params['scripts'] = $this->scripts;
        echo $this->actionRenderLayout('cart',$this->params);
    }
    public function actionMini()
    {
        //TODO: Доделать выпадающую корзину
    }
}