
/* Login Form Javascript Validation */

var username = $('#username');
var password = $('#password');

$('input.form-control').focusout(function() {

	if ($(this).attr('name') == 'username') {
		validateUsername();
	} else if ( $(this).attr('name') == 'password' ) {
		validatePassword();
	}

});


// Handle Login Form
$('form').submit(function(e){

	e.preventDefault();

	if ( validateUsername() && validatePassword() ) {

		var formData = new FormData($(this)[0]);
		formData.append("button-pressed", true);

		$.ajax({
			url: 'includes/login.inc.php',
			type: 'POST',
			data: formData,
			contentType: false,
    		processData: false,
    		success: function (response) {
    			createCookie("user", username.value, 3);
    			$(location).attr('href', 'index.html');

    			console.log(response);
    		},
    		error: function(data) {
    			console.log(data);
    		}
		});

	}
});

function createCookie(name, value, days) {
	if (days) {	
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		var expires = "; expires=" + date.toUTCString();
	} else {
		var expires = "";
	}
	document.cookie = name + "=" + value + expires + "; path=/";
}

/* Valida si un usuario es correcto */
function validateUsername() {

	// Comprobamos si esta vacio
	if (checkIfEmpty(username)) return;

	// Comprobamos RegEx
	if (!checkUsername(username)) return;
	
	return true;
}

function validatePassword() {

	// Comprobamos si esta vacio
	if (checkIfEmpty(password)) return;

	// Must of in certain length
	if (!checkPassword(password, 16)) return;

	return true;
}

/* Check if the field is empty */
function checkIfEmpty(field) {
  	
  	if (isEmpty(field.val().trim())) {
       	setInvalid(field, `${field.attr('name')} no puede estar vacio.`);
    	return true;
  	} else {
		setValid(field);
		return false;
  	}
}

/* Minimum eight characters, at least one uppercase letter, one lowercase letter and one number: */
function checkPassword(field, maxLength) {

	if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/.test(field.val())) {
		setValid(field);
		return true;
	} else if (field.val().length > maxLength) {
		setInvalid(field, `La ${field.attr('name')} debe contener como mucho ${maxLength} caracteres.`);
		return false;
	} else {
		setInvalid(field, `La ${field.attr('name')} al menos debe tener 8 caracteres, una letra minuscula, otra mayuscula y un numero.`);
		return false;
	}

}

/* Comprueba si solo hay caracteres alfanumericos */
function checkUsername(field) {
	
	if (/^[a-zA-Z0-9]+$/.test(field.attr('name'))) {
    	setValid(field);
		return true;
	} else {
		setInvalid(field, `${field.attr('name')} solo puede contener letras y numeros`);
		return false;
  	}
}


function isEmpty(value) {
	if (value === '') return true;
	return false;
}

/* Shows a warning message behind the input field */
function setInvalid(field, message) {

	if (field.hasClass('success')) 
		field.removeClass('success').addClass('error');
	else if (!field.hasClass('error')) 
		field.addClass('error');

	field.next().html(message);
}

/* Disables de warning message behind input field */
function setValid(field) {	

	if (field.hasClass('error')) 
		field.removeClass('error').addClass('success');
	else if (!field.hasClass('success')) 
		field.addClass('success');

	field.next().html("");
}





//https://pastebin.com/RS5ubqvv


/* Password RegEx - Cortesia de Stackoverflow 

Minimum eight characters, at least one letter and one number:

"^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"

Minimum eight characters, at least one letter, one number and one special character:

"^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"

Minimum eight characters, at least one uppercase letter, one lowercase letter and one number:

"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"

Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character:

"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"

Minimum eight and maximum 10 characters, at least one uppercase letter, one lowercase letter, one number and one special character:

"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,10}$"

*/