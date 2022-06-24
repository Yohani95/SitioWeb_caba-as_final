<?php
session_start();
include 'db/admin_db.php';
include 'menu2.php';

$email = '';
$rol = '';
//verifica el incio de sesion recibe el @param
if (isset($_SESSION["email"])) {
    $email = obtenernombre($_SESSION["email"]);
    $rol = obtenerrol($_SESSION["email"]);
    
}
?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="css/estilo_index.css" type="text/css" rel="stylesheet">
    
    <title>Paula Arriendos</title>
  </head>
  <body>
      <!-- Menu-->
    <?php
      include 'menu.php';
    ?>

      <!-- contenido de pagina-->
      <div class="">
    <h1 class="container" style="padding-top: 10px;">Bienvenidos<hr></h1>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active imgen">
            <img src="imagenes/geometricas.jpg" class="d-block w-100" style="width: 100%; height: 800px;" alt="...">
            <div class="carousel-caption" style="font-size: 30px;">
                <h1 >Pucon</h1>
                <p>Pucón, al igual que muchas ciudades del sur de Chile, ha sido escogido 
                    como lugar de residencia de muchos extranjeros por sus atractivos turísticos, naturales y económicos</p>
              </div>
          </div>
        </div>
      </div>
    

    <div class="container">
        <h2 class="container" style="padding-top: 10px;">Actividades<hr></h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
              <div class="card">
                <img src="imagenes/ojos-caburga.jpg" class="card-img-top" alt="">
                <div class="card-body">
                  <h5 class="card-title">Ojos del Caburga</h5>
                  <p class="card-text">Los Ojos del Caburga son uno de aquellos lugares donde todo se detiene para dar ritmo a la naturaleza y su 
                      cadencia tranquilizadora. Con variadas cascadas rodeadas de bosque nativo, conocer este lugar es uno de los mejores panoramas si quieres relajarte 
                      junto a la naturaleza. En Denomades incluimos una visita a los Ojos 
                      del Caburga en nuestro Tour por la zona, donde además visitamos otros atractivos de Pucón como el mirador Quelhue y los Saltos del Marimán.</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <img src="imagenes/termas-el-rincon.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Termas en la naturaleza</h5>
                  <p class="card-text">Una de las cosas que sí o sí debes hacer en Pucón es visitar alguna de sus termas. Las más conocidas son las famosas Termas Geométricas, 
                      con sus elegantes pasarelas rojas rodeadas de bosque. 
                      También recomendamos visitar las termas del Huife y las del Rincón, que aparecen en esta fotografía, en donde sus tinajas tienen
                       una vista alucinante a una gran cascada.</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <img src="imagenes/parque-nacional-conguillo.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">El Parque Nacional Conguillío posee paisajes que parecen sacados de ensueño. El lugar es parte
                       de la tierra ancestral de los Mapuches, y es que aquí se siente el eterno poder de la naturaleza como en muy pocos
                        otros lugares. En Denomades puedes reservar nuestro Traslado al Parque Nacional Conguillío, donde tendrás la libertad de realizar
                       un trekking por tu cuenta recorriendo paisajes conformados por las lenguas de lava de antiguas erupciones y los árboles del bosque.</p>
                </div>
              </div>
            </div>
           
          </div>
       
    </div>
    <div class="container">
        <h2 class="container" style="padding-top: 10px;">Seguridad<hr></h2>
        <div style="flex-direction: column;" >
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <img src="imagenes/prevencion-contagio.png" class="" alt="">
                <div>
                    <h3>Queremos que su estadía sea Tranquila y Segura, Conoce nuestro Protocolo de  Bioseguridad COVID-19.</h3>
                    <p>
                        Al Ingreso del Check In la cabaña se encontrara debidamente Sanitizada para su seguridad. 
                    </p>
                    <p>Uso Obligatorio de Mascarilla al Ingreso del Check In – Check Out  y Zonas Sociales.</p>
                    <p>Uso de Alcohol Gel y Toma de Temperatura a grupo familiar para registro (Declaración Jurada de Salud)</p>
                    <p>Cada cabaña cuenta con Alcohol Gel al ingreso y Pediluvio Sanitario.</p>
                    <p>Por Motivos de Seguridad COVID -19 el servicio de Mucama esta suspendido. </p>
                </div>
        
    </div> 
    
    </div>
    </div>
   
    </div><br>
    <div class="container">
        <h2 class="container" style="padding-top: 10px;">Nuestros Datos<hr></h2>
        <div style="flex-direction: column;" >
            <div class=" row row-cols-1 row-cols-md-3 g-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12353.382672658738!2d-71.96793505408223!3d-39.280410662712626!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x96147f42351988d1%3A0x3c5c238b02dc5935!2zUHVjb24sIFB1Y8OzbiwgQXJhdWNhbsOtYQ!5e0!3m2!1ses-419!2scl!4v1623076882742!5m2!1ses-419!2scl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                <div class="fst-italic">
                    <h3>Contactanos</h3>
                    <p>
                        Numero: +569 xxxxxxxx
                    </p>
                    <p>Correo Electronico: Paula_arriendos@gmail.com</p>
                    <p>Direccion:</p>
                    <h3>Nuestras redes</h3>
                </div>  
    </div> 
    </div>
    </div>

    
</div>
<!--pie de pagina-->
  <?php
    include 'pie_pagina.php'; 
  ?>
  
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>