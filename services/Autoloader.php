<?php

namespace services;

class Autoloader
{
    public function loadClass(string $className) {
        $filename = realpath("../{$className}.php");
        if (file_exists($filename)) {
            require $filename;
        }
    }
}