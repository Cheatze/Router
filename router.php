<?php

class Router
{

    //Shouldn't an empty get from index go to the main menu?
    private array $routes = [
        ['get', 'index', [BookController::class, 'index']],
    ];

    private array $pathPieces;

    public function __construct()
    {
        //$pathInfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        if (isset($_SERVER['PATH_INFO'])) {
            $pathInfo = $_SERVER['PATH_INFO'];
        } else {
            $pathInfo = '';
        }
        $this->pathPieces = explode('/', substr($pathInfo, 1));
    }

    public function processRoute(): void
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        foreach ($this->routes as $route) {
            [$routeMethod, $routePath, $routeAction] = $route;
            if ($method === $routeMethod && $this->matchRoute($routePath)) {
                if (isset($this->pathParts[1])) {
                    $id = (int) $this->pathPieces[1];
                    $routeAction($id);
                    return;
                }
                $routeAction();
                return;
            }
        }
        header('HTTP/1.1 404 Not Found');
        print '404 Not Found';
    }

    private function matchRoute(string $routePath): bool
    {
        $routePathParts = explode('/', $routePath);
        if (count($routePathParts) !== count($this->pathPieces)) {
            return false;
        }
        foreach ($routePathParts as $key => $routePathPart) {
            if (@$routePathPart[0] === ':') {
                continue;
            }
            if ($routePathPart !== $this->pathPieces[$key]) {
                return false;
            }
        }
        return true;
    }

    //$_SERVER['REQUEST_METHOD'] //post or get
    //$_SERVER['REQUEST_URI'] //like 'index.php'


}