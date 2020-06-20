<?php

use app\controllers\Controller;
use app\services\Autoloader;

include realpath("../services/Autoloader.php");
spl_autoload_register([new Autoloader(), 'loadClass']);

//http://php2?c=product&a=card&id=1                 Один продукт
//http://php2/?c=product&a=catalog                  Каталог
//http://php2/?c=user&a=info&login=admin&pass=123   Юзер
//http://php2?c=cart&a=info&userid=1                Корзина

$controllerName = 'app\\controllers\\' . ucfirst($_GET['c'] ?: 'page') . 'Controller';
$action = $_GET['a'];
if (class_exists($controllerName)) {
    /** @var $controller Controller */
    $controller = new $controllerName;
    $controller->runAction($action);
} else {
    die('Missing controller ' . $controllerName);
}