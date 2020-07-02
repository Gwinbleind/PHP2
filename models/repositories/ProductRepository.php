<?php


namespace app\models\repositories;


use app\models\Product;

class ProductRepository extends Repository
{
	protected function getObjectClass(): string
	{
		return Product::class;
	}
	public function getTableName(): string
	{
		return 'catalog';
	}
}