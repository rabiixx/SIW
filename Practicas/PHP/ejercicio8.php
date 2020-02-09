

<span>Ejercicio 8</span>

<?php

	function ejer8($nRows, $string) {
		for ($i=0; $i < $nRows; $i++) { ?>
			<table border="1" bgcolor="green">
				<tr>
					<td> <?php echo $string ?> </td>
				</tr>
			</table>

		<?php }
	}

	?>

	<form action="ejercicio8.php" method="GET">
		Numero Lineas: <input type="text" name="nRows"><br>
		Frase: <input type="text" name="string"><br>
		<input type="submit" name="enviar">
	</form>

	<?php

	$nRows = (isset($_GET['nRows']) ? $_GET['nRows'] : null);

	$string = (isset($_GET['string']) ? $_GET['string'] : null);

	ejer8($nRows, $string);
 ?>
