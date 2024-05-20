<?php

use Al3x5\Easybot\Bot;
use Al3x5\Easybot\Telegram;

require_once 'vendor/autoload.php';
/*
$bot = new Telegram('Tokenbot');

$bot->config([
    'logs' => __DIR__ . DIRECTORY_SEPARATOR
]);
//$bot->run();

//echo $bot->getMe();
//$bot->deleteWebhook();
//$bot->setWebhook('https://bd7e-152-206-215-188.ngrok-free.app/easybot/hook.php');
//echo $bot->getWebhookInfo();
*/
Bot::run(__DIR__);

//QUITAR .ENV Y METER TODAS LAS CONFIGURACIONES EN UN ARCHIVO CONFIG.PHP
dd(env('API_TOKEN'));
