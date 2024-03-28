<?php

use Controllers\ResourceController;
use Controllers\ExampleController;
use Routing\Router;
use Routing\RouterExecutor;
require_once './Routing/RouterExecutor.php';
require_once "./Routing/Router.php";
require_once './Controllers/ExampleController.php';
require_once './Controllers/ResourceController.php';


$router = new Router();
$router->get('/example', [ExampleController::class, 'index']);
$router->get('/home', [ExampleController::class, 'home']);
$router->get('/users', [ResourceController::class, 'list']);
$router->get('/users/{id}', [ResourceController::class, 'single']);

$executor = new RouterExecutor($router);
$executor->execute($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);