<?php

use Slim\App;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Controllers\HomeController;
use App\Controllers\PreflightController;

return function (App $app) {
    $app->get('/', HomeController::class . ':index')->setName('home');

    // Register the cors routes
    $cors_routes = ['/'];

    foreach ($cors_routes as $cors_route) {
        $app->options($cors_route, PreflightController::class);
    }
};