{title value="Statute & Board"}

<section>
	<h1>Statute &amp; Board</h1>
	{include file="/obj/byline.tpl"}
	<div class="headingbox">
		<h1><em>the</em> Statute</h1>
		<div class="justify">
			<p>The Life-Link Friendship-Schools Association has been formed to encourage and support youth in training in matters that primarily concern the peace research, conflict resolution and constructive cooperation, and to promote research and education in subjects whose development and dissemination can contribute to common security and peaceful development of the world.</p>
			<p>To achieve its purpose, the association, in addition to encouraging peace research and peace projects, will also organize or assist in organizing seminars, conferences, campaigns within
the fields related to the association's primary purpose. The purpose will be achieved through a democratic cooperation between youth and adults.</p>
		</div>
	</div>
	<p>You can continue to read the full statute (sv. "STADGAR för den ideella föreningen LIFE-LINK FRIENDSHIP-SCHOOLS med benämning LIFE-LINK FRIENDSHIP-SCHOOLS ASSOCIATION") <a href="{$uri.files}programme/Life-Link stadgar.pdf">here</a>.</p>
</section>
<section class="colgroup inline">
	<div class="column width50 first">
		<h1>Chairpersons</h1>
		{include file="/obj/byline.tpl"}
		{get_contacts department="Board" var="board"}
		{assign var=contact value=$board|@array_shift}
		<div class="contact">
			<h2><img src="{$uri.icon_flag_16}{$contact.iso2}" class="icon" title="{$contact.country_short}" /> {$contact.contact}</h2>
			<div class="position">{$contact.position|nl2br}</div>
		</div>
		{assign var=contact value=$board|@array_shift}
		<div class="contact">
			<h2><img src="{$uri.icon_flag_16}{$contact.iso2}" class="icon" title="{$contact.country_short}" /> {$contact.contact}</h2>
			<div class="position">{$contact.position|nl2br}</div>
		</div>
		<h1>Secretary</h1>
		{include file="/obj/byline.tpl"}
		{get_contacts department="Secretary" var="secretary"}
		{foreach from=$secretary item=contact name=contact}
			<div class="contact">
				<h2><img src="{$uri.icon_flag_16}{$contact.iso2}" class="icon" title="{$contact.country_short}" /> {$contact.contact}</h2>
				<div class="position">{$contact.position|nl2br}</div>
			</div>
		{/foreach}
		<h1>Office Consultants</h1>
		{include file="/obj/byline.tpl"}
		{get_contacts department="Consultants" var="consultants"}
		{foreach from=$consultants item=contact name=contact}
			<div class="contact">
				<h2><img src="{$uri.icon_flag_16}{$contact.iso2}" class="icon" title="{$contact.country_short}" /> {$contact.contact}</h2>
				<div class="position">{$contact.position|nl2br}</div>
			</div>
		{/foreach}
		<h1>International Advisors</h1>
		{include file="/obj/byline.tpl"}
		{get_contacts department="International Advisors" var="advisors"}
		{foreach from=$advisors item=contact name=contact}
			<div class="contact">
				<h2><img src="{$uri.icon_flag_16}{$contact.iso2}" class="icon" title="{$contact.country_short}" /> {$contact.contact}</h2>
				<div class="position">{$contact.position|nl2br}</div>
			</div>
		{/foreach}
	</div>
	<div class="column width50">
		<h1>Board Members</h1>
		{include file="/obj/byline.tpl"}
		{foreach from=$board item=contact name=contact}
			<div class="contact">
				<h2><img src="{$uri.icon_flag_16}{$contact.iso2}" class="icon" title="{$contact.country_short}" /> {$contact.contact}</h2>
				<div class="position">{$contact.position|nl2br}</div>
			</div>
		{/foreach}
	</div>
</section>
<section>
	<h1 class="simple">The board has ~monthly meetings. Each meeting has a protocol in Swedish, and an appendix in English.<br />
		You can download <a href="{$uri.files}board_meetings/StyrelsenBoard meeting Appendix !latest!.doc">the most recent appendix</a> or <a href="{$uri.board_meetings}" target="_blank">browse the previous appendices</a>.<br />
		Documents from anual meetings are also available for <a href="{$uri.anual_meetings}">download</a>.</h1>
</section>
