<div class="message-row chatbox-row"><span class="usr-tit radius" data-sender="<?php echo htmlspecialchars($msg->name_support)?>"><?php echo htmlspecialchars($msg->name_support)?><div class="msg-date"><?php if (date('Ymd') == date('Ymd',$msg->time)) {	echo  date(erLhcoreClassModule::$dateHourFormat,$msg->time);} else { echo date(erLhcoreClassModule::$dateDateHourFormat,$msg->time);}; ?></div></span><?php echo erLhcoreClassBBCode::make_clickable(htmlspecialchars($msg->msg),array('sender' => 0))?></div>
{{SPLITTER}}
<div class="message-row-in"><?php echo erLhcoreClassBBCode::make_clickable(htmlspecialchars($msg->msg))?></div>
