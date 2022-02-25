<?php

require_once APP_PATH.'Router.php';
use App\Router;

$router = new Router();

$router->get('/test', function (){
    echo "Routing works!";
    echo "<hr>";
});