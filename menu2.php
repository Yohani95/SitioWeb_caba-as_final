<?php

//funcion para mostrar o activar dropdown en la pagina principal, para el administrador
function imprimirmenu2($rol) {
    if ($rol == "admin") {
        echo '<li class="nav-item dropdown">'
        . '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">'
        . 'Opciones Usuario'
        . '</a>'
        . '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">'
        . '<li><a class="dropdown-item active" href="anuncios.php">Anuncioss</a></li>'
        . '<li><a class="dropdown-item" href="index.php">Home Usuarios</a></li>'
        . '<li><a class="dropdown-item" href="admin/reservas.php">Home administrador</a></li>'
        . '</ul>'
        . '</li>';
    } elseif ($rol == 'user') {
       
    } else {
        
    }
}
//funcion para mostrar o activar dropdown en la pagina de administracion, para el administrador
function imprimirmenu1($rol) {
  if ($rol == "admin") {
      echo '<li class="nav-item dropdown">'
      . '<a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">'
      . 'Opciones Usuario'
      . '</a>'
      . '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">'
      . '<li><a class="dropdown-item active" href="../anuncios.php">Anuncioss</a></li>'
      . '<li><a class="dropdown-item" href="../index.php">Home Usuarios</a></li>'
      . '<li><a class="dropdown-item" href="reservas.php">Home administrador</a></li>'
      . '</ul>'
      . '</li>';
  } elseif ($rol == 'user') {
     
  } else {
      
  }
}
