<?php

erLhcoreClassRestAPIHandler::setHeaders();
$chat = erLhcoreClassChat::getSession()->load( 'erLhcoreClassModelChat', $Params['user_parameters']['chat_id']);

if ($chat->hash == $Params['user_parameters']['hash'] && ($chat->status == erLhcoreClassModelChat::STATUS_BOT_CHAT || $chat->status == erLhcoreClassModelChat::STATUS_PENDING_CHAT || $chat->status == erLhcoreClassModelChat::STATUS_ACTIVE_CHAT)) // Allow add messages only if chat is active
{
        if ($Params['user_parameters']['type'] == 1) {
        	$chat->fbst = $chat->fbst == 1 ? 0 : 1;
        }

        if ($Params['user_parameters']['type'] == 2){
        	$chat->fbst = $chat->fbst == 2 ? 0 : 2;
        }

        $chat->user_typing = time();
        $chat->user_typing_txt = ($chat->fbst == 1 ? erTranslationClassLhTranslation::getInstance()->getTranslation('chat/voteaction','Thumbs up') : ($chat->fbst == 2 ? erTranslationClassLhTranslation::getInstance()->getTranslation('chat/voteaction','Thumbs down') : erTranslationClassLhTranslation::getInstance()->getTranslation('chat/voteaction','Removed thumb vote')));

        if (strpos($chat->operation_admin,'lhinst.updateVoteStatus') === false) {
            $chat->operation_admin .= "lhinst.updateVoteStatus(".$chat->id.");";
        }

        if (strlen($chat->operation_admin) > 200) {
            $chat->operation_admin = "lhinst.updateVoteStatus(".$chat->id.");";
        }

        $chat->updateThis(array('update' => array('fbst','user_typing','user_typing_txt','operation_admin')));
        
        erLhcoreClassChatEventDispatcher::getInstance()->dispatch('vote.action', array('chat' => & $chat));

        echo json_encode(array('error' => 'false', 'status' => $chat->fbst));
        exit;
}

echo erLhcoreClassChat::safe_json_encode(array('error' => 'true'));
exit;

?>
