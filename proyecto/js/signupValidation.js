/* Signup Form Javascript Validation */

// Input fields
const firstName = document.getElementById('first-name');
const lastName = document.getElementById('last-name');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirm-password');

firstName.addEventListener('focusout', function () {
	validateName(this);
});

lastName.addEventListener('focusout', function () {
	validateName(this);
});


// Form
const signupForm = document.getElementById('signup-form');

// Handle Signup Form
signupForm.addEventListener('submit', function(e) {


	// Prevent default behaviour
	e.preventDefault();

	if ( 
		validateName(firstName) &&
		validateName(lastName) &&
		validateUsername() &&
	 	validateEmail() && 
	 	validatePassword() &&
	 	validateConfirmPassword()
	 	) {

			var formData = new FormData(this);
			formData.append("button-pressed", true);
			
			//formData.append('username', username.value);
			//formData.append('password', password.value);*/
			
			$.ajax({
				url: 'includes/signup.inc.php',
				type: 'POST',
				data: formData,
				contentType: false,
	    		processData: false,
	    		success: function (response, data, error) {
	    			createCookie("user", username.value, 3);
	    			$(location).attr('href', 'espabila.html');
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


/* Validates firstname and lastname */
function validateName(field) {

	// Comprobamos si esta vacio
	if (checkIfEmpty(field)) return;

	// Comprobamos RegEx
	if (!checkName(field)) return;
	
	return true;
	
}

/* Only letters and no whitespaces */
function checkName(field) {
	
	if (/^[a-zA-Z]*$/.test(field.value)) {
    	setValid(field);
		return true;
	} else {
		setInvalid(field, `El ${field.placeholder} solo puede contener letras.`);
		return false;
  	}
}


function validateEmail() {
	
	// Comprobamos si esta vacio
	if (checkIfEmpty(email)) return;

	// Comprobamos RegEx
	if (!checkEmail(email)) return;
	
	return true;
}

function checkEmail(field) {
	
	var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	if (regex.test(field.value)) {
		setValid(field);
		return true;
	} else {
		setInvalid(field, 'El email no es valido.');
		return false;
	}
}

/* Valida si un usuario es correcto */
function validateUsername() {

	// Comprobamos si esta vacio
	if (checkIfEmpty(username)) return;

	// Comprobamos RegEx
	if (!checkUsername(username)) return;
	
	return true;
}


/* Comprueba si solo hay caracteres alfanumericos */
function checkUsername(field) {
	if (/^[a-zA-Z0-9]+$/.test(field.value)) {
    	setValid(field);
		return true;
	} else {
		setInvalid(field, `${field.name} solo puede contener letras y numeros.`);
		return false;
  	}
}

function validatePassword() {

	// Comprobamos si esta vacio
	if (checkIfEmpty(password)) return;

	// Must of in certain length
	if (!checkPassword(password, 16)) return;

	return true;
}

/* Minimum eight characters, at least one uppercase letter, one lowercase letter and one number: */
function checkPassword(field, maxLength) {

	if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/.test(field.value)) {
		setValid(field);
		return true;
	} else if (field.value.length > maxLength) {
		setInvalid(field, `La ${field.name} debe contener como mucho ${maxLength} caracteres.`);
		return false;
	} else {
		setInvalid(field, `La ${field.name} al menos debe tener 8 caracteres, una letra minuscula, otra mayuscula y un numero.`);
		return false;
	}

}

function validateConfirmPassword() {
	if (password.classList.contains('text-danger')) {
		setInvalid(confirmPassword, 'La contraseña debe ser valida.');
		return;
	}
	
	// If they match
	if (password.value !== confirmPassword.value) {
		setInvalid(confirmPassword, 'Las constraseñas no coinciden.');
		return;
	} else {
		setValid(confirmPassword);
		return true;
	}

}

/* Check if the field is empty */
function checkIfEmpty(field) {
  	if (isEmpty(field.value.trim())) {
    	
    	// Set field invalid
    	setInvalid(field, `${field.placeholder} no puede estar vacio.`);
    	return true;
  	} else {
		// set field valid
		setValid(field);
		return false;
  	}
}

function isEmpty(value) {
	if (value === '') return true;
	return false;
}

/* Shows a warning message behind the input field */
function setInvalid(field, msg) {

	field.nextElementSibling.innerHTML = msg;
	
	if (field.nextElementSibling.classList.contains('text-success')) {
		field.nextElementSibling.classList.remove('text-success');		
	}


	if (field.classList.contains('border-success')) {
		field.classList.remove('border-success');
	}

	field.classList.add('border-danger');
	field.nextElementSibling.classList.add('text-danger');
	
}

/* Disables de warning message behind input field */
function setValid(field) {	

	field.nextElementSibling.innerHTML = '';


	if (field.classList.contains('border-danger')) {
		field.classList.remove('border-danger');
	}

	field.classList.add('border-success');
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