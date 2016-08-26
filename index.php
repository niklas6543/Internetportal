<?php
	session_start();
	//error_reporting(0);
	/*echo '<xmp>';
	print_r($_SERVER);
	echo '<xmp>';
	*/
	if (!isset($_SESSION["login"]))
	{
		require('php/login.php');
		$modus='willkommen';	
	}

	if (isset($_SESSION["login"]))
	{
		if (!array_key_exists('modus', $_GET))
		{
			$modus='willkommen';		
			
		}else
		{
			$modus = $_GET['modus']; 
			
		}
		
		
		
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

