<?php

header('Content-type: application/json');

$tpl = erLhcoreClassTemplate::getInstance('lhcannedmsg/showsuggester.tpl.php');

$chat = erLhcoreClassChat::getSession()->load( 'erLhcoreClassModelChat', $Params['user_parameters']['chat_id']);
$tpl->set('chat',$chat);

if ( erLhcoreClassChat::hasAccessToRead($chat) ) {

    $tpl->set('keyword','');

    if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
        $tpl->set('keyword',strip_tags($_GET['keyword']));
    }

    echo json_encode(array('error' => false, 'result' => $tpl->fetch()));
}

exit;

?>