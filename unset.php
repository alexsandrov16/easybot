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
    "base_uri" => $endpoint.$config['token'].'/'
]);

//dd($endpoint.$config['token']);

$response = $client->request('GET', "deleteWebhook");

if ($response->getStatusCode() === Status::Ok->value) {
    echo 'Webhook eliminado correctamente'.PHP_EOL;

    $log = new Logger('up');
    $log->pushHandler(new StreamHandler('logs/debug.log', Level::Info));

    // add records to the log
    $log->debug($response->getBody());
} else {
    echo 'Error al eliminar webhook'.PHP_EOL;
}