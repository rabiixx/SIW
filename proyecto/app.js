$(document).ready(function() {



    fetchRestaurants();

  	/** Consulta a la base de datos los restaurantes y muestra 
      * los 10 primer */
  	function fetchRestaurants() {

  		
        $.ajax( {
  			url: 'restaurant_list.php',
  			method: 'POST',
  			dataType: 'json',
  			success: function (response) {
  				//const restaurants = JSON.parse(response);
                console.log("Hola");

                console.log(response);

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
                                  <button href="#" class="btn btn-primary btn-block mt-auto">Reservar</button>
                                </div>
                            </div>
                        </div>

                          `
                });
            $('#restaurant_list').html(template);		
  		    },
            error: function (data) {
                console.log(data['responseText']);

                console.log("adios");
            }
        });
    }



    /** Muestra los restaurantes que comiencen por la 
      * letra que el usuario introduzca por la barra de busqueda */ 
    $('#search').keyup(function() {

        console.log("Keyup")
        console.log($('#search').val());

        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: 'restaurant_search.php',
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
                                          <button href="#" class="btn btn-primary btn-block mt-auto">Reservar</button>
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

    var start = 6;
    var limit = 3;
    var reachedMax = false;

    /*$(window).data('ajaxready', true).scroll(function(e) {
        
        if ($(window).data('ajaxready') == false) return;*/

      $(window).scroll(function(e) {

        console.log("Opcion 1");


        var win_scroll_top = Math.round($(window).scrollTop());
        var doc_height = Math.round($(document).height());
        var win_height = Math.round($(window).height());

        console.log(win_scroll_top);
        console.log(doc_height);
        console.log(win_height);

        if (win_scroll_top >= doc_height - win_height) {

            //$("#load_more").click(function(event) {

                $.ajax({
                    url: 'inf_scroll.php',
                    method: 'POST',
                    data: {
                        start: start, 
                        limit: limit
                    },
                    success: function (response) {
   
                        console.log(response);

                        if (response == 'reachedMax') {
                            reachedMax = true;
                        } else {

                            start += limit;

                            restaurants = JSON.parse(response);
                            
                            console.log(restaurants);

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
                                              <button href="#" class="btn btn-primary btn-block mt-auto">Reservar</button>
                                            </div>
                                        </div>
                                    </div>`
                            });       
                            $('#restaurant_list').append(template);     
                        }
                    }
                });    
            } else {
                console.log("Opcions2");
            }
    });
    


    // Dropzone configuration
  /*  Dropzone.options.dropzoneForm = {
        url: 'upload_img.php',
        method: 'POST',
        acceptedFiles: '.png, .jpg, .jpeg, .gif',
        dictDefaultMessage: 'Arrastra las imagenes de tu restaurante aqui.',
        autoProcessQueue: false,
        init: function () {
            var myDropzone = this;
            $("#btn-add-restaurant").submit(function (e) {
    
                e.preventDefault();     // Evitamos que se recarge la pagina
        
                /** Como hemos puesto que las imagenes no se suban automaticamente,
                  * hay que llamar al metofo para que las suba */
              /*  myDropzone.processQueue();
            });
        }
    }*/

     Dropzone.options.dropzoneFrom = {
  autoProcessQueue: false,
  acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg",
          dictDefaultMessage: 'Arrastra las imagenes de tu restaurante aqui.',

  init: function(){
   var submitButton = document.querySelector('#submit-all');
   myDropzone = this;
   submitButton.addEventListener("click", function(){
    myDropzone.processQueue();
   });
   this.on("complete", function(){
    if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
    {
     var _this = this;
     _this.removeAllFiles();
    }
    list_image();
   });
  },
 };




    

});