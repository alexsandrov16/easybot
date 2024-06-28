<?php

namespace Al3x5\Easybot\Entities;

/**
 * Entity Class
 */
abstract class Entity
{
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            # code...
        }
    }

    public function __get(string $name): mixed
    {
        $property = strtolower(preg_replace('/(?<!^)([A-Z])/', '_$1', $name));
        return $this->$property;
    }
}
