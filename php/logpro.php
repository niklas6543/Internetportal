<?php

	require('functions/sql.php');
	require('functions/auth.php');
	require('functions/func.php');

	$id = $_SESSION["id"];
	$smarty = new Smarty;
	$error = '';
	$field_error = '';

	$fields = [
	   [ 'label' => 'Vorname', 'name' => 'firstname', 'type' => 'text', 'value' => ''],
	   [ 'label' => 'Nachname', 'name' => 'name', 'type' => 'text', 'value' => ''],
	   [ 'label' => 'Benutzername', 'name' => 'user', 'type' => 'text', 'value' => ''],
	   [ 'label' => 'Passwort', 'name' => 'paswd', 'type' => 'password', 'value' => ''],
	   [ 'label' => 'Passwort<br/>wiederholen', 'name' => 'paswd_wd', 'type' => 'password', 'value' => ''],
    ];

														  
	if (isset($_POST["create"]))
	{
		

		
		foreach ($fields as &$field)
		{
			$field['value'] = $_POST[$field['name']];
			
			if (empty($field['value']))
			{
					$field_error = 'field_missing';
					
			}

		}

		$paswd = $_POST['paswd'];
		$paswd_wd = $_POST['paswd_wd'];
		$b_day = Date("y-m-d",strtotime($_POST["birthday"]));

		if ($paswd == $paswd_wd && $field_error != 'field_missing')
		{
			$paswd = password_hash($paswd, PASSWORD_BCRYPT);
			
			$sql->insert('user', ['user' => $_POST['user'], 'paswd' => $paswd, 'vorname' => $_POST['firstname'], 'nachname' => $_POST['name'], 'geburtsdatum' => $b_day], $id);
			$error = 'without_error';

		}elseif ($paswd != $paswd_wd)
		{
			$error = 'password_disagree';
		}

	}
	if (isset($_POST['reset']) || $error == 'without_error')
	{
		foreach ($fields as &$field)
		{
			$field['value'] = '';
		}
	}
	
	
	$smarty->assign('fields',$fields);	
	$smarty->assign('field_error',$field_error);
	$smarty->assign("error",$error);
	$smarty->display('templates/logpro.tpl');


?>
