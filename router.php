<?php

class Router
{

    //Shouldn't an empty get from index go to the main menu?
    //Next a author/:id route ['get','author/:id',[BookController::class,'showByAuthor']],
    private array $routes = [
        ['get', 'book/:id', [BookController::class, 'show']],
        ['get', 'index', [BookController::class, 'index']],
        ['get', '', [MainController::class, 'menu']],
        ['post', 'book', [BookController::class, 'delete']],
        ['get', 'author', [BookController::class, 'showAuthors']],
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
                if (isset($this->pathPieces[1])) {
                    $string = $this->pathPieces[1];
                    preg_match('/\d+$/', $string, $matches); // Matches digits at the end of the string
                    $numbersAtEnd = $matches[0];
                    //$piece = $this->pathPieces[1]; //$lastLetter = substr($string, -1);
                    $id = (int) $numbersAtEnd;
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


}
