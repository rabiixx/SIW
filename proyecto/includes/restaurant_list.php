<?php 
  
  include('database.php');

  $query = "SELECT * from restaurantes LIMIT 6";
  $result = mysqli_query($conn, $query);
  
  if(!$result) {
    die('Query Failed'. mysqli_error($conn));
  }

  $json = array();

    while($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'imagen' => $row['Imagen'],
          	'nombre' => $row['Nombre'],
          	'ubicacion' => $row['Ubicacion'],
          	'categoria' => $row['Categoria'],
          	'precio' => $row['Precio']
        );
    }

  $jsonstring = json_encode($json);
  echo $jsonstring;
