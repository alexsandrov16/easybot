<?php

use GuzzleHttp\Client;
use Mk4U\Http\Status;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

require_once 'vendor/autoload.php';

$endpoint = 'https://api.telegram.org/bot';

$config = require 'config.php';

$client = new Client([
    "base_uri" => $endpoint . $config['token'] . '/'
]);

$response = $client->request('GET', "setWebhook?url={$config['webhook']}");

if ($response->getStatusCode() === Status::Ok->value) {
    echo 'Webhook listo' . PHP_EOL;
    $log = new Logger('up');
    $log->pushHandler(new StreamHandler('logs/debug.log', Level::Info));

    // add records to the log
    $log->debug($response->getBody());
} else {
    echo 'Error al establecer webhook' . PHP_EOL;
}
