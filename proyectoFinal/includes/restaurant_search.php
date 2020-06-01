<?php 

	include 'database.php';

	$search = $_POST['search'];

	if(!empty($search)) {
  		
  		$query = "SELECT * FROM restaurantes WHERE nombre LIKE '%$search%'";
  		$result = mysqli_query($conn, $query);
  
	  	if(!$result) {
	    	die('Query Error' . mysqli_error($conn));
	  	}
	  
	  	$json = array();
	  	
	  	while($row = mysqli_fetch_array($result)) {
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
	}
