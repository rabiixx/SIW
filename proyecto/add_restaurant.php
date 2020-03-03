<?php 


	include 'database.php';
	
	$name = $_POST['name'];
	$location = $_POST['location'];
	$food_type = $_POST['food-type'];
	$price = $_POST['price'];
	$img_name = $_FILES['images']['name'][0];

	/*$img_names = array();
	
	echo sizeof($_FILES['images']['name']);

	for ($i=0; $i < sizeof($_FILES['images']['name']); $i++) { 
		$img_names[] = $_FILES['images']['name'][$i];
	}

	print_r($img_names);*/
	/*echo $name;
	echo $location;
	echo $food_type;
	echo $price;*/


	$ds  = DIRECTORY_SEPARATOR;  //1
	 
	$storeFolder = 'img';   //2

	//echo sizeof($_FILES['images']['name']);
	 
	if (!empty($_FILES)) {

		//echo "Array Imagenes: ";

		//print_r($_FILES['images']);

		for ($i=0; $i < sizeof($_FILES['images']['name']); $i++) { 
			
			$tempFile = $_FILES['images']['tmp_name'][$i];          //3             
	      
		    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
		     
		    $targetFile =  $targetPath 	. $_FILES['images']['name'][$i];  //5
		
		   // echo $targetFile;

		    move_uploaded_file($tempFile, $targetFile); //6
		}    


		/** Una vez guardadas todas las imagenes que el usuario ha introducido, 
		  * creamos las 3 imagenes correspondientes de distinto tamaño */
		//$source = $_FILES['name']
		for ($i = 0; $i < sizeof($_FILES['images']['name']); $i++) { 

			$trozos = explode(".", $_FILES['images']['name'][$i]);

			$dest_img_sm = $targetPath . $trozos[count($trozos) - 2] . "_sm." . $trozos[count($trozos) -1];
			scale_img($targetFile, $dest_img_sm, $trozos[count($trozos) -1], 150, 150);

			$dest_img_md = $targetPath . $trozos[count($trozos) - 2] . "_md." . $trozos[count($trozos) -1];
			scale_img($targetFile, $dest_img_md, $trozos[count($trozos) -1], 800, 800);
			
			$dest_img_lg = $targetPath . $trozos[count($trozos) - 2] . "_lg." . $trozos[count($trozos) -1];
			scale_img($targetFile, $dest_img_lg, $trozos[count($trozos) -1], 1500, 1500);

		}

		$query = "INSERT into restaurantes(nombre, ubicacion, cocina, precio, imagen) VALUES ('$name', '$location', '$food_type', '$price', '$img_name')";
		$result = mysqli_query($conn, $query);

		if (!$result) {
			die('Query Failed.');
		}

		echo "Restaurant Successfully";  
		
	} else {
		echo "error";
	}



	function scale_img($img, $dest_img, $ext, $dest_imgx, $dest_imgy){

		echo $img;

		if ( $ext == "jpg" || $ext == "jpeg" ) {
			$source_img = imagecreatefromjpeg($img); 
		} else if ($ext = "png") {
			$source_img = imagecreatefrompng($img); 
		} else if ($ext = "gif") {
			$source_img = imagecreatefromgif($img); 
		}

		// Get width and heigth of the source image 
		$source_imgx = imagesx($source_img);
		
		$source_imgy = imagesy($source_img);

		// Create the new image
		$new_img = imagecreatetruecolor($dest_imgx, $dest_imgy);
		
		// Scale the new image
		imagecopyresampled($new_img, $source_img, 0, 0, 0, 0, $dest_imgx, $dest_imgy, $source_imgx, $source_imgy);
		
		//header("Content-Type: image/png");
		
		// Export the new scaled image
		if ( $ext == "jpg" || $ext == "jpeg" ) {
			imagejpeg($new_img, $dest_img, 100);
		} else if ($ext = "png") {
			 imagepng($new_img, $dest_img);
		} else if ($ext = "gif") {
			imagegif($new_img, $dest_img);
		}

		// Remove temporal image
		imagedestroy($new_img);		
	}

