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
    private function __wakeup(){}
    private function __clone(){}
    //Пишем свой способ
    /**
     * @return Db static
     */
    public static function getInstance() :Db
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}