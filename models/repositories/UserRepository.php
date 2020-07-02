<?php


namespace app\models\repositories;


use app\models\User;

class UserRepository extends Repository
{
	protected function getObjectClass(): string
	{
		return User::class;
	}
	public function getTableName(): string
	{
		return 'users';
	}
}