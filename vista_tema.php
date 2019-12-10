<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Foro - Posts</title>
    <link rel="stylesheet" type="text/css" href="/foro/estilos/style.css" />
    <link rel="stylesheet" type="text/css" href="/foro/estilos/style.php" />
</head>

<body>
    <div id="wraper">
        <h1 align="center">Salvador - Foro</h1>
        <br />
        <?php
session_start();
?>
            <div id="iniciosesion">
                <?php
if (!isset($_SESSION['uid'])){
    echo "<form action='/foro/usuarios/login_parse.php' method='post'>
    <p>Usuario: <input type='text' name='username' pattern='[A-Za-z0-9_-]{1,15}' required autocomplete='off'/> &nbsp;
    Contrase&ntilde;a: <input type='password' name='password' pattern='[A-Za-z0-9_-]{1,15}' required autocomplete='new-password'/>&nbsp;
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
include_once("../conexion.php");
$cid = $_GET['cid'];
$tid = $_GET['tid'];
$visitas_nueva = "";
$sql = "SELECT * FROM temas WHERE categoria_id='".$cid."' AND id='".$tid."' LIMIT 1";
$res = mysqli_query($con, $sql) or die(mysqli_error($con));
if (mysqli_num_rows($res) == 1){
    echo "<table width='100%'>";
    if (isset($_SESSION['uid'])) { echo "<tr><td colspan='2'><input type='submit' value='Agregar respuesta' onClick=\"window.location = 
    '/foro/posts/post_respuesta.php?cid=".$cid."&tid=".$tid."'\" /><hr />";} else {echo "<tr><td colspan='2'><p>Por favor inicia sesion para agregar respuesta</p></td></tr>";}
    while ($row = mysqli_fetch_assoc($res)){
        $sql2 = "SELECT * FROM posts WHERE categoria_id='".$cid."' AND tema_id='".$tid."'";
        $res2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
        while ($row2 = mysqli_fetch_assoc($res2)){
        $pid = $row2['id'];
        $sql4 = "select username from users where id = (select post_creador from posts where categoria_id='".$cid."' AND id='".$pid."')";
        $res4 = mysqli_query($con, $sql4) or die(mysqli_error($con));
        $row4 = mysqli_fetch_array($res4);
        $nombreusuario = $row4['username']; 
            echo "<tr><td valign='top' style='border: 1px solid #000000;'><div style='min-height: 125px;'><b>".$row['tema_titulo']."</b><spam class='edit'><a href='/foro/posts/borrar_post.php?cid=".$cid."&tid=".$tid."&pid=".$pid."'>Borrar</a> <a href='/foro/posts/editar_post.php?cid=".$cid."&tid=".$tid."&pid=".$pid."'>Editar | </a></spam><br />
            por <i>".$nombreusuario."</i> - ".$row2['post_fecha']."<hr />".$row2['post_contenido']."</div><tr><td colspan='2'></td></tr>";
        }
        $visitas_vieja = $row['tema_visitas'];
        $visitas_nueva = $visitas_vieja + 1;
        $sql3 = "UPDATE temas SET tema_visitas='".$visitas_nueva."' WHERE categoria_id='".$cid."' AND id='".$tid."' LIMIT 1";
        $res3 = mysqli_query($con, $sql3) or die(mysqli_error($con));
    }
    echo "</table>";
}else{
    echo "<p>Este tema no exsite</p>";
}
echo "<p><a href='/foro/categorias/vista_categoria.php?cid=".$cid."&tid=".$tid."'>Regresar a temas</a></p>";
?>
            </div>
    </div>
</body>

</html>