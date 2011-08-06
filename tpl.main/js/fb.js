// JavaScript Document

window.fbAsyncInit = function() {
	FB.init({
		appId  : '236062617449',
		status : true, // check login status
		cookie : true, // enable cookies to allow the server to access the session
		xfbml  : true  // parse XFBML
	});
};

$(function() {
	$('#fb-root').html('<script type="text/javascript" async="true" src="' + document.location.protocol + '//connect.facebook.net/en_US/all.js"></script>');
});
