<?php

namespace Al3x5\Easybot;

/**
 * undocumented class
 */
class Api
{
    public function __construct(private string $token)
    {
        $this->token = $token;
    }

    public function __call($name, $params)
    {
        return Http::client($this->token, $name, $params);
    }
}
