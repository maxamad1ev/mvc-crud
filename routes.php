<?php
require_once 'controllers/HomeController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/PostController.php';

$routes = [
    '/' => [
        'controller' => 'HomeController',
        'method' => 'index',
    ],
    '/register' => [
        'controller' => 'AuthController',
        'method' => 'register'
    ],
    '/login' => [
        'controller' => 'AuthController',
        'method' => 'login'
    ],
    '/logout' => [
        'controller' => 'AuthController',
        'method' => 'logout'
    ],
    '/handleRegister' => [
        'controller' => 'AuthController',
        'method' => 'handleRegister'
    ],
    '/handleLogin' => [
        'controller' => 'AuthController',
        'method' => 'handleLogin'
    ],
'/posts' => [
    'controller' => 'PostController',
    'method' => 'index'
],
'/posts/create' => [
    'controller' => 'PostController',
    'method' => 'create'
],
'/posts/store' => [
    'controller' => 'PostController',
    'method' => 'store'
],
'/posts/show' => [
    'controller' => 'PostController',
    'method' => 'show'
],
'/posts/edit' => [
    'controller' => 'PostController',
    'method' => 'edit'
],
'/posts/update' => [
    'controller' => 'PostController',
    'method' => 'update'
],
'/posts/delete' => [
    'controller' => 'PostController',
    'method' => 'delete'
],

];
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = $routes[$url];
if ($route) {
    $controller = new $route['controller']();
    $method = $route['method'];
    $controller->$method();
} else {
    header("HTTP/1.0 404 Not Found");
    require 'views/utilities/404.php';
} 
?>
