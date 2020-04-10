<?php 

	include '../includes/database.php';

	function loadRestaurants($conn, $code) {

		$query = "SELECT * FROM restaurantes WHERE Ubicacion != '' " ;

		if (isset($_POST['ubicacion'])) {
			$ubicaciones = implode("','", $_POST['ubicacion']);
			$query .= "AND Ubicacion IN('" . $ubicaciones . "')";
		}

		if (isset($_POST['cocina'])) {
			$cocinas = implode("','", $_POST['cocina']);
			$query .= " AND Cocina IN('" . $cocinas . "')";
		}

		if ($code == 2) {
			$start = $_POST['start'];
			$limit = $_POST['limit'];
			$query .= " LIMIT " . $start . ", " . $limit;
		} else {
			$query .= " LIMIT 6";
		}

		// echo $query;

		$result = mysqli_query($conn, $query);

		if (!$result) {
			exit("reachedMax");
		}
		  
		if ($code == 1) {
			// return "hola";
			return $result;
			// return $result;
			
		} else {
			
			if (!$result) {
				exit("reachedMax");
			}
			
			if ( mysqli_num_rows($result) > 0 ) {
				echo res2json($result);
			} else {
				exit("reachedMax");
			}
		}
	}


		/* Devulve el Html correspondiente a los filtros de la pagina */
	function setupFilters($conn) {

		// $filtros = array('Ubicacion', 'Cocina');

		// foreach ($filtros as $filtro) {

		// 	$query = "	SELECT DISTINCT $filtro, COUNT($filtro) AS Cantidad
		// 				FROM restaurantes GROUP BY $filtro";

		// 	$result = mysqli_query($conn, $query);
		// }

		$query1 = "	SELECT DISTINCT Ubicacion, COUNT(Ubicacion) AS Cantidad
						FROM restaurantes GROUP BY Ubicacion";
		
		$result1 = mysqli_query($conn, $query1);

		$query2 = "	SELECT DISTINCT Cocina, COUNT(Cocina) AS Cantidad
						FROM restaurantes GROUP BY Cocina";
		
		$result2 = mysqli_query($conn, $query2);


		return array(
			'Ubicacion' => $result1,
			'Cocina' => $result2
		);


	}
