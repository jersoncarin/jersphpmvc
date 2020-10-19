<?php 

class Controller
{
	
	public function __construct()
	{
		$this->security = new Security();
		$this->session = new Session();
		$this->request = new Request();
		$this->cookie = new Cookie($this->security);
		$this->files = new Files();
		$this->view = new View();
		
	}
	
	public function load($name,$class) {
		$this->$name = new $class();
	}
	
	public function not_found() {
		$controllerName = Config::$defaultError404;
		$controller = new $controllerName();
	    $controller->index();
	}
}