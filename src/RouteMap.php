<?php

namespace ShubhamGupta16\LaraliteCore;

use ShubhamGupta16\LaraliteCore\Types\TypeController;
use ShubhamGupta16\LaraliteCore\Types\TypeJson;
use ShubhamGupta16\LaraliteCore\Types\TypeView;

class RouteMap {

    public $method;
    public $middlewares;

    private function __construct(string $method)
    {
        $this->method = $method;
    }

    public function middleware(string $file_name): RouteMap
    {
        $this->middlewares[] = $file_name;
        return $this;
    }
    public function middlewares(array $array_of_file_names): RouteMap
    {
        $this->middlewares = $array_of_file_names;
        return $this;
    }

    public function controller(string $file_name): TypeController
    {
        return new TypeController($this, $file_name);
    }

    public function view(string $file_name) : TypeView
    {
        return new TypeView($this, $file_name);
    }

    public function json(array|object|string|int|float $data) : TypeJson
    {
        return new TypeJson($this, $data);
    }

    static public function get(): RouteMap
    {
        return new RouteMap('GET');
    }
    static public function post(): RouteMap
    {
        return new RouteMap('POST');
    }
    static public function put(): RouteMap
    {
        return new RouteMap('PUT');
    }
    static public function patch(): RouteMap
    {
        return new RouteMap('PATCH');
    }
    static public function delete(): RouteMap
    {
        return new RouteMap('DELETE');
    }
}