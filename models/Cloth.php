<?php

namespace models;

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