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
            "title" => "3. Юзер",
            "href" => "/?c=user"
        ],
        [
            "title" => "4. Корзина текущего юзера",
            "href" => "/?c=cart"
        ],
    ];
}