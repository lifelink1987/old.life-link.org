// JavaScript Document

$(function(){
	$('select[name=city]').show();
	$('select[name=country]').change(function() {
		var $this = $(this);
		var $city = $this.closest('form').find('select[name=city]').first();
		var $submit = $this.closest('form').find('input[type=submit]').first();
		
		if ($this.val()) {
			$this.attr('disabled', 'disabled');
			$city.attr('disabled', 'disabled');
			$submit.attr('disabled', 'disabled');
			$.getJSON(api_uri + 'action=get_cities&country=' + $this.val(), function(data) {
				var options = '';
				if (data) {
					options += '<option></option>';
					for (var i = 0; i < data.length; i++) {
						options += '<option>' + data[i] + '</option>';
					}
				}
				$city.html(options);
				$this.removeAttr('disabled');
				$city.removeAttr('disabled').closest('label').show();
				$submit.removeAttr('disabled');
			});
		} else {
			$city.html('').closest('label').hide();
		}
	});
});