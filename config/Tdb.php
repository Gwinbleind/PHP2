<?php


namespace app\config;


trait Tdb
{
protected array $config = [
        'driver' => 'mysql',
        'user' => 'geek',
        'pass' => 'geek',
        'host' => 'localhost',
        'dbname' => 'gb_php',
        'charset' => 'utf8',
    ];
}