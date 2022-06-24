<?php

/**
 * FUNCION REALIZA LA CONECCION A LA BASE DE DATOS.
 *
 * @return void
 */
function conectar() {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'prueba';

    $conn = mysqli_connect($host, $user, $password, $database);
    if (!$conn) {
        die('Error de conexion: ' . mysqli_connect_error($conn));
    } else {
        return $conn;
    }
}
/**
 * cifra la contraseña
 *
 * @param  mixed $pass contraseña cifrada
 * @return void
 */
function cifrar_pass($pass) {
    $cifrada = crypt($pass, "foo");
    return $cifrada;
}


/**
 * FUNCION REALIZA EL INICIO DE SESION, COMPROBANDO QUE LOS DATOS ESTEN REGISTRADO.
 *
 * @param  mixed $email correo electronico del usuario
 * @param  mixed $pass contraseña del usuario
 * @return void
 */
function login($email, $pass) {
    $cifrada = cifrar_pass($pass);
    $conn = conectar();
    $sql = "select pass from usuarios where email = '" . $email . "'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $fila = mysqli_fetch_assoc($result);
        
        if ($fila["pass"] === $cifrada) {
            echo "<div class='alert alert-primary'>";
            echo 'Inicio de sesión correcto';
            echo "</div>";
            return true;
        } else {
            echo "<div class='alert alert-danger'>";
            echo "!cobtraseña o usuario incorrecto!";
            echo "</div>";
            return false;
        }
    } else {
        echo "<div class='alert alert-danger'>";
        echo "El usuario ingresado no está registrado";
        echo "</div>";
        return false;
    }
    mysqli_close($conn);
}


/**
 * FUNCION OBTIENE EL ROL DEL USUARIO, SEGUN EL EMAIL INICIADO SESION.
 *
 * @param  mixed $email correo electronico del usuario
 * @return void
 */
function obtenerrol($email) {
    $conn = conectar();
    $sql = "select rol.nombre rol from usuarios join rol on usuarios.id_rol = rol.id_rol"
            . " where usuarios.email = '" . $email . "'";
    $result = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $fila["rol"];
}

/**
 * FUNCION OBTIENE EL NOMBRE DEL USUARIO, SEGUN EL EMAIL INICIADO SESION.
 *
 * @param  mixed $email correo electronico del usuario
 * @return void
 */
function obtenernombre($email) {
    $conn = conectar();
    $sql = "select nombre from usuarios where email = '" . $email . "'";
    $result = mysqli_query($conn, $sql);

    $fila = mysqli_fetch_assoc($result);
    $nombre = $fila["nombre"];
    mysqli_close($conn);
    return $nombre;
}

/**
 * FUNCION ELIMINA EL USUARIO SELECCIONADO.
 *
 * @param  mixed $email correo electronico del usuario
 * @return void
 */
function eliminarUsuario($email){
    $conn=conectar();
    $sql="delete from usuarios where email='".$email."'";
    if(mysqli_query($conn, $sql)){
        echo"<div class='alert alert-primary'>";
        echo'Usuario eliminado exitosamente';
        echo"</div>";

    }else{
        echo"<div class='alert alert-danger'>";
        echo'Error al Eliminar';
        echo"</div>";
    }
    mysqli_close($conn);
}

/**
 * FUNCION ELIMINA EL INMUEBLE SELECCIONADO.
 *
 * @param  mixed $id_inmueble id del inmueble
 * @return void
 */
function eliminarInmueble($id_inmueble){
    $conn=conectar();
    $sql="delete from inmueble where id_inmueble='".$id_inmueble."'";
    if(mysqli_query($conn,$sql)){
        echo"<div class='alert alert-primary'>";
        echo'Cabaña eliminada exitosamente';
        echo"</div>";
    }else{
        echo"<div class='alert alert-danger'>";
        echo'Error al Eliminar';
        echo"</div>";
    }
    mysqli_close($conn);
}

