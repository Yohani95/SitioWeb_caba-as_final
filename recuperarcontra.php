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

    <div class="container" style="margin-top: 70px; width:40rem;"> 
    <div>
        <form   method="post" action="">
        <h2>Recuperar contraseña</h2><hr><br>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Correo electronico</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
            <div id="emailHelp" class="form-text"></div>
        </div>
        <br><div class="text-end">
        <a type="" class="btn btn-secondary" href="index.php">Cancelar</a>
        <button type="submit"  class="btn btn-primary">Recuperar</button>
        </div>
        </form>
        <p>
        
            <?php
            //envio de email para recuperar la contraseña
            if (isset($_POST["email"])) {
                $email = $_POST["email"];
                recuperarContraseña($email);   
            }
            ?></p>
            </div>
    </div>
	

    <!--pie de pagina-->
  <?php
  
  echo "<div class='text-end' style='position: absolute; bottom: 0;width: 100%;'" ;
  include 'pie_pagina.php';
  echo "</div>";
  ?>
  </div>
 

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>