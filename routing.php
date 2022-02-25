<?php

require_once APP_PATH.'Router.php';
use App\Router;

require_once APP_PATH.'models/Book.php';
use App\Models\Book;

$router = new Router();

$router->get('/', function (){
    $book = new Book();
    echo "<pre>";
    var_dump($book->all());
    echo "</pre>";
});

$router->get('/test', function (){
    echo "Routing works!";
    echo "<hr>";
});