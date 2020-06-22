<?php /** @var $item \app\models\Product */?>
<div class="product__element">
					<a href="/?page=product&id=<?=$item->id?>" class="product__content">
						<img src="<?=$item->imgMedium?>" alt="" class="product__img">
						<div class="product__name"><?=$item->name?></div>
<div class="product__price"><?=number_format($item->price,2,',','.')?></div>
</a>
<a href="#" data-product__id="<?=$item->id?>" class="product__add">Add to Cart</a>
<img src="img/stars5.jpg" alt="stars" class="product__stars">
</div>