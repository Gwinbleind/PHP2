<?php

use app\models\Product;
use app\services\Autoloader;

include realpath("../services/Autoloader.php");
spl_autoload_register([new Autoloader(), 'loadClass']);


$product = Product::getRowByID(1);
var_dump($product);
//$product->category = 1;
//var_dump($product->updateRow());
