<?php
const APP_PATH = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR;
const STORAGE_PATH = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR;
const VIEW_PATH = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR;

require_once APP_PATH.'exception/ViewNotFoundException.php';
require_once APP_PATH.'exception/RouteNotFoundException.php';
require_once APP_PATH.'Router.php';
require_once APP_PATH.'Controller/LibaryController.php';
require_once APP_PATH.'view.php';
use App\Router;
use App\Controller\LibraryController;

$router = new Router();


$router
    ->get('/', [\App\Controller\LibraryController::class, 'index'])
    ->get('/create', [\App\Controller\LibraryController::class, 'create'])
    ->post('/create', [\App\Controller\LibraryController::class, 'store']);



try{
    echo $router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);}
catch (\app\exception\RouteNotFoundException $ex){
    echo $ex->getMessage();
}
catch (\app\exception\ViewNotFoundException $ex){
    echo $ex->getMessage();
}