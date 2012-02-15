// JavaScript Document

$(function(){
	$('form input[type=submit], form button').button();
	$('form label.double').live('click', function(e) {
		e.preventDefault();
	});
});