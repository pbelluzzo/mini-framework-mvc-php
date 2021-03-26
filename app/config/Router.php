<?php

$this->get('/',function(){
    echo 'Home!';
});

$this->get('/home',function(){
    echo 'Estou na Home!';
});

$this->get('/about/test', function(){
    echo 'Estou na pagina Sobre';
});

$this->get('/categoria', 'MyController@method');