<?php
session_start();
    include_once('../conexion.php');
    require_once('../validaciones.php');   
	$nuevouser = isset($_POST['usuarionuevo']) ? $_POST['usuarionuevo'] : null;
	$nuevopass = isset($_POST['passnuevo']) ? $_POST['passnuevo'] : null;
    $nuevoemail = isset($_POST['emailnuevo']) ? $_POST['emailnuevo'] : null;
    $nuevopasscifrado = password_hash($nuevopass, PASSWORD_DEFAULT);
    $errores = array();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	   if (!validarequerido($nuevouser)) {
      $errores[] = 'Todos los campos son obligatorios.';
   }
        if (!validarequerido($nuevopass)) {
      $errores[] = 'Todos los campos son obligatorios.';
   }
        if (!validarequerido($nuevoemail)) {
      $errores[] = 'Todos los campos son obligatorios.';
   }
        if (!validaemail($nuevoemail)) {
      $errores[] = 'El campo email es incorrecto.';
   }
   if(!$errores){
        $sql2 = "SELECT * FROM users WHERE username ='$nuevouser' OR email ='$nuevoemail'";
        $res2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
        $row2 = mysqli_fetch_assoc($res2);
        if($row2['username'] == $nuevouser){
            echo "El nombre de usuario ya esta en uso por favor intente <a href='crear_usuario.php'>crear usuario </a>con otro diferente.";
        }else{
        if (mysqli_num_rows($res2) == 0){    
        $sql = "INSERT INTO users (username, password, email) VALUES ('".$nuevouser."', '".$nuevopasscifrado."',
        '".$nuevoemail."')";
    $res = mysqli_query($con, $sql) or die(mysqli_error($con));
    if ($res) {
        $asunto = "Registro";
        $mensaje = "Enhorabuena! El usuario <b><i>$nuevouser</i></b> ha sido registrado con exito";
        $from = "Salvador - Foro";
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: ".$from."\r\n";

        mail($nuevoemail,$asunto,$mensaje,$headers);
        require_once('logout_parse.php'); 
        header("Location: /foro/index.php?status=reg_success");     
	}
    }else{
    echo "Usuario ya existe bajo el correo electronico indicado. Por favor regrese a la <a href='/foro/index.php'>pagina de inicio</a> e inice sesion.";    
   }
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