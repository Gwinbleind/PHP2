<?php


namespace app\models;


use app\interfaces\IRecord;

class Category extends Record implements IRecord
{
    protected string $name;

    public static function getTableName() :string
    {
        return 'categories';
    }

	public function __construct(string $name = '', $id = null)
	{
		parent::__construct($id);
		$this->name = $name;
	}
}