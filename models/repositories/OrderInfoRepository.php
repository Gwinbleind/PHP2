<?php


namespace app\models\repositories;


use app\models\OrderInfo;

class OrderInfoRepository extends Repository
{

	public function getTableName(): string
	{
		return "orders_info";
	}

	protected function getObjectClass(): string
	{
		return OrderInfo::class;
	}
}