<?php

namespace app\controller;
use app\core\Controller;

class PagesController extends Controller
{
    public function home()
    {
        $this->load('home/main');
    }

    public function aboutUs()
    {
        $this->load('about/main');
    }

    public function contact()
    {
        $this->load('contact/main');
    }

}