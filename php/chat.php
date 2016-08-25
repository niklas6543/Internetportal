<?php
	require('functions/auth.php');
	require('functions/sql.php');
	require('functions/func.php');

	$smarty = new Smarty;
	$id = $_SESSION['id'];
	
	$allUsers = $sql->select('user, id','user','NOT id=?', [$id]);
	$smarty->assign('users', $allUsers);
	
	$smarty->assign("id", $id);

	$receiver = $_SESSION['chatReceiver'];
	if (isset($_POST['send']))
	{
		$receiver = $_POST['user'];
		$message = $_POST['message'];
		$time = date('Y-m-d H:i:s');

		$sql->insert('messages', ['message' => $message, 'sender' => $id, 'receiver' => $receiver, 'sendtime' => $time]);
		redirect();
	}
	
	$smarty->assign("receiver", $receiver);
	$smarty->display('templates/chat.tpl');

?>
