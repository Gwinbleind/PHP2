<?php


namespace app\interfaces;


interface IRecord
{
    public static function getTableName() :string;
    //CRUD
    public function createRow();
    public static function getRowByID(int $id) :IRecord;
    public function updateRowByID();
    public function deleteRowById();
}