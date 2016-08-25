<?php
	session_start();

	/*echo '<xmp>';
	print_r($_SERVER);
	echo '<xmp>';
	*/
	if (!$_SESSION["login"])
	{
		require('php/login.php');
		$modus='willkommen';	
	}

	if ($_SESSION["login"])
	{
		$modus = $_GET['modus']; 
		
		if ($modus == 'ajax')
		{
			require('include/smarty/Smarty.class.php');
			require('php/functions/sql.php');
			header('Content-type: text/plain');
			$id = $_SESSION['id'];
			$receiver = $_GET['receiver'];
			$_SESSION['chatReceiver'] = $receiver;
			$messages = $sql->select('*', 'messages', '(sender=? and receiver=?) or (sender=? and receiver=?) order by sendtime DESC LIMIT 50 ', [$id, $receiver, $receiver, $id]);
			//print_r($messages);
			$smarty = new Smarty;
			$smarty->assign('id', $id);
			$smarty->assign('messages', $messages);
			$smarty->display('templates/chat_format.tpl');
			exit;
		}

		require('php/functions/navbar.php');
		
		if (!$modus)
		{		
 			$modus='willkommen';
		}
		
		$sites=[
			['name' => 'willkommen', 'src' => 'php/willkommen.php'],
			['name' => 'mitglieder', 'src' => 'php/mitglieder.php'],
			['name' => 'logpro', 'src' => 'php/logpro.php'],
			['name' => 'logout', 'src' => 'php/logout.php'],
			['name' => 'bild_laden', 'src' => 'php/avatar.php'],
			['name' => 'chat', 'src' => 'php/chat.php']
		];


		foreach ($sites as $site)
		{
			if ($site['name']==$modus)
			{
				require($site['src']);
				break;
			}
		}
		require('php/functions/footer.php');
	}

?>

