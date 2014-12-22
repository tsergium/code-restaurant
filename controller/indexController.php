<?php

Class indexController Extends baseController
{
    public function index()
    {
        $this->registry->template->show('index');
    }
}