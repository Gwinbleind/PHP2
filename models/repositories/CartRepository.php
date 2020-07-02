<?php


namespace app\models\repositories;


use app\models\Cart;

class CartRepository extends Repository
{
	protected function getObjectClass(): string
	{
		return Cart::class;
	}
	public function getTableName(): string
	{
		return 'cart';
	}
}