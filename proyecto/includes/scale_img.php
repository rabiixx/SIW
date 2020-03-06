<?php   
	
	// Obtenemos la extension de la imagen
	$ext = explode(".", $img);

	$ext = $ext[count($ext) - 1];

	if ( $ext == "jpg" || $ext == "jpeg" ) {
		$source_img = imagecreatefromjpeg($img); 
	} else if (condition) {
		$source_img = imagecreatefrompng($img); 
	} else if (condition) {
		$source_img = imagecreatefromgif($img); 
	}

	// Get width and heigth of the source image 
	$source_imagex = imagesx($source_image);
	
	$source_imagey = imagesy($source_image);

	$dest_imagex = 300;

	$dest_imagey = 200;

	// Create the new image
	$dest_image = imagecreatetruecolor($dest_imagex, $dest_imagey);
	
	// Scale the new image
	imagecopyresampled($dest_image, $source_image, 0, 0, 0, 0, $dest_imagex, $dest_imagey, $source_imagex, $source_imagey);
	
	header("Content-Type: image/jpeg");
	
	// Export the new scaled image
	imagejpeg($dest_image, NULL, 80);
?>