<?php
define('STORAGE_PATH', __DIR__ . '/../storage/');
define('APP_PATH', __DIR__ . '/../app/');
define('VIEW_PATH', __DIR__ . '/../resources/view/');


require APP_PATH.'/exceptions/RouteNotFoundException.php';
require APP_PATH.'/exceptions/ViewNotFoundException.php';

require_once APP_PATH.'App.php';
require_once APP_PATH.'View.php';
require_once APP_PATH.'Config.php';
require_once APP_PATH.'DB.php';
require_once APP_PATH.'Model.php';
//include APP_PATH.'controllers/HomeController.php';

use App\App;
use App\Config;
//use App\Controllers\HomeController;
//echo $config->DB_HOST;

require_once __DIR__ . '/../routing.php';

if(!isset($router)){
    die("Route config error!");
}

$app = new App(
    $router, ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']]
);
$app->run();