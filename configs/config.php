<?php
$params = [
    "menu" => [
        [
            "title" => "Главная",
            "href" => "/"
        ],
        [
            "title" => "1-4. Классы",
            "href" => "/?page=classes"
        ],
        [
            "title" => "5. Пример 1",
            "href" => "/?page=example1"
        ],
        [
            "title" => "6. Пример 2",
            "href" => "/?page=example2"
        ],
        [
            "title" => "7. Пример 3",
            "href" => "/?page=example3"
        ],
    ]
];

define("TEMPLATE_DIR", realpath('../templates/')."/");

include realpath('../engine/render.php');   //Рендер
include realpath('../engine/db.php');       //База данных
include realpath('../engine/classes.php');  //Классы для демонстрации