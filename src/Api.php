<?php

namespace Al3x5\Easybot;

use Al3x5\Easybot\Exceptions\ExceptionHandler;
use GuzzleHttp\Client;
use Mk4U\Http\Request;

//use GuzzleHttp\Exception\ClientException;

/**
 * Api Class
 */
class Api
{
    private Client $client;

    public function __construct(array $cfg)
    {
        new Config($cfg);
        $this->client = new Client();

        ExceptionHandler::start();
    }

    public function update(): array
    {
        return (new Request)->jsonData();
    }

    public function run()
    {
        $update = $this->update();

        if (env('dev')) {
            logging('dev', env('logs') . 'update.log', json_encode($update));
        }


        if (isset($update['message'])) {
            $update = $update['message'];
        }

        if (isset($update['callback_query'])) {
            $update = $update['callback_query'];
        }

        /*file_put_contents(
            'update.log',
            time() . '---' . '$update=' . json_encode($update, JSON_PRETTY_PRINT),
            FILE_APPEND
        );*/


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

        //dd($update);

        $this->sendMessage([
            'chat_id' => $update['from']['id'],
            'text' => '😉 Hola! Este es tu mensaje... 📨👇' . PHP_EOL . json_encode($update, JSON_PRETTY_PRINT),
            'reply_markup' => json_encode($keyboard)


        ]);
    }

    public function __call($name, array $params)
    {
        $method = new Method($name, $params[0] ?? []);
        return $method->execute($this->client);



        /*if (!$this->hasMethod($name)) {
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
        }*/
    }
}
