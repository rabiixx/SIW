<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>AJAX - Get Data from DB </title>
	
	<!-- BOOTSTRAP 4 CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


</head>
<body>

<div id="comments">
	<?php
		$sql = "SELECT * FROM comments LIMIT 2";
		$result = mysqli_query($sql);

		if (mysqli_num_row($result) > 0) {
			// Obtener una fila de resultado como un array asociativo
			while ($row = mysqli_fetch_assoc($result)){
				echo 	


			}
		} else {
			echo "No comments";
		}
	?>	
</div>

<div class="container">
	<div class="row justify-content-center mt-5 ">
		<button class="btn btn-warning text-center">Show more comments</button>	
	</div>
</div>









	<!-- JQUERY -->
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

	<!-- BOOTSTRAP 4 JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	
</body>
</html>