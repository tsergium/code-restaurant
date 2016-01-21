<?php

class indexController extends Controller
{
    public function index()
    {
        $this->registry->template->show('index-index');
    }
}