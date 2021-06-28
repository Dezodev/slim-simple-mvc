<?php

use DI\ContainerBuilder;
use Laminas\Config\Config;
use Slim\App;

define('APP_ROOT', dirname(dirname(__DIR__)));
define('APP_SRC', APP_ROOT . '/src');

require_once APP_ROOT . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

// Set up settings
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Create App instance
$app = $container->get(App::class);

// Get config
$config = $container->get(Config::class);

// Should be set to 0 in production
error_reporting(E_ALL);

// Should be set to '0' in production
ini_set('display_errors', '1');

// Timezone
date_default_timezone_set(
    $config->get('timezone', 'Europe/Paris')
);

// Register routes
(require __DIR__ . '/routes.php')($app);

// Register middleware
(require __DIR__ . '/middleware.php')($app);

return $app;