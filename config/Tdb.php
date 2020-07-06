<?php


namespace app\config;


trait Tdb
{
protected static array $config = [
        'driver' => 'mysql',
        'user' => 'geek',
        'pass' => 'geek',
        'host' => 'localhost',
        'dbname' => 'gb_php',
        'charset' => 'utf8',
    ];
}