<?php

abstract class Controller
{

	protected $registry;

	function __construct($registry)
    {
		$this->registry = $registry;
	}

	abstract public function index();
}