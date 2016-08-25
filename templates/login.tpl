<!DOCTYPE html
 PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="de">
<head>
<title>Loginseite</title>
<script src="include/jquery/jquery-3.1.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
/* <![CDATA[ */
var timeout;
function countdown()
{

  if (timeout > 0)
  	 {
	   $("#spzeit").html("Warten Sie die Zeit der Loginsperre ab!! ("+timeout+" Sekunden)");
	    timeout--;
	    window.setTimeout(countdown, 1000);
	  }else
	  {
        $("#warning").html("");
        $("#spzeit").html("<font color=\"green\">Login wieder möglich!<\/font>");
	  }   

	}
/* ]]> */
</script>
<link rel="stylesheet" type="text/css" href="css/sheet.css"/>
</head>
<body onLoad='start()'>
<h1>Loginseite</h1>
<form action="index.php" method="post">
<table summary="">
<tr>
<th align="left">Benutzername</th><td><input type="text" name="benutzer"/></td>
</tr><tr>
<th align="left">Passwort</th><td><input type="password" name="paswd"/></td>
</tr><tr>
<td width="50%" ><input type="submit" name="login" class="button" value="Anmelden"  onmouseover="this.value='Klick mich!!'" onmouseout="this.value='Anmelden'" /></td>
</tr>
</table>
</form>
{if $error eq 'warning'}
    <p class='warnings'>Login nicht möglich Benutzername/Passwort falsch!!</p>
{elseif $error eq 'toomanytries'}
	<p id="warning"><font color='red'>Warnung zu viele Versuche!!!</font></p>
    <p id="spzeit">Warten Sie die Zeit der Loginsperre ab!! ( 10 Sekunden)</p>
	<script type="text/javascript">/* <![CDATA[*/ function start() { timeout = 10; countdown(); } /* ]]> */</script>
{/if}
</body>
</html>
																		
