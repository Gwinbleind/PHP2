<?php


namespace app\services;

use app\config\Tdb;
use app\models\Record;
use app\traits\TSingletonDb;
use PDO;

class Db
{
    use TSingletonDb, Tdb;
    
    /**
     * @var PDO|null
     */
    public static $pdo = null;

    protected static function getDsnString()
    {
        return sprintf(
            '%s:host=%s;dbname=%s;charset=%s',
            self::$config['driver'],
            self::$config['host'],
            self::$config['dbname'],
            self::$config['charset'],
        );
    }
    public static function getConnection()
    {
        if (is_null(self::$pdo)) {
            self::$pdo = new PDO(
                self::getDsnString(),
                self::$config['user'],
                self::$config['pass']
            );
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_CLASS);
        }
        return self::$pdo;
    }
    //Low-level
    public function getLastId()
    {
        return self::$pdo->lastInsertId();
    }
    public function query(string $sql, array $params = [])
    {
        //готовим запрос
        $pdoStatement = self::$pdo->prepare($sql);
        //выполняем запрос, подставляя массив параметров
        $pdoStatement->execute($params);
//        var_dump($pdoStatement->errorInfo());
        //возвращаем подготовленный запрос
        return $pdoStatement;
    }
    public function execute(string $sql, array $params = [])
    {
        //возвращает количество строк в ответе запроса
        return $this->query($sql,$params)->columnCount();
    }
    public function queryArray($classname, string $sql, array $params = [])
    {
        $pdoStatement = $this->query($sql,$params);
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,$classname);
        return $pdoStatement->fetchAll();
    }
    public function queryOne($classname, string $sql, array $params = []) :Record
    {
        return $this->queryArray($classname, $sql,$params)[0];
    }
}