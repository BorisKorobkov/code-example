<?php

namespace mvc;

class Config
{
    public static $config = [
        'sitePath' => null,
        'defaultController' => 'site',
        'defaultAction' => 'index',
        'lang' => 'en-US',
        'charset' => 'UTF-8',
        'dbHost' => 'localhost:3306',
        'dbDatabase' => 'test',
        'dbUser' => 'root',
        'dbPassword' => '',
        'isSemanticUrl' => false,
    ];
}