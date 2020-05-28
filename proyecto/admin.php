<?php 

	include 'includes/database.php';

	$tabla = $_GET['tabla'];

	$src_template = explode("##MARCA##", file_get_contents("tables2.html"));

	$query = "SHOW TABLES";

	$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

	$tableNamesHtml = '';
	while ($row = mysqli_fetch_row($res)) {
		$tableNamesTemp = $src_template[1];

		$tableNamesTemp = str_replace("##TABLE##", $row[0] , $tableNamesTemp); 
		$tableNamesTemp = str_replace("##TABLELINK##", "admin.php?tabla=" . $row[0] , $tableNamesTemp); 

		$tableNamesHtml .= $tableNamesTemp;
	}

	$src_template[2] = str_replace("##TABLA##", $tabla , $src_template[2]);

	$tableNamesHtml = $src_template[0] . $tableNamesHtml . $src_template[2];

	
	$queryColumns = "	SELECT `COLUMN_NAME` 
						FROM `INFORMATION_SCHEMA`.`COLUMNS` 
						WHERE `TABLE_SCHEMA`='proyecto' 
    					AND `TABLE_NAME` = '$tabla' ";

    $res = mysqli_query($conn, $queryColumns);


	$columnNamesHtml = '<th scope="col"></th>';
	
    while ( $row = mysqli_fetch_row($res) ) {
		
    	$auxTemplate = $src_template[3];
		$auxTemplate = str_replace("##COL##", $row[0] , $auxTemplate);

		$columnNamesHtml .= $auxTemplate;
    }

    $columnNamesHtml .= '<th scope="col"></th><th scope="col"></th>';

    $numCol = mysqli_num_rows($res);

    mysqli_free_result($res);

	$queryData = "SELECT * FROM $tabla";
	$res = mysqli_query($conn, $queryData);

	$tableRowsHtml = '';

	$index = 0; 
	while ( $row = mysqli_fetch_row($res) ) {
		
		/* Checkbox */
		$auxTemplate = $src_template[5];

		$auxTemplate = str_replace("##CHECKID##", 'Check' . $index , $auxTemplate);
			

		$rowDataHtml = '';
		$inputRowHtml = '';

		for ($i=0; $i < $numCol; $i++) { 
		
			/* Table Row */
			$rowDataTempalte = $src_template[6];
			$rowDataTempalte = str_replace("##DATA##", $row[$i] , $rowDataTempalte);

			$rowDataHtml .= $rowDataTempalte; 

			$inputRowTemp = $src_template[8];
			$inputRowTemp = str_replace("##INPUT##", $row[$i], $inputRowTemp);

			$inputRowHtml .= $inputRowTemp;

		}

		$index++;

		$tableRowsHtml .= $auxTemplate . $rowDataHtml . $src_template[7] . '<td></td>' . $inputRowHtml . $src_template[9];
	}

	$inputRowTemp = '';
	for ($i=0; $i < $numCol; $i++) { 
		$inputRowTemp .= $src_template[6];
	}
	
	$inputRowTemp = str_replace("##INPUT##", "", $inputRowTemp);

	echo $tableNamesHtml . $columnNamesHtml . $src_template[4] . $tableRowsHtml . '<tr><td></td>' . $inputRowTemp . $src_template[10];
