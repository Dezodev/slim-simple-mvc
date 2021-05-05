<?php

use Slim\App;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Controllers\HomeController;

return function (App $app) {
    $app->get('/', HomeController::class . ':index')->setName('home');
};