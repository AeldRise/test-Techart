<?php

require "autoload.php";

use App\Controllers\HomeController;
use App\Models\NewsRepository;
use App\Controllers\NewsController;
use App\Core\Router;

$router = new Router();
$router->add("GET", '/', [HomeController::class, 'index']);
$router->add("GET", '/news/', [NewsController::class, 'index']);
$router->add("GET",'/news/page-{value}/', [NewsController::class, 'index']);
$router->add("GET",'/news/{value}/', [NewsController::class, 'show']);
$url = $_SERVER['REQUEST_URI'];
$router->dispatch($url);