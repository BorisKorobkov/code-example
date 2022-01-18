<?php

namespace blog;

use LogicException;

/**
 * Blog configuration
 */
class Config
{
    public function get(): array
    {
        $config = [
            'sitePath' => 'blog',
            'defaultController' => 'blog',
            'dbHost' => getenv('DB_HOST') ?: 'localhost:3306',
            'dbDatabase' => getenv('DB_DATABASE'),
            'dbUser' => getenv('DB_USER'),
            'dbPassword' => getenv('DB_PASSWORD'),
            'isSemanticUrl' => true,
        ];

        if (!$config['dbDatabase'] || !$config['dbUser'] || !$config['dbPassword']) {
            throw new LogicException('ENV-variables DB_DATABASE, DB_USER, DB_PASSWORD are not defined.');
        }

        return $config;
    }
}