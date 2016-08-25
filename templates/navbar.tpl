<!DOCTYPE html
 PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="de">
<head>

<title>
{foreach $fields as $field}
   	 {if $modus eq $field['modus']  or $modus eq '' and $field['name'] eq 'Home'}
	 	{$field['name']}
	 {/if} 
{/foreach}
{if $modus eq 'logout'}
	Logout
{/if}
</title>
<link rel="stylesheet" type="text/css" href="css/sheet.css"/>
<link rel="stylesheet" href="include/jquery/jquery-ui.min.css" type="text/css"/>
<script src="include/jquery/jquery-3.1.0.min.js" type="text/javascript"></script>
<script src="include/jquery/jquery-ui.min.js" type="text/javascript"></script>
</head>
<body>
<ul>
{foreach $fields as $field}
   	<li><a {if $modus eq $field['modus']  or $modus eq '' and $field['name'] eq 'Home'} class="active" {/if} href="index.php?modus={$field['modus']}">{$field['name']}</a></li>
{/foreach}
	<li style="float:right;"><a href="index.php?modus=logout" {if $modus eq 'logout'}class="active"{/if}>Logout</a></li>
</ul>



