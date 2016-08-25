<?php 
	require('functions/auth.php');

	$id=$_SESSION["id"];
	$_SESSION["b_day"]=Date("d.m.y",strtotime($_SESSION["b_day"]));

	$smarty= new Smarty;

	$smarty->assign('vorname',$_SESSION["vorname"]);
	$smarty->assign('nachname',$_SESSION["nachname"]);
	$smarty->assign('geburtsdatum',$_SESSION["b_day"]);

	$smarty->assign('id',$id);
	$smarty->assign('user',$_SESSION["user"]);	
		
	$smarty->display('templates/mitglieder.tpl');
?>
