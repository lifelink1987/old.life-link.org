<div id="related">
	<{include file="official:`$tpl.current`related.tpl"}>
</div>
<div id="llpagetitle">Statute</div>
<p>
	Life-Link Friendship-Schools statute is only available in Swedish.<br/>
	You can download it by clicking <a href="<{$tpl.links.files_get}>programme/Life-Link stadgar.pdf">here</a>.
</p>
<div id="llpagetitle">Board</div>
<div>
	<div class="yui-g">
		<div class="yui-u first">
			<dl>
			<{foreach from=$members item=member name=members}>
			<dt class="h2"><{$member.name}></dt>
			<dd>
				<{$member.title}>
				<{if $member.email}><br>
				<a href="<{$tpl.links.contact_get}><{$member.nickname}>" class="mail">Send a message to <{$member.firstname}></a> <{/if}>
			</dd>
			<{if $smarty.foreach.members.iteration == 2}>
				<div class="hr"></div>
				<span class="llclear h10"></span>
			<{/if}>
			<{/foreach}>
			</dl>
		</div>
		<div class="yui-u">
			<h2>Office Secretary</h2>
			<blockquote>
				<dl>
				<{foreach from=$secretary item=member}>
				<dt><strong><{$member.name}></strong></dt>
				<dd>
					<{$member.title}>
					<{if $member.email}><br>
					<a href="<{$tpl.links.contact_get}><{$member.nickname}>" class="mail">Send a message to <{$member.firstname}></a><{/if}>
				</dd>
				<{/foreach}>
				</dl>
			</blockquote>
			<span class="llclear h10"></span>
			<h2>Office Consultants</h2>
			<blockquote>
				<dl>
				<{foreach from=$consultants item=member}>
				<dt><strong><{$member.name}></strong></dt>
				<dd>
					<{$member.title}>
					<{if $member.email}><br>
					<a href="<{$tpl.links.contact_get}><{$member.nickname}>" class="mail">Send a message to <{$member.firstname}></a> <{/if}>
				</dd>
				<{/foreach}>
				</dl>
			</blockquote>
			<span class="llclear h10"></span>
			<h2>International Advisors</h2>
			<blockquote>
				<dl>
				<{foreach from=$advisors item=member}>
				<dt><strong><{$member.name}></strong></dt>
				<dd>
					<{$member.title}>
					<{if $member.email}><br>
					<a href="<{$tpl.links.contact_get}><{$member.nickname}>" class="mail">Send a message to <{$member.firstname}></a> <{/if}>
				</dd>
				<{/foreach}>
				</dl>
			</blockquote>
		</div>
	</div>
</div>
