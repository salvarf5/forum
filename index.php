<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Foro</title>
  <link rel="stylesheet" type="text/css" href="estilos/style.css"/>
  <link rel="stylesheet" type="text/css" href="estilos/style.php"/>
</head>
	
	<body>
		<div id="wraper">
			<h1 align="center">Salvador - Foro</h1><br />
            
<?php
session_start();
?>
<ul style="color: #f00; text-align:center;">
<?php
if(isset($_GET['mensaje'])){ 
	$mensaje = $_GET['mensaje'];
	echo $mensaje;}
?>
</ul>
<?php
if (isset($_GET['status'])){
        if ($_GET['status'] == 'reg_success'){
        echo "<script>alert('Usuario creado con exito. Recibirá  un email de confirmacion de registro.')</script>";
        }else if ($_GET['status'] == 'cambiado'){
        echo "<script>alert('Contraseña cambiada con exito.')</script>";
        }
        }
			
?>
<div id="iniciosesion">
<?php
if (!isset($_SESSION['uid'])){
    echo "<form action='/foro/usuarios/login_parse.php' method='post'>
    <p>Usuario: <input type='text' name='username' pattern='[A-Za-z0-9_-]{1,15}' required autocomplete='off'/> &nbsp;
    Contrase&ntilde;a: <input type='password' name='password' pattern='[A-Za-z0-9_-]{1,15}' required autocomplete='new-password' />&nbsp;
    <input type='submit' name='submit' value='Iniciar sesion' />
    ";
    echo "<input type='submit' value='Crear usuario' onClick=\"window.location = 
    '/foro/usuarios/crear_usuario.php'\" /></p>";
    echo "<p class='olvidado'><a href='/foro/usuarios/cambio_password.php'>&iquest;Has olvidado la contrase&ntilde;a?</a></p>";
}else{
        echo "<p>Has iniciado sesion como <i><a data-tooltip='Perfil' href='/foro/usuarios/perfil.php'>".$_SESSION['username']."</a></i> &bull; <input type='submit' value='Cerrar sesion' onClick=\"window.location = 
    '/foro/usuarios/logout_parse.php'\" /></p>";
        
}
?>
</div>
<hr />
<div id="categorias">
<?php
include_once("conexion.php");
$sql = "SELECT * FROM categorias ORDER BY categoria_titulo ASC";
$res = mysqli_query($con, $sql) or die(mysqli_error());
$categorias = "";
if (mysqli_num_rows($res) > 0){
    while ($row = mysqli_fetch_assoc($res)){
        $id = $row['id'];
        $titulo = $row['categoria_titulo'];
        $descripcion = $row['categoria_descripcion'];
        $categorias = "<a href='/foro/categorias/vista_categoria.php?cid=".$id."' class='catlinks'>".$titulo." - <font size='-1'>".$descripcion."</font></a>";
    echo $categorias;
    } 
}else {
    echo "<p> Todavia no hay categorias disponibles";
}
?>

</div>
</div>
</body>
</html>