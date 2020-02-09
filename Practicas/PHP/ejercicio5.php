<!DOCTYPE html>
<html>
<body>

<?php

	$matrix = array(
		array(1, "Ejercicio3", 1)
	);

	for ($i=1; $i < 51; $i++) {
		$total = $i + $matrix[$i-1][2] + 1;
		$temp_arr = array($i + 1, "Ejercicio3", $total) ;
		$matrix[] = $temp_arr;
	}

	for ($i=0; $i < 50; $i++) { ?>
    <?php if ($i % 2 == 0): ?>
      <table bgcolor="#00FF00" border="1">
    <?php else: ?>
      <table bgcolor="#00FFFF" border="1">
    <?php endif; ?>

		<tr>
			<td><?php echo $matrix[$i][0]; ?></td>
			<td><?php echo $matrix[$i][1]; ?></td>
			<td><?php echo $matrix[$i][2]; ?></td>
		</tr>
	</table>

	<?php } ?>


</body>
</html>
