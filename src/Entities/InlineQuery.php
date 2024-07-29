<?php

namespace Al3x5\Easybot\Entities;

/**
 * undocumented class
 */
class InlineQuery extends Base
{
    public function getEntities() : array
    {
        return [
            'from'=>User::class
        ];
    }
}
