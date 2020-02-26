<?php 

/** Hay que comprobar que el usuario ha hecho click en 
  * en el boton de sumbit. Puede ser que el usuario haya
  * accedido a la pagina mediante la url:
  * includes/signup.inc.php
  */

	if (isset($_POST['signup-submit'])) {
  		
  		require 'dbh.inc.php';

  		$username = $_POST['uid'];
  		$email = $_POST['mail'];
  		$password = $_POST['pwd'];
  		$passwordRepeat = $_POST['pwd-repeat'];

  		/** Si un usuario rellena todos los campos pero deja una vacio 
  		  * queremos que le rediriga a la pagina pero conservando los datos que
  		  * habia metido correctanmente */


  		if ( empty($username) || empty($email) || empty($password) || empty($passwordRepeat) ) {
  			header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
            exit();
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0- 9]*$/", $username)) {
            header("Location: ../signup.php?error=invalidmailuid");
            exit();
  		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?error=invalidmail&uid=".$username);
            exit();
        } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            header("Location: ../signup.php?error=invaliduid&mail=".$email);
            exit();
        } else if ($password !== $passwordRepeat) {
            header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
            exit();
        } 

        /** Comprobar si existe un uid en la base de datos con el mismo uid 
          * introducido en el formulario por el nuevo usuario. 
          * Vamos utilizar sentencias preparadas (SQL) con el fin de que ningun
          * usuario pueda introducir scrits (SQL) en los campos del formulario.
          * Para ello vamos a utilizar placeholders (HTML).
          */

        else {
            $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../signup.php?error=sqlerror");
                exit();      
            } else {
                
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                
                $resultCheck = mysqli_stmt_num_rows($stmt);
                
                if ($resultCheck > 0) {
                    header("Location: ../signup.php?error=usertaken&mail=".$email);
                    exit();
                } elseif (condition) {
                    $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../signup.php?error=sqlerror");
                        exit();      
                    } else {    

                        /** Si alguien consigue acceder a la base de datos, prodria ver 
                          * las contraseñas, por ellos vamos a encriptarlas. Para ello
                          * utilizaremos el algoritmo bcrypt (password_hash()).
                          * En ningun momento hay que utilizar MD5 o SHA256 pues 
                          * no son seguros.
                          */
                        $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);

                        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../signup.php?signup=success");
                        exit();

                    }
                }
            }



        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
  	} else {
        header("Location: ../signup.php?");
        exit();        
    }	





