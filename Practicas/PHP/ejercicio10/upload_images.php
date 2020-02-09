<?php 

	/* Ruta destino (incluir nombre del fichero) */
	$target_dir = 'subidas/';
	$target_file = $target_dir . basename($_FILES["fichero"]["name"]);

	/* Extensiones Permitidas */
	$allowedExtensions = array("jpeg", "jpg", "png", "gif");

	/* Obtener extension de la imagen */

	/* Opcion 1 */
	//echo strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	/* Opcion 2 */

	/* explode devuelve un array con todas las parted delimitadas por "."s"
	/* end() devuelve el ultimo elemento del array */
	/* in_array() compruba que se encuentre en el array de extensiones */

	$tmp = explode(".", strtolower($target_file));

	if (!in_array(end($tmp), $allowedExtensions)) {
			echo '<div class="error"> Invalid file type.</div>';
	} else {
		
		if (move_uploaded_file($_FILES["fichero"]["tmp_name"], $target_file)) {
			echo "El fichero " . basename($_FILES["fichero"]["name"]) . " ha sido subido correctamente.\n";
		} else {
			echo "Error";
		}
	}




		
 ?>
