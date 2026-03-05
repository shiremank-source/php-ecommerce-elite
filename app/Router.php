<?php
class Router
{
    private $routes = [];

    // Handle GET routes
    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    // Handle POST routes
    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    // Resolve route
    public function resolve($method, $uri)
    {
        $uri = parse_url($uri, PHP_URL_PATH);

        if (isset($this->routes[$method][$uri])) {
            return call_user_func($this->routes[$method][$uri]);
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
