<?php


namespace app\interfaces;


interface IModel
{
    public static function getTableName() :string;
    //CRUD
    public function createRow();
    public static function getRowByID(int $id) :IModel;
    public function updateRow();
    public function deleteRow();
}