<?php

namespace App\Controllers;

use DI\Container;
use Slim\Views\Twig;
use App\Factory\LoggerFactory;

class Controller
{
    protected $container;
    protected $twig;
    protected $logger;

    public function __construct(Container $container, Twig $twig, LoggerFactory $logger)
    {
        $this->container = $container;
        $this->twig = $twig;
        $this->logger = $logger->addFileHandler()
            ->addConsoleHandler()
            ->createLogger(static::class);
    }

    public function __get($property)
    {
        if ($this->container->get($property)) {
            return $this->container->get($property);
        }
    }
}