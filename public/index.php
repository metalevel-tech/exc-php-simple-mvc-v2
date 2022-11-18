<?php

/**
 * This is the entry point for the application.
 */

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\Application;

$rootPath = dirname(__DIR__);

$app = new Application($rootPath);

$app->router->get('/', "home");
$app->router->get('/home', "home");
$app->router->get('/contact', "contact");
$app->router->post('/contact', function () {
    return "Handling submitted data";
});

$app->run();
