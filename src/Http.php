<?php

namespace Al3x5\Easybot;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

/**
 * undocumented class
 */
class Http
{
    public static function client($token, $uri, $options): ResponseInterface
    {
        $client = new Client();


        try {
            /*if ($get) {
                return $this->client->get($path, $param);
            }*/
            return $client->post("https://api.telegram.org/bot$token/$uri", ['form_params' => $options]);
        } catch (ClientException $e) {
            /*$log = new Logger('telegram-api');
            $log->pushHandler(
                new StreamHandler("{$this->logs}error.log", Level::Error)
            );

            // add records to the log
            $log->error($e->getMessage());*/
        }
    }

    public static function update(): array
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return file_get_contents('php://input', true);
        }
        return [];
    }
}
