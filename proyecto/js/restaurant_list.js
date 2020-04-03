

// Import html header and footer
$(function(){
    var includes = $('[data-include]');
    jQuery.each(includes, function(){
        var file = $(this).data('include') + '.html';
        $(this).load(file);
    });
});



function loadRestaurant(x) {
 
    var trozo = x.split("-");

    var rest_name = trozo[trozo.length - 1];

    $.ajax({
        url: 'includes/load_restaurant.php',
        type: 'POST',
        //dataType: 'json',
        dataType: 'text',
        data: {
            restName: rest_name,
            buttonPressed: true
        },
        success: function (completeHtmlPage) {
            console.log(completeHtmlPage);
            $("html").html(completeHtmlPage);
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            //console.log('Error hackeado');
        }                                             
    });
}



$(document).ready(function() {

    var start = 6;              /* Indice inicial de carga del scroll */
    var limit = 3;              /* Indice final de carga del scroll */
    var reachedMax = false;     /* FLAG: se ha alcanzado el numero maximo de elementos */

    fetchRestaurants();

  	/** Consulta a la base de datos los restaurantes y muestra 
      * los 10 primeros */
  	function fetchRestaurants() {

        $.ajax( {
  			url: 'includes/restaurant_list.php',
  			method: 'POST',
  			dataType: 'json',
  			success: function (response) {
  				//const restaurants = JSON.parse(response);

                let template = '';
                response.forEach(restaurant => {
                    template += `
                            <div class="col-4 mb-3">
                                <div class="card h-100" href="reserve.html">
                                    <img class="card-img-top" src="img/${restaurant.imagen}" alt="Card image cap">
                                    <div class="d-flex card-body flex-column">
                                        <h5 class="card-title text-primary text-center">${restaurant.nombre}</h5>
                                        <p class="card-text">${restaurant.ubicacion}</p>
                                        <p class="card-text">${restaurant.cocina}</p>
                                        <h1 class="card-text">${restaurant.precio} €</h1>
                                        <button id="btn-${restaurant.nombre}" onclick="loadRestaurant(this.id)"  class="btn btn-primary btn-block mt-auto">Reservar</button>
                                    </div>
                                </div>
                            </div>

                          `
                });
            $('#restaurant_list').html(template);		
  		    },
            error: function (data) {
                //console.log(data['responseText']);

                //console.log("adios");
            }
        });
    }


    /** Muestra los restaurantes que comiencen por la 
      * letra que el usuario introduzca por la barra de busqueda */ 
    $('#search').keyup(function() {

        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: 'includes/restaurant_search.php',
                data: { search: search },
                method: 'POST',
                success: function (response) {

                    if(!response.error) {

                        let restaurants = JSON.parse(response);

                        let template = '';
                        restaurants.forEach(restaurant => {
                            template += `
                                <div class="col-4 mb-3">
                                    <div class="card h-100">
                                        <img class="card-img-top" src="img/${restaurant.imagen}" alt="Card image cap">
                                        <div class="d-flex card-body flex-column">
                                            <h5 class="card-title text-primary text-center">${restaurant.nombre}</h5>
                                            <p class="card-text">${restaurant.ubicacion}</p>
                                            <p class="card-text">${restaurant.cocina}</p>
                                            <h1 class="card-text">${restaurant.precio} €</h1>
                                            <button id="btn-${restaurant.nombre}" href="reserve.html" onclick="loadRestaurant(this.id)" class="btn btn-primary btn-block mt-auto">Reservar</button>                                        
                                        </div>
                                    </div>
                                </div>`
                        });
                        $('#restaurant_list').html(template);     
                    }
                }    
            })
        } else {
            fetchRestaurants();
        }
    });


    // Infinite Scroll


    /*$(window).data('ajaxready', true).scroll(function(e) {
        
        if ($(window).data('ajaxready') == false) return;*/

    $(window).scroll(function(e) {

        console.log("debug1");

        var win_scroll_top = Math.round($(window).scrollTop());
        var doc_height = Math.round($(document).height());
        var win_height = Math.round($(window).height());

        if (win_scroll_top >= doc_height - win_height) {
            
            // var h = $('input[name=checkbox]:not(:checked)');

            if ( $('input[name=checkboxUbicacion]').is(':checked') && $('input[name=checkboxCocina]').is(':checked') ) {   
                
                var opcionUbicacion = $('input[name=checkboxUbicacion]:checked');
                var opcionCocina =  $('input[name=checkboxCocina]:checked');
                console.log(opcionUbicacion.attr("value"));
                console.log(opcionCocina.attr("value"));
                $.ajax({
                    url: 'includes/controlador_restaurantes.php',
                    method: 'POST',
                    data: {
                        "code": 1,
                        "filtroUbicacion": "Ubicacion",
                        "opcionUbicacion": opcionUbicacion,
                        "filtroCocina": "Categoria",
                        "opcionCocina": opcionCocina,
                        "start": start, 
                        "limit": limit
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response == 'reachedMax') {
                            reachedMax = true;
                        } else {
                            fetchRestaurantes(response, 'append');
                        }
                    },
                    error: function(responseText, textStatus, errorThrown) {
                        console.log(responseText['responseText']);  
                    }
                }); 
            } else if ( $('input[name=checkboxUbicacion]').is(':checked') ) {
                
                var opcionUbicacion = $('input[name=checkboxUbicacion]:checked');
                console.log(opcionUbicacion.attr("value"));
                
                $.ajax({
                    url: 'includes/controlador_restaurantes.php',
                    method: 'POST',
                    data: {
                        code: 2,
                        filtroUbicacion: "Ubicacion",
                        opcionUbicacion: opcionUbicacion.attr('value'),
                        start: start, 
                        limit: limit
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log("HIOL");
                        if (response == 'reachedMax') {
                            reachedMax = true;
                        } else {
                            fetchRestaurantes(response, 'append');
                        }
                    },
                    error: function(responseText, textStatus, errorThrown) {
                        console.log(responseText['responseText']);  
                    }
                });

            } else if ( $('input[name=checkboxCocina]').is(':checked') ) {
                var opcionCocina = $('input[name=checkboxCocina]:checked');
                console.log(opcionCocina.attr("value"));

                $.ajax({
                    url: 'includes/controlador_restaurantes.php',
                    method: 'POST',
                    data: {
                        "code": 3, 
                        "filtroCocina": "Categoria",
                        "opcionCocina": opcionCocina.attr('value'),
                        "start": start, 
                        "limit": limit
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response == 'reachedMax') {
                            reachedMax = true;
                        } else {
                            fetchRestaurantes(response, 'append');
                        }
                    },
                    error: function(responseText, textStatus, errorThrown) {
                        console.log(responseText['responseText']);  
                    }
                });

            } else {
                console.log("Nada seleccionado");

                $.ajax({
                    url: 'includes/controlador_restaurantes.php',
                    method: 'POST',
                    data: {
                        "code": 4,
                        "start": start, 
                        "limit": limit
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response == 'reachedMax') {
                            reachedMax = true;
                        } else {
                            fetchRestaurants(response, 'append');
                        }
                    },
                    error: function(responseText, textStatus, errorThrown) {
                        console.log(responseText['responseText']);  
                    }
                });
            }
        }
    });
    

    function fetchRestaurantes(response, flag) {

        start += limit;
                        
        let template = '';
        response.forEach(restaurant => {
            template += `
                <div class="col-4 mb-3">
                    <div class="card h-100">
                        <img class="card-img-top" src="img/${restaurant.imagen}" alt="Card image cap">
                        <div class="d-flex card-body flex-column">
                            <h5 class="card-title text-primary text-center">${restaurant.nombre}</h5>
                            <p class="card-text">${restaurant.ubicacion}</p>
                            <p class="card-text">${restaurant.cocina}</p>
                            <h1 class="card-text">${restaurant.precio} €</h1>
                            <button id="btn-${restaurant.nombre}" href="reserve.html" onclick="loadRestaurant(this.id)" class="btn btn-primary btn-block mt-auto">Reservar</button>
                        </div>
                    </div>
                </div>`
        });

        (flag == "append") ? $('#restaurant_list').append(template) : $('#restaurant_list').html(template);
    }





