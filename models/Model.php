<?php


namespace app\models;


use app\interfaces\IModel;
use app\services\Db;

abstract class Model implements IModel
{
    public $id;
    protected array $changed = [];
    protected static array $arrayOfColumns = [];
    protected static array $hiddenProps = [
        'hiddenProps',
        'database',
        'id',
        'changed',
        'arrayOfColumns',
    ];

    public function __construct($id = null)
    {
        $this->id = $id;
    }
    public static function getTableName() :string
    {
        return "";
    }

    //Автосоздание списков колонок, плейсхолдеров и значений
    protected function getArrayOfColumns()
    {
        //массив всех параметров объекта
        if (empty(self::$arrayOfColumns)) {
            foreach ($this as $key => $value) {
                if (!in_array($key,self::$hiddenProps)) {
                    self::$arrayOfColumns[] = $key;
                }
            }
        }
        return self::$arrayOfColumns;
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
            if (!in_array($key,self::$hiddenProps)) {
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
        return sprintf($sql,static::getTableName(),$this->getStringOfColumns(),$this->getStringOfFillers());
    }
    protected static function getReadSqlString()
    {
        $sql = "SELECT * FROM `%s` WHERE `id` = :id";
        return sprintf($sql,static::getTableName());
    }
    protected function getUpdateSqlString()
    {
        $sql = "UPDATE `%s` SET %s WHERE `id` = :id";
        return sprintf($sql,static::getTableName(),$this->getStringOfParams());
    }
    protected function getDeleteSqlString()
    {
        $sql = "DELETE FROM `%s` WHERE `id` = :id";
        return sprintf($sql,static::getTableName());
    }
    //Create
    public function createRow() {
        $sql = $this->getCreateSqlString();
        Db::getInstance()->execute($sql,$this->getArrayOfParams());
        $this->id = Db::getInstance()->getLastId();
    }
    //Read
    public static function getFullTable() :array {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM `{$tableName}`";
        return Db::getInstance()->queryArray(get_called_class(),$sql);
    }
    public static function getRowByID(int $id) :Model {
        $sql = self::getReadSqlString();
        return Db::getInstance()->queryOne(get_called_class(),$sql, [
            ':id'=>$id
        ]);
    }
    public function readRowById()
    {
        $product = self::getRowByID($this->id);
        foreach (self::getArrayOfColumns() as $key) {
            $this->$key = $product->$key;
        }
    }
    //Update
    public function updateRow()
    {
        $sql = $this->getUpdateSqlString();
        $arrayOfParams = array_merge($this->getArrayOfParams(),[':id'=>$this->id]);
        return Db::getInstance()->execute($sql,$arrayOfParams);
    }
    //Delete
    public function deleteRow() {
        $sql = $this->getDeleteSqlString();
        return Db::getInstance()->execute($sql,[':id'=>$this->id]);
    }
}