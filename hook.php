<?php

use Al3x5\Easybot\Telegram;
use Al3x5\Easybot\TelegramException;

require_once 'vendor/autoload.php';

$bot = new Telegram('Tokenbot');

$bot->config(__DIR__);
//$bot->run();

//echo $bot->getMe();
//$bot->deleteWebhook();
//$bot->setWebhook('https://bd7e-152-206-215-188.ngrok-free.app/easybot/hook.php');
//echo $bot->getWebhookInfo();