/**
 * FUNCION MODIFICA LOS DATOS DE LOS INMUEBLES SI SE REQUIERE.
 *
 * @param  mixed $id                           id del inmueble
 * @param  mixed $titulo                       el titulo del imueble 
 * @param  mixed $capacidad                     capacidad de personas
 * @param  mixed $precio                        precio de la cabaña
 * @param  mixed $destino                       destino donde el documento o imagen quedara guardado
 * @param  mixed $descripcion                   descripcion de la cabaña
 * @return void
 */
function modificarInmueble($id,$titulo, $capacidad, $precio , $destino, $descripcion){
    $conn=conectar();
    $sql="update inmueble set titulo='".$titulo."' ,capacidad='".$capacidad."' ,precio='".$precio."' , imagen='".$destino."' ,
     descripcion='".$descripcion."' where id_inmueble='".$id."'"; 
     if(mysqli_query($conn,$sql)){
        echo "<div class='alert alert-primary'>";
        echo 'Cambios realizados correctamente';
        echo "</div>";
     }else{
        echo "<div class='alert alert-danger'>";
        echo 'Error al Intentar realizar modificaciones';
        echo "</div>";
     }
     mysqli_close($conn);
}

/**
 * FUNCION REGISTRAR RESERVA
 * @param mixed $arriendo   codigo del arriendo
 * @param mixed $email      correo electrónico del usuario
 * @param mixed $nombre     nombre usuario
 * @param mixed $numero     numero usuario 
 * @param mixed $fecha      fecha de reserva
 * @param mixed $mensaje    mensaje del usuario
 * @return void
 */
 
function registrarReserva($arriendo, $emailR, $nombreR, $numeroR , $fechaR, $msjR) {
    $conn = conectar();
    $sql = "INSERT INTO reservas (arriendo, email, nombre, numero, fecha, mensaje, estado) VALUES ('" . $arriendo . "', '"
                . $emailR . "' , '"
                . $nombreR . "', '"
                . $numeroR . "', '"
                . $fechaR . "', '"
                . $msjR . "', '"
                . 'Pendiente'."')";

        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-primary'>";
            echo 'RESERVA REGISTRADA EXITOSAMENTE';
            echo "</div>";
        } else {
            echo "<div class='alert alert-danger'>";
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo "</div>";
        }
   
    mysqli_close($conn);
}

/**
 * FUNCION OBTENER RESERVA 
 * @param mixed $id_reserva     id de la reserva
 * @param mixed $arriendo       arriendo reservado
 * @param mixed $email          email usuario
 * @param mixed $nombre         nombre usuario
 * @param mixed $numero         numero usuario
 * @param mixed $fecha          fecha reservada
 * @param mixed $mensaje        mensaje usuario
 * @param mixed $estado         estado de la reserva
 * @return void
 */

function obtenerReservas() {
    $conn = conectar();
    $sql = "select id_reserva, arriendo, email, nombre, numero, fecha, mensaje, estado
    from reservas where estado= 'Pendiente'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($fila = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $fila["id_reserva"] . "</td>";
            echo "<td>" . $fila["arriendo"] . "</td>";
            echo "<td>" . $fila["email"] . "</td>";
            echo "<td>" . $fila["nombre"] . "</td>";
            echo "<td>" . $fila["numero"] . "</td>";
            echo "<td>" . $fila["fecha"] . "</td>";
            echo "<td>" . $fila["mensaje"] . "</td>";
            echo "<td>" . $fila["estado"] . "</td>";
            echo "<td><a class='btn btn-success' href='modificarEstado.php?r=" . $fila["id_reserva"]
            . "'>Confirmar</a></td>";
            echo "<td><a class='btn btn-danger' href='eliminarReserva.php?r=" . $fila["id_reserva"]
            . "'>Rechazar</a></td>";
            echo "</tr>";
        }
    }
    mysqli_close($conn);
}

/**
 * FUNCION OBTENER RESERVAS APROBADAS
 * @param mixed $id_reserva     id de la reserva
 * @param mixed $arriendo       arriendo reservado
 * @param mixed $email          email usuario
 * @param mixed $nombre         nombre usuario
 * @param mixed $numero         numero usuario
 * @param mixed $fecha          fecha reservada
 * @param mixed $mensaje        mensaje usuario
 * @param mixed $estado         estado de la reserva
 * @return void
 */

