<?php

namespace Al3x5\Easybot;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;

/**
 * Telegram Api Class
 */
class Api
{
    /** @var Client $client Instancia de GuzzleHttp\Client */
    private Client $client;

    public function __construct($token)
    {


        $this->client = new Client([
            "base_uri" => "https://api.telegram.org/bot$token/"
        ]);
    }

    public function hendler(string $path, array $param = [], bool $get = true): ResponseInterface
    {
        try {
            return ($get)
                ? $this->client->get($path, $param)
                : $this->client->post($path, $param);
        } catch (ClientException $e) {
            $log = new Logger('telegram-api');
            $log->pushHandler(
                new StreamHandler("../error.log", Level::Error)
            );

            // add records to the log
            $log->error($e->getMessage());
        }
    }
}
