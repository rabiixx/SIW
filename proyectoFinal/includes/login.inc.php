<?php 

if (isset($_POST['button-pressed'])) {

	include 'database.php';

	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM usuarios WHERE (Username=? OR Email=?);";
	$stmt = mysqli_stmt_init($conn);

	/** Comprobamos que la sentencia funciona
	  * correctamente contra la base de datos */
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		exit(mysqli_stmt_error($stmt));
    	//echo mysqli_error();
		header("Location: ../signup.php?error=sqlerror");
		exit(); 		
	} else {
		mysqli_stmt_bind_param($stmt, "ss", $username, $username);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		/** Comprobamos que ha habido resultados.
		  * Devulve un array asociativo */
		if ( $row = mysqli_fetch_assoc($result) ) {
				
			$pwdCheck = password_verify($password, $row['Password']);

			if ($pwdCheck == false) {
				//header("Location: ../login.html?error=wrongpwd");
				echo $row['Password'];
				exit();
				
			/** Por si ocurriera un fallo y el resultado 
			  * obtenido fuese un algo que pueda considerarse
			  * verdadero, verificamos nuevamente por si acaso */
			} else if ($pwdCheck == true) {

				/** Cuando un usuario se logea iniciamos una sesion.
				  * Se crea una varianle global ($_SESSION) que contiene
				  * informacion sobre el usuario */
				session_start();
				$_SESSION['username'] = $row['Username'];

				if ($row['Rol']) {
					$_SESSION['Rol'] = 'admin';
				} else {
					$_SESSION['Rol'] = 'noadmin';
				}

				header("Location: ../login.html?login=success");
				exit();

			} else {
				header("Location: ../login.html?error=wrongpwd");
				exit();
			}
		} else {
			header("Location: ../login.html?error=nouser");
			exit();
		}

	}
} else {

	echo "Hooa";


}