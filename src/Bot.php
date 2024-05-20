<?php

namespace Al3x5\Easybot;

use Dotenv\Dotenv;

/**
 * undocumented class
 */
class Bot
{
    private static $instance;

    public function __construct($env)
    {
        //Carga variables de entorno para la configuracion
        (Dotenv::createImmutable($env))->load();
    }

    /**
     * Inicializa el bot
     **/
    public static function run($env)
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self($env);
        }

        /**
         * Logica para cargar todos los comandos y mensajes
         */

        return self::$instance;
    }
}
