<?php 


	include "database.php";

	$filtro = $_POST['filtro'];
	$opcion = $_POST["opcion"];

	$query = "SELECT * FROM restaurantes WHERE $filtro='$opcion'";

	// echo $query;

	$result = mysqli_query($conn, $query);
	  
	if(!$result) {
		die('Query Failed'. mysqli_error($conn));
	}

	// echo mysqli_num_rows($result);

	$json = array();

	while($row = mysqli_fetch_array($result)) {
	    $json[] = array(
	        'imagen' => $row['Imagen'],
	      	'nombre' => $row['Nombre'],
	      	'ubicacion' => $row['Ubicacion'],
	      	'categoria' => $row['Categoria'],
	      	'precio' => $row['Precio']
	    );
	}

	$jsonstring = json_encode($json);
	echo $jsonstring;

