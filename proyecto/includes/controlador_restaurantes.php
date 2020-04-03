<?php 

	include 'database.php';

	$accion = $_POST['accion'];
	


	if ($accion == 'filtro') {
		
		filtros($conn);

	} else {
		
		$code = $_POST['code'];

		switch ($code) {
			case 1:
				infScroll(1, $conn);
				break;
			case 2:
				infScroll(2, $conn);
				break;
			case 3:
				infScroll(3, $conn);
				break;
			case 4:
				infScroll(4, $conn);
				break;
		}
	}
		

	function filtros($conn) {

		$query = "SELECT * FROM restaurantes WHERE Ubicacion != '' " ;

		if (isset($_POST['ubicacion'])) {
			$ubicaciones = implode("','", $_POST['ubicacion']);
			$query .= "AND Ubicacion IN('" . $ubicaciones . "')";
		}

		if (isset($_POST['cocina'])) {
			$cocinas = implode("','", $_POST['cocina']);
			$query .= " AND Categoria IN('" . $cocinas . "')";
		}

		$query .= " LIMIT 6";

		// echo $query;

		$result = mysqli_query($conn, $query);
		  
		if(!$result) {
			die('Query Failed'. mysqli_error($conn));
		}

		// echo mysqli_num_rows($result);

		echo res2json($result);

	}

	function res2json($res){
		
		$json = array();

		while($row = mysqli_fetch_array($res)) {
		    $json[] = array(
		        'imagen' => $row['Imagen'],
		      	'nombre' => $row['Nombre'],
		      	'ubicacion' => $row['Ubicacion'],
		      	'categoria' => $row['Categoria'],
		      	'precio' => $row['Precio']
		    );
		}

		return json_encode($json);
	}




	function infScroll($code, $conn) {
	
		// $start = $_POST["start"];
		// $limit = $_POST["limit"];

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
			return res2json($result);
		} else {
			exit("reachedMax");
		}

	}