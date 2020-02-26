<?php 

	include 'database.php';

	if(!empty($_FILES["csv_file"]["name"])) {

		$file_data = fopen($_FILES["csv_file"]["tmp_name"], 'r');  
		
		fgetcsv($file_data);	// Leemos la primera linea del csv (cabecera)

		//print_r($file_data);

		while ($row = fgetcsv($file_data, 100, ";")) {
			
			$name = mysqli_real_escape_string($conn, $row[0]);

			$location = mysqli_real_escape_string($conn, $row[1]);

			$food_type = mysqli_real_escape_string($conn, $row[2]);

			$price = mysqli_real_escape_string($conn, $row[3]);

			$puntuation = mysqli_real_escape_string($conn, $row[4]);

			$img = mysqli_real_escape_string($conn, $row[5]);

			$query = "INSERT INTO restaurantes (nombre, ubicacion, cocina, precio, puntuacion, imagen)
					  VALUES ('$name', '$location', '$food_type', '$price', '$puntuation', '$img')";
		
			mysqli_query($conn, $query);
	
		}

		echo "error1";
	} else {
		echo  "error2";
	}