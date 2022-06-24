<?php
session_start();
include 'db/admin_db.php';
include 'menu2.php';
$conexion= conectar();
$email =$_GET['email'];
$token =$_GET['token'];
$nombre =$_GET['nombre'];
// si el token existe o no se le agrega el valor, true o false
$res=$conexion->query("select * from recuperar where 
        correo='$email' and token='$token'");
    $correcto=false;
    if(mysqli_num_rows($res) > 0){
    $fila = mysqli_fetch_row($res);
    $fecha =$fila[4];
    $realizado=$fila[3];
    if($realizado > 1 ){
        $correcto=false;

    }else{
        $correcto=true;
    }
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
      <div class="container" style="margin-top: 50px">
        <!--verifica que el token no aya sido utilisado-->
      <?php if($correcto){ 
      echo'
      <h2>Reiniciar contraseña </h2>
          <br>
          <form method="POST" action="">
          <input type="hidden" class="form-control" name="usuario" value="'. $email.'">
          <p>Bienvenido/a ' .$nombre.'</p>
          <p>Recuerde realizar el cambio de contraseña. Recuerde que tiene un timepo limitado para ello </p>
              <div class="form-group">
                  <label>Contraseña</label>
                  <input class="form-control" type="password" name="pass1">
              </div>
              <div class="form-group">
                  <label>Confirme la contraseña</label>
                  <input class="form-control" type="password" name="pass2">
              </div>
              <br>
              <button class="btn btn-primary" type="submit">Confirmar</button>
              <a class="btn btn-secondary" href="index.php">Cancelar</a>
          </form>
          <br>';?>
          <?php
          //se realiza la recuperacion de usuario.
          if (isset($_POST["usuario"])) {
              $usuario = $_POST["usuario"];
              $pass1 = $_POST["pass1"];
              $pass2 = $_POST["pass2"];
              if ($pass1 == $pass2) {
                  resetpassword($usuario, $pass1);
                  modificarcontador($token);
              } else {
                  echo "<div class='alert alert-danger'>";
                  echo "Las contraseñas no coinciden";
                  echo "</div>";
              }
          }
            ?>
            <?php
                    }else{
                     // si el token fue utilizado arroja el error.
                      echo' 
                      <div class="row justify-content-md-center">
                      <div class="card bg-light mb-3 alert alert-danger text-center " style=" max-width: 30rem; ">
                        <div class="card-header alert alert-danger" role="alert">
                        <h2 > TOKEN VENCIDO</h2>
                        <div class="image mr-3"> <img src="imagenes/alert.png" class="rounded-circle" width="150" /> </div>
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">El link que usted ha ingresado ya ha sido utilizado con anticipación</h5>
                          <p class="card-text">¡Recuerde que el link solo se encuentea habilitado para una ocación!</p>
                        </div>
                      </div>
                      </div>
                      ';
                      } ?>
      </div>  
    
<!--pie de pagina-->
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