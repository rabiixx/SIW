<?php 

	include 'database.php';

	// Indice desde el cual se cargaran los restaurantes
	$start = mysqli_real_escape_string($conn, $_POST['start']);
	 		 
	// Cantidad de restaurantes que se van a cargar
	$limit = mysqli_real_escape_string($conn, $_POST['limit']);

	$query = "SELECT * FROM restaurantes LIMIT $start, $limit";

	$results = mysqli_query($conn, $query);

	if (!$results) {
		exit("reachedMax");
	}
	
	if ( mysqli_num_rows($results) > 0 ) {
		while($row = mysqli_fetch_array($results)) {
			$json[] = array(
				'imagen' => $row['Imagen'],
				'nombre' => $row['Nombre'],
				'ubicacion' => $row['Ubicacion'],
				'cocina' => $row['Categoria'],
				'precio' => $row['Precio']
			);
		}
		$jsonstring = json_encode($json);
		echo $jsonstring;
	} else {
		exit("reachedMax");
	}