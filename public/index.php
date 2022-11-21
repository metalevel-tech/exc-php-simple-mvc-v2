<?php

/**
 * This is the entry point for the application.
 */

require_once __DIR__ . "/../vendor/autoload.php";

// Enable errors and warnings in the browser,
// https://tecadmin.net/enable-php-errors/
if (true) {
    ini_set("display_errors", 1);
    ini_set("display_startup_errors", 1);
    error_reporting(E_ALL);
}

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;

$rootPath = dirname(__DIR__);

$app = new Application($rootPath);

$app->router->get("/", [SiteController::class, "home"]);
$app->router->get("/home", [SiteController::class, "home"]);

$app->router->get("/contact", [SiteController::class, "contact"]);
$app->router->post("/contact", [SiteController::class, "handleContact"]);

$app->router->get("/login", [AuthController::class, "login"]);
$app->router->post("/login", [AuthController::class, "login"]);

$app->router->get("/register", [AuthController::class, "register"]);
$app->router->post("/register", [AuthController::class, "register"]);

$app->run();
