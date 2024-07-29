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
        $data = (new Request)->jsonData(true);

        if (empty($data)) {
            throw new ApiException("¡Update vacío! El webhook no debe ser llamado manualmente, sólo por Telegram.");
        }

        if (env('dev')) {
            logging('development', env('logs') . 'update.log', json_encode($data));
        }

        $this->update = new Update($data);
    }

    public function run()
    {
        $this->getUpdate();

        return match ($this->update->type()) {
            'message' => $this->message(),
            'callback_query' => $this->callback(),
        };
    }

    /**
     * Ejecuta el metodo especificado de la API de Telegram
     */
    public function __call($name, array $params)
    {
        $method = new Method($name, $params[0] ?? []);
        return $method->execute($this->client);
    }

    public function message() //: Returntype
    {
        $message = $this->update->get('message');

        if ($message->isCommand()) {
            //return $this->handlerCommand($message->text);
            return $this->sendMessage([
                'chat_id' => $message->chat->id,
                'text' => 'Soy un comando'
    
            ]);
        } else {
            return $this->sendMessage([
                'chat_id' => $message->chat->id,
                'text' => 'Soy un mensaje de *_texto_*'
    
            ]);
        }
    }

    public function callback() //: Returntype
    {
        $callback = $this->update->get('callback_query');

        return $this->editMessageText([
            'chat_id' => $callback->message->chat->id,
            'message_id' => $callback->message->message_id,
            //'text' => '😉 Hola! Este es tu mensaje de texto' . PHP_EOL . json_encode($callback->message, JSON_PRETTY_PRINT).PHP_EOL.PHP_EOL.'Opcion '.$callback->data,
            'text' => 'Precionaste la opcion ' . $callback->data

        ]);
    }
}
