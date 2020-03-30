jQuery(document).ready(function($) {
	

	$(function(){
		var includes = $('[data-include]');
		jQuery.each(includes, function(){
  			var file = $(this).data('include') + '.html';
  			$(this).load(file);
		});
	});


	$(function () {

		$.datepicker.setDefaults( $.datepicker.regional[ "es" ] );	

		$("#datepicker").datepicker({
			minDate: new Date(),
			dateFormat: "yy-mm-dd" 	// ISO 8601 Date Format
			/*onSelect: function () {
				if ($("#datepicker").val() != actualDate) {
					dinamicHourDropdown(false);	
				} else {
					dinamicHourDropdown(true);
				}				
			}*/
		});
	});



});