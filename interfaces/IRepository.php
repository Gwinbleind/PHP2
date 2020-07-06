<?php


namespace app\interfaces;


use app\models\Record;

interface IRepository
{
    public function getTableName() :string;

	public function getFullTable() :array;
	public function getTableByProperty(string $name, string $value) :array;
	public function getRowByProperty(string $name, string $value) :IRecord;
    //CRUD
    public function createRow(Record $record);
    public function getRowByID(int $id) :IRecord;
//    public function updateRowByID();
    public function saveRowByID(Record $record);
    public function deleteRowById(Record $record);
}