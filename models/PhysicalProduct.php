<?php


namespace models;


class PhysicalProduct extends Product
{
    public ?int $amount;

    /**
     * PhysicalProduct constructor.
     * @param int|null $id
     * @param string|null $name
     * @param int|null $price
     * @param int|null $amount
     * @param string|null $category
     */
    public function __construct(int $id = null, string $name = null, int $price = null, int $amount = null, string $category = null)
    {
        parent::__construct($id, $name, $price, $category);
        $this->amount = $amount;
    }

}