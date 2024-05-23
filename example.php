<?php

use Al3x5\Easybot\Api;

require_once 'vendor/autoload.php';

$bot = new Api([
    'token' => '7066153350:AAFqaUmSIMMDRrw-WWIxctK2lw45YCyrSZU',
    'commands' => []
]);
//$bot->setWebhook(['url'=>'/easybot/example.php']);

$bot->run();
