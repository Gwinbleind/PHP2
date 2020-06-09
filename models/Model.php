<?php


namespace models;


use interfaces\IModel;
use services\Db;

abstract class Model implements IModel
{
    protected $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getFullTable() {
        $query = "SELECT * FROM `{$this->getTableName()}`";
        var_dump($query);
        return $this->db->getArray($query);

    }
    public function getRowByID(int $id) {
        $query = "SELECT * FROM `{$this->getTableName()}` WHERE `id`={$id}";
        return $this->db->getArray($query)[0];
    }

}