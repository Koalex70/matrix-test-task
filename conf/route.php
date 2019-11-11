<?php

class Routing
{
    public static function buildRoute()
    {
        /** default controller and model */
        $controllerName = 'IndexController';
        $modelName = 'IndexModel';
        $action = 'index';

        include CONTROLLER_PATH . $controllerName . '.php';
        include MODEL_PATH . $modelName . '.php';

        $controller = new $controllerName();
        $controller->$action();
    }

    public static function errorPage()
    {

    }
}