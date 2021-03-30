<?php
namespace app\core;


class RouterCore
{
    private $uri;
    private $method;

    private $getArr = [];

    public function __construct()
    {
        $this->initialize();
        require_once('../app/config/Router.php');
        $this->execute();
    }

    private function initialize()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        $ex = explode('/',$uri);

        $uri = $this->normalizeURI($ex);

        for($i = 0; $i < UNSET_URI_COUNT; $i++)
        {
            unset($uri[$i]);
        }

        $this->uri = implode('/',$this->normalizeURI($uri));
        if(DEBUG_URI){
            dd($this->uri);

        }
    }

    private function get($router, $call)
    {
        $this->getArr[] = [
            'router' => $router,
            'call' => $call
        ];
    }

    private function execute(){
        switch($this->method){
            case 'GET':
                $this->executeGet();
                break;
            case 'POST':
                $this->executePost();
                break;
        }
    }

    private function executeGet()
    {
        foreach($this->getArr as $get){
            $getRouter = substr($get['router'],1);

            if(substr($getRouter, -1) == '/'){
                $getRouter = substr($getRouter,0,-1);
            }

            if($getRouter == $this->uri){
                if(is_callable($get['call'])){
                    $get['call']();
                    break;
                }
                $this->executeController($get['call']);
            }
        }
    }

    private function executePost()
    {

    }

    private function executeController($call)
    {
        $ex = explode('@',$call);

        if(!isset($ex[0]) || !isset($ex[1]))
        {
            (new \app\controller\MessageController)->message(PG_NOT_FOUND_MSG, PG_NOT_FOUND_TITLE, 404);
            return;
        }

        $cont = 'app\\controller\\' . $ex[0];
        if(!class_exists($cont)){
            (new \app\controller\MessageController)->message('Controller Not Found: ' . $ex[0],PG_NOT_FOUND_TITLE ,404);
            return;
        }

        if(!method_exists($cont, $ex[1])){
            (new \app\controller\MessageController)->message('Method Not Found: ' . $ex[1],PG_NOT_FOUND_TITLE ,404);
            return;
        }

        call_user_func_array([new $cont, $ex[1]],[]);
    }

    private function normalizeURI($arr)
    {
        return array_values(array_filter($arr));
    }
}