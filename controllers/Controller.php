<?php


namespace app\controllers;


use app\config\Tpage;

abstract class Controller
{
    use Tpage;
    protected $defaultAction = 'catalog';
    protected $action;
    protected array $params = [];

    public function runAction($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $methodName = 'action' . ucfirst($this->action);
        if (method_exists($this, $methodName)) {
            $this->$methodName();
        } else {
            die('Missing method ' . $methodName);
        }
    }
    //Render
    public function actionRenderTemplate($page, $params = [])
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
    public function actionRenderLayout($page, $params = [])
    {
        return $this->actionRenderTemplate("layout", [
            "content" => $this->actionRenderTemplate($page, $params),
            "menu" => $this->actionRenderTemplate("menu", $params),
            "scripts" => $this->actionRenderTemplate("scripts", $params),
            "links" => $this->actionRenderTemplate("links", $params),
            "header" => $this->actionRenderTemplate("header", $params),
            "footer" => $this->actionRenderTemplate("footer", $params),
        ]);
    }
}