<?php

if (!function_exists('env')) {
    /**
     * Carga las variables de entorno establecidads en el fichero .ENV
     */
    function env(string $name, mixed $default = null): mixed
    {
        return $_ENV[$name] ?? $default;
    }
}
