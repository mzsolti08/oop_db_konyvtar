<?php
declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException;
use App\Exceptions\ViewNotFoundException;

class App
{
    private static $db;

    private Router $router;
    private array $request;

    public function __construct(Router $router, array $request)
    {
        $this->router = $router;
        $this->request = $request; // ['uri'=> '/home/as/sad', 'method'=>'get']
    }

    public function run(){
        try {
            echo $this->router->resolve($this->request['uri'], $this->request['method']);
        } catch (RouteNotFoundException){
            http_response_code(404);
            echo "ERROR 404";
        } catch (ViewNotFoundException){
            http_response_code(404);
            echo "VIEW ERROR 404";
        }
    }
}