<?php


namespace app\models;


use app\interfaces\IRecord;

class Order extends Record implements IRecord
{
	protected ?int $userId;
	protected ?string $address;
	protected ?string $deliveryDate;
	protected ?int $cost;

	protected array $orderTable = [];

	public static function getTableName(): string
	{
		return 'orders';
	}

	public function __construct(int $userId = null, string $address = '', string $deliveryDate = '', int $cost = 0, $id = null)
	{
		parent::__construct($id);
		$this->userId = $userId;
		$this->address = $address;
		$this->deliveryDate = $deliveryDate;
		$this->cost = $cost;
	}
}