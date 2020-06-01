<?php 
	
	require 'includes/database.php';


	// if ($_POST["buttonPressed"]) {

		$restaurant = $_GET["restaurant"];


		$src_template = explode("##MARCA##", file_get_contents("reserve.html"));		


		$query = "SELECT * FROM restaurantes WHERE Nombre='$restaurant'; ";

		$result = mysqli_query($conn, $query);

		if (!$result) {
			 die('Query Failed'. mysqli_error($conn));
		}

		$row = mysqli_fetch_array($result);
        $json[] = array(
            'imagen' => $row['Imagen'],
          	'nombre' => $row['Nombre'],
          	'ubicacion' => $row['Ubicacion'],
          	'categoria' => $row['Cocina'],
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


		$src_template[0] = str_replace("##ImagenRestaurante##", "img/" . $json[0]['imagen'], $src_template[0]);
		$src_template[0] = str_replace("##NombreRestaurante##", $json[0]['nombre'], $src_template[0]);
		$src_template[0] = str_replace("##UBICACION##", $json[0]['ubicacion'], $src_template[0]);
		$src_template[0] = str_replace("##PRECIO##", $json[0]['precio'], $src_template[0]);
		$src_template[0] = str_replace("##COCINA##", $json[0]['categoria'], $src_template[0]);

	   	$auxTemplate = '';

	   	$dest_template = '';

		for ($i = 0; $i < sizeof($matrix); $i++) { 

			$auxTemplate = $src_template[5];

			$auxTemplate = str_replace("##Username##", $matrix[$i]['username'], $auxTemplate);
		   	$auxTemplate = str_replace("##Titulo##", $matrix[$i]['rating']['title'], $auxTemplate);
		   	$auxTemplate = str_replace("##Descripcion##", $matrix[$i]['rating']['description'], $auxTemplate);
		   	$auxTemplate = str_replace("##Fecha##", $matrix[$i]['date'], $auxTemplate);


		   	$dest_template .= $auxTemplate;
		}


		$query = "SELECT idRestaurante FROM restaurantes WHERE Nombre = '$restaurant'";
		$res = mysqli_query($conn, $query);
		$row = mysqli_fetch_row($res);
		$id = $row[0];

		$query = "SELECT * FROM imgrestaurante WHERE idRestaurante = '$id' ";
		//echo $query;
		$res = mysqli_query($conn, $query);
		

		$imgHtml1 = '';
		$imgHtml2 = '';

		$trozos = explode(".", $json[0]['imagen']);
		// $imagen_md = $trozos[0] . '_md.' . $trozos[1]; 		
		// $imagen_sm = $trozos[0] . '_sm.' . $trozos[1];
		// $imagen_lg = $trozos[0] . '_lg.' . $trozos[1];
		
		// $imgHtml1 .= str_replace("##IMGMD##", $imagen_md, $src_template[1]);
		// $imgHtml1 .= str_replace("##IMGLG##", $imagen_lg, $imgHtml1);
		// $imgHtml1 .= str_replace("##ACTIVE##", "active", $imgHtml1);

		// $imgHtml2 .= str_replace("##IMGSM##", $imagen_sm, $src_template[3]);

		
		if ($res) {
			
			$i = 0;
			while ($row = mysqli_fetch_assoc($res)) {
				
				$img1Template = $src_template[1];
				$img2Template = $src_template[3];

				//echo $row['imgName'];

				$trozos = explode(".", $row['imgName']);
				$imagen_md = $trozos[0] . '_md.' . $trozos[1]; 		
				$imagen_sm = $trozos[0] . '_sm.' . $trozos[1];
				$imagen_lg = $trozos[0] . '_lg.' . $trozos[1];

				$img1Template = str_replace("##IMGMD##", $imagen_md, $img1Template);
				$img1Template = str_replace("##IMGLG##", $imagen_lg, $img1Template);
				
				if ($i == 0) {
					$img1Template = str_replace("##ACTIVE##", "active", $img1Template);	
				} else {
					$img1Template = str_replace("##ACTIVE##", "", $img1Template);		
				}

				$img2Template = str_replace("##IMGSM##", $imagen_sm, $img2Template);

				$imgHtml1 .= $img1Template;
				$imgHtml2 .= $img2Template;
			
				$i++;
			}

			$imgHtml = $imgHtml1 . $src_template[2] . $imgHtml2 . $src_template[4]; 
		} else {
			$imgHtml = $imgHtml1 . $src_template[2] . $imgHtml2 . $src_template[4]; 
		}


		echo $src_template[0] . $imgHtml . $dest_template . $src_template[6];

	//}


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



?>

 <!-- <?php  

	// $cadena = file_get_contents("reserve.html");

	// $trozos = explode("##MARCA##", $cadena);

	// $aux = "";
	// $cuerpo = "";
	// $cuerpo = $str_replace("##NombreRestaurante##", )



	// for ($i = 0; $i < $numero; $i++) {
	// 	if ($i % 2) {
	// 		$aux = $trozos[1];
	// 		$aux = str_replace("##nomp1##", $nomp1, $aux);
	// 		$aux = str_replace("##ape1p1##", $ape1p1, $aux);
	// 		$aux = str_replace("##ape2p1##", $ape2p1, $aux);
	// 		$aux = str_replace("##color1##", $color1, $aux);
			
	// 		$cuerpo .= $aux;
	// 	} else {
	// 		$aux = $trozos[2];
	// 		$aux = str_replace("##nomp2##", $nomp2, $aux);
	// 		$aux = str_replace("##ape1p2##", $ape1p2, $aux);
	// 		$aux = str_replace("##ape2p2##", $ape2p2, $aux);
			
	// 		$aux = str_replace("##color2##", $color2, $aux);

	// 		$cuerpo .= $aux;
	// 	}
	// }

	// echo $trozos[0] . $cuerpo . $trozos[3];

?>  -->

<!--  	<div>##NombreRestaurante##</div>
	<div>##Ubicacion##</div>
	<div>##Precio##</div>
	<div>##Categoria##</div>
								<h5 class="text-center ml-3">##Username##</h5>

						<h5 class="mr-3">##Titulo##</h5>

			    		<h5 class="ml-auto">##Fecha##</h5>

						<div class="card-text font-weight-light font-italic">##Descripcion##</div> 
 -->