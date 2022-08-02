<?php

namespace mvc;

use InvalidArgumentException;
use LogicException;

class Router
{
    /**
     * @param array $config
     * @throws LogicException
     */
    public function __construct(array $config)
    {
        Config::$config = array_merge(Config::$config, $config);
        if (!Config::$config['sitePath']) {
            throw new LogicException('config.sitePath is not defined.');
        }
    }

    public function run()
    {
        [$controllerName, $actionName] = $this->getControllerNameAndAction();
        $controllerName = Config::$config['sitePath'] . '\\controller\\' . ucfirst(strtolower($controllerName));
        $controller = new $controllerName;
        if (!method_exists($controller, $actionName)) {
            throw new InvalidArgumentException('404. Not found');
        }

        $controller->{$actionName}();
    }

    /**
     * Return controller name and action name
     *
     * @return string[] [$controllerName, $actionName]
     */
    public function getControllerNameAndAction(): array
    {
        // With semantic URL
        // @link https://en.wikipedia.org/wiki/Semantic_URL
        if (isset($_SERVER['REQUEST_URI'])) {
            [$path] = explode('?', $_SERVER['REQUEST_URI'], 2);
            $path = trim($path, '/');
            if ($path) {
                $folders = explode('/', $path);
                return [
                    $folders[0],
                    $folders[1] ?? Config::$config['defaultAction'],
                ];
            }
        }

        // Without semantic URL
        return [
            $_GET['controller'] ?? Config::$config['defaultController'],
            $_GET['action'] ?? Config::$config['defaultAction'],
        ];
    }
}