<div>
	<h1><strong><{$organisation.name}></strong></h1>
	<div class="yui-g">
		<div class="yui-u first">
			<{$organisation.address}>
			<div class="hr"></div>
			<{if $organisation.tel and $organisation.tel neq '-'}>
				<blockquote>
					Tel: <strong><{$organisation.tel}></strong>
				</blockquote>
			<{/if}>
			<{if $organisation.fax and $organisation.fax neq '-'}>
				<blockquote>
					Fax: <strong><{$organisation.fax}></strong>
				</blockquote>
			<{/if}>
			<{if $organisation.website and $organisation.website neq '-'}>
				<blockquote>
					Website: <{$organisation.website}>
				</blockquote>
			<{/if}>
			<{if $organisation.email and $organisation.email neq '-'}>
				<blockquote>
					E-m@il: <{$organisation.email}>
				</blockquote>
			<{/if}>
		</div>
		<div class="yui-u">
			<{$organisation.addinfo}>
		</div>
	</div>
</div>
