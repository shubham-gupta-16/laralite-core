<?php

namespace ShubhamGupta16\LaraliteCore\Types;

use ShubhamGupta16\LaraliteCore\RouteMap;

class TypeJson
{
    public $route_map;
    public $data;
    public $status;
    public $headers;

    public function __construct(?RouteMap $route_map, array|object|string|int|float $data)
    {
        $this->route_map = $route_map;
        $this->data = $data;
    }

    public function status(int $status): TypeJson
    {
        $this->status = $status;
        return $this;
    }

    public function headers(array $headers): TypeJson
    {
        $this->headers = $headers;
        return $this;
    }

    public function addHeader(string $key, string $value): TypeJson
    {
        if (!isset($this->headers)) {
            $this->headers = [];
        }
        $this->headers[$key] = $value;
        return $this;
    }
}
