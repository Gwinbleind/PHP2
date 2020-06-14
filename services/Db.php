<?php


namespace app\services;

use app\config\Tdb;
use app\traits\TSingleton;
use PDO;

class Db
{
    use TSingleton, Tdb;
    
    /**
     * @var PDO|null
     */
    public $pdo = null;

    protected function getDsnString()
    {
        return sprintf(
            '%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['dbname'],
            $this->config['charset'],
        );
    }
    public function getConnection()
    {
        if (is_null($this->pdo)) {
            $this->pdo = new PDO(
                $this->getDsnString(),
                $this->config['user'],
                $this->config['pass']
            );
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        return $this->pdo;
    }
    //Low-level
    public function getLastId()
    {
        return $this->pdo->lastInsertId();
    }
    public function query(string $sql, array $params = [])
    {
        //готовим запрос
        $pdoStatement = $this->pdo->prepare($sql);
        //выполняем запрос, подставляя массив параметров
        $pdoStatement->execute($params);
        var_dump($pdoStatement->errorInfo());
        //возвращаем подготовленный запрос
        return $pdoStatement;
    }
    public function execute(string $sql, array $params = [])
    {
        //возвращает количество строк в ответе запроса
        return $this->query($sql,$params)->columnCount();
    }
    public function queryArray(string $sql, array $params = [])
    {
        return $this->query($sql,$params)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function queryOne(string $sql, array $params = [])
    {
        return $this->queryArray($sql,$params)[0];
    }
}