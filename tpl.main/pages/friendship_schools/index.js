// JavaScript Document

$(function(){
	/* Slideshow for Action Photos */
	if ($('#slider img').length){
		$('#slider').nivoSlider({
			effect:'fade',
			keyboardNav:false,
			directionNav:false,
			controlNav:false,
			slices:1
		});
	} else {
		$('#slider').addClass('bkground_leaf');
	}
});
