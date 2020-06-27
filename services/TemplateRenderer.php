<?php


namespace app\services;


use app\interfaces\IRenderer;

class TemplateRenderer implements IRenderer
{
    public function render($page, $params = []): string
    {
        ob_start();
        if (!is_null($params)) {
            extract($params);
        }
        $fileName = realpath('../views/templates/' . $page . ".php");
        if (file_exists($fileName)) {
            include $fileName;
        } else {
            exit("Страницы {$page} не существует");
        }
        return ob_get_clean();
    }
}