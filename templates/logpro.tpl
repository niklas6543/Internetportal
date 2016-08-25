
<h1>Loginprofil erstellen</h1>
<form action="index.php?modus=logpro" method="post">
<script type="text/javascript">
	$( function() {
		$( "#datepicker" ).datepicker({
			dateFormat: 'dd.mm.yy', 
			maxDate: '-1d',
			changeMonth: true,
			changeYear: true
		});
	} );
</script>
<table summary="">
{foreach $fields as $field}
	<tr>
	{if $field['value'] eq '' and $field_error eq 'field_missing'}
		<th align="left" bgcolor="red">
	{elseif $field['name'] eq 'paswd_wd' and $error eq 'password_disagree'}
		<th align="left" bgcolor="red">
	{else}
		<th align="left">
	{/if}
	{$field['label']}*</th><td><input type="{$field['type']}" name="{$field['name']}" value="{$field['value']}"/></td>
	</tr>
{/foreach}
<tr>
<th align="left">Geburtsdatum</th><td><input type="text" id="datepicker" name="birthday" readonly="readonly"/></td>
</tr><tr>
<td><input type="submit" name="create" class="button"/></td>
<td><input type="submit" name="reset" value="Zurücksetzen" class="button"/></td>
</tr>
</table>
<font size="2">*Pflichtfelder</font><br/>
</form>
{if $field_error eq 'field_missing'}
	<p><font color="red">!! Ein oder mehrere Formularfelder wurden nicht ausgefüllt !!</font></p>
{/if}
{if $error eq 'password_disagree' }
	<p><font color="red">Passwort stimmt nicht überein!!</font></p>
{elseif $error eq 'without_error'}
    <p><font color="green">Benutzer wurde erfolgreich erstellt!!</font></p>
{/if}
<p><a href="index.php?modus=mitglieder">zu Profildaten</a></p>
<p><a href="index.php?modus=willkommen">zu Willkommen</a></p>
