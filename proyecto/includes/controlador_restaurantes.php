<?php 

	include 'database.php';
	include '../models/restaurantsModel.php';
	include '../views/restaurantsView.php';

	$accion = ( isset($_GET['accion']) ) ? $_GET['accion'] : $_POST['accion'];

	if ($accion == 'setup') {
		showRestaurantsPage(setupFilters($conn), loadRestaurants($conn, 1));
	} else if ($accion == 'filtrar') {
		echo data2json(loadRestaurants($conn, 2));
	} else if ($accion == 'scroll') {
		echo data2json(loadRestaurants($conn, 3));	
	}

