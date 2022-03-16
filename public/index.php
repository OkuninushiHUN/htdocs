<?php
const APP_PATH = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR;
const STORAGE_PATH = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR;
const VIEW_PATH = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR;

require_once APP_PATH.'exception/ViewNotFoundException.php';
require_once APP_PATH.'exception/RouteNotFoundException.php';
require_once APP_PATH.'Router.php';
require_once APP_PATH . 'Controller/LibraryController.php';
require_once APP_PATH.'view.php';
require_once APP_PATH.'DB.php';
require_once APP_PATH.'models/book.php';


use App\Router;
use App\Controller\LibraryController;
use App\View;
session_start();
$db= APP\DB::getInstance();


$router = new Router();
$router->get('/dbtest', function (){
    var_dump(app\DB::getInstance()->query("SELECT * FROM books")->fetchAll());
});

$router->get('/set/cookie', function (){
    setcookie('COOKIE_NAME', 'COOKIE_value', time()+86400, '/');
});

$router->get('/delete/cookie', function (){
    setcookie('COOKIE_NAME', '', time()-3600, '/');
});

$router->get('/show/cookie', function (){
    var_dump($_COOKIE);
});
$router->get('/show/session', function (){
   var_dump($_SESSION);
});

$router->get('/set/session', function (){
    $_SESSION['sajt']= "trapista";
    $_SESSION['innivalo']= "forrocsoki";
});

$router->get('/delete/session', function () {
    unset($_SESSION['sajt']);
});

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