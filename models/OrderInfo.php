<?php


namespace app\models;


class OrderInfo extends Record
{
	protected int $orderId;
	protected int $productId;
	protected int $price;
	protected int $amount;

	public static function getTableName(): string
	{
		return 'orders_info';
	}
}