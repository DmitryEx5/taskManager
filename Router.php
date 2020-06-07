<?php

/**
 * Class Router
 */
class Router
{

    public function route()
    {
        if (($pos = strpos($_SERVER['REQUEST_URI'], '?')) !== FALSE) {
            $route = substr($_SERVER['REQUEST_URI'], 0, $pos);
        } else {
            $route = '/task/index';
        }

        $route = is_null($route) ? $_SERVER['REQUEST_URI'] : $route;
        $route = explode('/', $route);
        array_shift($route);
        if (IS_DEV) {
            array_shift($route);
        }
        $controllerName = array_shift($route);
        $controller = ucfirst($controllerName . 'Controller');
        $action = array_shift($route) . 'Action';
        require_once CONTROLLER_PATH . $controller . ".php";
        require_once MODEL_PATH . $controllerName . "Model.php";
        $controller = new $controller();
        $controller->$action();
    }

    public function showError()
    {
        (new Controller())->errorAction();
    }

}
