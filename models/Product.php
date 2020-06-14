<?php

namespace app\models;

use app\interfaces\IProduct;

class Product extends Model implements IProduct
{
    public $name;
    public $price;
    public $category;
    public $amount;

    public function __construct($id = null, $name = null, $price = null, $category = null)
    {
        parent::__construct($id);
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->amount = 1;
    }

    public function getTableName()
    {
        return 'catalog';
    }
    public function getCost()
    {
        return $this->price*$this->amount;
    }
}