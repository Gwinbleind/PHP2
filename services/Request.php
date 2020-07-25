<?php


namespace app\services;


class Request
{
	protected string $requestString;
	protected string $controllerName;
	protected string $actionName;
	protected string $regexp = "/(?P<controller>\w+)\/(?P<action>\w+)\??(?P<params>.*)/ui";

	public function __construct()
	{
		$this->requestString = $_SERVER['REQUEST_URI'];
		preg_match($this->regexp,$this->requestString,$matches);
		$this->controllerName = $matches['controller'] ?: '';
		$this->actionName = $matches['action'] ?: '';
	}

	public function getControllerName() :string
	{
		return $this->controllerName;
	}
	public function getActionName() :string
	{
		return $this->actionName;
	}
	public function get(string $name)
	{
		return strip_tags($_GET[$name]);
	}
	public function post(string $name)
	{
		return strip_tags($_POST[$name]);
	}
	public function session(string $name) {
		return $_SESSION[$name];
	}
	public function isAjax() :string
	{
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']==='XMLHttpRequest';
	}
	public function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}
}