<?php

namespace Atreito\Core\Router;

use Atreito\Core\Router\Routes;
use Atreito\View\GenericView;

class Router
{
    private $viewRoutes = [];
    private $controllerRoutes = [];

    public function __construct() 
    {
        $this->viewRoutes = Routes::getRoutesToViewsMap();
        $this->controllerRoutes = Routes::getControllerRoutes();
    }

    // Decide se renderiza uma view, ou se ativa um controlador, dependendo da rota.
    public function dispatch(string $route = null, $postData = []) 
    {
        if ($route === null) {
            $route = $_SERVER['REQUEST_URI'];
        }

        // Se a rota solicitada for uma rota de controlador...
        if (isset($this->controllerRoutes[$route])) {
            $controllerInfo = $this->controllerRoutes[$route];
            $controllerClass = 'Atreito\Controller\\' . $controllerInfo['class'];
            $controllerMethod = $controllerInfo['method'];
            
            $controller = new $controllerClass();
            return $controller->$controllerMethod($postData); 
        } 
        // Se a rota solicitada for uma rota de view...
        elseif (isset($this->viewRoutes[$route])) {
            $view = new GenericView();
            return $view->renderView($route);
        } 
        // Caso contrário, 404
        else {
            echo "404 - Page Not Found.";
        }
    }
}
