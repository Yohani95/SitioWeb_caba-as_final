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
    header("Location: admin/usuarios.php");
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
    <title>Admin_Usuarios</title>
     
</head>

<body>

    <div class="wrapper">
        <!-- MENU  -->
        <?php include 'menuadmin.php';?>

        <!-- contenido de la pagina  -->
        <div class="container">
            <div class="">
            <h2>Usuarios</h2>
            <hr>
            <p>Lista de usuarios del sistema.</p>
         </div>
         <div class="table-responsive">
            <table id="tablaUsuarios" class="table" style="width:100%">
                <thead class="text-center thead-light" >
                    <tr> 
                        <th>Codigo</th>
                        <th>Correo</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Rol</th>
                        <th></th>
                    </tr>
                <tbody>
                      <!-- LLAMANDO A LA FUNCION PARA OBTENER LOS USUARIOS  -->
                    <?php obtenerUsuarios(); ?>
                   
                </tbody>
                </thead>
            </table>
            </div>
                <div class="container" style="margin-top: 20px">
                     <a class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#RegistrarUsuario" type="button" style="">Nuevo Usuario</a>
                </div>
        <div >
            <p>
                <?php
                  // SE ENVIA LOS DATOS DE REGISTRO DE UN NUEVO USUARIO
                if (isset($_POST["email"])) {
                    $email = $_POST["email"];
                    $nombre = $_POST["nombre"];
                    $apellido = $_POST["apellido"];
                    $pass = $_POST["pass1"];
                    $pass2 = $_POST["pass2"];
                    $id_rol= $_POST["id_rol"];
    
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
        </div>
 
    <!-- Modal registrar Usuario-->
    <div class="modal fade" id="RegistrarUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Registrar Usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <!--Inicio del formulario para registrar -->
        <form method="post" action="">
            <h2>Registro</h2><br>
            <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input type="form-text" class="form-control" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Apellido</label>
            <input type="form-text" class="form-control" name="apellido" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Correo electronico</label>
            <input type="email" class="form-control" aria-describedby="emailHelp" name="email" required>
            <div id="emailHelp" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="pass1" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirmar contraseña</label>
            <input type="password" class="form-control" name="pass2" required >
        </div>
        <div class="form-group">
                    <label>Rol</label>
                    <select class="form-control" name="id_rol">
                        <option value="1">Usuario normal</option>
                        <option value="2">Administrador</option>
                        
                    </select>
                </div>
        <div class="text-right" >
        <div class="modal-footer">
        
        </div>
        <button type="submit" class="btn btn-success">Registrar</button>
        <a href="index.php" class="btn btn-secondary"data-bs-dismiss="modal">Cancelar</a>
        
        </div>
        </form><br>
        </div>
    </div>
    </div>
  
                
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" ></script>
    <!-- JavaScrip -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js" ></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    
    <!-- funsion para ocultar el sidebar-->
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
        $('#tablaUsuarios').DataTable( {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        } );
    } );
    </script>


</body>

</html>