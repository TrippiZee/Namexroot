<?php

namespace Includes;

use Exception;

class Router {

    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function load($file){

        $router = new static;

        require $file;

        return $router;
    }

//    public function define($routes) {
//
//        $this->routes = $routes;
//    }

    public function get($uri, $controller){

        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller){

        $this->routes['POST'][$uri] = $controller;
    }

    public function redirect($uri, $requestType){

        if(array_key_exists($uri, $this->routes[$requestType])){
//            return $this->routes[$requestType][$uri];
            return $this->callAction(
                ...explode('@',$this->routes[$requestType][$uri])
            );
        }

        throw new Exception('NO ROUTES');
    }

    protected function callAction($controller,$method){

        $controller = "Includes\\Controllers\\{$controller}";
        $controller = new $controller;

        if(!method_exists($controller,$method)){
            throw new \Exception(
                "No {$method} exists in route: {$controller}"
            );
        }
        return (new $controller)->$method();
//        $test = new CustomerController();
//        return $test->allCustomers();
    }
}