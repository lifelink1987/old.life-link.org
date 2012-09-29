// JavaScript Document

var $previousLabel;

$(function(){
	$('#kml_ll').buttonset().removeClass('invisible');
	$('#kml_misc').buttonset().removeClass('invisible');
		
	function createMarker(point, name, desc){
		var marker = new GMarker(point, {title:name});
		
		GEvent.addListener(marker, 'click', function(){
			marker.openInfoWindowHtml(desc);
		});
		return marker;
	}
	
	function createMarkers(placemarks) {
		var points = new Array();
		var markers = new Array();
		
		for (var i = 0; i < placemarks.length; i++) {
			var name = placemarks[i].getElementsByTagName('name')[0].childNodes[0].nodeValue;
			var desc = placemarks[i].getElementsByTagName('description')[0].childNodes[0].nodeValue;
			var coord = placemarks[i].getElementsByTagName('Point')[0].getElementsByTagName('coordinates')[0].childNodes[0].nodeValue;
			coord = coord.split(',');
			var lat = parseFloat(coord[1]);
			var lng = parseFloat(coord[0]);
			
			var point = new GLatLng(lat, lng);
			
			points.push({'point':point, 'name':name, 'desc':desc});
			markers.push(createMarker(point, name, desc));
		}
		return {p:points, m:markers};
	}
	
	function addMarkers(points, markers, center, cluster) {
		if (center) {
			var bounds = map.getBounds();
			for (var i = 0; i < points.length; i++) {
				bounds.extend(points[i].point);
			}
			map.setCenter(bounds.getCenter(), map.getBoundsZoomLevel(bounds));
		}
		
		mapClusterer.clearMarkers();
		map.clearOverlays();
		if (cluster) {
			mapClusterer.addMarkers(markers);
		} else {
			for (var i = 0; i < markers.length; i++) {
				map.addOverlay(markers[i]);
			}
		}
	}
	
	if (GBrowserIsCompatible()) {
		map = new GMap2(document.getElementById('map_canvas'));
		mapClusterer = new MarkerClusterer(map, [], {maxZoom:6, gridSize:40});
		map.addControl(new GSmallMapControl());
		map.addControl(new GMenuMapTypeControl());
		map.addControl(new GScaleControl());
		
		/*var bounds = map.getBounds();
		var southWest = bounds.getSouthWest();
		var northEast = bounds.getNorthEast();
		var lngSpan = northEast.lng() - southWest.lng();
		var latSpan = northEast.lat() - southWest.lat();*/
		
		cache_pm = {ll_schools:{}, ll_countries:{}, aspnet_countries:{}};
		
		$('#kml_ll_schools + label').live('click', function() {
			if ($previousLabel) {
				$previousLabel.removeClass('ui-state-active').attr('aria-pressed', 'false');
			}
			if (cache_pm.ll_schools.p) {
				addMarkers(cache_pm.ll_schools.p, cache_pm.ll_schools.m, false, true);
			} else {
				$('.kml_group').addClass('invisible');
				var searchUrl = host + '/kml/friendship-schools.kml';
				GDownloadUrl(searchUrl, function(data){
					$('.kml_group').removeClass('invisible');
					var xml = GXml.parse(data);
					var placemarks = xml.documentElement.getElementsByTagName('Placemark');
					if (placemarks.length == 0) {
						alert('No results');
					}
					
					cache_pm.ll_schools = createMarkers(placemarks);
					addMarkers(cache_pm.ll_schools.p, cache_pm.ll_schools.m, true, true);
				});
			}
			$previousLabel = $(this);
			return false;
		});
		
		$('#kml_ll_countries + label').live('click', function() {
			if ($previousLabel) {
				$previousLabel.removeClass('ui-state-active').attr('aria-pressed', 'false');
			}
			if (cache_pm.ll_countries.p) {
				addMarkers(cache_pm.ll_countries.p, cache_pm.ll_countries.m, false, false);
			} else {
				$('.kml_group').addClass('invisible');
				var searchUrl = host + '/kml/friendship-schools-countries.kml';
				GDownloadUrl(searchUrl, function(data){
					$('.kml_group').removeClass('invisible');
					var xml = GXml.parse(data);
					var placemarks = xml.documentElement.getElementsByTagName('Placemark');
					if (placemarks.length == 0) {
						alert('No results');
					}
					
					cache_pm.ll_countries = createMarkers(placemarks);
					addMarkers(cache_pm.ll_countries.p, cache_pm.ll_countries.m, false, false);
				});
			}
			$previousLabel = $(this);
			return false;
		});
		
		$('#kml_aspnet_countries + label').live('click', function() {
			if ($previousLabel) {
				$previousLabel.removeClass('ui-state-active').attr('aria-pressed', 'false');
			}
			if (cache_pm.aspnet_countries.p) {
				addMarkers(cache_pm.aspnet_countries.p, cache_pm.aspnet_countries.m, false, false);
			} else {
				$('.kml_group').addClass('invisible');
				var searchUrl = host + '/kml/unesco-aspnet-countries.kml';
				GDownloadUrl(searchUrl, function(data){
					$('.kml_group').removeClass('invisible');
					var xml = GXml.parse(data);
					var placemarks = xml.documentElement.getElementsByTagName('Placemark');
					if (placemarks.length == 0) {
						alert('No results');
					}
					
					cache_pm.aspnet_countries = createMarkers(placemarks);
					addMarkers(cache_pm.aspnet_countries.p, cache_pm.aspnet_countries.m, false, false);
				});
			}
			$previousLabel = $(this);
			return false;
		});
		
		var center = new GLatLng(59.85, 17.63);
		map.setCenter(center, 2);
		$('#kml_ll_schools + label').click();
	 }
});