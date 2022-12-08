<?php

namespace ShubhamGupta16\LaraliteCore\Types;

class TypeJson
{
    public $method;
    public $data;
    public $status;
    public $headers;

    public function __construct(string $method, array|object|string|int|float $data)
    {
        $this->method = $method;
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
}
