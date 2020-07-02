<?php


namespace app\interfaces;


use app\models\Record;

interface IRepository
{
    public function getTableName() :string;

	public function getFullTable() :array;
	public function getTableByProperty(string $name, string $value) :array;
	public function getRowByProperty(string $name, string $value) :Record;
    //CRUD
    public function createRow(Record $record) :void;
    public function getRowByID(int $id) :Record;
//    public function updateRowByID();
    public function saveRowByID(Record $record);
    public function deleteRowById(Record $record);
}