/*    $('input[name=checkboxUbicacion]').change(function(){
        if( $(this).is(':checked') ) {

            // Desabilitamos tomas las opciones de la categoria que no sean la seleccionada
            $('input[name=checkboxUbicacion]').not($(this)).attr("disabled", "true");

            // Obtenemos la opcion seleccionada
            var opcion = $(this).next().text();
            // console.log($(this).next().text());
            
            // Obtenemos el nombre del filtro
            var filtro = $(this).parents(".list-group-flush").prev().text();
            // console.log(filtro);

        } else {

            // Si el usuario deselcciona la opcion elegida, habilitamos todas las opciones de nuevo
            $('input[name=checkboxUbicacion]').not($(this)).removeAttr('disabled');

        }
    });




    $('input[name=checkboxCocina]').change(function(){
        if( $(this).is(':checked') ) {

            // Desabilitamos tomas las opciones de la categoria que no sean la seleccionada
            $('input[name=checkboxCocina]').not($(this)).attr("disabled", "true");

            // Obtenemos la opcion seleccionada
            var opcion = $(this).next().text();
            // console.log($(this).next().text());
            
            // Obtenemos el nombre del filtro
            var filtro = $(this).parents(".list-group-flush").prev().text();
            // console.log(filtro);

        } else {

            // Si el usuario deselcciona la opcion elegida, habilitamos todas las opciones de nuevo
            $('input[name=checkboxCocina]').not($(this)).removeAttr('disabled');

        }
    });*/



