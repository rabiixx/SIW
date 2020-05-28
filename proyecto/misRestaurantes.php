<?php 

	include 'includes/database.php';

	session_start();
	if ( !($username = $_SESSION['username']) ) {
		header("Location ../login.html");
		exit();
	}

	$queryUser = "SELECT idUsuario FROM usuarios WHERE (Username = '$username')";
	$res = mysqli_query($conn, $queryUser);
	$row = mysqli_fetch_assoc($res);
	$idUsuario = $row['idUsuario'];

	$queryRest = "SELECT * FROM restaurantes WHERE idUsuario = '$idUsuario'";
	$res = mysqli_query($conn, $queryRest);

	echo showRestaurants($res);

	function showRestaurants($data) {

		$src_template = explode("##RESTAURANTE##", file_get_contents("misRestaurantes.html"));

		$auxTemplate = '';
		$restaurantListHtml = '';

		while($row = mysqli_fetch_array($data)) {
			
			$auxTemplate = $src_template[1];

			$auxTemplate = str_replace("##IMAGEN##", 'img/' . $row['Imagen'] , $auxTemplate);
			$auxTemplate = str_replace("##NOMBRE##", $row['Nombre'] , $auxTemplate);
			$auxTemplate = str_replace("##UBICACION##", $row['Ubicacion'] , $auxTemplate);
			$auxTemplate = str_replace("##COCINA##", $row['Cocina'] , $auxTemplate);
			
			$auxTemplate = str_replace("##LINK##", $row['Nombre'] , $auxTemplate);

			if ( $row['Precio'] < 20 ) {
				$auxPrecio = '<i class="fas fa-euro-sign mx-1"></i>
						<i class="fas fa-euro-sign mx-1 euro-disabled"></i>
						<i class="fas fa-euro-sign mx-1 euro-disabled"></i>';
			} else if ( $row['Precio'] < 50 ) {

				$auxPrecio = '<i class="fas fa-euro-sign mx-1"></i>
						<i class="fas fa-euro-sign mx-1"></i>
						<i class="fas fa-euro-sign mx-1 euro-disabled"></i>';
			} else {
				$auxPrecio = '<i class="fas fa-euro-sign mx-1"></i>
						<i class="fas fa-euro-sign mx-1"></i>
						<i class="fas fa-euro-sign mx-1"></i>';
			}
			
			$auxTemplate = str_replace("##PRECIO##", $auxPrecio, $auxTemplate);

			$restaurantListHtml .= $auxTemplate;
		}

		return $src_template[0] . $restaurantListHtml . $src_template[2];
	}

