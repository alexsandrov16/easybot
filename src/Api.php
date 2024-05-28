<?php

namespace Al3x5\Easybot;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * undocumented class
 */
class Api
{
    private string $token;
    private array $cmd;
    private Client $client;
    private string $endpoint = 'https://api.telegram.org/bot';

    public function __construct(array $config)
    {
        $this->token = $config['token'];
        $this->cmd = $config['commands'];
        $this->client = new Client();
    }

    public function update(): array
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function run() //: Returntype
    {
        $update = $this->update();



        if (isset($update['message'])) {
            $update=$update['message'];
        }

        if (isset($update['callback_query'])) {
            $update=$update['callback_query'];

        }

        file_put_contents(
            'update.log',
            time() . '---' . '$update=' . json_encode($update, JSON_PRETTY_PRINT),
            FILE_APPEND
        );


        if (empty($update)) {
            file_put_contents('error.log', 'Empty $update', FILE_APPEND);
        }
        $this->sendMessage([
            'chat_id' => $update['from']['id'],
            'text' => '😉 Hola! Este es tu mensaje... 📨👇'.PHP_EOL.json_encode($update,JSON_PRETTY_PRINT)

        ]);
    }

    public function __call($name, array $params)
    {
        try {
            $response = $this->client->post(
                $this->endpoint . $this->token . "/$name",
                [
                    'form_params' => $params[0]
                ]
            );

            if ($response->getStatusCode()===200) {
                if ($name!=='sendMessage') {
                    return $response->getBody();
                }
            }


        } catch (ClientException $e) {
            file_put_contents('error.log', time() . '-' . $e->getMessage(), FILE_APPEND);
        }
    }
}
