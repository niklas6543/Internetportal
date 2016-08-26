<?php

	require('include/smarty/Smarty.class.php');

	require_once('php/functions/sql.php');
	require('php/functions/func.php');
	

	$error='';
	
	if (isset($_POST["login"]))
	{
		$benutzer = $_POST["benutzer"];
		$paswd = $_POST["paswd"];

			$rows = $sql->select('*', 'user', 'user=?', [$benutzer]);
			

			$id = $rows[0]['id'];
			$logins = $rows[0]['logins'];
			$logintry = $rows[0]['logintries'];

			$trydate = date( 'Y-m-d H:i:s');
			$sql->updateById('user', ['logintries' => $trydate], $id);

			$sperre = 1;

			$aktuell = strtotime($trydate);
			$altezeit = strtotime($logintry);
			$diff=$aktuell-$altezeit;

			if ($logins<2)
			{
				$sperre=0;
			}

			if ($aktuell-$altezeit>10 && $sperre==1)
			{
				$sperre=0;
				$logins=0;
			}

			if ($aktuell-$altezeit<10 && $sperre==1)
			{
				$error='toomanytries';
			}

			if (password_verify($paswd,$rows[0]['paswd'])!=1 && $sperre==0)
			{

				$error='warning';

                if ($logins<2)
                {
                   $logins++;
                }
			}

			if (password_verify($paswd,$rows[0]['paswd']) && $sperre==0)
			{
				$_SESSION["login"]=true;
				$_SESSION["id"]=$id;
				$_SESSION["user"]=$rows[0]['user'];
				$_SESSION["vorname"]=$rows[0]['vorname'];
				$_SESSION["nachname"]=$rows[0]['nachname'];
				$_SESSION["b_day"]=$rows[0]['b_day'];
				$lastlogin = date( 'Y-m-d H:i:s');
				$sql->updateById('user', ['lastlogin' => $lastlogin], $id);
				$_SESSION["lastlogin"]=$lastlogin;
				$logins=0;
				

				$sql->updateById('user', ['logins' => $logins], $id);
				redirect();
			}else
			{
			
			

				$sql->updateById('user', ['logins' => $logins], $id);
			}
	}

	$smarty= new Smarty;
	$smarty->assign('error',$error);
	$smarty->display('templates/login.tpl');

							
?>
