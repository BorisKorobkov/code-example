<?php

use framework\Controller;
use framework\Logger;

try {
    require_once __DIR__ . '/framework/autoload.php';

    // JSON
    $filename = 'http://www.mocky.io/v2/5c6abed9330000cc2e7f4ceb';
//    $filename = 'tests/payload.json';
    $reader = models\ReaderJson::class;

    // XML
//    $filename = 'tests/payload.xml';
//    $reader = models\ReaderXml::class;


    // remove this file name
    $argvCopy = $argv;
    array_shift($argvCopy);

    // the first parameter is a class name
    if (!count($argvCopy)) {
        throw new InvalidArgumentException('Class is not specified');
    }

    // build controller name with namespace
    $controllerName = array_shift($argvCopy); // the first parameter is a class name
    $controllerName = ucwords($controllerName, '_'); // camelize
    $controllerName = str_replace('_', '', $controllerName);
    $controllerName = 'controllers\\' . $controllerName; // add namespace

    /**
     * @throws InvalidArgumentException when class doesn't exist
     * @var Controller $controller
     */
    $controller = new $controllerName($filename, $reader);
    $result = $controller->run($argvCopy);

    echo $result . PHP_EOL;

} catch (Exception $e) {

    Logger::getInstance()->exception($e);
    echo $e->getMessage();
}