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
  
    `<!-- Prerequisitos DRP -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <!-- Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


    <title>Paula Arriendos</title>
  </head>
  <body>
      <!--navbar menu-->
    <?php
        include 'menu.php';
    ?>  
   <!-- contenido de pagina-->
   
   <?php 
       $id_inmueble =$_GET['id_inmueble'];
    ?>
   <div class="container">
    <div class="row">
      <div class="card container" style="width:50rem; margin-top: 30px">
        <?php mostrarAnuncio($id_inmueble) ?>
      </div>
    </div>
  </div>
    
  <div >
  <!--Insertar reserva -->
<p>
    <?php

    if (isset($_POST["emailR"])) {
        $arriendo=$_GET['id_inmueble'];
        $emailR = $_POST["emailR"];
        $nombreR = $_POST["nombreR"];
        $numeroR = $_POST["numeroR"];
        $fechaR = $_POST["fechaR"];
        $msjR= $_POST['msjR'];

        registrarReserva($arriendo,$emailR, $nombreR, $numeroR , $fechaR, $msjR);    
    }
    ?></p>
</div>

    <!--pie de pagina-->
    <?php
        include 'pie_pagina.php';
    ?>

    <!-- contenido emergente o modal-->
            <div class="modal fade" id="Registrarreserva" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Registrar reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Correo Electronico</label>
            <input type="email" class="form-control" name= "emailR" id="emailR" aria-describedby="emailHelp" required>
            <br>

            <div class="mb-3"><label for="" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombreR" id="nombreR" required></div>

            <div class="mb-3"><label for="" class="form-label">Numero</label>            
            <input type="number" class="form-control" name="numeroR" id="numeroR" required></div>

            <div class="mb-3"><label class="form-label">Fecha</label>
          <input class="form-control" type="text" name="fechaR" id="fechaR" readonly required></div>
          <div class="mb-3">
                <label for="" class="form-label">Mensaje</label>
                <textarea class="form-control" name="msjR" id="msjR" rows="3" required></textarea>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Reservar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
    <br>

<!-- DateRangePicker Configuración-->
    <script type="text/javascript">
$(function() {
  var date = new Date();
  var currentMonth = date.getMonth();
  var currentDate = date.getDate();
  var currentYear = date.getFullYear();
    $('input[name="fechaR"]').daterangepicker({
      minDate: new Date(currentYear, currentMonth, currentDate)
    , dateFormat: 'yy-mm-dd'
    , startDate: moment(date).add(1,'days')
    , endDate: moment(date).add(2,'days')
    , isInvalidDate: function(ele) {
        var currDate = moment(ele._d).format('YY-MM-DD');
        return ["dd-mm-YYYY"].indexOf(currDate) != -1;
    }
    , locale: {
        format: 'DD.MM.YYYY'
    }
    });
});
</script>`


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