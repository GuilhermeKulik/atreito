<?php

namespace Atreito\View;

use Atreito\Core\Router\Routes;

/**
 * Class responsible for rendering views based on the route.
 */
class GenericView
{
    /**
     * Associative array to store registered routes and their corresponding file paths.
     *
     * @var array
     */
    private $routes = [];

    /**
     * GenericView constructor.
     * 
     * Initializes the class by fetching the routes from the Routes configuration.
     */
    public function __construct() 
    {
        $this->routes = Routes::getRoutesToViewsMap();
    }

    /**
     * Renders a view based on the current URL, or in case null, it will get the URL.
     * 
     * @return void
     */
    public function renderFromCurrentURL(string $path = null): void
    {
        // Se $path não for fornecido, pegue o valor da URL atual.
        if ($path === null) {
            $path = $_SERVER['REQUEST_URI'];
        }
        
        $this->renderView($path);
    }

    /**
     * Renders the specified view based on the provided route.
     *
     * @param string $route The route for which the view needs to be rendered.
     * @return void
     */
    public function renderView(string $route): void {
        if (isset($this->routes[$route])) {
            $fullFilePath = $this->routes[$route];
            
            if (file_exists($fullFilePath)) {
                include $fullFilePath;
            } else {
                echo "Arquivo não encontrado: " . $fullFilePath; // Para debug.
            }
        } else {
            $this->displayErrorPage();
        }
    }

    /**
     * Displays a 404 error page when the requested view is not found.
     *
     * @return void
     */
    private function displayErrorPage(): void
    {
        echo "404 - Page Not Found.";
        // Alternatively, you can redirect to an error page or include an error file here.
    }
}
