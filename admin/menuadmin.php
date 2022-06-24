<?php

echo"
<!-- MENU -->
<nav id='sidebar'>
            <div class='sidebar-header'>
                <h3>Administracion Inmuebles</h3>
            </div>

            <ul class='list-unstyled components'>
                <p>Gestion</p>
                
                <li>
                <a href='inmuebles.php' class='d-block text-light p-3 border-0'><i class='icon ion-md-apps lead mr-2'></i>
                    Inmuebles publicados</a>
                </li>
                
                <li>
                <a href='usuarios.php' class='d-block text-light p-3 border-0'><i class='icon ion-md-people lead mr-2'></i>
                    Usuarios</a>
                </li>
                <li>
                <a href='reservas.php' class='d-block text-light p-3 border-0'><i class='icon ion-md-alert lead mr-2'></i>
                    Reservas Pendientes</a>
                </li>
                <li>
                <a href='reservasAprobadas.php' class='d-block text-light p-3 border-0'><i class='icon ion-md-checkmark lead mr-2'></i>
                    Reservas Aprobadas</a>
                </li>
            </ul>
        </nav>

        <!-- CONTENIDO DE PAGINA  -->
        <div id='content'>

            <nav class='navbar navbar-expand-lg navbar-light bg-light'>
                <div class='container-fluid'>

                    <button type='button' id='sidebarCollapse' class='btn btn-info'>
                        <i class='fas fa-align-left'></i>
                        <span>expandir</span>
                    </button>
                    <button class='btn btn-dark d-inline-block d-lg-none ml-auto' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                        <i class='fas fa-align-justify'></i>
                    </button>

                    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                        <ul class='nav navbar-nav ml-auto'>"?>
                        
                        <?php
                        //LLAMADO DE FUNCION PARA OBETENER EL NOMBRE DE LA PERSONA INICIADA SESION.
                        if (isset($_SESSION["email"])) {
                            $usuario = obtenernombre($_SESSION["email"]);
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="../logout.php">' . $usuario . ' (Salir)</a>';
                            echo '</li>';
                        } else {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="login.php">Iniciar sesión</a>';
                            echo '</li>';
                        }
                        imprimirmenu1($rol)
                    ?> <?php echo"
                        </ul>
                    </div>
                </div>
            </nav>"?>
    