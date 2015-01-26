<?php

class Template extends Router
{
	private $registry;
	private $vars = array();

	function __construct($registry) {
		$this->registry = $registry;
	}

 	public function __set($index, $value)
 	{
		$this->vars[$index] = $value;
	}

	function show($name) {
		$path = __SITE_PATH . '/views' . '/' . $name . '.php';

		if(file_exists($path) == false)
		{
			throw new Exception('No template found in path: '. $path);
			return false;
		}

		foreach ($this->vars as $key => $value)
		{
			$$key = $value;
		}
		include ($path);
	}
}

?>