/*    $('input[type=checkbox]').change(function(){

        var filterName = $(this).attr('name');

        if ($(this).is(':checked')) {
            $('input[name=' + filterName + ']').not($(this)).attr("disabled", "true");


            $('input[name=checkboxUbicacion]').is(':checked')

                var opcionUbicacion = $('input[name=checkboxUbicacion]:checked');
                var opcionCocina =  $('input[name=checkboxCocina]:checked');
                console.log(opcionUbicacion.attr("value"));
                console.log(opcionCocina.attr("value"));
                $.ajax({
                    url: 'includes/controlador_restaurantes.php',
                    method: 'POST',
                    data: {
                        "code": 1,
                        "filtroUbicacion": "Ubicacion",
                        "opcionUbicacion": opcionUbicacion,
                        "filtroCocina": "Categoria",
                        "opcionCocina": opcionCocina,
                        "start": start, 
                        "limit": limit
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response == 'reachedMax') {
                            reachedMax = true;
                        } else {
                            fetchRestaurantes(response, 'append');
                        }
                    },
                    error: function(responseText, textStatus, errorThrown) {
                        console.log(responseText['responseText']);  
                    }
                }); 




        } else {
            $('input[name=' + filterName + ']').not($(this)).removeAttr('disabled');
        }

    });*/


    $('input[type=checkbox]').change(function(){

        var Ubicaciones = [];

        $('input[name=checkboxUbicacion]:checked').each(function() {
            Ubicaciones.push($(this).val());
        });

        var Cocinas = [];

        $('input[name=checkboxCocina]:checked').each(function() {
            Cocinas.push($(this).val());
        });

        $.ajax({
            url: 'includes/controlador_restaurantes.php',
            method: 'POST',
            data: {
                accion: 'filtro',
                ubicacion: Ubicaciones,
                cocina: Cocinas
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                fetchRestaurantes(response, 'html');
            },
            error: function(responseText, textStatus, errorThrown) {
                console.log(responseText['responseText']);  
            }
        }); 



    });



});