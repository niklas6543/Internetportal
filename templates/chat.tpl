<script type="text/javascript">

function reload(continuos)
{
	
	$.ajax('index.php?modus=ajax&receiver='+$('.user:checked').val()).done(function(html){
			$('.chat').html(html);
			
			if ($('#scroll').is(':checked'))
			{
				$('.chat').scrollTop(500);
			}
			
			if (continuos)
			{
				setTimeout(function(){ reload(continuos); }, 3000);
			}
	});

}


	$(function(){
		$('.user').on('change', function(){ 
		
			reload(false); 
		
		});
	
		reload(true);
	});



</script>
<h1>Willkommen im "chat room"</h1>
<form action="index.php?modus=chat" method="post">
<table summary="">
<tr>
<td>
<div class="chat">
</div>
</td>
<td>
{foreach $users as $user}
<input type="radio" name="user" value="{$user['id']}" class="user" {if $receiver eq $user['id']}checked{/if} /> {$user['user']}<br/>
{/foreach} 
</td>
</tr>
</table>
<input type="checkbox" name="autoscroll" id="scroll"  checked /> auto scroll<br/>
<p><textarea name="message" placeholder="Deine Nachricht..." id="textarea"></textarea></p>
<p><input type="submit" name="send" class="button" value="Senden"/></p>
</form>

