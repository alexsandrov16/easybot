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

        file_put_contents(
            'update.log',
            time() . '---' . '$update=' . json_encode($this->update(), JSON_PRETTY_PRINT),
            FILE_APPEND
        );


        if (empty($update)) {
            file_put_contents('error.log', 'Empty $update', FILE_APPEND);
        }
        $this->sendMessage([
            'chat_id' => $update['message']['from']['id'],
            'text' => 'Hola! Este es tu mensaje...'.PHP_EOL.json_encode($update,JSON_PRETTY_PRINT)

        ]);
    }

    public function sendMessage($params)
    {
        try {
            $response = $this->client->post(
                $this->endpoint . $this->token . '/sendMessage',
                [
                    'form_params' => $params
                ]
            );
        } catch (ClientException $e) {
            file_put_contents('error.log', time() . '---' . $e->getMessage(), FILE_APPEND);
        }
    }
}
