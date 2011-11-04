<{if $result_message}>
	<h3><{$result_message}></h3>
	<div class="hr"></div>
<{/if}>
<{if !$result_noform}>

<span class="llclear h10"></span>
<h1><strong>Action Photos</strong></h1>
<blockquote>
	<{if !$result_noupload}>
		<form method="post" action="<{$tpl.links.report_photos}>" id="form-upload" enctype="multipart/form-data" class="upload major" anchor="resultsAnchor">
		<input type="hidden" name="upload" id="form-upload-upload" value="1">
		<div class="yui-gc">
			<div class="yui-u first">
				<dl>
					<dt>
						<label for="form-upload-document">JPEG Image File</label>
						<em>*</em>
					</dt>
					<dd>
						<input type="file" name="document" id="form-upload-document" tabindex="1" class="required jpeg">
					</dd>
				</dl>
			</div>
			<div class="yui-u lltextc">
				<button type="submit" id="form-upload-submit" class="ajax" tabindex="2">Add Action Photo</button>
			</div>
		</div>
		</form>
		<div class="hr"></div>
		<span class="llclear h10"></span>
	<{/if}>
	<{if $photos}>
		<form method="post" action="<{$tpl.links.report_photos}>" id="form-titles" anchor="resultsAnchor" class="major">
		<input type="hidden" name="titles" id="form-titles-titles" value="1">
		<{foreach from=$photos item=photo name=photos}>
		<{if !$smarty.foreach.photos.first}>
			<span class="llclear h10"></span>
		<{/if}>
		<div class="yui-gc sb">
			<div class="yui-u first">
				<span class="h2 llfloatr"><strong><{$smarty.foreach.photos.iteration}></strong></span>
				<h2><{$photo.filename|truncate:30:'...':true}></h2>
				<dl>
					<dt>Photo Title</dt>
					<dd>
						<input type="text" name="title<{$smarty.foreach.photos.iteration}>" id="form-photos-photo<{$smarty.foreach.photos.iteration}>" value="<{$photo.title}>" tabindex="<{$smarty.foreach.photos.iteration*2+10}>" autocomplete="off" maxlength="255">
					</dd>
				</dl>
			</div>
			<div class="yui-u lltextc">
				<a href="<{$photo.photo}>" rel="lightbox" title="<{$photo.title}>" class="llbordernone"><img src="<{$photo.thumbnail}>" alt="<{$photo.title}>"></a><br>
				<a href="<{$tpl.links.report_photos_get_photo}><{$photo.filename_url}>&delete=1#resultsAnchor">Delete this photo</a>
			</div>
		</div>
		<{/foreach}>
		<div class="yui-gc">
			<div class="yui-u first">
				<button type="submit" id="form-titles-submit" class="ajax" tabindex="<{$smarty.foreach.photos.iteration*2+11}>">Save the titles for the photos</button>
			</div>
			<div class="yui-u lltextc">
			</div>
		</div>
		</form>
	<{else}>
		No Action Photos added to this Report!
	<{/if}>
</blockquote>

<span class="llclear h10"></span>
<form method="post" action="<{$tpl.links.report_photos}>" id="form-photos" anchor="resultsAnchor" class="major">
<input type="hidden" name="photos" id="form-photos-photos" value="1">
<button type="submit" id="form-photos-submit" class="ajax submit" tabindex="20">
<{if $photos}>
	Press this button to Register with this/these Photo(s)!
<{else}>
	Press this button to Register without Photos!
<{/if}>
</button><br>
<small>We hope you enjoyed your action!</small>
</form>

<{/if}>