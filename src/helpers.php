<?php

use Al3x5\Easybot\Exceptions\ApiException;

/**
 * @DREPECADE
 */
if (!function_exists('configr')) {
    /**
     * Establecer variable de entorno para la configuracion
     * 
     * Ej: [
     *      'token' => '',
     *      'name'=>'',
     *      'endpoint' => 'https://api.telegram.org/bot{TOKEN}/',
     *      'handlers' => [
     *          'commands' => [],
     *          'callbacks' => [],
     *          'buttons_response' => []
     *      ],
     *      'logs' => 'path/logs/'
     * ]
     */
    function configr(array $cfg): void
    {
        $_ENV['token'] = $cfg['token'] ?? throw new ApiException("Token del bot no especificado");
        $_ENV['endpoint'] = $cfg['endpoint'] ?? 'https://api.telegram.org/bot{TOKEN}/';

        if (isset($cfg['handlers'])) {
            if (!is_array($cfg['handlers'])) {
                throw new ApiException("El handler parametro debe ser un array");
            }
            foreach (['commands', 'callbacks', 'texts'] as $value) {
                if (!in_array($value, $cfg['handlers'])) {
                    $cfg['handlers'][$value] = [];
                }
            }
        }

        $_ENV = $cfg;
    }
}

if (!function_exists('env')) {
    /**
     * 
     */
    function env(string $name, mixed $default = null): mixed
    {
        return $_ENV[$name] ?? $default;
    }
}
