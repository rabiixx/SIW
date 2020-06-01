<?php 

	include 'includes/database.php';

	$query = "SHOW TABLES";

	$res = mysqli_query($conn, $query);

	$src_template = explode("##MARCA##", file_get_contents("csv_upload.html"));


	$tableListHtml = '';
	while ($row = mysqli_fetch_row($res) ) {
		
		$tableListTemp = $src_template[1];

		$tableListTemp = str_replace("##TABLE##", $row[0] , $tableListTemp);
		$tableListHtml .= $tableListTemp;

	}

	echo $src_template[0] . $tableListHtml . $src_template[2];


