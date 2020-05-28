<?php 

	include 'database.php';

	$code = $_POST['code'];

	if ( $code == 'csv' ) {

		$query = "SHOW TABLES";

		$res = mysqli_query($conn, $query);

		$src_template = explode("##MARCA##", file_get_contents("../csv_upload.html"));


		$tableListHtml = '';
		while ($row = mysqli_fetch_row($res) ) {
			
			$tableListTemp = $src_template[1];

			$tableListTemp = str_replace("##TABLE##", $row[0] , $tableListTemp);
			$tableListHtml .= $tableListTemp;

		}

		echo $src_template[0] . $tableListHtml . $src_template[2];

	} else if ( $code == 'tables' ) {

		$tabla = $_POST['table'];
		$start = $_POST['start'];
		$limit = $_POST['limit'];

		$src_template = explode("##MARCA##", file_get_contents("../tablesTemplate.html"));

		$src_template[0] = str_replace("##TABLA##", $tabla , $src_template[0]);

		$queryColumns = "	SELECT `COLUMN_NAME` 
							FROM `INFORMATION_SCHEMA`.`COLUMNS` 
							WHERE `TABLE_SCHEMA`='proyecto' 
	    					AND `TABLE_NAME` = '$tabla' ";

	    $res = mysqli_query($conn, $queryColumns);

		$columnNamesHtml = '<th scope="col"></th>';
		
	    while ( $row = mysqli_fetch_row($res) ) {
			
	    	$auxTemplate = $src_template[1];
			$auxTemplate = str_replace("##COL##", $row[0] , $auxTemplate);

			$columnNamesHtml .= $auxTemplate;
	    }

	    $columnNamesHtml .= '<th scope="col"></th><th scope="col"></th>';

	    $tableHeaderHtml = $src_template[0]. $columnNamesHtml . $src_template[2];

	    $numCol = mysqli_num_rows($res);

	    mysqli_free_result($res);


		$queryData = "SELECT * FROM $tabla LIMIT $start, $limit";
		//echo $queryData;
		$res = mysqli_query($conn, $queryData);

		$tableRowsHtml = '';

		$index = 0; 
		while ( $row = mysqli_fetch_row($res) ) {
			
			/* Checkbox */
			$auxTemplate = $src_template[3];

			$auxTemplate = str_replace("##CHECKID##", 'Check' . $index , $auxTemplate);
				

			$rowDataHtml = '';
			$inputRowHtml = '';

			for ($i=0; $i < $numCol; $i++) { 
			
				/* Table Row */
				$rowDataTempalte = $src_template[4];
				$rowDataTempalte = str_replace("##DATA##", $row[$i] , $rowDataTempalte);

				$rowDataHtml .= $rowDataTempalte; 

				$inputRowTemp = $src_template[6];
				$inputRowTemp = str_replace("##INPUT##", $row[$i], $inputRowTemp);

				$inputRowHtml .= $inputRowTemp;

			}

			$index++;

			$tableRowsHtml .= $auxTemplate . $rowDataHtml . $src_template[5] . '<td></td>' . $inputRowHtml . $src_template[7];
		}

		$inputRowTemp = '';
		for ($i=0; $i < $numCol; $i++) { 
			$inputRowTemp .= $src_template[6];
		}
		
		$inputRowTemp = str_replace("##INPUT##", "", $inputRowTemp);

		echo $tableHeaderHtml . $tableRowsHtml . '<tr><td></td>' . $inputRowTemp . $src_template[8];




	} else if ( $code == 'json') {
		echo "hola";
	} else if ($code == 'sidebar'){

		$query = "SHOW TABLES";

		$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

		while ( $row = mysqli_fetch_row($res)) {
			$tablas[] = $row[0];
		}

		echo json_encode($tablas);

	}