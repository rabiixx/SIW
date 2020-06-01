<?php 

	include 'database.php';

	if(!empty($_FILES["file"]["name"])) {
		
		$table = $_POST['table'];
		
		$file_data = fopen($_FILES["file"]["tmp_name"], 'r');  
		
		//fgetcsv($file_data);	// Leemos la primera linea del csv (cabecera)


		$str = '';
		while ($row = fgetcsv($file_data, 100, ",")) {
			

			for ($i=0; $i < sizeof($row); $i++) { 

				$str .= "'" . mysqli_real_escape_string($conn, $row[$i]) . "'";

				if ($i != sizeof($row) - 1) {
					$str .= ', ';
				}
			}

			$query = "INSERT INTO $table VALUES (" . $str . ")";
			echo $query;

			echo mysqli_query($conn, $query) or die(mysqli_error($conn));
	
		}

		echo "error1";
	} else {
		echo  "error2";
	}