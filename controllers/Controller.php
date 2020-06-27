<?php


namespace app\controllers;


use app\config\Tpage;
use app\interfaces\IRenderer;

class Controller
{
    use Tpage;
	protected string $defaultAction = 'catalog';
    protected $action;
    protected array $params = [];
    protected IRenderer $renderer;

    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

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
    public function actionRenderLayout($page, $params = [])
    {
        return $this->renderer->render("layout", [
            "content" => $this->renderer->render($page, $params),
            "menu" => $this->renderer->render("menu", $params),
            "scripts" => $this->renderer->render("scripts", $params),
            "links" => $this->renderer->render("links", $params),
            "header" => $this->renderer->render("header", $params),
            "footer" => $this->renderer->render("footer", $params),
        ]);
    }
}