<?php 



	function showRestaurantsPage($filters, $restaurants) {

		$src_template = explode("##MARCA##", file_get_contents("rest_list_template.html"));
		
		echo $src_template[0] . showFilters($filters) . $src_template[4] . showRestaurants($restaurants) . $src_template[6];
	}


	function showFilters($filters) {

		$src_template = explode("##MARCA##", file_get_contents("rest_list_template.html"));
		$filtersHtml = '';

		if ( isset($_POST['cocina']) ) {
			$cocina = $_POST['cocina'];			
		} else {
			$cocina = "";
		}

		if ( isset($_POST['ubicacion']) ) {
			$ubicacion = $_POST['ubicacion'];			
		} else {
			$ubicacion = "";
		}

		foreach ($filters as $key => $filter) {

			$filterCard = $src_template[1];
			$filterCard = str_replace("##CARDID##",  'filtro' . $key, $filterCard);
			$filterCard = str_replace("##HEADERTEXT##", $key, $filterCard);
			$filterCard = str_replace("##ULID##", 'lista' . $key, $filterCard);

			$auxTemplate = '';
			$filterElementList = '';

			$index = 0;
			while($row = mysqli_fetch_array($filters[$key])) {
				
				$auxTemplate = $src_template[2];

				$auxTemplate = str_replace("##INPUTID##", 'check' . $key . $index , $auxTemplate);
				$auxTemplate = str_replace("##INPUTNAME##", 'checkbox' . $key, $auxTemplate);
				$auxTemplate = str_replace("##INPUTVALUE##", $row[$key] , $auxTemplate);
				

				if ($key == 'Cocina') {
					if ($cocina == $row[$key]) {
						$auxTemplate = str_replace("##CHECKED##", 'checked' , $auxTemplate);
					} else {
						$auxTemplate = str_replace("##CHECKED##", "" , $auxTemplate);
					}	
				}

				if ($key == 'Ubicacion') {
					if ($ubicacion == $row[$key]) {
						$auxTemplate = str_replace("##CHECKED##", 'checked' , $auxTemplate);
					} else {
						$auxTemplate = str_replace("##CHECKED##", "" , $auxTemplate);
					}
	
				}
						
				$auxTemplate = str_replace("##LABELFOR##", 'check' . $key . $index , $auxTemplate);
				$auxTemplate = str_replace("##LABELVALUE##", $row[$key] , $auxTemplate);
				$auxTemplate = str_replace("##CANTIDAD##", $row['Cantidad'] , $auxTemplate);
				
				$filterElementList .= $auxTemplate;
				$filterElementList;

				$index++;
			}

			$filtersHtml .= $filterCard . $filterElementList . $src_template[3];	
		}

		return $filtersHtml;
	}


	function showRestaurants($data) {

		$src_template = explode("##MARCA##", file_get_contents("rest_list_template.html"));

		$auxTemplate = '';
		$restaurantListHtml = '';

		while($row = mysqli_fetch_array($data)) {
			
			$auxTemplate = $src_template[5];

			$auxTemplate = str_replace("##IMAGEN##", 'img/' . $row['Imagen'] , $auxTemplate);
			$auxTemplate = str_replace("##NOMBRE##", $row['Nombre'] , $auxTemplate);
			$auxTemplate = str_replace("##UBICACION##", $row['Ubicacion'] , $auxTemplate);
			$auxTemplate = str_replace("##COCINA##", $row['Cocina'] , $auxTemplate);

			$auxPrecio = '';
			if ( $row['Precio'] < 20 ) {
				$auxPrecio .= '<i class="fas fa-euro-sign mx-1"></i>
						<i class="fas fa-euro-sign mx-1 euro-disabled"></i>
						<i class="fas fa-euro-sign mx-1 euro-disabled"></i>';
			} else if ( $row['Precio'] < 50 ) {

				$auxPrecio .= '<i class="fas fa-euro-sign mx-1"></i>
						<i class="fas fa-euro-sign mx-1"></i>
						<i class="fas fa-euro-sign mx-1 euro-disabled"></i>';
			} else {
				$auxPrecio .= '<i class="fas fa-euro-sign mx-1"></i>
						<i class="fas fa-euro-sign mx-1"></i>
						<i class="fas fa-euro-sign mx-1"></i>';
			}
			
			$auxTemplate = str_replace("##PRECIO##", $auxPrecio, $auxTemplate);
			$auxTemplate = str_replace("##LINK##", $row['Nombre'] , $auxTemplate);
			
			$restaurantListHtml .= $auxTemplate;
		}

		return $restaurantListHtml;
	}


	function data2json($res) {

		if ( !$res || (mysqli_num_rows($res) == 0) ) {
			return "reachedMax";
		} else {

			$json = array();


			while($row = mysqli_fetch_array($res)) {

				$auxPrecio = '';
				if ( $row['Precio'] < 10 ) {
					$auxPrecio .= '<i class="fas fa-euro-sign mx-1"></i>
							<i class="fas fa-euro-sign mx-1 euro-disabled"></i>
							<i class="fas fa-euro-sign mx-1 euro-disabled"></i>';
				} else if ( $row['Precio'] < 25 ) {

					$auxPrecio .= '<i class="fas fa-euro-sign mx-1"></i>
							<i class="fas fa-euro-sign mx-1"></i>
							<i class="fas fa-euro-sign mx-1 euro-disabled"></i>';
				} else {
					$auxPrecio .= '<i class="fas fa-euro-sign mx-1"></i>
							<i class="fas fa-euro-sign mx-1"></i>
							<i class="fas fa-euro-sign mx-1"></i>';
				}

			    $json[] = array(
			        'imagen' => $row['Imagen'],
			      	'nombre' => $row['Nombre'],
			      	'ubicacion' => $row['Ubicacion'],
			      	'cocina' => $row['Cocina'],
			      	'precio' => $auxPrecio
			    );
			}

			return json_encode($json);
		}		
	}