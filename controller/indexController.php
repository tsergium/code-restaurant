<?php

class indexController extends Controller
{
    public function index()
    {
        $this->registry->template->show('index-index');
    }

    public function assignmentOne()
    {
        $this->registry->template->show('assignment1');
    }

    public function assignmentTwo()
    {
        $this->registry->template->show('assignment2');
    }

    public function assignmentThree()
    {
        $this->registry->template->show('assignment3');
    }
}