<?php

namespace Al3x5\Easybot;

use Al3x5\Easybot\Exceptions\ApiExceptions;

/**
 * undocumented class
 */
class Api
{
    private string $token;
    private array $cmd;

    public function __construct(array $config)
    {
        $this->token = $config['token'];
        $this->cmd = $config['commands'];
    }

    public function hookUpdate(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Update::set(file_get_contents('php://input', false));
        }
    }

    public function run() //: Returntype
    {
        $update = Http::update();

        if (!empty($update)) {
            $this->sendMessage([
                'chat_id' => $update['message']['from']['id'],
                'text' => 'Hola ' . $update['message']['from']['first_name'] . ', este fue tu mensaje anterior...' . PHP_EOL . json_encode($update, JSON_PRETTY_PRINT)
            ]);
        }
    }

    public function __call($method, $params)
    {
        return Http::client($this->token, $method, $params);
    }
}
