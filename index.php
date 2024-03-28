<?php

use Controllers\ExampleController;
use Routing\Router;
use Routing\RouterExecutor;
require_once './Routing/RouterExecutor.php';
require_once "./Routing/Router.php";
require_once './Controllers/ExampleController.php';


$router = new Router();
$router->get('/example', [ExampleController::class, 'index']);
$router->get('/home', [ExampleController::class, 'home']);

$requestedRoute = $_SERVER['REQUEST_URI'];
$requestedMethod = $_SERVER['REQUEST_METHOD'];

$executor = new RouterExecutor($router);
$executor->execute($requestedMethod, $requestedRoute);