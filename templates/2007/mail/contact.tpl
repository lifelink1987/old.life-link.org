<div class="h1">New message<{if $contact}> for <strong><{$contact.firstname}></strong><{/if}></div>
<div class="h2">from <strong><{$name}></strong>, in  <strong><{$country|upper}></strong></div>

<br><br>
<blockquote>
	<{$message}>
</blockquote>
<br><br>

<strong><{$name}></strong><br>
---<br>
<strong>Address</strong>: <{$mail}> (<{$country}>)<br>
<strong>E-mail</strong>: <{$email}><br>
<strong>Telephone</strong>: <{$tel}><br>
<strong>Fax</strong>: <{$fax}>
