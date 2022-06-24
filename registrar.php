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
  <!-- menu  -->
  <?php
    include 'menu.php';
  ?>
 <!-- CONTENIDO DE LA PAGINA, SOLICITUD DE DATOS PARA EL REGISTRO -->
<div class="container" style="margin-top: 50px; width:50rem;" >  
        <form method="post" action="">
            <h2>Registro</h2><hr><br>
            <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input type="form-text" class="form-control" id="exampleInputPassword1" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Apellido</label>
            <input type="form-text" class="form-control" id="exampleInputPassword1" name="apellido" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Correo electronico</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
            <div id="emailHelp" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="pass1" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirmar contraseña</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="pass2" required >
        </div>
        <div class="text-end">
        <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
        </form><br>
        <p>
            <?php
            //envio de datos para el registro de usuario
            if (isset($_POST["email"])) {
                $email = $_POST["email"];
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $pass = $_POST["pass1"];
                $pass2 = $_POST["pass2"];
                $id_rol= 1;
 
                if($pass == $pass2){
                  registrar($email, $nombre, $apellido, $pass, $id_rol);
                }
                else{
                    echo "<div class='alert alert-danger'>";
                    echo "Las contraseñas no son iguales";
                    echo "</div>";
                }
                    
            }
            ?></p>
</div>

<!--pie de pagina -->

<?php
   echo "<div class='text-end' style='position: absolute; bottom: 0;width: 100%;'" ;
   include 'pie_pagina.php';
   echo "</div>";
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  </body>
</html>