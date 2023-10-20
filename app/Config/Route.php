<?php

namespace FrameworkSimas\Config;

use FrameworkSimas\Middleware\RoleMiddleware;

class Route
{
    protected static $routes = [];

    public static function add($method, $path, $controller, $function, $middleware = null)
    {
        self::$routes[] = [
            "method" => $method,
            "path" => $path,
            "controller" => $controller,
            "function" => $function,
            "middleware" => $middleware
        ];
    }

    public static function run()
    {
        $path = '/';
        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        }

        $method = $_SERVER['REQUEST_METHOD'];

        $matched = false;

        // Add default route
        // if ($path === '/') {
        //     $defaultController = new DefaultController();
        //     $defaultController->index();
        //     return;
        // }

        foreach (self::$routes as $route) {
            $pattern = "#^{$route['path']}$#";
            $pattern = preg_replace_callback('/\{([^\}]+)\}/', function ($matches) {
                return '([^/]+)';
            }, $pattern);
            // /product/1
            // [/product, 1]
            if (preg_match($pattern, $path, $variables) && ($method == $route['method'])) {
                $middleware = $route['middleware'];
                if ($middleware != null) {
                    $instances = new RoleMiddleware;
                    if ($instances->handle($middleware) == false) {
                        http_response_code(401);
                        echo json_encode(['error' => "Unauthorized :("]);
                        exit;
                    }
                }

                $function = $route['function'];
                $controller = new $route['controller'];
                array_shift($variables);

                preg_match_all('/\{([^\}]+)\}/', $route['path'], $matches);
                $paramNames = $matches[1];

                $request = [];
                foreach ($paramNames as $paramName) {
                    $request[$paramName] = array_shift($variables);
                }

                call_user_func_array([$controller, $function], [$request]);

                $matched = true;
                break;
            }
        }

        if (!$matched) {
            // Handle 404 or other responses for unmatched routes
            header("HTTP/1.0 404 Not Found");
            echo "Page Not Found :(";
        }
    }
}
