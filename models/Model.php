<?php


namespace app\models;


use app\interfaces\IModel;
use app\services\Db;

abstract class Model implements IModel
{
    public $id;
    public Db $database;
    protected array $changed = [];
    protected array $hiddenProps = [
        'hiddenProps',
        'database',
        'id',
        'changed'
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
    protected function getStringOfParams()
    {
        //TODO: Переписать для вывода только измененных параметров
        $columns = $this->getArrayOfColumns();
        $fillers = $this->getArrayOfFillers();
        $result = array_map(function ($column, $filler) {
            return "`{$column}`={$filler}";
        },$columns,$fillers);
        return implode(', ',$result);
    }

    //CRUD
    protected function getCreateSqlString()
    {
        $sql = "INSERT INTO `%s` (%s) VALUES (%s)";
        return sprintf($sql,$this->getTableName(),$this->getStringOfColumns(),$this->getStringOfFillers());
    }
    protected function getReadSqlString()
    {
        $sql = "SELECT * FROM `%s` WHERE `id` = :id";
        return sprintf($sql,$this->getTableName());
    }
    protected function getUpdateSqlString()
    {
        $sql = "UPDATE `%s` SET %s WHERE `id` = :id";
        return sprintf($sql,$this->getTableName(),$this->getStringOfParams());
    }
    protected function getDeleteSqlString()
    {
        $sql = "DELETE FROM `%s` WHERE `id` = :id";
        return sprintf($sql,$this->getTableName());
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
        $sql = $this->getReadSqlString();
        $product = $this->database->queryOne($sql, [
            ':id'=>$this->id
        ]);
        foreach ($this->getArrayOfColumns() as $key) {
            $this->$key = $product[$key];
        }
    }
    //Update
    public function updateRow()
    {
        $sql = $this->getUpdateSqlString();
        $arrayOfParams = array_merge($this->getArrayOfParams(),[':id'=>$this->id]);
        return $this->database->execute($sql,$arrayOfParams);
    }
    //Delete
    public function deleteRow() {
        //TODO: Finish Delete
        $sql = $this->getDeleteSqlString();
        return $this->database->execute($sql,[':id'=>$this->id]);
    }
}