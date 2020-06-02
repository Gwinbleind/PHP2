<?php
//Функции рендера
function renderTemplate($page, $params = [])
{
    ob_start();
    if (!is_null($params)) {
        extract($params);
    }
    $fileName = realpath(TEMPLATE_DIR . $page . ".php");
    if (file_exists($fileName)) {
        include $fileName;
    } else {
        exit("Страницы {$page} не существует");
    }
    return ob_get_clean();
}

function renderLayout($page, $params = []) {
    return renderTemplate("layout", [
        "content" => renderTemplate($page, $params),
        "menu" => renderTemplate("menu", $params),
        "scripts" => renderTemplate("scripts", $params),
        "links" => renderTemplate("links", $params),
    ]);
}

