<?php

namespace app\core;

class Controller{

    protected function load(string $view, $params = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/view/');
        $twig = new \Twig\Environment($loader);

        $twig->addGlobal('BASE', BASE);
        $twig->addGlobal('PG_NOT_FOUND_TITLE', PG_NOT_FOUND_TITLE);
        $twig->addGlobal('PG_NOT_FOUND_MSG', PG_NOT_FOUND_MSG);
        echo $twig->render($view  . '.twig.php', $params);
    }
}