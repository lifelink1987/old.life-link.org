// JavaScript Document

var pageRules = {
	'#list_country:change': function(element) {
		$('list_city').disabled = true;
		xajax_update_cities($F('list_country'), 'list_city');
	},
	'#between_month:change': function(element) {
		$('between_and_month').disabled = true;
		if ($('between_year').value == $F('between_and_year'))
		{
			xajax_update_months('between_and_month', $F('between_month'));
		}
		else
		{
			xajax_update_months('between_and_month');
		}
	},
	'#between_year:change': function(element) {
		$('between_and_year').disabled = true;
		xajax_update_years('between_and_year', $F('between_year'));
	},
	'#namelike:focus': function(element) {
		var results = $(element.getAttribute('results'));
		if ((element.value.length > 3) && (results.innerHTML.length > 0))
		{
			results.style.display = 'block';
		}
	},
	'#namelike:keyup': function(element) {
		var results = $(element.getAttribute('results'));
		element.value = element.value.replace(/high/, '');
		element.value = element.value.replace(/prim/, '');
		element.value = element.value.replace(/seco(n(d)?)?/, '');
		element.value = element.value.replace(/scho(o(l)?)?/, '');
		if ((element.value.length > 0) && (element.value.charAt(0) == parseInt(element.value.charAt(0))))
		{
			element.value = onlyNumbers(element.value);
			xajax_update_schools_by_name(element.value, 'namesearch_results', '<{$tpl.links.members_get}>school&schoolnumber=');
		}
		else if (element.value.length > 3)
		{
			xajax_update_schools_by_name(element.value, 'namesearch_results', '<{$tpl.links.members_get}>school&schoolnumber=');
		}
		else
		{
			results.style.display = 'none';
		}
	},
	'#schoolnumber:focus': function(element) {
		var results = $(element.getAttribute('results'));
		if (results.innerHTML.length > 0)
		{
			results.style.display = 'block';
		}
	},
	'#schoolnumber:keyup': function(element) {
		var results = $(element.getAttribute('results'));
		element.value = onlyNumbers(element.value);
		if (element.value.length > 0)
		{
			xajax_update_schools_by_number(element.value, element.getAttribute('results'), '<{$tpl.links.members_get}>school&schoolnumber=');
		}
		else
		{
			results.style.display = 'none';
		}
	}
}