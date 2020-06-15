<?php

include realpath("../services/Autoloader.php");
spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);


$product = new \app\models\Product(null,'testName',50,3);
var_dump($product->getStringOfParams());
