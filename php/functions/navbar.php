<?php
	require('include/smarty/Smarty.class.php');
 	
	$fields = [
			['modus' => 'willkommen', 'name' => 'Home'],
			['modus' => 'mitglieder', 'name' => 'Profildaten'],
			['modus' => 'logpro', 'name' => 'Benutzer erstellen'],
			['modus' => 'bild_laden', 'name' => 'Profilbilder'],
			['modus' => 'chat', 'name' => 'Nachrichten']

	];

	$smarty= new Smarty;
 	$modus = $_GET['modus'];
	$smarty->assign("modus",$modus);
	$smarty->assign("fields",$fields);
  	$smarty->display("templates/navbar.tpl");

?>
