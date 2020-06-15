<?php


namespace app\interfaces;


interface IModel
{
    public function getTableName();
    //CRUD
    public function createRow();
    public function getRowByID();
    public function updateRow();
    public function deleteRow();
}