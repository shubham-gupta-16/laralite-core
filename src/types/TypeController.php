<?php

namespace ShubhamGupta16\LaraliteCore\Types;

use ShubhamGupta16\LaraliteCore\RouteMap;

class TypeController
{
    public $route_map;
    public $file;
    public $fun;

    public function __construct(?RouteMap $route_map, string $file_name)
    {
        $this->route_map = $route_map;
        $this->file = $file_name;
    }

    public function fun(string $function_name): TypeController
    {
        $this->fun = $function_name;
        return $this;
    }
}
