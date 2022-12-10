<?php

class HomeController extends Controller
{
    public function index()
    {
        // $this->setLayout("layout/lame");

        return $this->renderView('home');
    }

    public function calendar()
    {
        return $this->renderView('orphanage/calendar');
    }
}