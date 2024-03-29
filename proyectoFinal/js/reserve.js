$(function(){
	var includes = $('[data-include]');
	jQuery.each(includes, function(){
			var file = $(this).data('include') + '.html';
			$(this).load(file);
	});
});

$(document).ready(function() {



// 	$(document).on("click", "a", function (e) {
//     	e.preventDefault();
//     	console.log($(this).text());



// 		var navHeight = $("#miniNav").height();

//     	var listaOpiniones = document.getElementById("listaOpiniones");

// 		console.log(navHeight);

//     	listaOpiniones.scrollIntoView({ behavior: 'smooth'});
// // 		var scrolledY = window.scrollY;

// 		console.log(scrolledY);		

// 		if(scrolledY){
// 			window.scroll(0, scrolledY - navHeight);
// 		}

//     });


	let mainNavLinks = document.querySelectorAll("div a");

	mainNavLinks.forEach(link => {
	  	
	  	link.addEventListener("click", event => {
		    event.preventDefault();
		    
		    let target = document.querySelector(event.target.hash);
	    
	    	target.scrollIntoView({
	      		behavior: "smooth",
	      		block: "start"
	    	});
		});
	});



	var date = new Date();
	var actualHour = date.getHours();		// Get actual hour
	var actualMin = date.getMinutes();		// Get actual min
	var dd = String(date.getDate()).padStart(2, '0');
	var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
	var yy = date.getFullYear();

	actualDate = yy + "-" + mm + "-" + dd;

	defaultStartSec = 13 * 60;		// Reservations starts at 13:00
	defaultEndSec =  23 * 60;		// Reservations finish at 23:00 

	//document.getElementById("datepicker").defaultValue = actualDate;

	dinamicHourDropdown(true);

	$(function () {

		$.datepicker.setDefaults( $.datepicker.regional[ "es" ] );	

		$("#datepicker").datepicker({
			minDate: new Date(),
			dateFormat: "yy-mm-dd", 	// ISO 8601 Date Format
			onSelect: function () {
				if ($("#datepicker").val() != actualDate) {
					dinamicHourDropdown(false);	
				} else {
					dinamicHourDropdown(true);
				}				
			}
		});
	});

	

	/* Displays a reservation hour dropdown list with a 30min delay. */
	function dinamicHourDropdown(today) {
		
		if (today) {

			/* Round time to 30min delay */
			if (actualMin <= 30) {
				actualMin = 30;
			} else {
				 ++actualHour;
				 actualMin = 0;
			}

			/* Convert to mins */
			actualStartSec = (60 * actualHour) + actualMin;	// Hora actual
			 
			actualStartSec = actualStartSec < defaultStartSec ? defaultStartSec : actualStartSec;

		} else {
			actualStartSec = defaultStartSec;
		}

		let template = '';

		for (var i = actualStartSec; i <= defaultEndSec; i += 30) {
	        hours = Math.floor(i / 60);
	        minutes = i % 60;
	        if (minutes < 10){
	            minutes = '0' + minutes; // adding leading zero
	        }
	        //ampm = hours % 24 < 12 ? 'AM' : 'PM';
	        hours = hours % 24;
	        if (hours === 0){
	            hours = 12;
	        }

	        template += `<option value="${hours}:${minutes}">${hours}:${minutes}</option>`
	    }

	    if (i == actualStartSec) {
			$("#hour").html(`<option>No hay horarios disponibles para hoy</option>`);	    	
	    }

	    $("#hour").html(template);
	};


 

	$(document).ready(function() {
		
		form = document.getElementById('reserveForm');

		form.addEventListener('submit', function(e) {

			e.preventDefault();
		
			var formData = new FormData(this);
		
			var date = document.getElementById("datepicker").value;

			formData.append('date', date);
			formData.append("button-pressed", true);

			$.ajax({
				url: 'includes/reserve.php',
				type: 'POST',
				data: formData,
				contentType: false,
	    		processData: false,
	    		success: function (response) {
	    			console.log(response);
					$('#reserveForm').trigger("reset");
					$( "#datepicker").datepicker( "setDate", "getDate" );
	    		},
	    		error: function(data) {
	    			console.log(data);	
	    		}
			});
		
		});

	});


});

