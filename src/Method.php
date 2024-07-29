<?php

namespace Al3x5\Easybot;

use Al3x5\Easybot\Exceptions\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Telegram Api Methods Class
 */
class Method
{
    private array $apiMethod = [
        'getMe',
        'setWebhook',
        'deleteWebhook',
        'getWebhookInfo', //Informativos
        'sendMessage',
        'forwardMessage',
        'forwardMessages',
        'copyMessage',
        'sendPhoto',
        'sendAudio',
        'sendDocument',
        'sendVideo',
        'sendAnimation',
        'sendPoll',
        'sendDice',

        'editMessageText',

        'sendChatAction',//Estado
    ];

    //private

    public function __construct(private string $method, private array $params)
    {
        if ($this->has($method) == false) {
            throw new ApiException("Error metodo '$method' no encontrado");
        }

        $this->method = $method;
        $this->params = $params;
    }

    public function has(string $name): bool
    {
        return in_array($name, $this->apiMethod);
    }

    public function execute(Client $client) //: Returntype
    {
        try {
            $response = $client->post(
                env('endpoint') . $this->method,
                [
                    'form_params' => $this->params
                ]
            );

            if ($response->getStatusCode() === 200) {
                if ($this->method !== 'sendMessage') {
                    $result = json_decode($response->getBody(), true);
                    return match ($this->method) {
                        'getMe' => $this->printCLi($result['result']),
                        'setWebhook' =>$result['description'].PHP_EOL,
                        'deleteWebhook' => $result['description'].PHP_EOL,
                        'getWebhookInfo' => $this->printCLi($result['result']),
                        default=>json_encode($result).PHP_EOL
                    };
                }
            }
        } catch (ClientException $e) {
            logging(
                'TelegramApi',
                env('logs') . get_class($e),
                $e->getMessage() . '' . $e->getTraceAsString(),
                ['code' => $e->getCode()]
            );
        }
    }

    public function printCLi(array $data): string
    {
        $output='';
        foreach ($data as $key => $value) {
            $output .= "$key: $value" . PHP_EOL;
        }
        return $output;
    }
}
