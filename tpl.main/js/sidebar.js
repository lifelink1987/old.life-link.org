// JavaScript Document

$(function(){
	$('#type_to_search').html5form();
	
	$('#type_to_search').submit(function(){
		return false;
	});
	
	var country_autocomplete = $('#type_to_search input[name=country]').autocomplete({
		source:api_uri + 'action=get_countries',
		open:function(){
			$this = $(this);
			$('.ui-autocomplete').css('width', $this.css('width'));
		},
		select:function(event, ui){
			$this = $(this);
			$this.val(ui.item.label).attr('disabled', 'disabled');
			$('#overlay').show().addClass('bkground_loader');
			window.location = country_uri + ui.item.value;
		}
	}).data('autocomplete');
	country_autocomplete.menu.element.attr('id', 'sidebar_country_autocomplete_menu');
	
	var school_autocomplete = $('#type_to_search input[name=school]').autocomplete({
		source:api_uri + 'action=get_schools',
		select:function(event, ui){
			$this = $(this);
			$this.val(ui.item.label).attr('disabled', 'disabled');
			$('#overlay').show().addClass('bkground_loader');
			window.location = action_uri + ui.item.value;
		}
	}).data('autocomplete');
	school_autocomplete.menu.element.attr('id', 'sidebar_school_autocomplete_menu');
	/*$school_autocomplete._renderItem = function(ul, item) {
		return $('<li></li>')
			.data('item.autocomplete', item)
			.append('<a>' + item.label + '<br>' + item.desc + '</a>')
			.appendTo(ul);
	};*/
	
	var action_complete = $('#type_to_search input[name=action]').autocomplete({
		source:api_uri + 'action=get_actions',
		select:function(event, ui){
			$this = $(this);
			$this.val(ui.item.label).attr('disabled', 'disabled');
			$('#overlay').show().addClass('bkground_loader');
			window.location = action_uri + ui.item.value;
		}
	}).data('autocomplete');
	action_complete.menu.element.attr('id', 'sidebar_action_autocomplete_menu');
});
