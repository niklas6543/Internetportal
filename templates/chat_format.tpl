{section name=idx loop=$messages step=-1}
{if $messages[idx].sender eq $id}
	<div style="color: black;">
{else}
	<div style="color: blue;">
{/if}
&raquo; {$messages[idx].sendtime|escape} || {$messages[idx].message|escape}<br/>
</div>
{/section}
