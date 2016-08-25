<?php
	require('functions/auth.php');
	require('functions/func.php');

	if (isset($_POST['yes']))
	{
		session_destroy();
		redirect();
	}

	if (isset($_POST['no']))
	{
		header("Location: index.php?modus=willkommen");
	}

	$smarty= new Smarty;
	$smarty->assign('user', $_SESSION['user']);
	$smarty->display('templates/logout.tpl');


?>
