<?php

include realpath("../services/Autoloader.php");
spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);


$product = Product::getRowByID(1);
$product->readRowById();
var_dump($product);
//$product->category = 1;
//var_dump($product->updateRow());
