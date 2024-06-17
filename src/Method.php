<?php

namespace Al3x5\Easybot;

use Al3x5\Easybot\Exceptions\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * undocumented class
 */
class Method
{
    private array $apiMethod = [
        'getMe',
        'setWebhook',
        'deleteWebhook',
        'getWebhookInfo',//Informativos
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

    //private

    public function __construct(private string $method, private array $params)
    {

        if ($this->has($method)==false) {
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
                //if ($this->method !== 'sendMessage') {
                    return $response->getBody();
                //}
            }
        } catch (ClientException $e) {
            logging(
                'TelegramApi',
                get_class($e),
                $e->getMessage().''.$e->getTraceAsString()
            );
        }
    }
}
