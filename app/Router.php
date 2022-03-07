<?php

namespace App;

use App\Exception\RouteNotFoundException;

class Router
{


    private array $routes = array();

    public function register(string $requestMethod, string $route, callable|array $action) {
        $this -> routes[$requestMethod][$route] = $action;
        return $this;
    }

    public function get(string $route, callable|array $action){
        return $this->register('get', $route, $action);
    }
    public function post(string $route, callable|array $action){
        return $this->register('post', $route, $action);
    }



    public function resolve(string $requestUri, string $requestMethod) {

        $route = explode('?', $requestUri)[0];
        $method = strtolower($requestMethod);

        $action = $this->routes[$method][$route] ?? null;

        if(!$action){
            throw new RouteNotFoundException();
        }
        if (is_callable($action)) {
            return call_user_func($action);
        }
        if (is_array($action)) {
            [$class, $function] = $action;
            if (class_exists($class)){
                $object = new $class();
                if (method_exists($object, $function)){
                    return call_user_func_array([$object,$function], []);
                }
            }


        }
        throw new RouteNotFoundException();

    }

}