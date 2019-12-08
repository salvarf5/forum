<?php session_start(); ?>
<?php
if (!isset($_SESSION['uid']) || ($_GET['cid'] == "")){
    header("Location: /foro/index.php");
    exit();
}
$cid = $_GET['cid'];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Foro - Crear Tema</title>
  <link rel="stylesheet" type="text/css" href="/foro/estilos/style.css"/>
  <link rel="stylesheet" type="text/css" href="/foro/estilos/style.php"/>
</head>
	
	<body>
		<div id="wraper">
			<h1 align="center">Salvador - Foro</h1><br />
<div id="iniciosesion">
<?php
echo "<p>Has iniciado sesion como <i><a data-tooltip='Perfil' href='/foro/usuarios/perfil.php'>".$_SESSION['username']."</a></i> &bull; <input type='submit' value='Cerrar sesion' onClick=\"window.location = 
    '/foro/usuarios/logout_parse.php'\" /></p>";
?>
</div>

<hr />
<div id="categorias">
<form action="/foro/temas/crear_tema_parse.php" method="post">
<p>Titulo de tema:</p>
<input type="text" name="tema_titulo" size="98" maxlength="150"/>
<p>Contenido del tema:</p>
<textarea name="tema_contenido" rows="5" cols="75"></textarea>
<br /><br />
<input type="hidden" name="cid" value="<?php echo $cid; ?>"/>
<input type="submit" name="tema_enviar" value="Crear Tema"/>
</form>
</div>
</div>
</body>
</html>