<?php

use app\controllers\Controller;
use app\exceptions\RecordException;
use app\services\Autoloader;
use app\services\TemplateRenderer;

include realpath("../services/Autoloader.php");
include realpath("../vendor/autoload.php");
spl_autoload_register([new Autoloader(), 'loadClass']);

//http://php2?c=product&a=card&id=1                 Один продукт
//http://php2/?c=product&a=catalog                  Каталог
//http://php2/?c=user								Юзер
//http://php2?c=cart&a=info&userid=1                Корзина

$controllerName = 'app\\controllers\\' . ucfirst($_GET['c'] ?: 'product') . 'Controller';
$action = $_GET['a'];
if (class_exists($controllerName)) {
	/** @var $controller Controller */
	$controller = new $controllerName(new TemplateRenderer());//    $controller = new $controllerName(new \app\services\TwigRenderer());
	//    $controller->useLayout = false;
	try {
		$controller->runAction($action);
	} catch (RecordException $e) {
		$c = new Controller(new TemplateRenderer());
		$c->actionException($e);
	} catch (\Exception $e) {
		$c = new Controller(new TemplateRenderer());
		$c->actionException($e);
	}
} else {
	$c = new Controller(new TemplateRenderer());
	$c->actionException(new Exception('page not found'));
}