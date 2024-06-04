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

    //private

    public function __construct(private string $method, private array $params)
    {
        if ($this->has($method)) {
            $this->method = $method;
            $this->params = $params;
        }

        throw new ApiException("Error metodo api no encontrado");
        
    }

    public function has(string $name): bool
    {
        return in_array($name, $this->apiMethod);
    }

    public function execute(Client $client) //: Returntype
    {
        try {
            $response = $client->post(
                env('endpoint') . "/$this->method",
                [
                    'form_params' => $params[0] ?? []
                ]
            );

            if ($response->getStatusCode() === 200) {
                if ($this->method !== 'sendMessage') {
                    return $response->getBody();
                }
            }
        } catch (ClientException $e) {
            file_put_contents('error.log', time() . '-' . $e->getMessage(), FILE_APPEND);
        }
    }
}
