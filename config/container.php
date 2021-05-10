<?php

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use App\Factory\LoggerFactory;
use Laminas\Config\Config;

return [
    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
    },

    Config::class => function () {
        return new Config(require __DIR__ . '/settings.php');
    },

    ErrorMiddleware::class => function (ContainerInterface $container) {
        $app = $container->get(App::class);
        $settings = $container->get(Config::class)->get('error')->toArray();

        $logger = $container->get(LoggerFactory::class)
            ->addFileHandler()
            ->createLogger('error');

        return new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            (bool)$settings['display_error_details'],
            (bool)$settings['log_errors'],
            (bool)$settings['log_error_details'],
            $logger
        );
    },


    // Twig templates
    Twig::class => function (ContainerInterface $container) {
        $settings = $container->get(Config::class)->get('twig')->toArray();

        $options = $settings['options'];
        $options['cache'] = $options['cache_enabled'] ? $options['cache_path'] : false;

        $twig = Twig::create($settings['paths'], $options);

        // Twig Extensions
        // ...

        return $twig;
    },

    TwigMiddleware::class => function (ContainerInterface $container) {
        return TwigMiddleware::createFromContainer(
            $container->get(App::class),
            Twig::class
        );
    },

    LoggerFactory::class => function (ContainerInterface $container) {
        return new LoggerFactory($container->get(Config::class)->get('logger')->toArray());
    },
];