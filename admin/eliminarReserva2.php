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
    header("Location: usuarios.php");
}
?>
<!doctype html>
<html lang="es">

<head>
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
   <title>Eliminar Inmueble</title>
</head>

<body>

    <div class="wrapper">
        <!-- MENU -->
        <?php include 'menuadmin.php';?>
        <!-- CONTENIDO DE LA PAGINA -->
        <div class="container">
            <h2>Eliminar reserva</h2>
            <hr>
            <p>¿Está seguro que desea eliminar la reserva?</p>
            <form method="post" action="">
            <input type="hidden" name="idR" value="<?php echo $_GET["r"];  ?>">
                
                <button class="btn btn-primary" type="submit">Confirmar</button>
                <a class="btn btn-secondary" href="reservas.php">Cancelar</a>
            </form>
            <br>
            <?php
            if (isset($_POST["idR"])) {
                $id_reserva = $_POST["idR"];;
                eliminarReserva($id_reserva);
            }
            ?>
        </div>

    <!--SCRIPT -->
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

</body>

</html>