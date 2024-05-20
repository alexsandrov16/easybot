<?php

use Al3x5\Easybot\Bot;
use Al3x5\Easybot\TelegramLogger;

require_once 'vendor/autoload.php';

//Bot::run(__DIR__);

$log = new TelegramLogger(__DIR__ . '/');

$log->update('Mensaje de error',['algo de contexto'=>'no se como saldra esto']);
