<?php

namespace ShubhamGupta16\LaraliteCore\Types;

use ShubhamGupta16\LaraliteCore\RouteMap;

class TypeView
{
    public $route_map;
    public $file;
    public $data;
    public $status;
    public $headers;

    public function __construct(?RouteMap $route_map, string $file_name)
    {
        $this->route_map = $route_map;
        $this->file = $file_name;
    }

    public function with(array $data): TypeView
    {
        $this->data = $data;
        return $this;
    }

    public function status(int $status): TypeView
    {
        $this->status = $status;
        return $this;
    }

    public function headers(array $headers): TypeView
    {
        $this->headers = $headers;
        return $this;
    }

    public function addHeader(string $key, string $value): TypeView
    {
        if (!isset($this->headers)) {
            $this->headers = [];
        }
        $this->headers[$key] = $value;
        return $this;
    }
}
