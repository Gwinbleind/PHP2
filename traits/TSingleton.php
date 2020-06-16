<?php


namespace app\traits;


use app\services\Db;

trait TSingleton
{
    /**
     * @var Db|null
     */
    protected static $instance = null;
    //Закрываем все способы создания объекта
    private function __construct(){}
    public function __wakeup(){}
    public function __clone(){}
    //Пишем свой способ
    /**
     * @return static
     */
    public static function getInstance() :Db
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        self::$instance::getConnection();
        return self::$instance;
    }
}