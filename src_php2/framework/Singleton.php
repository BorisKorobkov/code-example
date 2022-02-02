<?php

namespace framework;

class Singleton
{
    private static $instance = null;

    // "protected" prevents initiation with outer code
    protected function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            // static() - the class that was initially called at runtime
            // self() - this class (Singleton)
            self::$instance = new static();
        }

        return self::$instance;
    }
}