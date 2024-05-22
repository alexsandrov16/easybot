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
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public static function client($token, $uri, $options): ResponseInterface
    {
        $client = new Client([
            "base_uri" => "https://api.telegram.org/bot$token/"
        ]);



        try {
            /*if ($get) {
                return $this->client->get($path, $param);
            }*/
            return $client->post($uri, $options);
        } catch (ClientException $e) {
            /*$log = new Logger('telegram-api');
            $log->pushHandler(
                new StreamHandler("{$this->logs}error.log", Level::Error)
            );

            // add records to the log
            $log->error($e->getMessage());*/
        }
    }
}
