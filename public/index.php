<?php
include realpath('../configs/config.php');
if (isset($_GET['page'])) {
    extract($_GET);
} else {
    $page = 'index';
}

switch ($page) {
    case 'classes':
        $params['links'] = [
            'style_catalog' => 'css/style.css',
            'lato_font' => 'https://fonts.googleapis.com/css?family=Lato:100,300,400,700&display=swap',
            'font_awesome' => 'https://use.fontawesome.com/7f8eaeebe5.css',
        ];
        $product1 = new Product(1, 'Майка',150,1,'men','img/product_mini/Product_1.png','img/Product_1.png');
        $product2 = new Cloth(2,'Блузка',200,1,'women','img/product_mini/Product_2.png','img/Product_2.png',
            '','red','silk','XS',2019,'Bindburhan');
            $params['cart1'] = $product1->renderCartItem();
            $params['miniCart1'] = $product1->renderMiniCartItem();
            $params['cart2'] = $product2->renderCartItem();
            $params['miniCart2'] = $product2->renderMiniCartItem();
        break;
    case 'example1':

        break;
    case 'example2':
    case 'example3':
        break;
    case 'catalog':
        $params['links'] = [
            'style_catalog' => 'css/style.css',
            'lato_font' => 'https://fonts.googleapis.com/css?family=Lato:100,300,400,700&display=swap',
            'font_awesome' => 'https://use.fontawesome.com/7f8eaeebe5.css',
        ];
        $params['scripts'] = [
            'vue' => [
                'link' => 'https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js',
                'async' => '0'
            ],
            'feedback_vue_js' => [
                'link' => 'js/front.js',
                'async' => '1'
            ]
        ];
        $db = connectDB();
        $params['catalog'] = getCatalog($db);
        break;
}
//$message = [
//    "OK" => "Сообщение добавлено",
//    "edit" => "Сообщение исправлено",
//    "del" => "Сообщение удалено",
//];
//$params['message'] = $message[$_GET['message']];
echo renderLayout($page, $params);