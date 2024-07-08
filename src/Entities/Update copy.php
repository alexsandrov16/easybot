<?php

namespace Al3x5\Easybot\Entities;

use Al3x5\Easybot\Entities\Interfaces\ObjectsInterface;
use Al3x5\Easybot\Exceptions\ApiException;

/**
 * undocumented class
 * 
 * update_id 	Integer 	El identificador único de la actualización. Los identificadores de actualización comienzan a partir de un determinado número positivo y aumentan secuencialmente. Este identificador resulta especialmente útil si utiliza webhooks , ya que le permite ignorar las actualizaciones repetidas o restaurar la secuencia de actualización correcta, en caso de que se estropeen. Si no hay nuevas actualizaciones durante al menos una semana, el identificador de la próxima actualización se elegirá aleatoriamente en lugar de secuencialmente. 
 * 
 * message 	Message 	Opcional . Nuevo mensaje entrante de cualquier tipo: texto, foto, pegatina, etc.
 * 
 * edited_message 	Message 	Opcional . Nueva versión de un mensaje que el bot conoce y que fue editado. En ocasiones, esta actualización puede desencadenarse por cambios en los campos de mensajes que no están disponibles o que su bot no utiliza activamente.
 * 
 * channel_post 	Message 	Opcional . Nueva publicación entrante del canal de cualquier tipo: texto, foto, calcomanía, etc.
 * 
 * edited_channel_post 	Message 	Opcional . Nueva versión de una publicación de canal que el bot conoce y que fue editada. En ocasiones, esta actualización puede desencadenarse por cambios en los campos de mensajes que no están disponibles o que su bot no utiliza activamente.
 * 
 * business_connection 	BusinessConnection 	Opcional . El bot se conectó o desconectó de una cuenta comercial, o un usuario editó una conexión existente con el bot
 * 
 * business_message 	Message 	Opcional . Nuevo mensaje de una cuenta comercial conectada
 * 
 * edited_business_message 	Message 	Opcional . Nueva versión de un mensaje de una cuenta comercial conectada
 * 
 * deleted_business_messages 	BusinessMessagesDeleted 	Opcional . Se eliminaron mensajes de una cuenta comercial conectada
 * 
 * message_reaction 	MessageReactionUpdated 	Opcional . Un usuario cambió una reacción a un mensaje. El bot debe ser administrador en el chat y debe especificar explícitamente "message_reaction"en la lista de actualizaciones_permitidas para recibir estas actualizaciones. La actualización no se recibe para las reacciones establecidas por los bots.
 * 
 * message_reaction_count 	MessageReactionCountUpdated 	Opcional . Se cambiaron las reacciones a un mensaje con reacciones anónimas. El bot debe ser administrador en el chat y debe especificar explícitamente "message_reaction_count"en la lista de actualizaciones_permitidas para recibir estas actualizaciones. Las actualizaciones están agrupadas y pueden enviarse con un retraso de hasta unos minutos.
 * 
 * inline_query 	InlineQuery 	Opcional . Nueva entrante en línea consulta
 * 
 * chosen_inline_result 	ChosenInlineResult 	Opcional . El resultado de una consulta en línea elegida por un usuario y enviada a su compañero de chat. Consulte nuestra documentación sobre la recopilación de comentarios para obtener detalles sobre cómo habilitar estas actualizaciones para su bot.
 * 
 * callback_query 	CallbackQuery 	Opcional . Nueva consulta de devolución de llamada entrante
 * 
 * shipping_query 	ShippingQuery 	Opcional . Nueva consulta de envío entrante. Sólo para facturas con precio flexible
 * 
 * pre_checkout_query 	PreCheckoutQuery 	Opcional . Nueva consulta entrante previa al pago. Contiene información completa sobre el pago.
 * 
 * poll 	Poll 	Opcional . Nuevo estado electoral. Los bots solo reciben actualizaciones sobre encuestas detenidas manualmente y encuestas enviadas por el bot.
 * 
 * poll_answer 	PollAnswer 	Optional. Opcional . Un usuario cambió su respuesta en una encuesta no anónima. Los bots reciben nuevos votos solo en las encuestas enviadas por el propio bot.
 * 
 * my_chat_member 	ChatMemberUpdated 	Opcional . El estado de miembro del chat del bot se actualizó en un chat. Para los chats privados, esta actualización se recibe solo cuando el usuario bloquea o desbloquea el bot.
 * 
 * chat_member 	ChatMemberUpdated 	Opcional . El estado de un miembro del chat se actualizó en un chat. El bot debe ser administrador en el chat y debe especificar explícitamente "chat_member" en la lista de actualizaciones_permitidas para recibir estas actualizaciones.
 * 
 * chat_join_request 	ChatJoinRequest 	Opcional . Se ha enviado una solicitud para unirse al chat. El bot debe tener el derecho de administrador can_invite_users en el chat para recibir estas actualizaciones.
 * 
 * chat_boost 	ChatBoostUpdated 	Opcional . Se agregó o cambió un impulso de chat. El bot debe ser administrador en el chat para recibir estas actualizaciones.
 * 
 * removed_chat_boost 	ChatBoostRemoved 	Opcional . Se eliminó un impulso de un chat. El bot debe ser administrador en el chat para recibir estas actualizaciones. 
 */
class Update implements TgObjectInterface
{
    //private int $update_id;
    //private Message $message;
    /*private Message $edited_message;
    private Message $channel_post;
    private Message $edited_channel_post;
    //private BusinessConnection $business_connection;
    private Message $edited_business_message;
    private Message $deleted_business_messages;*/
    //private BusinessMessagesDeleted $message_reaction;
    //private MessageReactionUpdated $message_reaction_count;
    //private MessageReactionCountUpdated $inline_query;
    //private InlineQuery $chosen_inline_result;
    #private CallbackQuery $callback_query;
    //private ShippingQuery $shipping_query;
    //private PreCheckoutQuery $pre_checkout_query;
    //private Poll $poll;
    //private PollAnswer $poll_answer;
    //private ChatMemberUpdated $my_chat_member;
    //private ChatMemberUpdated $chat_member;
    //private ChatJoinRequest $chat_join_request;
    //private ChatBoostUpdated $chat_boost;
    //private ChatBoostRemoved $removed_chat_boost;

    use Entity;

    public function __construct(array $data)
    {
        if (empty($data)) {
            throw new ApiException("¡Update vacío! El webhook no debe ser llamado manualmente, sólo por Telegram.");
        }

        if (env('dev')) {
            logging('development', env('logs') . 'update.log', json_encode($data));
        }
    }

    public function test( $var = null) : void
    {
        # code...
    }
}
