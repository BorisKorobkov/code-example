<?php

use blog\Config;
use mvc\Router;

try {
    // Autoloader
    require_once __DIR__ . '/../../mvc/autoload.php';

    // Blog configuration
    $config = (new Config())->get();

    // Run application
    (new Router($config))->run();

} catch (Exception $e) {
    // @todo write to syslog
    // echo $e->getMessage();

    throw $e;
}