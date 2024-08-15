<?php

namespace ShubhamGupta16\LaraliteCore;

use ShubhamGupta16\LaraliteCore\Types\TypeJson;
use ShubhamGupta16\LaraliteCore\Types\TypeView;

class Response {

    static public function json(array|object|string|int|float $data): TypeJson
    {
        return new TypeJson(null, $data);
    }

    static public function view(string $file_name): TypeView
    {
        return new TypeView(null, $file_name);
    }
}