<?php

class Product
{
    public $id;
    public $name;
    public $price;
    public $amount;
    public $category;
    public $img_small;
    public $img_medium;
    public $img_large;

    /**
     * Product constructor.
     * @param $id
     * @param $name
     * @param $price
     * @param $amount
     * @param $category
     * @param $img_small
     * @param $img_medium
     * @param $img_large
     */
    public function __construct($id = null, $name = null, $price = 0, $amount = 1, $category = null, $img_small = '', $img_medium = '', $img_large = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->amount = $amount;
        $this->category = $category;
        $this->img_small = $img_small;
        $this->img_medium = $img_medium;
        $this->img_large = $img_large;
    }

    //Рендер мини-ячейки продукта в выпадающей корзине
    public function renderMiniCartItem()
    {
        return "<div class=\"cart__product\">
            <img src=\"{$this->img_small}\" alt=\"\" class=\"cart__prod_img\">
            <div class=\"cart__prod_title\">{$this->name}</div>
            <img src=\"img/stars5.jpg\" alt=\"stars\" class=\"cart__prod_stars\">
            <div class=\"cart__prod_price\">{$this->amount}&nbsp<span class=\"price_x\">x</span>&nbsp{$this->price}</div>
            <a @click.stop.prevent=\"handleByClick(id)\" href=\"#\">
                <i data-product__id=\"{$this->id}\" class=\"cart__prod_del fa fa-times-circle\"></i>
            </a>
        </div>";
    }
    //Рендер строки продукта на странице корзины
    public function renderCartItem()
    {
        return "<div class=\"product__element\">
            <a href=\"\" class=\"product__content\">
                <img class=\"product__img\" src=\"{$this->img_medium}\" alt=\"\">
                <div class=\"product__name\">{$this->name}</div>
                <div class=\"product__price\">{$this->price}.00</div>
            </a>
            <a href=\"#\" @click.stop.prevent=\"handleByClick(id)\" class=\"product__add\" data-product__id=\"{$this->id}\">Add to Cart</a>
            <img src=\"img/stars5.jpg\" alt=\"stars\" class=\"product__stars\">
        </div>";
    }
}

class Cloth extends Product {
    public $color;
    public $material;
    public $size;
    public $year;
    public $collection;
    public $description;

    /**
     * CustomProduct constructor.
     * @param null $id
     * @param null $name
     * @param int $price
     * @param int $amount
     * @param null $category
     * @param string $img_small
     * @param string $img_medium
     * @param string $img_large
     * @param $color
     * @param $material
     * @param $size
     * @param $year
     * @param $collection
     * @param $description
     */
    public function __construct($id = null, $name = null, $price = 0, $amount = 1, $category = null,
                                $img_small = '', $img_medium = '', $img_large = '', $color = null,
                                $material = null, $size = null, $year = null, $collection = null, $description = null)
    {
        parent::__construct($id,$name,$price,$amount,$category,$img_small,$img_medium,$img_large);
        $this->color = $color;
        $this->material = $material;
        $this->size = $size;
        $this->year = $year;
        $this->collection = $collection;
        $this->description = $description;
    }

    public function renderCartItem()
    {
        $information = "
            <div class=\"prod__text\">{$this->description}</div>
            <div class=\"prop__prop\">MATERIAL: <span class=\"prop__value\">{$this->material}</span></div>
            <div class=\"prop__prop\">COLOR: <span class=\"prop__value\">{$this->color}</span></div>
            <div class=\"prop__prop\">SIZE: <span class=\"prop__value\">{$this->size}</span></div>
            <div class=\"prop__prop\">COLLECTION: <span class=\"prop__value\">{$this->collection}</span></div>
        ";
        return parent::renderCartItem() . $information;
    }
}