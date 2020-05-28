<?php 

	include 'database.php';


	if ($_POST['button-pressed']) {
		
		$search = $_POST['search'];

  		$query = "SELECT Nombre, Ubicacion FROM restaurantes WHERE Nombre LIKE '$search%' LIMIT 4";
	  	$result = mysqli_query($conn, $query);
  
		if(!$result) {
	    	die('Query Failed'. mysqli_error($conn));
	  	}

    	$restaurantes_json = array();

	    while($row = mysqli_fetch_array($result)) {
	        $restaurantes_json[] = array(
	            'nombre' => $row['Nombre'],
	          	'ubicacion' => $row['Ubicacion'],
	        );
	    }


  		$query = "SELECT DISTINCT Ubicacion FROM restaurantes WHERE Ubicacion LIKE '$search%' LIMIT 4";
	  	$result = mysqli_query($conn, $query);
  
		if(!$result) {
	    	die('Query Failed'. mysqli_error($conn));
	  	}

	  	$ubicaciones_json = array();

	    while($row = mysqli_fetch_array($result)) {
	        $ubicaciones_json[] = array(
	          	'ubicacion' => $row['Ubicacion'],
	        );
	    }

  		$query = "SELECT DISTINCT Cocina FROM restaurantes WHERE Cocina LIKE '$search%' LIMIT 4";
	  	$result = mysqli_query($conn, $query);
  
		if(!$result) {
	    	die('Query Failed'. mysqli_error($conn));
	  	}

	  	$cocina_json = array();

	    while($row = mysqli_fetch_array($result)) {
	        $cocina_json[] = array(
	          	'cocina' => $row['Cocina'],
	        );
	    }



	    $result_json = array(	'lista_restaurantes' => $restaurantes_json,
	    						'lista_ubicaciones' => $ubicaciones_json,
	    						'lista_cocinas' => $cocina_json);

	    $json = json_encode($result_json);

		echo $json;
	}