<?php


namespace app\services;

use app\config\Tdb;
use app\interfaces\IRecord;
use app\traits\TSingleton;
use PDO;

class Db
{
    use TSingleton, Tdb;
    
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
        return $this->query($sql,$params)->rowCount();
    }
    public function queryArray($classname, string $sql, array $params = [])
    {
        $pdoStatement = $this->query($sql,$params);
        $pdoStatement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,$classname);
		$res = $pdoStatement->fetchAll();
//		var_dump($res);
        return $res;
    }
    public function queryOne($classname, string $sql, array $params = []) :IRecord
    {
    	$record = $this->queryArray($classname, $sql,$params)[0];
    	if (is_null($record)) {
    		$record = new $classname();
//    		throw new RecordException('product not found');
		}
        return $record;
    }
}