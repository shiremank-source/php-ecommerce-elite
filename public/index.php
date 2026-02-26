<?php

session_start();

require_once __DIR__ . '/../app/Router.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';

$router = new Router();
$controller = new HomeController();

$router->get('/', [$controller, 'index']);
$router->get('/shop', [$controller, 'shop']);
$router->get('/cart', [$controller, 'cart']);

$router->resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);





