<?php 



	function showRestaurantsPage($filters, $restaurants) {
		$src_template = explode("##MARCA##", file_get_contents("../index.html"));
		
		echo $src_template[0] . showFilters($filters) . $src_template[4] . showRestaurants($restaurants) . $src_template[6];
	}


	function showFilters($filters) {

		$src_template = explode("##MARCA##", file_get_contents("../index.html"));
		$filtersHtml = '';

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

		$src_template = explode("##MARCA##", file_get_contents("../index.html"));

		$auxTemplate = '';
		$restaurantListHtml = '';

		while($row = mysqli_fetch_array($data)) {
			
			$auxTemplate = $src_template[5];

			$auxTemplate = str_replace("##IMAGEN##", '../img/' . $row['Imagen'] , $auxTemplate);
			$auxTemplate = str_replace("##NOMBRE##", $row['Nombre'] , $auxTemplate);
			$auxTemplate = str_replace("##UBICACION##", $row['Ubicacion'] , $auxTemplate);
			$auxTemplate = str_replace("##COCINA##", $row['Cocina'] , $auxTemplate);
			$auxTemplate = str_replace("##PRECIO##", $row['Precio'] , $auxTemplate);
			$auxTemplate = str_replace("##LINK##", $row['Nombre'] , $auxTemplate);
			
			$restaurantListHtml .= $auxTemplate;
		}

		return $restaurantListHtml;
	}