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

		// echo "Array Imagenes: ";
		// print_r($_FILES['images']);

		$targetPath = dirname( __FILE__ ) . $ds . '..' . $ds . $storeFolder . $ds;  //4

		for ($i=0; $i < sizeof($_FILES['images']['name']); $i++) { 
			
			$tempFile = $_FILES['images']['tmp_name'][$i];          //3             
	      

		     
		    $targetFile =  $targetPath . $_FILES['images']['name'][$i];  //5
		

			// echo "tempfile" . $tempFile;
		   	// echo "targetfile" . $targetFile;
		   	// echo $i;

		    move_uploaded_file($tempFile, $targetFile); //6
		}    


		/** Una vez guardadas todas las imagenes que el usuario ha introducido, 
		  * creamos las 3 imagenes correspondientes de distinto tamaño */
		//$source = $_FILES['name']
		for ($i = 0; $i < sizeof($_FILES['images']['name']); $i++) { 

			echo 'line 63: ';
			print_r($_FILES['images']['name'][$i]);

			$trozos = explode(".", $_FILES['images']['name'][$i]);

			echo 'line 67: ';
			print_r($trozos);

			$targetFile =  $targetPath . $_FILES['images']['name'][$i]; 

			$dest_img_sm = $targetPath . $trozos[count($trozos) - 2] . "_sm." . $trozos[count($trozos) -1];
			scale_img($targetFile, $dest_img_sm, $trozos[count($trozos) -1], 150, 150);

			$dest_img_md = $targetPath . $trozos[count($trozos) - 2] . "_md." . $trozos[count($trozos) -1];
			scale_img($targetFile, $dest_img_md, $trozos[count($trozos) -1], 800, 800);
			
			$dest_img_lg = $targetPath . $trozos[count($trozos) - 2] . "_lg." . $trozos[count($trozos) -1];
			scale_img($targetFile, $dest_img_lg, $trozos[count($trozos) -1], 1500, 1500);
		}

		// $query = "INSERT into restaurantes(nombre, ubicacion, cocina, precio, imagen) VALUES ('$name', '$location', '$food_type', '$price', '$img_name')";
		// $result = mysqli_query($conn, $query);

		// if (!$result) {
		// 	die('Query Failed.');
		// }

		// echo "Restaurant Successfully";  
		
	} else {
		echo "error";
	}



	function scale_img($src_img_path, $dest_img_path, $ext, $dest_imgx, $dest_imgy){

		echo "Source Image: " . $src_img_path;
		echo "Dest Image: " . $dest_img_path;

		if ( $ext == "jpg" || $ext == "jpeg" ) {
			$src_img = imagecreatefromjpeg($src_img_path); 
		} else if ($ext = "png") {
			$src_img = imagecreatefrompng($src_img_path); 
		} else if ($ext = "gif") {
			$src_img = imagecreatefromgif($src_img_path); 
		}

		// Get width and heigth of the source image 
		$src_imgx = imagesx($src_img);
		
		$src_imgy = imagesy($src_img);

		// Create the new image
		$new_img = imagecreatetruecolor($dest_imgx, $dest_imgy);
		
		// Scale the new image
		imagecopyresampled($new_img, $src_img, 0, 0, 0, 0, $dest_imgx, $dest_imgy, $src_imgx, $src_imgy);
		
		//header("Content-Type: image/png");
		
		// Export the new scaled image
		if ( $ext == "jpg" || $ext == "jpeg" ) {
			imagejpeg($new_img, $dest_img_path, 100);
		} else if ($ext = "png") {
			 imagepng($new_img, $dest_img_path);
		} else if ($ext = "gif") {
			imagegif($new_img, $dest_img_path);
		}

		// Remove temporal image
		imagedestroy($new_img);		
	}

