<?php 



if (isset($_POST['login-sumbit'])) {
	
	require 'dbh.inc.php';

	$mailuid = $_POST['mailudi'];
	$password = $_POST['password'];


	if ( empty($mailudi) || empty($password) ) {
		header("Location: ../signup.php?error=emptyfields");
		exit();		
	} else {
		$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
		$stmt = mysqli_stmt_init($conn);

		/** Comprobamos que la sentencia funciona
		  * correctamente contra la base de datos */
		if (!mysqli_stmt_prepare($stmt)) {
			header("Location: ../signup.php?error=sqlerror");
			exit(); 		
		} else {
			mysqli_stmt_bind_param($stmt, "ss", $mailudi, $mailudi);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			/** Comprobamos que ha habido resultados.
			  * Devulve un array asociativo */
			if ( $row = mysqli_fetch_assoc($result) ) {
				
				$pwdCheck = password_verify($password, $row['pwdUsers']);
				
				if ($pwdCheck == false) {
					header("Location: ../signup.php?error=wrongpwd");
					exit();
				
				/** Por si ocurriera un fallo y el resultado 
				  * obtenido fuese un algo que pueda considerarse
				  * verdadero, verificamos nuevamente por si acaso */
				} else if ($pwdCheck == true) {

					/** Cuando un usuario se logea iniciamos una sesion.
					  * Se crea una varianle global ($_SESSION) que contiene
					  * informacion sobre el usuario */
					session_start();

					$_SESSION['userId'] = $row['idUsers'];
					$_SESSION['userUid'] = $row['uidUsers'];

					header("Location: ../signup.php?login=success");
					exit();

				} else {
					header("Location: ../signup.php?error=wrongpwd");
					exit();
				}
			} else {
				header("Location: ../signup.php?error=nouser");
				exit();
			}

		}



	}

} else {
	header("Location: ../signup.php?");
	exit(); 
}