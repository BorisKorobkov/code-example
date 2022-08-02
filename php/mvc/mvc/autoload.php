<?php
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/../' . str_replace('\\', '/', $className) . '.php';
    if (!file_exists($fileName)) {
        throw new InvalidArgumentException('404. Not found');
    }
    require_once $fileName;
});
