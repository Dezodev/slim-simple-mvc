<?php

namespace App\Controllers;

use DI\Container;
use Slim\Views\Twig;

class Controller
{
    protected $container;

    public function __construct(Container $container, Twig $twig)
    {
        $this->container = $container;
        $this->twig = $twig;
    }

    public function __get($property)
    {
        if ($this->container->get($property)) {
            return $this->container->get($property);
        }
    }
}