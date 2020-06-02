<? if (!is_null($menu)): ?>
	<? foreach ($menu as $key => $value): ?>
		<a href="<?= $value["href"] ?>"><?= $value["title"] ?></a>
	<? endforeach; ?>
<?endif;?>
<br>
