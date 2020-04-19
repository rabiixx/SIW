var start = 6;              /* Indice inicial de carga del scroll */
var limit = 3;              /* Indice final de carga del scroll */
var reachedMax = false;     /* FLAG: se ha alcanzado el numero maximo de elementos */

/*  Import html header and footer */
$(function(){
    var includes = $('[data-include]');
    jQuery.each(includes, function(){
        var file = $(this).data('include') + '.html';
        $(this).load(file);
    });
}); 

$(document).ready(function() {

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



    /* Infinite Scroll */
    $(window).on('scroll', function(e) {

        var win_scroll_top = Math.round($(window).scrollTop());
        var doc_height = Math.round($(document).height());
        var win_height = Math.round($(window).height());

        if (win_scroll_top >= doc_height - win_height) {

            // $('#filtros').children().each(function() {
            //     var temp = $(this).attr('id').split('filtro');
            //     filtros.push(temp[temp.length - 1]);
            // });

            var Ubicaciones = [];

            $('input[name=checkboxUbicacion]:checked').each(function() {
                Ubicaciones.push($(this).val());
            });

            var Cocinas = [];

            $('input[name=checkboxCocina]:checked').each(function() {
                Cocinas.push($(this).val());
            });

            $.ajax({
                url: 'controlador_restaurantes.php',
                method: 'POST',
                data: {
                    accion: 'scroll',
                    code: 2,
                    ubicacion: Ubicaciones,
                    cocina: Cocinas,
                    start: start,
                    limit: limit
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    fetchRestaurantes(response, 'append');
                },
                error: function(responseText, textStatus, errorThrown) {
                    console.log(responseText['responseText']);  
                }
            });
        }
    });

    

    /** 
      * Detecta si algun filtro ha sido seleccionado,
      * lo aplica y devuelve los resultados de haberlo aplicado 
      */
    $('#filtros').on('change', 'input[type=checkbox]', function() {

        console.log('hola');

        start = 6;

        var Ubicaciones = [];

        $('input[name=checkboxUbicacion]:checked').each(function() {
            Ubicaciones.push($(this).val());
        });

        var Cocinas = [];

        $('input[name=checkboxCocina]:checked').each(function() {
            Cocinas.push($(this).val());
        });

        console.log(Ubicaciones);

        $.ajax({
            url: 'controlador_restaurantes.php',
            method: 'POST',
            data: {
                accion: 'filtrar',
                code: 1,
                ubicacion: Ubicaciones,
                cocina: Cocinas
            },
            dataType: 'json',
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



    function fetchRestaurantes(response, flag) {

        if (flag == 'append') 
            start += limit;

                        
        let template = '';
        response.forEach(restaurant => {
            template += `
                <div class="col-4 mb-3">
                    <div class="card h-100">
                        <img class="card-img-top" src="../img/${restaurant.imagen}" alt="Card image cap">
                        <div class="d-flex card-body flex-column">
                            <h5 class="card-title text-primary text-center">${restaurant.nombre}</h5>
                            <p class="card-text">${restaurant.ubicacion}</p>
                            <p class="card-text">${restaurant.cocina}</p>
                            <h1 class="card-text">${restaurant.precio} €</h1>
                             <a href="../load_restaurant.php?restaurant=${restaurant.nombre}" class="btn btn-primary stretched-link mt-auto">Reservar</a>
                            
                        </div>
                    </div>
                </div>`
        });

        (flag == "append") ? $('#restaurant_list').append(template) : $('#restaurant_list').html(template);
    }


// <button id="btn-${restaurant.nombre}" href="reserve.html" class="btn btn-primary btn-block mt-auto">Reservar</button>