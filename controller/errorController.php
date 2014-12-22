<?php

Class errorController Extends baseController
{
    public function index()
    {
        $this->registry->template->page_title = 'Error 404: Page not found';
        $this->registry->template->show('error');
    }
}