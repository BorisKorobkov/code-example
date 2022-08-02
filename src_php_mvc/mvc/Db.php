<?php

namespace mvc;

use mysqli;
use RuntimeException;

class Db
{
    /** @var mysqli */
    private static $connection;

    /**
     * @return mysqli
     * @throws RuntimeException
     */
    public static function getConnection(): mysqli
    {
        if (!self::$connection) {
            self::$connection = new mysqli(
                Config::$config['dbHost'],
                Config::$config['dbUser'],
                Config::$config['dbPassword'],
                Config::$config['dbDatabase']);

            if (self::$connection->connect_error) {
                throw new RuntimeException(sprintf('Connection error (%s) %s', self::$connection->connect_errno, self::$connection->connect_error));
            }
        }

        return self::$connection;
    }
}