<?php

namespace ShubhamGupta16\LaraliteCore\Types;

class TypeController
{
    public $method;
    public $file;
    public $fun;

    public function __construct(string $method, string $file_name)
    {
        $this->method = $method;
        $this->file = $file_name;
    }

    public function fun(string $function_name): TypeController
    {
        $this->fun = $function_name;
        return $this;
    }
}
