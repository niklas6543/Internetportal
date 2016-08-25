<?php
	require('php/functions/auth.php');
	if (isset($_POST["logout"]))
	{
		header("location: index.php?modus=logout");
	}

	$smarty= new Smarty;
	$smarty->assign('user',$_SESSION["user"]);
    $smarty->assign('lastlogin',$_SESSION["lastlogin"]);
	$smarty->display('templates/willkommen.tpl');
?>			
