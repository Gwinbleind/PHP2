<?php


namespace app\models;


use app\interfaces\IRecord;

class Cart extends Record implements IRecord
{
    protected int $userId;
    protected int $productId;
    protected int $amount;
    protected Product $product;

    public function __construct($userId = 0, $productId = 0, $amount = 1, $id = null)
    {
        parent::__construct($id);
		$this->userId = $userId;
		$this->productId = $productId;
		$this->amount = $amount;
    }

	public static function getTableName(): string
	{
		return 'cart';
	}
}