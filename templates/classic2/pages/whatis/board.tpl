<div id="pageContentHeader">
		<{include file="official:`$tpl.current`header.tpl"}>
	</div>
	<div id="pageContentBody">
		<div class="llpagetitle">
			Board
		</div>
		<div class="llboxllgreen llboxtextwhite llroundl llborderr llfloatr" style="width: 45%;">
			<div class="llboxbd">
				<h1>Office Secretary</h1>
				<ul>
					<{foreach from=$secretary item=member}>
					<li class="llspaced">
						<h2><{$member.name}></h2>
						<div class="llmarginl">
							<{$member.title}>
							<{if $member.email}><br>
							<a href="<{$tpl.links.contact_get}><{$member.nickname}>" icon="mail">Send a message to <{$member.firstname}></a><{/if}>
						</div>
					</li>
					<{/foreach}>
				</ul>
				<br>
				<hr>
				<br>
				<h1>Office Consultants</h1>
				<ul>
					<{foreach from=$consultants item=member}>
					<li class="llspaced">
						<h2><{$member.name}></h2>
						<div class="llmarginl">
							<{$member.title}>
							<{if $member.email}><br>
							<a href="<{$tpl.links.contact_get}><{$member.nickname}>" icon="mail">Send a message to <{$member.firstname}></a> <{/if}>
						</div>
					</li>
					<{/foreach}>
				</ul>
			</div>
		</div>
		<div style="width: 50%">
			<ul>
				<{foreach from=$members item=member name=members}>
				<li class="llspaced">
					<h1><{$member.name}></h1>
					<div class="llmarginl">
						<{$member.title}>
						<{if $member.email}><br>
						<a href="<{$tpl.links.contact_get}><{$member.nickname}>" icon="mail">Send a message to <{$member.firstname}></a> <{/if}>
					</div>
				</li>
				<{if $smarty.foreach.members.iteration == 2}> <br>
				<br>
				<{/if}>
				<{/foreach}>
			</ul>
		</div>
	</div>
