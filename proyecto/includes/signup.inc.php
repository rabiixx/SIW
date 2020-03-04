<?php 


    /** Hay que comprobar que el usuario ha hecho click en 
      * en el boton de sumbit. Puede ser que el usuario haya
      * accedido a la pagina mediante la url:
      * includes/signup.inc.php
      */
	if (isset($_POST['button-pressed'])) {
  		
        include '..\database.php';

        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name']; 
  		$username = $_POST['username'];
  		$email = $_POST['email'];
  		$password = $_POST['password'];

        /** Comprobar si existe un uid en la base de datos con el mismo uid 
          * introducido en el formulario por el nuevo usuario. 
          * Vamos utilizar sentencias preparadas (SQL) con el fin de que ningun
          * usuario pueda introducir scrits (SQL) en los campos del formulario.
          * Para ello vamos a utilizar placeholders (HTML).
          */

        $sql = "SELECT Username FROM usuarios WHERE Username=?";
        
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror1");
            exit();      
        } else {
            
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            
            $resultCheck = mysqli_stmt_num_rows($stmt);
            
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usertaken&mail=".$email);
                exit();
            } else {
                $sql = "INSERT INTO usuarios (Nombre, Apellido, Username, Email, Password) VALUES (?, ?, ?, ?, ?)";


                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror2");
                    exit();      
                } else {    

                    /** Si alguien consigue acceder a la base de datos, prodria ver 
                      * las contraseñas, por ellos vamos a encriptarlas. Para ello
                      * utilizaremos el algoritmo bcrypt (password_hash()).
                      * En ningun momento hay que utilizar MD5 o SHA256 pues 
                      * no son seguros.
                      */
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sssss", $firstName , $lastName, $username, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    //header("Location: ../signup.php?signup=success");

                }
            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    } else {
        header("Location: ../signup.php?");
        exit();        
    }	