function obtenerReservasA() {
    $conn = conectar();
    $sql = "select id_reserva, fechaA, arriendo, email, nombre, numero, fecha, mensaje, estado
    from reservas where estado= 'Aprobado'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($fila = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $fila["id_reserva"] . "</td>";
            echo "<td>" . $fila["fechaA"] . "</td>";
            echo "<td>" . $fila["arriendo"] . "</td>";
            echo "<td>" . $fila["email"] . "</td>";
            echo "<td>" . $fila["nombre"] . "</td>";
            echo "<td>" . $fila["numero"] . "</td>";
            echo "<td>" . $fila["fecha"] . "</td>";
            echo "<td>" . $fila["mensaje"] . "</td>";
            echo "<td>" . $fila["estado"] . "</td>";
            echo "<td><a class='btn btn-danger' href='eliminarReserva.php?r=" . $fila["id_reserva"]
            . "'>Eliminar</a></td>";
            echo "</tr>";
        }
    }
    mysqli_close($conn);
}


/**
 * FUNCION ELIMINAR RESERVA
 * @param mixed $id_reserva     id de la reserva
 * @return void
 */

function eliminarReserva($id_reserva){
    $conn=conectar();
    $sql="delete from reservas where id_reserva='".$id_reserva."'";
    if(mysqli_query($conn,$sql)){
        echo"<div class='alert alert-primary'>";
        echo'Reserva eliminada exitosamente';
        echo"</div>";
    }else{
        echo"<div class='alert alert-danger'>";
        echo'Error al eliminar';
        echo"</div>";
    }
    mysqli_close($conn);
}


/**
 * FUNCION MODIFICA EL ESTADO DE LA RESERVA
 * @param  mixed $id_reserva        codigo de la reserva
 * @return void
 */

function aprobarReserva($id_reserva){
    $conn=conectar();
    $sql="update reservas set estado='".'Aprobado'."' where id_reserva='".$id_reserva."'"; 
     if(mysqli_query($conn,$sql)){
        echo "<div class='alert alert-primary'>";
        echo 'RESERVA APROBADA';
        echo "</div>";
     }else{
        echo "<div class='alert alert-danger'>";
        echo 'Error al Intentar realizar modificaciones';
        echo "</div>";
     }
     mysqli_close($conn);
}

/**
 * FUNCION REGISTRA A LOS USUARIOS CON LAS CARACTERISTICAS QUE SE SOLICITAN.
 *
 * @param  mixed $email             correo electronico del usuario
 * @param  mixed $nombre            nombre del usuario  
 * @param  mixed $apellido          apellido del usuario
 * @param  mixed $pass              contraseña del usuario
 * @param  mixed $id_rol            el rol que ocupa el usuario
 * @return void
 */
function registrar($email, $nombre, $apellido, $pass, $id_rol) {
    $conn = conectar();
    $quary = "select email from usuarios where email = '" . $email . "'";
    $result = mysqli_query($conn, $quary);
    if (mysqli_num_rows($result) ==0) {
        $fila = mysqli_fetch_assoc($result);
        $sql = "insert into usuarios (email, nombre, apellido, pass, id_rol) values ('" . $email. "', '"
                . $nombre . "' , '"
                . $apellido . "', '"
                . cifrar_pass($pass) . "', "
                . $id_rol . ")";

        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-primary'>";
            echo 'Usuario creado exitosamente';
            echo "</div>";
        } else {
            echo "<div class='alert alert-danger'>";
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo "</div>";
        }
    }else{
        echo "<div class='alert alert-danger'>";
            echo 'correo ya se encuentra registrado';
            echo "</div>";
    }
    mysqli_close($conn);
}


/**
 * FUNCION REGISTRA INMUEBLE CON LAS CARACTERISTICAS QUE SE SOLICITAN.
 * 
 * @param  mixed $titulo                el titulo del imueble 
 * @param  mixed $capacidad             capacidad de personas 
 * @param  mixed $precio                precio de la cabaña
 * @param  mixed $destino               destino donde el documento o imagen quedara guardado
 * @param  mixed $descripcion           descripcion de la cabaña
 * @return void
 */
