<?php

namespace app\models;

use app\interfaces\IProduct;

class Product extends Record implements IProduct
{
    protected $name;
    protected $price;
    protected $category;
    protected $amount;
    protected $imgSmall;
    protected $imgMedium;
    protected $imgLarge;
    protected $description;

    public function __construct($id = null, $name = null, $price = null, $category = null)
    {
        parent::__construct($id);
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->amount = 1;
    }

    public static function getTableName() :string
    {
        return 'catalog';
    }
    public function getCost()
    {
        return $this->price*$this->amount;
    }
}