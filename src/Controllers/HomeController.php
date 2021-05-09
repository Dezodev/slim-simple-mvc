<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeController extends Controller
{
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->logger->info('This is a test message.');
        return $this->twig->render($response, 'home.twig', [
            'projectName' => 'Slim simple MVC',
            'projectDescription' => 'A Slim 4 simple MVC skeleton',
        ]);
    }
}
