<h1>Profilbilder</h1>
<h2>Bild hochladen/löschen</h2>
<form action="index.php?modus=bild_laden" method="post" enctype="multipart/form-data">
<table summary="">
<tr>
<td><input type="file" name="img"/></td>
</tr><tr>
<td><p><input type="submit" name="load" value="Hochladen" class="button"/></p>
</tr>
</table>
</form>
<h2>Hochgeladene Bilder</h2>
<table summary="">
<tr>
{for $i=1 to $imganz}
	<td>
	<div align="center" class="div">
	<img src="php/functions/bild_load.php?id={$imgid[$i-1]}" class="img" alt=""/>
	</div>
	<a href="index.php?modus=bild_laden&amp;delete={$imgid[$i-1]}"><img src="images/x_button.png" alt=""/></a>
	</td>
	
	{if $i%4 eq 0}
		</tr><tr>
	{/if}
{/for}
<td></td></tr>
</table>
<p>{$imganz} gefunden</p>
