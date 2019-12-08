<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Foro - Crear Usuario</title>
  <link rel="stylesheet" type="text/css" href="/foro/estilos/style.php"/>
    <script type="text/javascript">
 
function timedMsg()
{
var t=setTimeout("document.getElementById('mimsg').style.display='none';",5000);
}
 
</script>
</head>
	
	<body>
		<div id="wraper">
            <?php echo "<a href='/foro/index.php'>Regresar a la pagina de inicio</a>";?> 
<?php 
session_start();
include_once("../conexion.php");
require_once('../validaciones.php');
			
if (isset($_SESSION['uid'])){
	$errores = array();
	$usuariolog = $_SESSION['uid'];
	$sql3 = "SELECT * FROM users WHERE id = '".$usuariolog."'";
    $res3 = mysqli_query($con, $sql3) or die(mysqli_error($con));
	 while ($row = mysqli_fetch_assoc($res3)){
		 $username = $row['username'];
		 $pass = $row['password'];
	 }
	if(isset($_POST['editardatos'])){
		$usuarionuevo = $_POST['usuarionuevo'];
		$passnuevo = $_POST['passnuevo'];
		$nuevopasscifrado = password_hash($passnuevo, PASSWORD_DEFAULT);
	   if (!validarequerido($usuarionuevo)) {
      $errores[] = 'El nombre de usuario es obligatorio.';
   }
		if(!$errores){
			$sql6 = "SELECT * FROM users WHERE username ='$usuarionuevo'";
        	$res6 = mysqli_query($con, $sql6) or die(mysqli_error($con));
        	$row2 = mysqli_fetch_assoc($res6);
		if (($_POST['usuarionuevo'] ==  $username) && (empty($passnuevo))){
            $mensaje= "No has modificado ningun dato de tu perfil.";
		    header("location: /foro/index.php?mensaje=$mensaje");
            
        }else{
            if (($_POST['usuarionuevo'] ==  $username) && (!empty($passnuevo))){
                $sql7 = "UPDATE users SET password = '$nuevopasscifrado' WHERE id = '$usuariolog'";	
		          $res7 = mysqli_query($con, $sql7) or die(mysqli_error($con));
		          session_destroy();
     	          $mensaje= "Has editado tu contraseña satisfactoriamente.";
		          header("location: /foro/index.php?mensaje=$mensaje");
        }  
        }
           if (($_POST['usuarionuevo'] <>  $username) && (empty($passnuevo))){
                if($row2['username'] == $usuarionuevo){
				$errores[]= "El nombre de usuario ya esta en uso por favor intente con otro diferente..";
			}else{
                 $sql5 = "UPDATE users SET username = '$usuarionuevo' WHERE id = '$usuariolog'";	
		          $res5 = mysqli_query($con, $sql5) or die(mysqli_error($con));
		          session_destroy();
     	          $mensaje= "Has editado tu nombre de usuario satisfactoriamente.";
		          header("location: /foro/index.php?mensaje=$mensaje");   
                }
            }else{
             if (($_POST['usuarionuevo'] <>  $username) && isset($_POST['passnuevo'])){
                 if($row2['username'] == $usuarionuevo){
				$errores[]= "El nombre de usuario ya esta en uso por favor intente con otro diferente..";
			}else{
                   $sql4 = "UPDATE users SET password = '$nuevopasscifrado', username = '$usuarionuevo' WHERE id = '$usuariolog'";
    	           $res4 = mysqli_query($con, $sql4) or die(mysqli_error($con));
		          session_destroy();
     	          $mensaje= "Tus datos de perfil han sido editados satisfactoriamente.";
		          header("location: /foro/index.php?mensaje=$mensaje");         
                 }
             
        }
               }
        }
            }	
    if(isset($_GET['borrar'])){
	$sql = "DELETE FROM users WHERE id = '".$usuariolog."'";
    $res = mysqli_query($con, $sql) or die(mysqli_error($con));
	if($res){
		$sql2 = "DELETE FROM posts WHERE post_creador = '".$usuariolog."'";
    	$res2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
		session_destroy();
     	$mensaje= "Te has dado de baja en Salvador-Foro. Gracias por haber formado parte de nuestra comunidad";
		header("location: /foro/index.php?mensaje=$mensaje");
	}else{
		$mensaje= "ERROR: no se ha podido ejecutar la accion. Por favor intentelo mas tarde.";	
		}
    }
}

    ?>
			<br/>
			<br/>
			<?php if ($errores): ?>
       <span style="color: #f00; text-align:center;">
          <?php foreach ($errores as $error): ?>
             <li><?php echo $error?></li>
          <?php endforeach; ?>
       </span>
    <?php endif; ?>
<div id="mimsg">
<p>Si dejas el campo contrase&ntilde;a vacio mantendras por defecto tu contrase&ntilde;a actual</p>
<script language="JavaScript" type="text/javascript">timedMsg()</script>
</div>
<div id="contenido">
<div id="encabezadoreg">
<h3>Editar Credenciales</h3>
<hr />
</div>
<form method="post">
<p>Introduzca el nuevo usuario </p>	
<input type="text" class="entradas" name="usuarionuevo" value="<?php echo $username; ?>" required/>
<p>Introduzca la nueva contrase&ntilde;a </p>
<input type="password" class="entradas" name="passnuevo" value="" autocomplete="new-password" placeholder="Contrase&ntilde;a actual"/>
<br />
<input type="submit" name="editardatos" class="entradas" value="Editar"/>
</form>

	<hr />
<p>Haga clic <a style="color: cornflowerblue;" name="borrar" href="perfil.php?borrar" onclick="return confirm('¿Estas seguro que quieres cerrar la cuenta?')">aqui para cerrar su cuenta.</a></p>
</div>
</div>
</body>
</html>
   



