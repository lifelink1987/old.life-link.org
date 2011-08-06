// JavaScript Document

$(function(){
	$('select[name=after]').change(function() {
		var $this = $(this);
		var $before = $this.nextAll('select[name=before]:first').first();
		var after_val = $this.val().split('.');
		var before_val = $before.val().split('.');
		
		if (after_val[1] > before_val[1]
			|| (after_val[1] == before_val[1] && after_val[0] > before_val[0])) {
				$before.val($this.val());
		}
	});
	
	$('select[name=before]').change(function() {
		var $this = $(this);
		var $before = $this.prevAll('select[name=after]:first');
		var after_val = $before.val().split('.');
		var before_val = $this.val().split('.');
		
		if (after_val[1] > before_val[1]
			|| (after_val[1] == before_val[1] && after_val[0] > before_val[0])) {
				$after.val($this.val());
		}
	});
});