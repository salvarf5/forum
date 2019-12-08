<?php
session_start();
    include_once('../conexion.php');
    require_once('../validaciones.php');   
	$usuemail = isset($_POST['usuemail']) ? $_POST['usuemail'] : null;
	$nuevopass = isset($_POST['nuevopass']) ? $_POST['nuevopass'] : null;
    $nuevopasscifrado = password_hash($nuevopass, PASSWORD_DEFAULT);
    $errores = array();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	   if (!validarequerido($usuemail)) {
      $errores[] = 'Todos los campos son obligatorios.';
   }
        if (!validarequerido($nuevopass)) {
      $errores[] = 'Todos los campos son obligatorios.';
   }
   if(!$errores){
        $sql2 = "SELECT * FROM users WHERE username ='$usuemail' OR email ='$usuemail'";
        $res2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
        $row2 = mysqli_fetch_assoc($res2);
        if($row2['username'] == $usuemail || $row2['email'] == $usuemail){
            $nombreusuario = $row2['username'];
            echo $nombreusuario;
            $sql3 = "UPDATE users SET password='$nuevopasscifrado' WHERE username='$nombreusuario'";
            $res3 = mysqli_query($con, $sql3) or die(mysqli_error($con));
            if ($res3) {
        $asunto = "Cambio Contraseña";
        $email = $row2['email'];
        $mensaje = "Enhorabuena <b><i>$nombreusuario</i></b> la contrase&ntilde;a ha sido cambiada con exito";
        $from = "Salvador - Foro";
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: ".$from."\r\n";

        mail($email,$asunto,$mensaje,$headers);
        require_once('logout_parse.php'); 
        header("Location: /foro/index.php?status=cambiado");     
	}
        }else{
            echo "No existe ningun usuario con ese nombre o correo electronico.<a href='cambio_password.php'> Intentelo de nuevo</a> o <a href='crear_usuario.php'>registrese como nuevo usuario</a>";
    
   }
   }
   }
	
?>
 <?php if ($errores): ?>
       <ul style="color: #f00;">
          <?php foreach ($errores as $error): ?>
             <li> <?php echo $error ?> </li>
          <?php endforeach; ?>
       </ul>
    <?php endif; ?>