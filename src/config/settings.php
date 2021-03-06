<?php
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;

// Settings
$settings = [];

// Application settings
$settings['timezone'] = 'Europe/Paris';

// Path settings
$settings['root'] = APP_ROOT;
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';

// Error Handling Middleware settings
$settings['error'] = [
    // Should be set to false in production
    'display_error_details' => true,

    // Parameter is passed to the default ErrorHandler
    // View in rendered output by enabling the "displayErrorDetails" setting.
    // For the console and unit tests we also disable it
    'log_errors' => true,

    // Display error details in error log
    'log_error_details' => true,
];

// Twig settings
$settings['twig'] = [
    // Template paths
    'paths' => [
        APP_ROOT . '/templates',
    ],
    // Twig environment options
    'options' => [
        // Should be set to true in production
        'cache_enabled' => false,
        'cache_path' => APP_ROOT . '/var/twig',
    ],
];

// Logger settings
$settings['logger'] = [
    'name' => 'app',
    'path' => APP_ROOT . '/var/logs',
    'filename' => 'app.log',
    'level' => \Monolog\Logger::DEBUG,
    'file_permission' => 0775,
];

// Storage settings
$settings['storage'] = [
    'adapter' => new LocalFilesystemAdapter(
        APP_ROOT . '/var/storage/',
        PortableVisibilityConverter::fromArray(
            [
                'file' => [
                    'public' => 0640,
                    'private' => 0604,
                ],
                'dir' => [
                    'public' => 0740,
                    'private' => 7604,
                ],
            ]
        ),
    ),
];

return $settings;