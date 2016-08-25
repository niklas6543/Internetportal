<?php
	define("server","localhost");
	define("benutzer","test");
	define("passwort","kathruieJFEksd");
	define("name","seiteDB");
	
	$con=mysqli_connect(server,benutzer,passwort,name);
	mysqli_autocommit($con,TRUE);
	error_reporting(E_ALL);
	if (!$con)
	{
		echo "keine Verbindung möglich";
		exit();
	}
?>
