<?php

namespace ShubhamGupta16\LaraliteCore\Types;

class TypeView
{
    public $method;
    public $file;
    public $data;
    public $status;
    public $headers;

    public function __construct(string $method, string $file_name)
    {
        $this->method = $method;
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
}
