<?php


namespace app\interfaces;


interface IModel
{
    public function getTableName();
    public function getRowByID(int $id);
}