<?php

namespace app\services;

class Autoloader
{
    public function loadClass(string $className) {
        $cutName = str_replace('app\\','../',$className);
        $filename = realpath("{$cutName}.php");
        if (file_exists($filename)) {
            require $filename;
        }
    }
}