<?php


namespace app\config;


trait Tpage
{
    public $menu = [
        [
            "title" => "1. Продукт id=1",
            "href" => "/?c=product&a=card&id=1"
        ],
        [
            "title" => "2. Каталог",
            "href" => "/?c=product&a=catalog"
        ],
        [
            "title" => "3. Юзер",
            "href" => "/?c=user"
        ],
        [
            "title" => "4. Корзина",
            "href" => "/?c=cart"
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