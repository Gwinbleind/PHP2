<?php
/* @var $menu string
 * @var $header string
 * @var $content string
 * @var $footer string
 */
?>
<!doctype html>
<html lang="en">
<head>
 	<meta charset="UTF-8">
	<title>Document</title>
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="js/shop.js" async=""></script>
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700&amp;display=swap">
	<link rel="stylesheet" href="https://use.fontawesome.com/7f8eaeebe5.css">
</head>
<body>
<?=$menu?>
<?=$header?>
<div id="root">
	<?=$content?>
</div>
<?=$footer?>
</body>
</html>