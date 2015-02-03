<?php

/**
 * Class Registry
 * @property class Db
 * @property class Template
 * @property class Router
 */
class Registry
{
    private $vars = array();

    public function __set($index, $value)
    {
        $this->vars[$index] = $value;
    }

    public function __get($index)
    {
        return $this->vars[$index];
    }
}