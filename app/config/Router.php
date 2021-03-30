<?php

$this->get('/','PagesController@home');

$this->get('/home',function(){
    (new \app\controller\TesteController)->index();
    //echo 'Estou na Home!';
});

$this->get('/about', 'PagesController@aboutUs');

$this->get('/contact', 'PagesController@contact');