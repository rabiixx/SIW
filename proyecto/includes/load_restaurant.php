<?php 
	
	require 'database.php';


	if ($_POST["buttonPressed"]) {

		$restauratName = $_POST["restName"];

		$query = "SELECT * FROM restaurantes WHERE Nombre='Aintzane'; ";

		$result = mysqli_query($conn, $query);

		if (!$result) {
			 die('Query Failed'. mysqli_error($conn));
		}

		$row = mysqli_fetch_array($result);
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
        
        $idRestaurant = $row['idRestaurante'];
	
	
		$matrix = array();
		
		$results = getRating($idRestaurant, $conn);
		
		while ($row = mysqli_fetch_assoc($results)) {
			
			$rating = array(
		        'title' => $row['Titulo'],
		      	'description' => $row['Descripcion'],
		      	'punctuation' => $row['Puntuacion'],
		    );

			$matrix[] = array(
				'rating' => $rating,
				'username' => getUsername($row['idUsuario'], $conn),
				'date' => $row['Fecha'],
				'imgs' => getImages($row['idOpinion'], $conn),
			);
		}


		$jsonstring = json_encode($matrix);
	

		$src_template = explode("##MARCA##", file_get_contents("../reserve.html"));

	   	$auxTemplate = '';

	   	$dest_template = '';

		for ($i = 0; $i < sizeof($matrix); $i++) { 

			$auxTemplate = $src_template[1];

			$auxTemplate = str_replace("##Username##", $matrix[$i]['username'], $auxTemplate);
		   	$auxTemplate = str_replace("##Titulo##", $matrix[$i]['rating']['title'], $auxTemplate);
		   	$auxTemplate = str_replace("##Descripcion##", $matrix[$i]['rating']['description'], $auxTemplate);
		   	$auxTemplate = str_replace("##Fecha##", $matrix[$i]['date'], $auxTemplate);


		   	$dest_template .= $auxTemplate;
		}

		echo $src_template[0] . $dest_template . $src_template[2];

	}





   /**
    * @param  %idUser
    * @return 
    */
    function getUsername(int $idUser, $conn) {
   		$query = "SELECT Nombre FROM usuarios WHERE (idUsuario = $idUser)";		
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		
		$username = mysqli_fetch_row($result)[0];

		return $username;
   	}



   	/**
   	 * @param  int $idOpinion Id de la opinion
   	 * @return Array $arrImgs Array con los nombres de las imagenes de la opinion
   	 */
   	function getImages(int $idOpinion, $conn)
   	{
   	
		// Obtener todas las imagenes pertencientes a una opinion
		$query = "	SELECT imgName FROM imagenes
						WHERE '$idOpinion'=idOpinion ";

		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

		$arrImgs = array();
		while ($row = mysqli_fetch_assoc($result)){
			$arrImgs[] = $row['imgName'];
		}

   		return $arrImgs;

   	}

   	function getRating($idRestaurant, $conn)
   	{
   			
   		$query = "	SELECT o.Titulo, o.Descripcion, o.Puntuacion, op.idUsuario, op.idOpinion, op.Fecha
					FROM opiniones o, opinar op
					WHERE ('$idRestaurant' = op.idRestaurante) AND (op.idOpinion = o.idOpinion);";

		$result = mysqli_query($conn, $query) or die('Query failed' . mysqli_error($conn));

   		return $result;
   	}




   	