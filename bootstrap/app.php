<?php 

// set config files

require 'autoload.php';

App\Core\Session::start();

define('dir_root', __DIR__ . '/../');

define('dir_view', __DIR__ . '/../views/');

foreach (glob(__DIR__.'/../config/*.php') as $filename):
		$name = basename($filename, '.php');
        App\Core\Config::set($name, $value = require $filename);
endforeach;

// set up database connection

App\Database\Connections::make();

// init routers
$router = new App\Core\Router;

$router->define(require __DIR__ . '/../routes.php');

// check if it's a post method, if post then check if it contains session token 
// for csrf protection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_POST['token']) || $_POST['token']!=session('_token')){
    	
    	die('CSRF verification failed');
    }
}


// parse url

$uri = trim($_SERVER['REQUEST_URI'], '/');

$parse = parse_url($uri);

// get current route
$action = $router->direct($parse['path']);

// extract associated controller and method to call

list($controller, $method) = explode('@', $action);

$class = 'App\Controllers\\' . $controller;

// call controller and get contents

$content = call_user_func_array([new $class, $method], []);

// output content

echo view('layout', compact('content'));

// remove temporary session

App\Core\Session::removeTemp();