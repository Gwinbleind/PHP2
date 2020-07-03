<?php


namespace app\models;


use app\interfaces\IRecord;

class OrderInfo extends Record implements IRecord
{
	protected int $orderId;
	protected int $productId;
	protected int $amount;
	protected Product $product;

	public function __construct(int $orderId = 0, int $productId = 0, int $amount = 0, $id = null)
	{
		parent::__construct($id);
		$this->orderId = $orderId;
		$this->productId = $productId;
		$this->amount = $amount;
	}

	public static function getTableName(): string
	{
		return 'orders_info';
	}


}