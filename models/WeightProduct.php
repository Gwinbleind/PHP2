<?php


namespace models;


class WeightProduct extends Product
{
    public ?float $amount;

    /**
     * WeightProduct constructor.
     * @param int|null $id
     * @param string|null $name
     * @param int|null $price
     * @param float|null $amount
     * @param string|null $category
     */
    public function __construct(int $id = null, string $name = null, int $price = null, float $amount = null, string $category = null)
    {
        parent::__construct($id, $name, $price, $category);
        $this->amount = $amount;
    }

}