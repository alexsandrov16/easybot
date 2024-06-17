<?php

use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

if (!function_exists('env')) {
    /**
     * Obtiene Variables de entorno
     */
    function env(string $name, mixed $default = null): mixed
    {
        return $_ENV[$name] ?? $default;
    }
}

if (!function_exists('logging')) {
    /**
     * Establece archivos de registro
     */
    function logging(
        string $name,
        string $filename,
        string $message,
        array $context = []
    ): void {
        $logger = new Logger($name);
        $stream_handler = new StreamHandler($filename);

        if (env('dev') && preg_match('/^dev/', $name)) {
            $stream_handler->setFormatter(new JsonFormatter());
        }

        $logger->pushHandler($stream_handler);
        $logger->debug($message, $context);
    }
}
