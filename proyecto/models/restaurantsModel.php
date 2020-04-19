<?php 

	include '../includes/database.php';

	function loadRestaurants($conn, $code) {

		$query = "SELECT * FROM restaurantes WHERE Ubicacion != '' " ;

		if ( isset($_POST['ubicacion']) ) {
			if ($code == 1) {
				$ubicaciones = $_POST['ubicacion'];
			} else {
				$ubicaciones = implode("','", $_POST['ubicacion']);
			}	
			
			$query .= "AND Ubicacion IN('" . $ubicaciones . "')";
		}

		if ( isset($_POST['cocina']) ) {
			if ($code == 1) {
				$cocinas = $_POST['cocina'];
			} else {
				$cocinas = implode("','", $_POST['cocina']);	
			}
			
			$query .= " AND Cocina IN('" . $cocinas . "')";
		}

		if ($code == 3) {
			$start = $_POST['start'];
			$limit = $_POST['limit'];
			$query .= " LIMIT " . $start . ", " . $limit;
		} else {
			$query .= " LIMIT 6";
		}

		// echo $query;

		$result = mysqli_query($conn, $query);

		return $result;
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
						FROM restaurantes GROUP BY Ubicacion ORDER BY Cantidad DESC";
		
		$result1 = mysqli_query($conn, $query1);

		$query2 = "	SELECT DISTINCT Cocina, COUNT(Cocina) AS Cantidad
						FROM restaurantes GROUP BY Cocina ORDER BY Cantidad DESC";
		
		$result2 = mysqli_query($conn, $query2);


		return array(
			'Ubicacion' => $result1,
			'Cocina' => $result2
		);


	}



