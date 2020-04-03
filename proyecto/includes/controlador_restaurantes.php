<?php 


	include 'database.php';

	$code = $_POST['code'];

	switch ($code) {
		case 1:
			infScroll(1);
			break;
		case 2:
			infScroll(2);
			break;
		case 3:
			infScroll(3);
			break;
		case 4:
			infScroll(4);
			break;
	}



	function infScroll($code) {
	
		$start = $_POST["start"];
		$limit = $_POST["limit"];

		// Indice desde el cual se cargaran los restaurantes
		$start = mysqli_real_escape_string($conn, $_POST['start']);
		 		 
		// Cantidad de restaurantes que se van a cargar
		$limit = mysqli_real_escape_string($conn, $_POST['limit']);


		switch ($code) {
			case '1':

				$filtroUbicacion = $_POST["filtroUbicacion"];
				$opcionUbicacion = $_POST["opcionUbicacion"];
				$filtroCocina = $_POST["filtroCocina"];
				$opcionCocina = $_POST["opcionCocina"];

				$query = "	SELECT * FROM restaurantes WHERE ( ($filtroUbicacion='$opcionUbicacion') AND ($filtroCocina='$opcionCocina') )
						 	LIMIT $start, $limit;";
				break;
			
			case 2:
				
				$filtroUbicacion = $_POST["filtroUbicacion"];
				$opcionUbicacion = $_POST["opcionUbicacion"];

				$query = "	SELECT * FROM restaurantes WHERE ($filtroUbicacion='$opcionUbicacion') LIMIT $start, $limit;";

				break;
			
			case 3:

				$filtroCocina = $_POST["filtroCocina"];
				$opcionCocina = $_POST["opcionCocina"];

				$query = "	SELECT * FROM restaurantes WHERE ($filtroCocina='$opcionCocina') LIMIT $start, $limit;";
				
				break;

			default:

				$query = "	SELECT * FROM restaurantes LIMIT $start, $limit;";
				
				break;
		}

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

	}