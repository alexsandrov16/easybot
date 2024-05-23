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
            'chat_id' => 649800747,
            'text' => 'Hola!'

        ]);
    }

    public function sendMessage($params)
    {
        try {
            $response = $this->client->get(
                $this->endpoint . $this->token . '/sendMessage',
                [
                    'query' => $params
                ]
            );
        } catch (ClientException $e) {
            file_put_contents('error.log', time() . '---' . $e->getMessage(), FILE_APPEND);
        }
    }
}
