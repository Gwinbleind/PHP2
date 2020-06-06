<?php

namespace models;

use interfaces\IProduct;
use services\Db;

abstract class Product extends Model implements IProduct
{
    public ?int $id;
    public ?string $name;
    public ?int $price;
    public ?string $category;

    /**
     * Product constructor.
     * @param int|null $id
     * @param string|null $name
     * @param int|null $price
     * @param string|null $category
     */
    public function __construct(int $id = null, string $name = null, int $price = null, string $category = null)
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