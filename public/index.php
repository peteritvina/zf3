<?php

use Zend\Mvc\Application;
use Zend\Stdlib\ArrayUtils;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\Factory\InvokableFactory;
use Album\Service\Example;
use Album\Service\Example2;
use Interop\Container\ContainerInterface; 
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

if ($_SERVER['APPLICATION_ENV'] === 'development') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}


// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

// Composer autoloading
include __DIR__ . '/../vendor/autoload.php';
/*
//Chay doan serviceManager.
$serviceManager = new ServiceManager([
    'factories' =>[
        Example::class =>InvokableFactory::class,
        Example2::class =>function(ContainerInterface $container,$requestedName){
            $example = $container->get(Example::class);
            return new Example2($example);
        },
    stdClass::class => InvokableFactory::class,
    ]
]);

echo "<hr>";
//echo get_class($serviceManager);
$example2 = $serviceManager->get(Example2::class);
$example2->sayHello();
echo "<hr>";
//end doan chay serviceManager
*/
if (! class_exists(Application::class)) {
    throw new RuntimeException(
        "Unable to load application.\n"
        . "- Type `composer install` if you are developing locally.\n"
        . "- Type `vagrant ssh -c 'composer install'` if you are using Vagrant.\n"
        . "- Type `docker-compose run zf composer install` if you are using Docker.\n"
    );
}

// Retrieve configuration
$appConfig = require __DIR__ . '/../config/application.config.php';
if (file_exists(__DIR__ . '/../config/development.config.php')) {
    $appConfig = ArrayUtils::merge($appConfig, require __DIR__ . '/../config/development.config.php');
}

// Run the application!
Application::init($appConfig)->run();
