<?php 

	include 'database.php';
	include '../models/tablesModel.php';
	include '../views/restaurantsView.php';

	if ( !isset($_POST['code']) ) {
		header("Location: ../misRestaurantes.php?code=notvalid");
		exit();
	}

	$code = $_POST['code'];

	if ($code == 'insert') {
		echo insert($conn);
	} else if ($code == 'update') {
		$data = json_decode($_POST['json'], true);
		
		update($conn, $data['table'], $data['fields']);

	} else if ($code == 'deleteSingle') {
		
		$data = json_decode($_POST['json'], true);		

		echo delete($conn, $data['table'], $data['fields']);
	} else if ($code == 'deleteSelected') {

		$data = json_decode($_POST['json'], true);

		foreach ($data['selectedRows'] as $key => $value) {
			delete($conn, $data['table'], $value);
		}
	}

