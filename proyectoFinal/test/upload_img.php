<?php 
	
	$ds  = DIRECTORY_SEPARATOR;  //1
	 
	$storeFolder = 'img';   //2

	echo sizeof($_FILES['images']['name']);

	echo $_POST['firstname'];

	print_r($_FILES['images']);

	 
	if (!empty($_FILES)) {

		for ($i=0; $i < sizeof($_FILES['images']['name']); $i++) { 
			
			$tempFile = $_FILES['images']['tmp_name'][$i];          //3             
	      
		    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
		     
		    $targetFile =  $targetPath. $_FILES['images']['name'][$i];  //5
		 
		    move_uploaded_file($tempFile,$targetFile); //6
		}    
	}


