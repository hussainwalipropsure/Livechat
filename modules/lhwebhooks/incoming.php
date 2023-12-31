<?php

$dummyPayload = null;

try {

    $incomingWebhook = erLhcoreClassModelChatIncomingWebhook::findOne(array('filter' => array('identifier' => $Params['user_parameters']['identifier'])));

    if (!($incomingWebhook instanceof erLhcoreClassModelChatIncomingWebhook)) {
       throw new Exception('Incoming webhook could not be found!');
    }

    if ($incomingWebhook->disabled == 1) {
        throw new Exception('Incoming webhook is disabled!');
    }

    if (!is_array($dummyPayload)) {
        if (isset($_POST) && is_array($_POST) && !empty($_POST)){
            $data = $_POST;
        } else {
            $data = json_decode(file_get_contents('php://input'), true);
        }
    } else {
        $data = $dummyPayload;
    }

    if (erConfigClassLhConfig::getInstance()->getSetting( 'site', 'debug_output' ) == true) {
        erLhcoreClassLog::write(json_encode($data));
    }

    if (session_id()) session_write_close();

    erLhcoreClassChatEventDispatcher::getInstance()->dispatch('chat.webhook_incoming', array(
        'webhook' => & $incomingWebhook,
        'data' => & $data
    ));

    if (function_exists('fastcgi_finish_request')) {
        fastcgi_finish_request();
    }

    erLhcoreClassChatWebhookIncoming::processEvent($incomingWebhook, $data);

} catch (Exception $e) {
    if (erConfigClassLhConfig::getInstance()->getSetting( 'site', 'debug_output' ) == true){
        erLhcoreClassLog::write($e->getMessage().' | '. json_encode($data));
    }
}

exit;

?>