<?php

namespace Al3x5\Easybot;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Api Class
 */
class Api
{
    private string $token;
    private array $cmd;
    private Client $client;
    private string $endpoint = 'https://api.telegram.org/bot';
    private array $apiMethod = [
        'getMe',
        'setWebhook',
        'deleteWebhook',
        'getWebhookInfo',


        'sendMessage',
        'forwardMessage',
        'forwardMessages',
        ' copyMessage',
        'sendPhoto',
        'sendAudio',
        'sendDocument',
        'sendVideo',
        'sendAnimation',
        'sendPoll',
        'sendDice',
    ];

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
            $update = $update['message'];
        }

        if (isset($update['callback_query'])) {
            $update = $update['callback_query'];
        }

        file_put_contents(
            'update.log',
            time() . '---' . '$update=' . json_encode($update, JSON_PRETTY_PRINT),
            FILE_APPEND
        );


        if (empty($update)) {
            file_put_contents('error.log', 'Empty $update', FILE_APPEND);
        }

        $keyboard = [
            'keyboard' => [
                ['👤 Perfil', '🏦 Banca', 'Jugar'],
                ['⚙️ Más opciones']
            ],
            'resize_keyboard' => true, // Ajusta el tamaño del teclado
            //'one_time_keyboard' => true // Indicar que el teclado se usa una vez
        ];

        /*$keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => 'Opción 1', 'callback_data' => 'opcion1'],
                    ['text' => 'Opción 2', 'callback_data' => 'opcion2']
                ]
            ]
        ];*/

        $this->sendMessage([
            'chat_id' => $update['from']['id'],
            'text' => '😉 Hola! Este es tu mensaje... 📨👇' . PHP_EOL . json_encode($update, JSON_PRETTY_PRINT),
            'reply_markup' => json_encode($keyboard)


        ]);
    }

    public function __call($name, array $params)
    {
        if (!$this->hasMethod($name)) {
            throw new \InvalidArgumentException();
            
        }
        try {
            $response = $this->client->post(
                $this->endpoint . $this->token . "/$name",
                [
                    'form_params' => $params[0] ?? []
                ]
            );

            if ($response->getStatusCode() === 200) {
                if ($name !== 'sendMessage') {
                    return $response->getBody();
                }
            }
        } catch (ClientException $e) {
            file_put_contents('error.log', time() . '-' . $e->getMessage(), FILE_APPEND);
        }
    }

    public function hasMethod(string $name): bool
    {
        return in_array($name, $this->apiMethod);
    }
}
