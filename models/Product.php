<?php

namespace app\models;

use app\interfaces\IProduct;

class Product extends Model implements IProduct
{
    public $id;
    public $name;
    public $price;
    public $category;
    public $amount;

    public function __construct($id = null, $name = null, $price = null, $category = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
    }

    public function getTableName()
    {
        return 'catalog';
    }
    public function getRowByID(int $id)
    {
        $product = parent::getRowByID($id);
        $this->id = $id;
        $this->name = $product['name'];
        $this->price = $product['price'];
        $this->amount = $product['amount'];
        $this->category = $product['category'];
    }
    public function getCost()
    {
        return $this->price*$this->amount;
    }

}