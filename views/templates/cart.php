<?php /**
 * @var array $cart
 * @var Cart $item
 * @var int $totalCost
 */

use app\models\Cart; ?>
<div class="new__flex">
	<span class="new_left">New Arrivals </span>
	<span class="new_right">Home / Men / <span class="new_right_active">New Arrivals</span></span>
</div>
<div class="shop_table div_flex">
	<? if (!empty($cart)): ?>
		<? foreach ($cart as $item): ?>
			 <div class="shop_table__prodline">
				 <div class="shop_table__details div_colwrap">
					 <img src="<?= $item->product->imgMedium ?>" style="width: 100px;" alt="">
					 <div class="product__name product__name_cart"><?= $item->product->name ?></div>
					 <div class="product__prop">
						 Color: <span class="product__prop_value">Red</span>
						 <br>
						 Size: <span class="product__prop_value">Xll</span>
					 </div>
				 </div>
				 <div class="shop_table__property div_flex">$<?= $item->product->price ?></div>
				 <div class="shop_table__property div_flex">
					 <input data-id="<?= $item->id ?>" @change="cartAmountChangeHandler"
					        class="choose__box choose__box_cart" min="1" type="number" value="<?= $item->amount ?>">
				 </div>
				 <div class="shop_table__property div_flex">FREE</div>
				 <div class="shop_table__property div_flex">$<?= $item->product->getCost() ?></div>
				 <div class="shop_table__action div_flex">
					 <a href="">
						 <i data-id="<?= $item->id ?>" @click.stop.prevent="cartXClickHandler" class="fa fa-times-circle" aria-hidden="true"></i>
					 </a>
				 </div>
			 </div>
		<? endforeach; ?>
	<? else: ?>
		 Корзина пуста
	<? endif; ?>
	<div class="shop_table__flex">
		<div class="header_flex">
			<div class="button_goto div_flex">Clear shopping cart</div>
			<a href="/"><div class="button_goto div_flex">Continue Shopping</div></a>
		</div>
		<div class="form__box">
			<form id="shipping form" action="" class="shipping_form">
				<div class="shipping_form__h1">Shipping Adress</div>
				<select class="choose__box choose__box_ship" name="country" id="choose country" form="shipping form">
					<option value="1">Bangladesh</option>
					<option value="2">USA</option>
					<option value="3">United Kingdom</option>
					<option value="4">Gonduras</option>
					<option value="5">Russian Federation</option>
				</select>
				<input class="choose__box choose__box_ship" type="text" form="shipping form" id="choose State"
				       placeholder="State">
				<input class="choose__box choose__box_ship" type="text" form="shipping form" id="choose ZIP"
				       placeholder="Postcode / Zip">
				<input class="button_goto button_goto_quote" type="submit" value="get a quote">
			</form>
			<form id="coupon form" action="" class="shipping_form">
				<div class="shipping_form__h1">coupon discount</div>
				<div class="shipping_form__h2">Enter your coupon code if you have one</div>
				<input class="choose__box choose__box_ship" type="text" form="coupon form" id="choose State2"
				       placeholder="State">
				<input class="button_goto button_goto_coupon" type="submit" value="Apply coupon">
			</form>
			<form id="checkout form" action="" class="checkout_form">
				<div class="checkout_form__h2">
					<span>Sub total</span>
					<div style="width: 20px; height: 10px"></div>
					<span>$<?= $totalCost ?></span>
				</div>
				<div class="checkout_form__h1">
					<span>GRAND TOTAL</span>
					<div style="width: 20px; height: 10px"></div>
					<span class="checkout_form__h1_active">$<?= $totalCost ?></span>
				</div>
				<div class="checkout_form__submit div_flex">proceed to checkout</div>
			</form>
		</div>
	</div>
</div>