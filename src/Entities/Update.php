<?php

namespace Al3x5\Easybot\Entities;

use Al3x5\Easybot\Entities\Interfaces\EntitiesInterface;
use Al3x5\Easybot\Exceptions\ApiException;

/**
 * Update Entity
 */
class Update extends Base
{
    protected function getEntities(): array
    {
        return [
            'message'              => Message::class,
            'edited_message'       => Message::class,
            'channel_post'         => Message::class,
            'edited_channel_post'  => Message::class,
            'chosen_inline_result' => InlineQuery::class,
            'callback_query'       => CallbackQuery::class,
            'chosen_inline_result' => InlineQuery::class,

            //private ChatMemberUpdated $my_chat_member;
            //private ChatMemberUpdated $chat_member;
            //private ChatJoinRequest $chat_join_request;
        ];
    }
}
