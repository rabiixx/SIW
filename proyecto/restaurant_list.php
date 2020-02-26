<?php 
  
  include('database.php');

  $query = "SELECT * from restaurantes LIMIT 3";
  $result = mysqli_query($conn, $query);
  
  if(!$result) {
    die('Query Failed'. mysqli_error($conn));
  }

  $json = array();

  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
    	 'imagen' => $row['imagen'],
      	'nombre' => $row['nombre'],
      	'ubicacion' => $row['ubicacion'],
      	'cocina' => $row['cocina'],
      	'precio' => $row['precio']
    );
  }

  $jsonstring = json_encode($json);
  echo $jsonstring;
