<?php

namespace ShubhamGupta16\LaraliteCore;

use ShubhamGupta16\LaraliteCore\Types\TypeJson;
use ShubhamGupta16\LaraliteCore\Types\TypeView;

class Response {

    static public function json(array|object|string|int|float $data): TypeJson
    {
        return new TypeJson('', $data);
    }

    static public function view(string $file_name): TypeView
    {
        return new TypeView('', $file_name);
    }
}