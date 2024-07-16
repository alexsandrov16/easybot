<?php

namespace Al3x5\Easybot\Entities;

/**
 * undocumented class
 */
class MessageEntity extends Base
{
    public function getEntities(): array
    {
        return [
            'user' => User::class
        ];
    }
}
