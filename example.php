<?php

use Al3x5\Easybot\Api;

require_once 'vendor/autoload.php';

$bot = new Api([
    'token' => '213456:aVd_asSDLrvDDlgfZCXoyrPs',
    'commands' => []
]);
//$bot->setWebhook(['url'=>'/easybot/example.php']);

$bot->run();
