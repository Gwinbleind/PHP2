<?php
include 'classes.php';
$product1 = new Product(1, 'Майка',150,1,'men','img/product_mini/Product_1.png','img/Product_1.png');
$product2 = new Cloth(2,'Блузка',200,1,'women','img/product_mini/Product_2.png','img/Product_2.png',
   '','red','silk','XS',2019,'Bindburhan');
$cart1 = $product1->renderCartItem();
$miniCart1 = $product1->renderMiniCartItem();
$cart2 = $product2->renderCartItem();
$miniCart2 = $product2->renderMiniCartItem();
?>
<h2>Класс Product - базовая информация о товаре</h2>
<h3>Элемент страницы каталога</h3>
<?=$cart1?>
<h3>Элемент выпадающей корзины</h3>
<?=$miniCart1?>
Класс Cloth - дополнительная инфо об одежде - описание/коллекция/материал/размер
<h3>Элемент страницы каталога</h3>
<?=$cart2?>
<h3>Элемент выпадающей корзины</h3>
<?=$miniCart2?>