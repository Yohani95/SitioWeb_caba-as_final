<?php
session_start();
include '../db/admin_db.php';
include '../menu2.php';

$email = '';
$rol = '';
if (isset($_SESSION['email'])) {
    $rol = obtenerrol($_SESSION['email']);
    if ($rol != "admin") {
       header("Location: index.php");
    } 
} else {
    header("Location: admin/reservas.php");
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Bootstrap CSS CDN -->
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" >
    <!-- Bootstrap DATATABLES -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- CSS LOCAL -->
    <link rel="stylesheet" href="../css/esti.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" ></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" ></script>
    <!-- Ionic icons -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <title>Reservas Aprobadas</title>

</head>

<body>

    <div class="wrapper">
        <!-- MENU  -->
        <?php include 'menuadmin.php';?>

        <!-- contenido de la pagina  -->

        <div class="container">
            <div class="">
            <h2>Reservas Aprobadas</h2>
            <hr>
            <p>Listado de reservas que han sido aprobadas por el administrador.</p>
         </div>
         <div class="table-responsive">
            <table id="tablaReservas" class="table" style="width:100%">
                <thead class="text-center thead-light" >
                    <tr> 
                        <th>N° Reserva</th>
                        <th>Fecha Aprobación</th>
                        <th>Arriendo</th>
                        <th>Correo</th>
                        <th>Nombre</th>
                        <th>Número</th>
                        <th>Fecha</th>
                        <th>Mensaje</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                <tbody>
                      <!-- Funcion obtener reservas  -->
                    <?php obtenerReservasA(); ?>
    
                </tbody>
                </thead>
            </table>
            </div>
        <div >

            
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" ></script>
    <!-- JavaScrip -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js" ></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
        
    </script>
        <!-- Funcion datatable (con traduccion)-->
        <script>
        $(document).ready(function() {
        $('#tablaReservas').DataTable( {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        } );
    } );
    </script>
</body>

</html>