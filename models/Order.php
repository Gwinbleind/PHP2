<?php


namespace app\models;


class Order extends Record
{
	protected int $userId;
	protected string $address;
	protected string $deliveryDate;
	protected int $cost;

	protected array $orderTable;

	public static function getTableName(): string
	{
		return 'orders';
	}
}