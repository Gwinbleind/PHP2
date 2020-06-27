<?php


namespace app\traits;


use app\controllers\Controller;

trait TSingletonController
{
    /**
     * @var Controller|null
     */
    protected static $instance = null;
    //Закрываем все способы создания объекта
    private function __construct(){}
    private function __wakeup(){}
    private function __clone(){}
    //Пишем свой способ
    /**
     * @return Controller static
     */
    public static function getInstance() :Controller
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}