<?php
//index.php

?>
<!DOCTYPE html>
<html>
 <head>
  <title>How to Upload a File using Dropzone.js with PHP</title>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>        
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script> -->


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- JQUERY -->
 <!--  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script> -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>


   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.css"> 

  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.js"></script>
 
 </head>
 <body>
  <div class="container">
   <h3 align="center">How to Upload a File using Dropzone.js with PHP</h3>
   
  <!--   <form action="upload.php" class="dropzone" id="dropzoneFrom"></form>
 
   <div align="center">
    <button type="button" class="btn btn-info" id="submit-all">Upload</button>
   </div>-->

   


  <form action="upload_img.php" class="dropzone" id="hola"></form>

  <div align="center">
    <button align="center" class="btn btn-success" type="submit" id="submit">Subir Fotos</button>
  </div>

  <div id="preview"></div>

  </div>
 </body>
</html>

<script>

$(document).ready(function(){


  Dropzone.options.hola = {
    autoProcessQueue: false,
      acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg",
      dictDefaultMessage: 'Hoasdla',
  }

 
 /*Dropzone.options.dropzoneFrom = {
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
 };*/

 /*list_image();

 function list_image()
 {
  $.ajax({
   url:"upload.php",
   success:function(data){
    $('#preview').html(data);
   }
  });
 }

 $(document).on('click', '.remove_image', function(){
  var name = $(this).attr('id');
  $.ajax({
   url:"upload.php",
   method:"POST",
   data:{name:name},
   success:function(data)
   {
    list_image();
   }
  })
 });
 */
});
</script>
