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
    header("Location: admin/inmueble.php");
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
    <!-- CKEDITOR -->
    <script src="../libreria/ckeditor/ckeditor.js"></script>
   <!-- Ionic icons -->
   <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
   <style>
       .desc{
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            color: rgb(0, 0, 0);
            overflow: hidden;
        }
        .desc:hover{
            display: block;      
        }
   </style>
    <title>Admin_Inmuebles</title>
     
</head>

<body>

    <div class="wrapper">
        <!-- MENU  -->
        <?php include 'menuadmin.php';?>

        <!-- contenido de la pagina  -->
        <div class="container contenido-tienda">
            <h2>Inmuebles registrados</h2>
            <hr>
            <p>Inmuebles ingresados en la base de dato hasta la fecha</p>
            <div class="table-responsive ">
            <table id="tablaInmuebles" class="table" style="width:100%">
                <thead class="text-center thead-light" >
                    <tr>
                        <th>Codigo</th>
                        <th>Tipo de inmueble</th>
                        <th>capacidad</th>
                        <th>Precio</th>
                        <th>Descripcion</th>
                        <th></th>
                        <th></th>
                    </tr>
                <tbody>
                    <?php obtenerInmuebles(); ?>
                </tbody>
                </thead>
            </table>
        </div>
        <div class="">
            <a class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#RegistrarInmueble" type="button">Nuevo inmueble</a>
        </div>
        <div >


        <!--insercion de un nuevo inmueble -->
        <p>
            <?php
            if (isset($_POST["titulo"])) {
                $titulo = $_POST["titulo"];
                $capacidad = $_POST["capacidad"];
               // $direccion = $_POST["direccion"];
                $precio = $_POST["precio"];
                $descripcion = $_POST["descripcion"];
                //apartado para ingresar ruta de la foto
                $foto=$_FILES["foto"]["name"];
                $ruta=$_FILES["foto"]["tmp_name"];
                $destino="../principal/".$foto;
                copy($ruta,$destino);
 
                registrarInmueble($titulo, $capacidad, $precio , $destino, $descripcion);
               
                    
            }
            ?></p>
        </div>
        </div>

    <!-- Modal registrar inmueble-->
    <div class="modal fade" id="RegistrarInmueble" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" >Registrar nuevo inmueble</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <!--Inicio del formulario para registrar -->
        <form action="" method="POST" enctype="multipart/form-data"> 
            <h2>Ingreso de anuncio</h2><br>
         <!--Inicio del contenido -->
         <div class="form-group row">
                                <div class="col-6 mb-3" >
                                    <label for="" class="form-label">Nombre inmueble</label>
                                    <input type="text" class="form-control" name="titulo" id="titulo" >
                                </div>
                                <div class="col-6 mb-3" >
                                    <label for="" class="form-label">Capacidad del inmueble</label>
                                    <input type="text" class="form-control col-3" name="capacidad" id="capacidad" required>
                                </div>
                            </div>
                            <!--sisguiente div row -->
                            <div class="form-group row" >
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Direccion</label>
                                    <input type="text" class="form-control" name="direccion" id="direccion">
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Valor</label>
                                    <input type="text" class="form-control col-4" name="precio" id="precio" required>
                                </div>
                            </div>
                             <!--sisguiente div row -->
                            <div class="form-group row">
                                <div class="col-7 mb-3">
                                    <label for="formFileMultiple" class="form-label">Agregar fotos</label>
                                    <input class="form-control" type="file" id="archivo" name="foto" multiple accept="image/*" required>
                                </div>
                            </div>
                             <!--sisguiente div row -->
                            <div class="form-group row"> 
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label">Descripcion</label>
                                    <textarea class="form-control" rows="4" cols="6" name="descripcion" id="descripcion" required></textarea>
                                </div>
                            </div>        
                            

        <!--inicio de botones -->
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
    </div>
      
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
        $('#tablaInmuebles').DataTable( {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        } );
    } );
    </script>
    
    <script>        
        CKEDITOR.replace( 'descripcion',{
            enterMode: CKEDITOR.ENTER_BR,
            entities:false
            } );
    </script>

</body>

</html>