function registrarInmueble($titulo, $capacidad, $precio , $destino, $descripcion) {
    $conn = conectar();
    $sql = "INSERT INTO inmueble (titulo, capacidad, precio, imagen, descripcion) VALUES ('" . $titulo. "', '"
                . $capacidad . "' , '"
                . $precio . "', '"
                . $destino . "', '"
                . $descripcion . "')";

        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-primary'>";
            echo 'inmueble creado exitosamente';
            echo "</div>";
        } else {
            echo "<div class='alert alert-danger'>";
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo "</div>";
        }
   
    mysqli_close($conn);
}

/**
 * FUNCION MUESTRA TODOS LOS USUARIOS REGISTRADOS
 *
 * @return void
 */
function obtenerUsuarios() {
    $conn = conectar();
    $sql = "select id_usr, usuarios.email, usuarios.nombre, usuarios.apellido, rol.descripcion
    from usuarios join rol on usuarios.id_rol = rol.id_rol";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($fila = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $fila["id_usr"] . "</td>";
            echo "<td>" . $fila["email"] . "</td>";
            echo "<td>" . $fila["nombre"] . "</td>";
            echo "<td>" . $fila["apellido"] . "</td>";
            echo "<td>" . $fila["descripcion"] . "</td>";
            echo "<td><a class='btn btn-danger' href='eliminarUsuario.php?c=" . $fila["email"]
            . "'>Eliminar</a></td>";
            echo "</tr>";
        }
    }
    mysqli_close($conn);
}

/**
 * FUNCION MUESTRA TODO LOS ANUNCIOS REGISTRADOS.
 *
 * @return void
 */
function obtenerInmuebles() {
    $conn = conectar();
    $sql = "select id_inmueble, titulo, capacidad, precio, descripcion from inmueble" ;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($fila = mysqli_fetch_assoc($result)) {
           
            echo "<tr>";
            echo "<td>" . $fila["id_inmueble"] . "</td>";
            echo "<td>" . $fila["titulo"] . "</td>";
            echo "<td>" . $fila["capacidad"] . "</td>";
            echo "<td>" . $fila["precio"] . "</td>";
            echo "<td> <p class='desc'>" . $fila["descripcion"] . "</p></td>";
            echo "<td><a class='btn btn-danger' href='eliminarInmueble.php?e=" . $fila["id_inmueble"]
            . "'>Eliminar</a></td>";
            
            echo "<td><a class='btn btn-primary ' href='modificarInmueble.php?m=" . $fila["id_inmueble"]
            . "'>Modificar</a></td>";
            echo "</tr>";
        }
    }
    mysqli_close($conn);
}



/**
 * FUNCION MUESTRA EL ANUNCIO SELECCIONADO, COMPARANDO EL ID.
 *
 * @param  mixed $id_inmueble           id del inmueble
 * @return void
 */
