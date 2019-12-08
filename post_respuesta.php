<?php session_start(); ?>
<?php
if (!isset($_SESSION['uid']) || ($_GET['cid'] == "")){
    header("Location: /foro/index.php");
    exit();
}
$cid = $_GET['cid'];
$tid = $_GET['tid'];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Foro - Responder</title>
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
<form action="/foro/posts/post_respuesta_parse.php" method="post">
<p>A&ntilde;ade tu respuesta aqui:</p>
<textarea name="respuesta_contenido" rows="5" cols="75" required=""></textarea>
<br /><br />
<input type="hidden" name="cid" value="<?php echo $cid; ?>" />
<input type="hidden" name="tid" value="<?php echo $tid; ?>" />
<input type="submit" name="respuesta_enviar" value="Postear respuesta"/>
</form>
</div>
</div>
</body>
</html>