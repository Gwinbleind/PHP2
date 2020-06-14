<?php


namespace app\models;


use app\interfaces\IModel;
use app\services\Db;

abstract class Model implements IModel
{
    public $id;
    public Db $database;
    protected array $hiddenProps = [
        'hiddenProps',
        'database',
        'id'
    ];

    public function __construct($id = null)
    {
        $this->id = $id;
        $this->database = Db::getInstance();
        $this->database->getConnection();
    }

    //Автосоздание списков колонок, плейсхолдеров и значений
    protected function getArrayOfColumns()
    {
        $columns = [];
        foreach ($this as $key => $value) {
            if (!in_array($key,$this->hiddenProps)) {
                $columns[] = $key;
            }
        }
        return $columns;
    }
    protected function getArrayOfFillers()
    {
        $fillers = $this->getArrayOfColumns();
        foreach ($fillers as &$column) {
            $column = ":{$column}";
        }
        return $fillers;
    }
    protected function getArrayOfValues()
    {
        $values = [];
        foreach ($this as $key => $value) {
            if (!in_array($key,$this->hiddenProps)) {
                $values[] = $value;
            }
        }
        return $values;
    }
    protected function getArrayOfParams()
    {
        $keys = $this->getArrayOfFillers();
        $values = $this->getArrayOfValues();
        return array_combine($keys, $values);
    }
    protected function getStringOfColumns() {
        $columns = $this->getArrayOfColumns();
        foreach ($columns as &$key) {
            $key = "`{$key}`";
        }
        return implode(', ',$columns);
    }
    protected function getStringOfFillers()
    {
        $fillers = $this->getArrayOfFillers();
        return implode(', ',$fillers);
    }

    //CRUD
    protected function getCreateSqlString()
    {
        $sql = "INSERT INTO `%s` (%s) VALUES (%s)";
        return sprintf($sql,$this->getTableName(),$this->getStringOfColumns(),$this->getStringOfFillers());
    }
    protected function getReadSqlString()
    {
        $sql = "INSERT INTO `%s` (%s) VALUES (%s)";
        sprintf($sql,$this->getTableName(),$this->getStringOfColumns(),$this->getStringOfFillers());
        return;
    }
    protected function getUpdateSqlString()
    {
        $sql = "INSERT INTO `%s` (%s) VALUES (%s)";
        sprintf($sql,$this->getTableName(),$this->getStringOfColumns(),$this->getStringOfFillers());
        return;
    }
    protected function getDeleteSqlString()
    {
        $sql = "INSERT INTO `%s` (%s) VALUES (%s)";
        sprintf($sql,$this->getTableName(),$this->getStringOfColumns(),$this->getStringOfFillers());
        return;
    }
    //Create
    public function createRow()
    {
        $sql = $this->getCreateSqlString();
        $this->database->execute($sql,$this->getArrayOfParams());
        $this->id = $this->database->getLastId();
    }
    //Read
    public function getFullTable() {
        $sql = "SELECT * FROM `{$this->getTableName()}`";
        return $this->database->queryArray($sql);
    }
    public function getRowByID() {
        $sql = "SELECT * FROM `{$this->getTableName()}` WHERE `id` = :id";
        $product = $this->database->queryOne($sql, [
            ':id'=>$this->id
        ]);
        foreach ($this->getArrayOfColumns() as $key) {
            $this->$key = $product[$key];
        }
    }
    //Update
    //Delete
}