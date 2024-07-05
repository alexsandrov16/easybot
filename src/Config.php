<?php

namespace Al3x5\Easybot;

use Al3x5\Easybot\Exceptions\ApiException;

/**
 * Config class
 */
class Config
{
    private string $token;
    private string $name;
    private const ENDPOINT = 'https://api.telegram.org/bot{TOKEN}/';
    private array $handlers;
    private array $logs;

    public function __construct(array $cfg)
    {
        if (empty($cfg)) {
            throw new ApiException("Error, config empty");
        }

        if (!isset($cfg['token'])) {
            throw new ApiException("TOKEN Api no definido");
        }

        $_ENV = [
            'token' => self::token($cfg['token']),
            'name' => $cfg['name'] ?? null,
            //'exceptions' => $cfg['exceptions'] ?? true,
            //'async' => $cfg['async'] ?? false,
            //'storage' => $cfg['storage'] ?? \WeStacks\TeleBot\Storage\JsonStorage::class,
            'endpoint' => $cfg['api_url'] ?? self::endpoint('https://api.telegram.org/bot{TOKEN}/', $cfg['token']),
            /*'http' => $cfg['http'] ?? [],
            'webhook' => $cfg['webhook'] ?? [],
            'poll' => $cfg['poll'] ?? [],
            'handlers' => $cfg['handlers'] ?? null,*/
            'dev' => $cfg['dev'] ?? false,
            'logs' => !empty($cfg['logs'])?rtrim($cfg['logs'], '/') . '/': dirname(__DIR__,2)
        ];


        /*foreach ($cfg as $key => $value) {
            $this->cfg[$key] = match ($key) {
                'token' => self::token($value),
                'name' => self::name($value),
                'endpoint' => self::endpoint($value, $cfg['token']),
                'handlers' => self::handlers($value),
                'logs' => self::logs($value),
                default => throw new ApiException("Error Processing parameter invalid")
            };
        }


        $_ENV = $this->cfg;*/
    }

    private static function token(string $token): string
    {

        if (preg_match('/(\d+):[\w\-]+/', $token)) {
            return $token;
        }

        throw new ApiException('Invalid TOKEN API defined!');
    }

    private static function endpoint(string $endpoint, string $token): string
    {
        return str_replace('{TOKEN}', $token, $endpoint);
    }
}
