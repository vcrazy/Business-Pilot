$(document).ready(function(){
	$('.datetimepicker').datetimepicker({
		dateFormat: 'yy-mm-dd',
		minDate: new Date(+ new Date + 1000 * 60 * 10) // minDate after 10 minutes (FB specs)
	});
});
