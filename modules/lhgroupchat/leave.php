<?php

header ( 'content-type: application/json; charset=utf-8' );

$db = ezcDbInstance::get();
$db->beginTransaction();

try {

    if (!isset($_SERVER['HTTP_X_CSRFTOKEN']) || !$currentUser->validateCSFRToken($_SERVER['HTTP_X_CSRFTOKEN'])) {
        throw new Exception('Invalid CSRF token!');
    }

    $item = erLhcoreClassModelGroupChat::fetchAndLock($Params['user_parameters']['id']);

    $groupChatMember = erLhcoreClassModelGroupChatMember::findOne(array('filter' => array('user_id' => $currentUser->getUserID(), 'group_id' => $Params['user_parameters']['id'])));

    if ($groupChatMember instanceof erLhcoreClassModelGroupChatMember) {
        $groupChatMember->removeThis();
        $item->updateMembersCount();
    }

    // If it's private group and the last person left the chat, remove group itself.
    if ($item->type == erLhcoreClassModelGroupChat::PRIVATE_CHAT) {
        if (erLhcoreClassModelGroupChatMember::getCount(array('filtergt' => array('jtime' => 0), 'filter' => array('group_id' => $item->id))) == 0) {
            $item->removeThis();
            erLhcoreClassChatEventDispatcher::getInstance()->dispatch('group_chat.remove_group_chat', array('chat' => & $item));
        }
    }

    $db->commit();

    echo json_encode(array());

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode($e->getMessage());
    $db->rollback();
}



exit;

?>
