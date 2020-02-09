<?php

/** Estaria bien utilizar in checkbox en el que se pudieran
  * elegir solo dos opciones (los dos colores) y una vez elegidos
  * que no puede elegir mas. En este caso estamos utilizando php lo
  * cual imposibilita realizar esta implementacion. Para ello habria
  * que utilizar javascript (no me apetece)
  */

	$allowed_colors = array('red', 'green', 'blue', 'brown', 'gray', 'yellow' );

	if (isset($_POST['enviar'])) {

		if (isset($_POST['nRows']))
			$nRows = $_POST["nRows"];

		if (isset($_POST['string']))
			$string = $_POST["string"];

		if (isset($_POST['bgcolor1']))
			$bgcolor1 = $_POST["bgcolor1"];

		if (isset($_POST['bgcolor2']))
			$bgcolor2 = $_POST["bgcolor2"];
	}

	if ( !in_array(strtolower($bgcolor1), $allowed_colors) ) {
		$bgcolor1 = 'oranje';
	}

	if ( !in_array(strtolower($bgcolor2), $allowed_colors) ) {
		$bgcolor2 = 'white';
	}

	$matrix = array();

	for ($i=0; $i < $nRows; $i++) {
		$matrix[] = array($i, $string);
	}

	for ($i=0; $i < $nRows; $i++) {
		if ($i % 2 == 0 ) {
			echo '<table border="1" bgcolor="' . $bgcolor1 . '">';
		} else {
			echo '<table border="1" bgcolor="' . $bgcolor2 . '">';
		} ?>
			<tr>
				<td><?php echo $matrix[$i][0]; ?></td>
				<td><?php echo $matrix[$i][1]; ?></td>
			</tr>
		</table>
	<?php }

	// Menu desplegable select

	/* $selected_val = $_GET['Color'];
	// print_r($selected_val);
	foreach ($selected_val as $color) {
		echo $color."\n".'<br>';
	} */

?>
