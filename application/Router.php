<?php

class Router
{
	private $registry;
	private $path;
	private $args = array();

	public $file;
	public $controller = 'index'; // index is default controller
	public $action = 'index'; // index is default action

	function __construct(Registry $registry)
	{
		$this->registry = $registry;
	}

	function setPath($path)
	{
		if (is_dir($path) == false)
		{
			throw new Exception ('Invalid controller path: `' . $path . '`');
		}
		$this->path = $path;
	}

 	public function loader()
 	{
		$this->getController();

		if(is_readable($this->file) == false)
		{
			$this->file = $this->path.'/errorController.php';
			$this->controller = 'error';
		}
        
		include $this->file;

		$class = $this->controller . 'Controller';
		$controller = new $class($this->registry);

		if (is_callable(array($controller, $this->action)) == false)
		{
			$action = 'index';
		}
		else
		{
			$action = $this->action;
		}
		$controller->$action();
 	}

	private function getController()
	{
		$route = (empty($_GET['rt'])) ? '' : $_GET['rt'];
		if(!empty($route) && $route != 'index.php')
		{
			$parts = explode('/', $route);
			$this->controller = $parts[0];
			if(isset( $parts[1])){
				$this->action = $parts[1];
			}else{
                $this->action = 'index';
            }
		}

		$this->file = $this->path .'/'. $this->controller . 'Controller.php';
	}
}
