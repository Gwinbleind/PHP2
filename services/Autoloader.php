<?php

namespace services;

class Autoloader
{
    public $path = [];

    public function loadClass(string $className) {
        $parts = explode('\\',$className);
        $filename = realpath("../{$parts[0]}/{$parts[1]}.php");
        if (file_exists($filename)) {
            require $filename;
        }
    }
}