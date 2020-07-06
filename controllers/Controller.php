<?php


namespace app\controllers;


use app\config\Tpage;
use app\interfaces\IRenderer;

class Controller
{
    use Tpage;
	protected string $defaultAction = 'catalog';
    protected $action;
    public array $params = [];
    protected IRenderer $renderer;
    public bool $useLayout = true;

    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }
    public function prepareParams() {
    	$this->params['menu'] = $this->menu;
    	return $this;
	}

    public function runAction($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $methodName = 'action' . ucfirst($this->action);
        if (method_exists($this, $methodName)) {
            $this->$methodName();
        } else {
			throw new \Exception('missing action');
		}
    }
    public function actionRenderLayout($page)
    {
    	if ($this->useLayout) {
			return $this->renderer->render("../layouts/layout", [
				"menu" => $this->renderer->render("menu", $this->params),
				"header" => $this->renderer->render("header", $this->params),
				"content" => $this->renderer->render($page, $this->params),
				"footer" => $this->renderer->render("footer", $this->params),
			]);
		} else {
			return $this->renderer->render($page, $this->params);
		}
    }

	public function actionException(\Exception $exception) :void {
		$this->prepareParams()->params['message'] = $exception->getMessage();
		echo $this->actionRenderLayout('404');
	}
}