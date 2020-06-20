<?php


namespace app\config;


trait Tpage
{
    public $menu = [
        [
            "title" => "1. Продукт c id=1",
            "href" => "/?c=product&a=card&id=1"
        ],
        [
            "title" => "2. Каталог",
            "href" => "/?c=product&a=catalog"
        ],
        [
            "title" => "3. Юзер админ",
            "href" => "/?c=user&a=info&login=admin&pass=123"
        ],
        [
            "title" => "4. Корзина юзера с id=1",
            "href" => "/?c=cart&a=info&userid=1"
        ],
    ];
    public $links = [
        'style_main' => 'css/style.css',
        'lato_font' => 'https://fonts.googleapis.com/css?family=Lato:100,300,400,700&display=swap',
        'font_awesome' => 'https://use.fontawesome.com/7f8eaeebe5.css',
    ];
    public $scripts = [
        'vue' => [
            'link' => 'https://cdn.jsdelivr.net/npm/vue/dist/vue.js',
            'async' => '0'
        ],
    ];
}