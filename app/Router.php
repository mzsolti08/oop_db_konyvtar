<?php
declare(strict_types=1);

namespace App;

use App\Controllers\HomeController;
use App\Exceptions\RouteNotFoundException;
//use App\Exceptions\RouteNotFoundException as RNFException;

class Router
{
    private array $routes = array();
    /*
     [
     'get' => [
            '/' => [0 => HomeController:class, 1 => 'index']
            '/login' => {action}
        ]
     'post' => [
            '/login' => {action}
        ]
     ]


     [
          'get' => [
                '/' => [HomeController::class, 'index'],
                '/contact' => [HomeController::class, 'contact'],
                '/galery' => { return 'galery'; }
            ]
     ]

     * */
    public function register(string $requestMethod, string $route, callable|array $action) : self {
        $this->routes[$requestMethod][$route] = $action;
        return $this;
    }
    public function get(string $route, callable|array $action) : self {
        return $this->register('get', $route, $action);
    }
    public function post(string  $route, callable|array $action) : self {
        return $this->register('post', $route, $action);
    }


    /// $_SERVER['REQUEST_URI'] = "/index.php/asdfa/sdfW/SAD?ASGKB=1234"
    /// blathy.info/index.php/asdfa/sdfW/SAD?ASGKB=1234


    public function resolve(string $requestUri, string $requestMethod){
        $route = explode('?', $requestUri)[0];   // ['/index.php/asdfa/sdfW/SAD', 'ASGKB=1234']  >> '/index.php/asdfa/sdfW/SAD'
        $requestMethod = strtolower($requestMethod);

        $action = $this->routes[$requestMethod][$route] ?? null;

        if (!$action) {
            throw new RouteNotFoundException();
        }
        if (is_callable($action)){
            return call_user_func($action);
        }
        if (is_array($action)){
            [$class, $function] = $action;
            /*
            $class = $action[0];
            $function = $action[1];
            */
            if (class_exists($class)){
                $class = new $class();
                if (method_exists($class, $function)){
                    return call_user_func_array([$class, $function], []);
                }
            }
        }

        throw new RouteNotFoundException();
    }

    public function routes() : array{
        return $this->routes;
    }

}