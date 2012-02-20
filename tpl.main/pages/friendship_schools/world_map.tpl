{js file="http://maps.google.com/maps?file=api&v=2&sensor=false&key=`$gmaps_key`" absolute=true where=head}
{js file="http://shared.life-link.org/gmaps-utility-library/markerclusterer/src/markerclusterer.js" absolute=true where=head}
{title value="World Map of Life-Link Friendship-Schools"}

<section>
	<h1>World Map</h1>
	{include file="/obj/byline.tpl"}
	<h3 class="center"><em>of</em> Life-Link Friendship-Schools <em>and</em> others</h3>
	<div id="kml_ll" class="kml_group invisible">
		<h2>Life-Link Friendship-Schools</h2>
		<input type="radio" id="kml_ll_schools" name="kml_ll" checked /><label for="kml_ll_schools">by School</label>
		<input type="radio" id="kml_ll_countries" name="kml_ll" /><label for="kml_ll_countries">by Country</label>
	</div>
	<div id="map_canvas">
	</div>
</section>
<section>
	<div id="kml_misc" class="kml_group invisible">
		<h2>Other School Networks</h2>
		<input type="radio" id="kml_aspnet_countries" name="kml_misc" /><label for="kml_aspnet_countries">UNESCO ASPnet (by Country)</label>
		<p class="first">* UNESCO ASPnet data is accurate as of June 2004</p>
	</div>
</section>
<section>
	<h1 class="simple">
		You can also see the Friendship-Schools in <a href="http://earth.google.com">Google Earth</a>,<br />
		through a KML file with <a href="{$host}/friendship-schools.kml">schools</a> or <a href="{$host}/friendship-schools-countries.kml">countries</a>.
	</h1>
</section>
{include file="/obj/section_fb_comments.tpl" fb_comments_id="map" fb_comments_url=$uri.map}