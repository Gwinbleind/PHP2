<?php
/** @var User $user
 * @var array $orders
 * @var Order $order
 * @var Product $product
 * @var OrderInfo $orderInfo
 */

use app\models\Order;
use app\models\OrderInfo;
use app\models\Product;
use app\models\User;

?>
<div class="container category_flex">
	<div>
		<p class="footer__link">Username: <?= $user->login ?></p>
		<p class="footer__link">Password hash: <?= $user->password_hash ?></p>
		<p class="footer__link">Password: <?= $user->pass ?></p>
		<div class="button button_login div_flex" @click="logoutClickHandler">Logout</div>
	</div>
	<div class="products">
		<h2>Orders:</h2>
	   <? if (!empty($orders)): ?>
			 <div>
			  <? foreach ($orders as $key => $order): ?>
			  <h3>№<?=$key+1?></h3>
					  <p>Address: <?= $order->address ?></p>
					  <p>Delivery Date: <?= $order->deliveryDate ?></p>
				  <? foreach ($order->orderTable as $orderInfo): ?>
						  <div>
							  <p>Amount: <?= $orderInfo->amount ?></p>
							  <p>Name: <?= $orderInfo->product->name ?></p>
							  <img src="<?= $orderInfo->product->imgSmall ?>" alt="">
						  </div>
				  <? endforeach; ?>
					  <p>Total cost: <?= $order->cost ?></p>
			  <? endforeach; ?>
			 </div>
	   <? endif; ?>
	</div>
</div>