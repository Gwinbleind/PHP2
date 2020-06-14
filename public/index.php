<?php

use app\models\Product;
use app\services\Autoloader;

include realpath("../services/Autoloader.php");

spl_autoload_register([new Autoloader(), 'loadClass']);

$product = new Product();
$product->getRowByID(1);
var_dump($product);