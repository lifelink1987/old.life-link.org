// JavaScript Document

var pageRules = {
	"#tel, #fax": function(element) {
		Andrei.Event.add(element, 'keyup', function(event) {
			var target = Andrei.Event.target(event);
			target.value = onlyNumbers(target.value, 3, 0);
		},
		false);
	},
	
	"#students, #parents, #teachers, #perfdays": function(element) {
		Andrei.Event.add(element, 'keyup', function(event) {
			var target = Andrei.Event.target(event);
			target.value = onlyNumbers(target.value, 0, 1);
		},
		false);
	},
	
	"#age": function(element) {
		Andrei.Event.add(element, 'keyup', function(event) {
			var target = Andrei.Event.target(event);
			target.value = onlyNumbers(target.value, 2, 1);
		},
		false);
	}
}