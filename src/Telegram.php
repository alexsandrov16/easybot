<?php

namespace Al3x5\Easybot;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Mk4U\Http\Request;
use Mk4U\Http\Status;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;

/**
 * undocumented class
 */
final class Telegram
{
    /** @var Client $client Instancia de GuzzleHttp\Client */
    private Client $client;

    /** @param Request $request Instancia de Mk4U\Http\Request */
    private Request $request;

    private ?string $logs;

    public function __construct(string $token)
    {
        $this->client = new Client([
            "base_uri" => "https://api.telegram.org/bot$token/"
        ]);
    }

    /**
     * Establecer configuracion del bot
     */
    public function config($config): void
    {
        $this->logs = $config . '/';
    }

    /**
     * Envia la solicitud el bot
     **/
    public function send(string $path, array $param = [], bool $get = true): ResponseInterface
    {
        try {
            if ($get) {
                return $this->client->get($path, $param);
            }
            return $this->client->post($path, $param);
        } catch (ClientException $e) {
            $log = new Logger('telegram-api');
            $log->pushHandler(
                new StreamHandler("{$this->logs}error.log", Level::Error)
            );

            // add records to the log
            $log->error($e->getMessage());
        }
    }

    /**
     * Inicializa el bot
     **/
    public function run()
    {
        //captura solicitud hecha al bot
        $this->request = new Request;

        $json = $this->request->jsonData(false);
    }

    /**
     * Establecer Webhook
     */
    public function setWebhook(string $url): string
    {
        $param = [
            "query" => "url=$url"
        ];
        $response = $this->send('setWebhook', $param);

        if ($response->getStatusCode() === Status::Ok->value) {
            return 'Webhook listo' . PHP_EOL;
        } else {
            return 'Error al establecer webhook' . PHP_EOL;
        }
    }

    /**
     * Establecer Webhook
     */
    public function deleteWebhook(): string
    {
        $response = $this->send('deleteWebhook');

        if ($response->getStatusCode() === Status::Ok->value) {
            return 'Webhook eliminado correctamente' . PHP_EOL;
        } else {
            return 'Error al eliminar webhook' . PHP_EOL;
        }
    }

    /**
     * Devuelve info del bot
     */
    private function info(string $info): string
    {
        $response = $this->send($info);

        return $response->getBody();
    }

    /**
     * Obtener info del Bot
     */
    public function getMe(): string
    {
        return $this->info(__FUNCTION__);
    }


    /**
     * Obtener info de webhook
     */
    public function getWebhookInfo(): string
    {
        return $this->info(__FUNCTION__);
    }
}
