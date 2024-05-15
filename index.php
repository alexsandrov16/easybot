<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Mk4U\Http\Request;
use Mk4U\Http\Status;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

require_once 'vendor/autoload.php';

$config = require 'config.php';

$endpoint = 'https://api.telegram.org/bot';


$request = new Request;

$json = $request->jsonData();
//if ($json->ok) {

$chatId = $json['message']['chat']['id'];
$name = $json['message']['from']['first_name'];
$message = $json['message']['text'];

$client = new Client([
    'base_uri' => $endpoint . $config['token'] . '/'
]);


//$response = $client->get("/sendMessage?chat_id=$chatId&text=Hola $name");
/*$client->get("/sendMessage?chat_id=$chatId&text=Este fue tu mensaje anterior
    
    $message");*/

try {
    $client->request('GET', "sendMessage?chat_id=$chatId&text=Hola $name");

    $client->get("sendMessage?chat_id=$chatId&text=Este fue tu mensaje anterior
    
".json_encode($json,JSON_PRETTY_PRINT));

    $log = new Logger('up');
    $log->pushHandler(new StreamHandler('logs/debug.log', Level::Info));

    // add records to the log
    $log->debug($response->getBody());
} catch (ClientException $e) {
    $log = new Logger('down');
    $log->pushHandler(new StreamHandler('logs/error.log', Level::Error));

    // add records to the log
    $log->error($e->getMessage());
}
//}
