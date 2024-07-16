<?php

namespace Al3x5\Easybot\Entities;

/**
 * undocumented class
 */
class CallbackQuery extends Base
{
    public function getEntities(): array
    {
        return [
            'from' => User::class,
            'message' => Message::class,
        ];
    }
}
