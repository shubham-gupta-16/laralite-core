<?php

namespace ShubhamGupta16\LaraliteCore;

class LaraliteCore
{
    public static function serve()
    {
        $ROUTES = include '../settings/routes.php';
        $uri = $_SERVER['REQUEST_URI'];
        if (isset($ROUTES[$uri])) {
            $route = $ROUTES[$uri];
            self::runpage($route);
        } else if ($r = self::matchRoute($ROUTES)) {
            self::runpage($r[0], $r[1]);
        } else {
            self::err(404);
        }
    }

    private static function runpage($route, array $data = [])
    {

        try {
            switch (get_class($route)) {
                case 'ShubhamGupta16\LaraliteCore\Types\TypeView':
                    self::validate_method($route->route_map, false);
                    if (!is_file("..\\views\\" . $route->file . '.php')) return self::err(500);
                    $DATA = (object) $route->data;
                    include '..\\views\\' . $route->file . '.php';
                    self::output($route->status, $route->headers, null);
                    break;
                case 'ShubhamGupta16\LaraliteCore\Types\TypeJson':
                    self::validate_method($route->route_map, true);
                    self::output($route->status, $route->headers, $route->data);
                    break;
                case 'ShubhamGupta16\LaraliteCore\Types\TypeController':
                    if (!is_file("..\\controllers\\" . $route->file . '.php')) return self::err(500);
                    include '..\\controllers\\' . $route->file . '.php';
                    $response = call_user_func($route->fun, ...$data);
                    if (gettype($response) == 'object' && get_class($response) == 'ShubhamGupta16\LaraliteCore\Types\TypeView') {
                        self::validate_method($route->route_map, false);
                        $DATA = (object) $response->data;
                        include '..\\views\\' . $response->file . '.php';
                        self::output($response->status, $response->headers, null);
                    } elseif (gettype($response) == 'object' && get_class($response) == 'ShubhamGupta16\LaraliteCore\Types\TypeJson') {
                        self::validate_method($route->route_map, true);
                        self::output($response->status, $response->headers, $response->data);
                    } else {
                        self::validate_method($route->route_map, true);
                        self::output(200, null, $response);
                    }
                    break;
                default:
                    return self::err(500);
            }
        } catch (\Throwable $th) {
            self::err($th->getCode(), $th->getMessage());
        }
    }

    private static function setup_middlewares(){

    }

    private static function output(int $status_code, ?array $headers, $data)
    {
        http_response_code($status_code);
        if ($data != null) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        }
        if ($headers != null) {
            foreach ($headers as $header) {
                header($header);
            }
        }
        die;
    }

    private static function validate_method(RouteMap $route_map, bool $isJson)
    {
        if ($_SERVER['REQUEST_METHOD'] !== $route_map->method) {
            return self::err(400, $isJson ? 'Bad Request' : null);
        }
    }

    private static function err(int $status_code, ?string $message = null, ?array $data = null)
    {
        http_response_code($status_code);
        if ($message != null) {
            header('Content-Type: application/json; charset=utf-8');
            $errorJson = [
                'self::error' => $message
            ];
            if ($data != null)
                $errorJson['data'] = $data;
            echo json_encode($errorJson);
        }
        die;
    }

    private static function matchRoute($routes = [], $url = null)
    {
        if (!isset($_SERVER['REDIRECT_URL']) && $url == null)
            return [];
        $reqUrl = $url ?? $_SERVER['REDIRECT_URL'];

        $reqUrl = rtrim($reqUrl, "/");

        foreach ($routes as $uri => $route) {
            if (strpos($uri, '{') === false)
                continue;
            $pattern = "@^" . preg_replace('/{[a-zA-Z0-9\_\-.]+}/', '([a-zA-Z0-9\_\-.]+)', $uri) . "$@D";
            $params = [];
            if (preg_match($pattern, $reqUrl, $params)) {
                array_shift($params);
                return [$route, $params];
            }
        }
        return [];
    }
}
