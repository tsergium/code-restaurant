<?php

/**
 * Class Registry
 * @property null|PDO db
 * @property Template template
 * @property Router router
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