<?php


namespace app\models;


class Cart extends Record
{
    protected int $userId;
    protected int $productId;
    protected int $amount;
    protected Product $product;

    public function __construct($id = null, $amount = 1, $userId = 0, $productId = 0)
    {
        parent::__construct($id);
        $this->amount = $amount;
        $this->userId = $userId;
        $this->productId = $productId;
    }

	public static function getTableName(): string
	{
		return 'cart';
	}
}