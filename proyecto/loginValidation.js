
const red = '#F44336';

// Input fields
const username = document.getElementById('username');
const password = document.getElementById('pass');

// Form
const form = document.getElementById('loginForm');

// Handle form
form.addEventListener('submit', function(e) {
	// Prevent default behaviour
	e.preventDefault();

	if ( (validateUsername() || validateEmail()) && validatePassword() ) {

		//var form = $('form'); // You need to use standard javascript object here
		var formData = new FormData();
		formData.append('username', username.value);
		formData.append('password', password.value);
		/*formData.append('username', $('username').val());
		formData.append('password', $('pass').val());*/

		//console.log(formData.get("Nombre de Usuario"));


		$.ajax({
			url: 'includes/login.inc.php',
			type: 'POST',
			data: formData,
			contentType: false,
    		processData: false
		})
		.done(function(data) {
			console.log(data);
		})
		.fail(function() {
			console.log("error");
		});
		





	}

});


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


function checkIfEmpty(field) {
  	if (isEmpty(field.value.trim())) {
    	
  		console.log(field.value);

    	// set field invalid
    	setInvalid(field, `${field.name} no puede estar vacio.`);
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

function setInvalid(field, message) {
	field.parentElement.nextElementSibling.innerHTML = message;
}

function setValid(field) {	
	field.parentElement.nextElementSibling.innerHTML = '';
}

/* Comprueba si solo hay caracteres alfanumericos */
function checkUsername(field) {
	if (/^[a-zA-Z0-9]+$/.test(field.value)) {
    	setValid(field);
		return true;
	} else {
		setInvalid(field, `${field.name} solo puede contener letras y numeros`);
		return false;
  	}
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