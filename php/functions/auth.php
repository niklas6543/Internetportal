<?php
//	session_start();
// Test	
	
	if (!$_SESSION["login"])
	{
		header("location: index.php");
	}
?>
