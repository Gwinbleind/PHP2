<?php

include realpath("../services/Autoloader.php");
spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);


$product = new \app\models\Product(3);
$product->getRowByID();
$product->category = 1;
var_dump($product->updateRow());
