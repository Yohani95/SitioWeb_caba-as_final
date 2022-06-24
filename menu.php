<?php
echo'
<!--navbar menu-->
                <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" >
            <div class="container-fluid container"> 
                <a class="navbar-brand fst-italic" href="index.php">Arriendos Pucon</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="anuncios.php">Anuncios</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href=""></a>
                    </li>
                
                    <li class="nav-item">
                    <a class="nav-link" href="nosotros.php" tabindex="-1" aria-disabled="">Nosotros</a>
                    </li>
                    
                '
                    
                    ?>
                     <?php
                     //llamado de la funcion para obtener el nombre del usuario, si esta iniciada alguna sesion
                                if (isset($_SESSION["email"])) {
                                    $usuario = obtenernombre($_SESSION["email"]);
                                    echo '<li class="nav-item">';
                                    echo '<a class="nav-link" href="logout.php">' . $usuario . ' (Salir)</a>';
                                    echo '</li>';
                                } else {
                                    echo '<li class="nav-item">';
                                    echo '<a class="nav-link" href="login.php">Iniciar sesión</a>';
                                    echo '</li>';
                                }
                                //llamado para identificar el rol de la sesion
                                imprimirmenu2($rol);
                       
                    ?>
                     <?php
                  
                     echo'
                  
                </ul>
                </div>
            </div>
            </nav>
      ';?>