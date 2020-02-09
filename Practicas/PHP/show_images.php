<?php 

	$dir = 'subidas/';

	/* Extensiones Permitidas */
	$allowedExtensions = array("jpeg", "jpg", "png", "gif");

	if (!file_exists($dir)) {
			echo 'Directory /' . $dir . '/ not found';
	} else {

		/* Mostrar fichero del directorio */
		// $dir_contents = scandir($dir);
		// print_r($dir_contents);

		/** scandir() devuelve dos ficheros extra (. y ..) que no queremos que se muestren */

		foreach (scandir($dir) as $imagen) {
			$tmp = explode(".", strtolower($imagen));
			if (in_array(end($tmp), $allowedExtensions)) {
				echo '<img src="' . $dir . '/' . $imagen . '" alt="' . $imagen . '" height="200" width="200"><br>';
			}
		}
	}

 ?>


	