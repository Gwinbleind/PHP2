<?php


namespace app\models;


use app\interfaces\IModel;
use app\services\Db;

abstract class Model implements IModel
{
    protected Db $database;

    public function __construct()
    {
        $this->database = Db::getInstance();
        $this->database->getConnection();
    }

    public function getFullTable() {
        $sql = "SELECT * FROM `{$this->getTableName()}`";
        return $this->database->queryArray($sql);
    }
    public function getRowByID(int $id) {
        $sql = "SELECT * FROM `{$this->getTableName()}` WHERE `id` = :id";
        return $this->database->queryOne($sql, [':id'=>$id])[0];
    }

}