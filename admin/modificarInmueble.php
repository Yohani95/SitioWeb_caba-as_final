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
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include 'menuadmin.php';?>
        <div class="container ">

        <!-- contenido de la pagina  -->
        <?php $id_inmueble =$_GET['m'];?>
         
        <?php  
        $conn = conectar();
            $sql = "SELECT * FROM `inmueble` WHERE id_inmueble =".$id_inmueble."";
            $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
         <!--Inicio del formulario para registrar -->
         <form action="" method="POST" enctype="multipart/form-data"> 
            <h2>Modificar anuncio</h2><br>
         <!--Inicio del contenido -->
         <input type="hidden" name="id" value="<?php echo $_GET["m"];  ?>">
          <div class='form-group row'>
                <div class='col-6 mb-3' >
                    <label for="" class='form-label'>Nombre inmueble</label>
                    <input type='text' class='form-control' name='titulo' id='titulo' value="<?php echo $row['titulo']?>" required>
                </div>
                <div class='col-6 mb-3' >
                    <label for='' class='form-label'>Capacidad del inmueble</label>
                    <input type='text' class='form-control col-3' name='capacidad' id='capacidad'value="<?php echo $row['capacidad']?>" required>
                </div>
            </div>
            <!--sisguiente div row -->
            <div class='form-group row' >
                <div class='col-6 mb-3'>
                    <label for='' class='form-label'>Direccion</label>
                    <input type='text' class='form-control' name='direccion' id='direccion'>
                </div>

                <div class='col-6 mb-3'>
                    <label for='' class='form-label'>Valor</label>
                    <input type='text' class='form-control col-4' name='precio' id='precio' value="<?php echo $row['precio']?>" required>
                </div>
            </div>
            <!--sisguiente div row -->
            <div class='form-group row'>
                <div class='col-7 mb-3'>
                    <label for='formFileMultiple' class='form-label'>Agregar fotos</label>
                    <input class="form-control" type="file" id="archivo" name="foto" multiple accept="image/*" required>
                </div>
            </div>
            <!--sisguiente div row -->
            <div class='form-group row'> 
                
                <div>
                    <label for='' class='form-label'>Descripcion</label>
                    <textarea class='form-control' rows='15' name='desc' id='desc'><?php echo $row['descripcion']?></textarea>
                </div>
            </div>

            <button type='submit' class='btn btn-success'>Guardar cambios</button>
            <a class='btn btn-secondary' href='inmuebles.php'>Cancelar</a>
      
        </div>
        </form><br>
      
        <p>
            <?php
            if (isset($_POST["id"])) {
                $id= $_POST["id"];
                $titulo = $_POST["titulo"];
                $capacidad = $_POST["capacidad"];
               // $direccion = $_POST["direccion"];
                $precio = $_POST["precio"];
                $desc = $_POST["desc"];
                //apartado para ingresar ruta de la foto
                $foto=$_FILES["foto"]["name"];
                $ruta=$_FILES["foto"]["tmp_name"];
                $destino="../principal/".$foto;
                copy($ruta,$destino);
 
                modificarInmueble($id,$titulo, $capacidad, $precio , $destino, $desc);       
            }
        ?></p>

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

   <script>        
        CKEDITOR.replace( 'desc',{
            enterMode: CKEDITOR.ENTER_BR,
            entities:false
            } );
    </script>


</body>

</html>