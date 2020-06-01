<?php 

	function insert($conn) {

		$table = $_POST['table'];
		$fields = $_POST['fields'];

		$fields = implode("','", $_POST['fields']);

		$query = "INSERT INTO $table VALUES ('" . $fields . "')";

		$res = mysqli_query($conn, $query);


		$query = "SELECT * FROM $table";

		$res = mysqli_query($conn, $query);
		$numRows = mysqli_num_rows($res);
		$numCols = mysqli_num_fields($res);

		mysqli_data_seek($res, $numRows - 1);
	    $lastRow = mysqli_fetch_row($res);


		$src_template = explode("##MARCA##", file_get_contents("../tables2.html"));

		$src_tempalte[3] = str_replace("##CHECKID##", 'Check' . $lastRow[0] , $src_template[3]);


		$rowDataHtml = '';
		for ($i=0; $i < $numCols; $i++) { 
			$aux = $src_template[4];
			$aux = str_replace("##DATA##", $lastRow[$i] , $aux);
		
			$rowDataHtml .= $aux;
		}


	    $inputRowHtml = '';
		for ($i=0; $i < $numCols; $i++) { 
			$inputRowHtml .= $src_template[6];
		}


		echo $src_template[3] . $rowDataHtml . $src_template[5] . $src_template[7];


	}


	function delete($conn, $table, $fields) {

		$pk_query = "SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'";

		$res = mysqli_query($conn, $pk_query);
		
		$str_pk = getPK($conn, $table, $fields);

		print_r($str_pk);

		$query = "DELETE FROM $table WHERE $str_pk";

		mysqli_query($conn, $query);
	}

	function update($conn, $table, $fields) {

		$data = json_decode($_POST['json'], true);

		$str_pk = getPK($conn, $table, $fields);

		echo $str_pk;

		$str_update = '';

		$i = 0;
		foreach ($data['updatedFields'] as $key => $value) {
			$str_update .= $key . " = " . "'$value'";
		
			if ( $i != sizeof($data['updatedFields']) - 1) {
				$str_update .= " AND ";
			}
			$i++;
		}

		$update_query = "UPDATE " . $data['table'] . " SET " . $str_update . " WHERE " . $str_pk;
		echo $update_query;

		mysqli_query($conn, $update_query) or die(mysqli_error($conn));
	}

	function getPK($conn, $table, $fields) {

		$pk_query = "SHOW KEYS FROM " . $table . " WHERE Key_name = 'PRIMARY'";
		
		$res = mysqli_query($conn, $pk_query);
		
		$i = 0;
		$str_pk = '';
		while ( $row = mysqli_fetch_assoc($res)) {
			
			$str_pk .= $row['Column_name'] . ' = ' . $fields[$row['Column_name']];	
			if ( $i != mysqli_num_rows($res) - 1) {
				$str_pk .= ' AND ';
			}
			$i++;
		}
		return $str_pk;
	}