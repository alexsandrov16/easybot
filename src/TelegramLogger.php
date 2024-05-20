<?php

namespace Al3x5\Easybot;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

/**
 * TelegramLogger class
 */
class TelegramLogger
{
    /** @param Logger $logs Instancia de la clase Logger de Monolog */
    private Logger $logs;

    public function __construct(private string $path)
    {
        $this->logs = new Logger('TELEGRAM-API');

        $this->path = $path;
    }

    /**
     * Crea el archivo de registro para los eventos tipo ERROR
     **/
    public function error(string $message, array $context = []): void
    {
        $this->stream(__FUNCTION__ . '.log', Level::Error);
        $this->logs->error($message, $context);
    }

    /**
     * Crea el archivo de registro para los eventos tipo DEBUG
     **/
    public function debug(string $message, array $context = []): void
    {
        $this->stream(__FUNCTION__ . '.log', Level::Debug);
        $this->logs->debug($message, $context);
    }

    /**
     * Crea el archivo de registro para los eventos tipo UPDATE
     **/
    public function update(string $message, array $context = []): void
    {
        $this->stream('update.log', Level::Info);
        $this->logs->info($message, $context);
    }

    /**
     * Manejador de la creacion de fujos de archivos
     **/
    private function stream(string $file, Level $level): void
    {
        $this->logs->pushHandler(
            new StreamHandler($this->path . $file, $level)
        );
    }
}
