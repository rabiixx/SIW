<!DOCTYPE html>
<html>
<body>

<?php 

	$matrix = array();

	for ($i=0; $i <= 50; $i++) {
		$temp_arr = array($i+1, "Ejercicio3") ;
		$matrix[] = $temp_arr;
		//array_push($matrix, $temp_arr);
	}


	for ($i=0; $i < 50; $i++) { ?>
	<table border="1">
		<tr>
			<td><?php echo $matrix[$i][0]; ?></td>
			<td><?php echo $matrix[$i][1]; ?></td>
		</tr>		
	</table>
	
	<?php } ?>


</body>
</html>