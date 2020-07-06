<?php


namespace app\services;


use app\interfaces\IRenderer;

class TwigRenderer implements IRenderer
{
    public function render($page, $params = []): string
    {
    	$page .= ".twig";
		$loader = new \Twig\Loader\FilesystemLoader('..\views\templates\twig');
		$twig = new \Twig\Environment($loader, []);

		return $twig->render($page, $params);
    }
}