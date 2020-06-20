<?php


namespace app\models;


use app\interfaces\IRecord;
use app\services\Db;

abstract class Record implements IRecord
{
    public ?int $id;
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
    protected static function prepareCondition(string $condition = null) :string {
        if (!empty($condition)|$condition == 0) {
            return ' WHERE ' . $condition;
        } else {
            return '';
        }
    }

    //CRUD
    protected function getCreateSqlString()
    {
        $sql = "INSERT INTO `%s` (%s) VALUES (%s)";
        return sprintf($sql,static::getTableName(),$this->getStringOfColumns(),$this->getStringOfFillers());
    }
    protected static function getReadSqlString(string $condition = '1')
    {
        $condition = self::prepareCondition($condition);
        $sql = "SELECT * FROM `%s`" . $condition;
        return sprintf($sql,static::getTableName());
    }
    protected function getUpdateSqlString(string $condition = '0')
    {
        $condition = self::prepareCondition($condition);
        $sql = "UPDATE `%s` SET %s" . $condition;
        return sprintf($sql,static::getTableName(),$this->getStringOfParams());
    }
    protected function getDeleteSqlString(string $condition = '0')
    {
        $condition = self::prepareCondition($condition);
        $sql = "DELETE FROM `%s`" . $condition;
        if (!empty($condition)) {
            return sprintf($sql,static::getTableName());
        } else {
            return $sql . ' WHERE 0';
        }
    }
    //Create
    public function createRow() {
        $sql = $this->getCreateSqlString();
        Db::getInstance()->execute($sql,$this->getArrayOfParams());
        $this->id = Db::getInstance()->getLastId();
    }
    //Read
    public static function getFullTable() :array {
        $sql = self::getReadSqlString();
        return Db::getInstance()->queryArray(get_called_class(),$sql);
    }
    public static function getTableByProperty(string $name, string $value) :array {
        $condition = "`{$name}` = :{$name}";
        $sql = self::getReadSqlString($condition);
//        var_dump($sql);
        return Db::getInstance()->queryArray(get_called_class(),$sql,[
            ":{$name}"=>$value
        ]);
    }
    public static function getRowByProperty(string $name, string $value) :Record {
        $condition = "`{$name}` = :{$name}";
        $sql = self::getReadSqlString($condition);
        return Db::getInstance()->queryOne(get_called_class(),$sql, [
            ":{$name}"=>$value
        ]);
    }
    public static function getRowByID(int $id) :Record {
//        $sql = self::getReadSqlString("`id` = :id");
//        return Db::getInstance()->queryOne(get_called_class(),$sql, [
//            ':id'=>$id
//        ]);
        return self::getRowByProperty('id',$id);
    }
    //Update
    public function updateRowByID()
    {
        $sql = $this->getUpdateSqlString();
        $arrayOfParams = array_merge($this->getArrayOfParams(),[':id'=>$this->id]);
        return Db::getInstance()->execute($sql,$arrayOfParams);
    }
    //Delete
    public function deleteRowById() {
        $sql = $this->getDeleteSqlString("`id` = :id");
        return Db::getInstance()->execute($sql,[':id'=>$this->id]);
    }
}