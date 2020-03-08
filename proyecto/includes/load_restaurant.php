<?php 
	
	require 'database.php';


	if ($_POST["buttonPressed"]) {

		$restauratName = $_POST["restName"];

		$query = "SELECT * FROM restaurantes WHERE Nombre='$restauratName'; ";

		$result = mysqli_query($conn, $query);

		if (!$result) {
			 die('Query Failed'. mysqli_error($conn));
		}

		$idRestaurant = $row['idRestaurante'];

		while($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'imagen' => $row['Imagen'],
          	'nombre' => $row['Nombre'],
          	'ubicacion' => $row['Ubicacion'],
          	'categoria' => $row['Categoria'],
          	'precio' => $row['Precio'],
			'puntuacion' => $row['Puntuacion'],
			'mapa' => $row['Mapa'],
			'aforo' => $row['Aforo'],
        );

        $jsonstring = json_encode($json);
  		echo $jsonstring;
    }


    // Cargamos las opiniones 
    $query = "	SELECT * 
    			FROM opiniones o, opinar op 
    			WHERE '$idRestaurant' = op.idRestaurant



	}