function mostrarAnuncio($id_inmueble){

    $conn = conectar();
    $sql = "SELECT * FROM `inmueble` WHERE id_inmueble = ".$id_inmueble."";
    $resultSet = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($resultSet); 
    
       
            echo"        <img src='principal/".$row[4] ."' class='card-img-top' style='margin-top: 20px' alt='mal la url'>";
            echo"        <div class='card-body'>";
            echo"            <h5 class='card-title'>".$row[1] ." " . $row[2]." personas</h5>";
            echo"            <p class='card-text'>";
            echo"                Precio: ".$row[3]." por día.</p>";
            echo"             <h6 class='card-title'> Detalles</h6>";
            echo"               <p class='card-text'>".$row[5]."</p>";
            echo"<br>";
            echo"        <div class=' top-50 end-0 translate-middle-y' style='margin-right: 30px'>";
            echo"            <button class='btn d-flex btn-success' data-bs-toggle='modal' data-bs-target='#Registrarreserva' type='button'>reservar
                        </button>";
            echo"        </div>";
                        
            echo"        </div>";
            echo"        </div>";
    

mysqli_close($conn);
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * FUNCION PARA RECUPERAR CONTRASEÑA
 *
 * @param  mixed $email         correo electronico del usuario
 * @return void
 */
function recuperarContraseña($email){
    
    require 'libreria/PHPMailer/Exception.php';
    require 'libreria/PHPMailer/PHPMailer.php';
    require 'libreria/PHPMailer/SMTP.php';
    $conn = conectar();
    //VERIFICAMOS SI SE ENCUNTRA EL CORREO REGISTRADP
    $sql= "SELECT * FROM usuarios WHERE email = '" . $email . "'";

    $resultSet = mysqli_query($conn, $sql);
    $mostrar= mysqli_fetch_row($resultSet); 
    $nombre = "".$mostrar[2]." ".$mostrar[3]."" ;

    if (mysqli_num_rows($resultSet) >0) {
        //GENERAMOS UN TOKEN
        $bytes = random_bytes(5);
        $token =bin2hex($bytes);
        //CODIGO AL AZAR
        $codigo= 1;

        $query=" INSERT INTO recuperar (correo, token, realizado) VALUES('$email','$token','$codigo') ";
        mysqli_query($conn, $query);

        $mensaje="
        <html lang='es'>
        <head>
        <title>Restablecer</title>
        </head>
        <body>

        <h2> Hola $nombre</h2>
        <p>
        Usted a soliictado un cambio de contraseña</p>
        <p>
        En caso de no ser asi favor ignorar correo</P>

        Para realizar el cambio de contraseña ir al siguinete link
        <p> <a class='btn btn-primary'
            href='http://localhost/SitioWeb_caba%C3%B1as/cambiarcontrasena.php?email=$email&token=$token&nombre=$nombre&realizado=$codigo'> 
            para restablecer da click aqui </a> </p>

        
        </body>
        </html>
        
        ";
        //inicia PHPMAILER
        $mail = new PHPMailer(true);

        try {
            //Server settings
                $mail->SMTPDebug = 0;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true; 
                $mail->From='pruebaweb2021inacap@gmail.com';                                  // Enable SMTP authentication
                $mail->Username='pruebaweb2021inacap@gmail.com';//este debe ir en el address?
                $mail->Password='Inacap2021';                            // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
                //Recipients
                $mail->setFrom('pruebaweb2021inacap@gmail.com', 'Cambio de password');
                $mail->addAddress($email);     // Add a recipient

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Restablecer Password';
                $mail->Body    = $mensaje;
        
            $mail->send();
                    echo "<div class='alert alert-primary'>";
                    echo "Se ha enviado un correo con la contraseña";
                    echo "</div>";
        } catch (Exception $e) {
                echo "<div class='alert alert-danger'>";
                echo "No es posible enviar contraseña";
                echo "</div>";
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        
        
    }
    else
    {
        echo "<div class='alert alert-danger'>";
        echo "El correo no se encuentra registrado";
        echo "</div>";
    }

}

/**
 * FUNCION ENVÍA UN CORREO AL CONFIRMAR LA RESERVA
 * @param mixed $id_reserva         codigo de la reserva
 * @return void
 */

function confirmacionCorreo($id_reserva){
    
    require '../libreria/PHPMailer/Exception.php';
    require '../libreria/PHPMailer/PHPMailer.php';
    require '../libreria/PHPMailer/SMTP.php';
    $conn = conectar();
    $sql= "SELECT fechaA, email, nombre FROM reservas WHERE id_reserva = '" . $id_reserva . "'";

    $resultSet = mysqli_query($conn, $sql);
    $mostrar= mysqli_fetch_row($resultSet); 
    $fecha= "".$mostrar[0]."";
    $email= "".$mostrar[1]."";
    $nombre = "".$mostrar[2]."" ;

    if (mysqli_num_rows($resultSet) >0) {
        $mensaje="
        <html lang='es'>
        <head>
        <title>Confirmación</title>
        </head>
        <body>

        <h2> Saludos $nombre</h2>
        <p>
        Su reserva ha sido confirmada con fecha: $fecha</p>
        <p>
        Arriendos Paula.</P>
        
        </body>
        </html> ";
        //inicia PHPMAILER
        $mail = new PHPMailer(true);

        try {
            //Server settings
                $mail->SMTPDebug = 0;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username='pruebaweb2021inacap@gmail.com';//este debe ir en el address?
                $mail->Password='Inacap2021';                            // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                //Recipients
                $mail->setFrom('pruebaweb2021inacap@gmail.com', 'Confirmación arriendo');
                $mail->addAddress($email);     // Add a recipient
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Confirmacion arriendo';
                $mail->Body    = $mensaje;
        
            $mail->send();
                    echo "<div class='alert alert-primary'>";
                    echo "Se ha enviado un correo con la confirmación";
                    echo "</div>";
        } catch (Exception $e) {
                echo "<div class='alert alert-danger'>";
                echo "No es posible enviar correo";
                echo "</div>";
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }   
    }
    else
    {
        echo "<div class='alert alert-danger'>";
        echo "No existe";
        echo "</div>";
    }
}

function confirmacionEliminacion($id_reserva){
    
    require '../libreria/PHPMailer/Exception.php';
    require '../libreria/PHPMailer/PHPMailer.php';
    require '../libreria/PHPMailer/SMTP.php';
    $conn = conectar();
    $sql= "SELECT fechaA, email, nombre FROM reservas WHERE id_reserva = '" . $id_reserva . "'";

    $resultSet = mysqli_query($conn, $sql);
    $mostrar= mysqli_fetch_row($resultSet); 
    $fecha= "".$mostrar[0]."";
    $email= "".$mostrar[1]."";
    $nombre = "".$mostrar[2]."" ;

    if (mysqli_num_rows($resultSet) >0) {
        $mensaje="
        <html lang='es'>
        <head>
        <title>Confirmación</title>
        </head>
        <body>

        <h2> Saludos $nombre</h2>
        <p>
        Su reserva ha sido rechazada con fecha: $fecha</p>
        <p>
        Arriendos Paula.</P>
        
        </body>
        </html> ";
        //inicia PHPMAILER
        $mail = new PHPMailer(true);

        try {
            //Server settings
                $mail->SMTPDebug = 0;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username='pruebaweb2021inacap@gmail.com';//este debe ir en el address?
                $mail->Password='Inacap2021';                            // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                //Recipients
                $mail->setFrom('pruebaweb2021inacap@gmail.com', 'Reserva rechazada');
                $mail->addAddress($email);     // Add a recipient
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Reserva rechazada';
                $mail->Body    = $mensaje;
        
            $mail->send();
                    echo "<div class='alert alert-primary'>";
                    echo "Se ha enviado un correo informando del rechazo";
                    echo "</div>";
        } catch (Exception $e) {
                echo "<div class='alert alert-danger'>";
                echo "No es posible enviar correo";
                echo "</div>";
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }   
    }
    else
    {
        echo "<div class='alert alert-danger'>";
        echo "No existe";
        echo "</div>";
    }
}

/**
 * resetpassword esta funcion realiza el cambio de la contraseña, sincronizado segun el email.
 *
 * @param  mixed $usuario            email del usario
 * @param  mixed $pass               contraseña del usuario
 * @return void
 */
function resetpassword($usuario, $pass) {
    $conn = conectar();
    $sql = "update usuarios set pass='" . cifrar_pass($pass) . "' where email='" . $usuario . "'";
    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-primary'>";
        echo 'Contraseña reiniciada correctamente';
        echo "</div>";
    } else {
        echo "<div class='alert alert-danger'>";
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo "</div>";
    }
    mysqli_close($conn);
}

/**
 * esta funcion realiza la , sincronizado segun el email.
 *
 * @param  mixed $token  token para reconocer el estado de este
 * @return void
 */
function modificarcontador($token) {
    $conn = conectar();
    $num=2;
    $sql = "UPDATE recuperar SET realizado=" . $num ." WHERE token='". $token."'";
    if (mysqli_query($conn, $sql)) {
      
    } else {
        echo "<div class='alert alert-danger'>";
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo "</div>";
    }
    mysqli_close($conn);
}

