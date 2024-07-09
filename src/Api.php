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

    private /*Update */ $update;

    /**
     * Inicializa el bot
     */
    public function __construct(array $cfg)
    {
        new Config($cfg);
        $this->client = new Client();

        ExceptionHandler::start();
    }

    /**
     * Obtiene el objeto Update de Telegram
     */
    public function getUpdate(): void
    {
        $this->update = //new Update(
            (new Request)->jsonData(true)
        /*)*/;

        if (empty($data)) {
            throw new ApiException("¡Update vacío! El webhook no debe ser llamado manualmente, sólo por Telegram.");
        }

        if (env('dev')) {
            logging('development', env('logs') . 'update.log', json_encode($data));
        }
    }

    public function run()
    {
        $this->getUpdate();
        logging('UpdateTest', env('logs') . 'updObj.log', json_encode($this->update));



        /*
        


        if (empty($update)) {
            file_put_contents('error.log', 'Empty $update', FILE_APPEND);
        }*/

        //Teclado simple
        $keyboard = [
            'keyboard' => [
                ['👤 Perfil', '🏦 Banca', '🎮 Jugar'],
                ['⚙️ Más opciones']
            ],
            'resize_keyboard' => true, // Ajusta el tamaño del teclado
            //'one_time_keyboard' => true // Indicar que el teclado se usa una vez
        ];

        // Datos del teclado inline
        $inline = [
            'inline_keyboard' => [
                [ // Primera fila
                    ['text' => 'Opción 1', 'callback_data' => 'opcion1'],
                    ['text' => 'Opción 2', 'callback_data' => 'opcion2']
                ],
                [ // Segunda fila
                    ['text' => 'Opción 3', 'callback_data' => 'opcion3']
                ]
            ]
        ];

        //dd($update);
        
        //Majea los mensajes
        if (isset($this->update->message)) {
            $this->sendMessage([
                'chat_id' => $this->update->message->from->id,
                'text' => '😉 Hola! Este es tu mensaje... 📨👇' . PHP_EOL . json_encode($this->update, JSON_PRETTY_PRINT),
                'reply_markup' => json_encode($inline)
    
    
            ]);
        }

        //Majea los callbacks
        if (isset($this->update->callback_query)) {
            $update = $this->update->callback_query;
            $this->sendMessage([
                'chat_id' => $this->update->callback_query->from->id,
                'text' => '😉 Hola! Este es tu mensaje... 📨👇' . PHP_EOL . json_encode($this->update, JSON_PRETTY_PRINT),
                'reply_markup' => json_encode($keyboard)
    
    
            ]);
        }

        /*

// Procesar la actualización
if ($this->update->hasUpdate()) {
    $update = $this->update->getUpdate();

    // Obtener el tipo de actualización
    $updateType = $update['update_id']; // Ajusta esto según tu estructura de actualización

    // Ejecutar la lógica del bot según el tipo de actualización
    if ($updateType === 'message') {
        // Manejar un mensaje
        $this->handleMessage($update);
    } else if ($updateType === 'callback_query') {
        // Manejar un callback_query
        $this->handleCallbackQuery($update);
    } else {
        // ... manejar otros tipos de actualización
    }
}*/
    }

    /**
     * Ejecuta el metodo especificado de la API de Telegram
     */
    public function __call($name, array $params)
    {
        $method = new Method($name, $params[0] ?? []);
        return $method->execute($this->client);
    }
}
