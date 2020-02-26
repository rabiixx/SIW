<?php 
	if ($_POST) {
		$name = $_POST['name'];
		$lastname = $_POST['lastname'];
	}

	echo "<h1> Hola ". $name . " " . $lastname . " </h1>" 
 ?>