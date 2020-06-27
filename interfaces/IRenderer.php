<?php


namespace app\interfaces;


interface IRenderer
{
    public function render($page, $params = []) :string;
}