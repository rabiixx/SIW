<?php


    if (isset($_POST['enviar'])) {

        $name = (isset($_POST['name']) ? $_POST['name'] : null);

        // Letras y espacios en blanco
        if ( !preg_match("/^[a-zA-Z ]*$/", $name) ) {
            $error = "Solo se periten letras y espacion en blanco";
            echo $error;
        }

        $first_surname = $_POST['first_surname'];
        if ( !preg_match("/^[a-zA-Z ]*$/", $first_surname) ) {
            $error = "Solo se periten letras y espacion en blanco";
            echo $error;
        }

        $second_surname = $_POST['second_surname'];
        if ( !preg_match("/^[a-zA-Z ]*$/", $second_surname) ) {
            $error = "Solo se periten letras y espacion en blanco";
            echo $error;
        }

        $address = $_POST['address'];

        $population = $_POST['population'];

        $province = $_POST['province'];

        $phone1 = $_POST['phone1'];

        if (isset($_POST['phone2'])) {
            $phone2 = $_POST['phone2'];
        }

        $email = $_POST['email'];
    }


    $tabla = array(
        array('Nombre', $name),
        array('Primer Apellido', $first_surname),
        array('Segundo Apellido', $second_surname),
        array('Direccion', $address),
        array('Poblacion', $population),
        array('Provincia', $province),
        array('Telefono 1', $phone1),
        array('Telefono 2', $phone2),
        array('Email', $email)
    );

    ?>


    <?php for ($i=0; $i < 9; $i++) { ?>
        <table border = "1" >
            <tr>
                <td><?php echo $tabla[$i][0]; ?></td>
                <td><?php echo $tabla[$i][1]; ?></td>
            </tr>
        </table>
    <?php } ?>
