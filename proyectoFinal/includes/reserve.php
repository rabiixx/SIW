<?php 


if (isset($_POST['button-pressed'])) {

	include 'database.php';

	$nPeople = $_POST['nPeople'];
	$date = $_POST['date'];
	$hour = $_POST['hour'];


	$currentDate = date("Y-m-d h:i:s");
	$reservationDate = $date . " " . $hour;

	echo $reservationDate;

	// Comprobar comida o cena	
	$turno = 'comida';

	// Seguramente hara falta un par de consultas para obetner el id del usuario y restaurante
	$idUsuario = 1;
	$idRestaurante = 1;

	$query = "INSERT INTO reserva(Fecha, Turno, idRestaurante, idUsuario, FechaReserva) VALUES ('$currentDate', '$turno', '$idRestaurante', '$idUsuario', '$reservationDate')";

	$result = mysqli_query($conn, $query);

}