<?php

namespace Al3x5\Easybot;

use Al3x5\Easybot\Entities\Update;
use Al3x5\Easybot\Exceptions\ApiException;
use Al3x5\Easybot\Exceptions\ExceptionHandler;
use GuzzleHttp\Client;
use Mk4U\Http\Request;

/**
 * Api Class
 */
class Api
{
    private Client $client;

    private Update $update;

    public function __construct(array $cfg)
    {
        new Config($cfg);
        $this->client = new Client();

        ExceptionHandler::start();
    }

    public function update(): array|object
    {
        $input = (new Request)->jsonData(false);

        if (empty($input)) {
            throw new ApiException("¡Update vacío! El webhook no debe ser llamado manualmente, sólo por Telegram.");
        }

        if (env('dev')) {
            logging('development', env('logs') . 'update.log', json_encode($input));
        }

        return $input;
    }

    public function run()
    {
        $update = $this->update();


        /*
        if (isset($update['message'])) {
            $update = $update['message'];
        }

        if (isset($update['callback_query'])) {
            $update = $update['callback_query'];
        }


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
        /*
        $this->sendMessage([
            'chat_id' => $update['from']['id'],
            'text' => '😉 Hola! Este es tu mensaje... 📨👇' . PHP_EOL . json_encode($update, JSON_PRETTY_PRINT),
            'reply_markup' => json_encode($keyboard)


        ]);
        
*/
    }

    public function __call($name, array $params)
    {
        $method = new Method($name, $params[0] ?? []);
        return $method->execute($this->client);
    }

    public function processUpdate() //: Returntype
    {
        # code...
    }
}
