<?php

use Al3x5\Easybot\Api;

require_once 'vendor/autoload.php';

$bot = new Api([
    'token' => '709i4YCyrSZU',
    'commands' => []
]);
//$bot->setWebhook(['url'=>'/easybot/example.php']);

$bot->run();
