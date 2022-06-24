<?php
session_start();
include 'db/admin_db.php';
include 'menu2.php';

$email = '';
$rol = '';
//verifica el incio de sesion
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
    <!--navbar menu-->
    <?php
       include 'menu.php';
    ?> 
        <!--Contenido de la pagina, para inicio de sesion-->
        <div class="container">
        <div class="container" style="margin-top: 50px; width:50rem;" >
            <h2>Inicio Sesion</h2><hr><br>
            <form   method="post" action="">
                <div class="mb-3" >
                    <label for="" class="form-label">Correo Electronico</label>
                    <input type="text" class="form-control" name="email" required>
                    <div id="emailHelp" class="form-text"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="pass" required>
                </div>
                
                <a class="forgot text-muted" style="margin-right: 50px" href="recuperarcontra.php">¿Olvidaste la contraseña?</a>
                
                <a class="forgot text-muted"  href="registrar.php">Registrate</a> 
                <br>
                <div class="text-end">
                <button type="submit" class="btn btn-primary " style="margin-bottom: 50px; margin-top: 50px">Iniciar Sesion</button>
                </div>
            </form>
            </div>
           
            
            <?php
            //envio de datos para el inicio de sesion, identificando el rol del usuario
                if (isset($_POST["email"])) {
                    $email = $_POST["email"];
                    $pass = $_POST["pass"];
                    if (login($email, $pass)) {
                        $_SESSION["email"] = $email;
                        $rol = obtenerrol($email);
                    if ($rol === "admin") {
                            header("Location: admin/reservas.php");
                    } else {
                            header("Location: anuncios.php");
                        }
                    }
                }
                ?>
        </div>
    <!--pie de pagina-->
    <br style="margin-top">
    
    <?php
    echo "<div class='text-end' style='position: absolute; bottom: 0;width: 100%;'" ;
    include 'pie_pagina.php';
    echo "</div>";
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