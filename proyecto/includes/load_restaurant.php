<?php 
	
	require 'database.php';


	if ($_POST["buttonPressed"]) {

		$restauratName = $_POST["restName"];

		$query = "SELECT * FROM restaurantes WHERE Nombre='Aintzane'; ";

		$result = mysqli_query($conn, $query);

		if (!$result) {
			 die('Query Failed'. mysqli_error($conn));
		}

		

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
	        $idRestaurant = $row['idRestaurante'];
	    }
        $jsonstring = json_encode($json);
//  		echo $jsonstring;

  		
	    
	    $query2 = "		SELECT opiniones.Titulo, opiniones.Descripcion, opiniones.Puntuacion, opinar.idUsuario, opinar.idImg, opinar.Fecha, opiniones.idOpinion, opinar.idRestaurante 
						FROM opiniones, opinar
						WHERE (1 = opinar.idRestaurante) AND (opinar.idOpinion = opiniones.idOpinion);";


		$result = mysqli_query($conn, $query2) or die(mysqli_error($conn));

		if (!$result) {
			 exit('Query Failed'. mysqli_error($conn));
		}

		$query_user = "SELECT idUsuario FROM usuarios WHERE (idUsuario = 1)";		
		$username = mysqli_query($conn, $query_user) or die(mysqli_error($conn));
		
		$username = mysqli_fetch($username);

		// Obtener todas las imagenes pertencientes a una opinion
		$query_imgs = "	SELECT imgName FROM imagenes i, opinar o
						WHERE o.idOpinion='$row['idOpinion']' AND (o.idImg = i.idImg); ";
		$result = mysqli_query($conn, $query_imgs);

		$arr_imgs = mysqli_fetch_array($result);

		$matrix = array();

		$row = mysqli_fetch_array($result);

		$matrix[] = array(
			'rating' => $rating,
			'username' => $username,
			'date' => $row['Fecha'],
			'imgs' => $arr_img;
		);


		for ($i=1; $i < mysqli_num_rows($result); $i++) { 
			
			$row = mysqli_fetch_array($result);	

			if ($row['idUsuario'] == matrix[i - 1]) {
				# code...
			} else {
				# code...
			}
			


			$query_user = "SELECT idUsuario FROM usuarios WHERE (idUsuario = 1)";		
			//mysqli_query($conn);



		}


		
	    $rating[] = array(
	        'title' => $row['Titulo'],
	      	'description' => $row['Descripcion'],
	      	'rating' => $row['Puntuacion'],
	      	'date' => $row['Fecha'],
	    	'idUser'=> $row['idUsuario'],
	    );

	    

		$matrix[] = array(
			'rating' => $rating,
			'username' => $row['idUsuario'],
			'date' => $row['Fecha']
			//'imgs' => $arr_img;
		);

		//print_r($matrix);


		$jsonstring2 = json_encode($matrix[]);
		echo $jsonstring2;


   }
