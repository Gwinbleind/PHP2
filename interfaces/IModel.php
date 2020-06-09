<?php


namespace interfaces;


interface IModel
{
    public function getTableName();
    public function getRowByID(int $id);
}