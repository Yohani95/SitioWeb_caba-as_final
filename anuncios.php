<?php
session_start();
include 'db/admin_db.php';
include 'menu2.php';

$email = '';
$rol = '';
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
      <!--navbar menu-->
      <?php
       include 'menu.php';
      ?>  
      <!-- contenido de pagina-->
      
      <div class="container" style="margin-top: 50px">
      <h1>Nuestros Arriendos</h1><hr>
        <div class="row">
            <?php
           //se muestra los inmueble registrados
            $conexion =  conectar();
            $sql = "SELECT * FROM `inmueble`";
            $resultSet = mysqli_query($conexion, $sql);
            while ($row = mysqli_fetch_row($resultSet)) {
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <img src="principal/<?php echo $row[4]; ?>" class="card-img-top"  width="180" height="200" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row[1] . " " . $row[2]; ?> personas</h5>
                            <p class="card-text">
                                Precio: <?php echo $row[3]; ?> por día.
                            
                            </p>
                        
                            <!--boton para seleccionar el inmueble y envia el id de este-->
                            <a href="descripcion.php?id_inmueble=<?php echo $row[0]; ?>" class="btn btn-primary " >Ver mas</a>
                        </div>
                    </div>
                    <br>
                </div>
            <?php
            }
            ?>
           
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