<?php
include realpath("../services/Autoloader.php");

spl_autoload_register([new services\Autoloader(), 'loadClass']);

$product1 = new \models\PhysicalProduct();
$product1->getRowByID(1);
$product1->amount = 2;

$product2 = new \models\InternetProduct();
$product2->getRowByID(2);
$product2->amount = 3;

$product3 = new \models\WeightProduct();
$product3->getRowByID(3);
$product3->amount = 3.3;

?>
<p>Физический продукт: <?=$product1->price?> * <?=$product1->amount?> = <?=$product1->getCost();?> руб</p>
<p>Интернет-продукт: <?=$product2->price?> * <?=$product2->amount?> / 2 = <?=$product2->getCost();?> руб</p>
<p>Весовой продукт: <?=$product3->price?> * <?=$product3->amount?> = <?=$product3->getCost();?> руб</p>