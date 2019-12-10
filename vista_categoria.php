<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Foro - Categorias</title>
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
 $row_cnt = "";
if (isset($_SESSION['uid'])){
    $logged = " | <a href=/foro/temas/crear_tema.php?cid=".$cid.">Haz clic aqui para crear un tema</a>";
}else{
    $logged = " | Por favor inicie sesion para crear un tema en este foro";
}
$temas = "";
$sql = "SELECT id FROM categorias WHERE id='".$cid."' LIMIT 1";
$res = mysqli_query($con, $sql) or die(mysqli_error());
if (mysqli_num_rows($res) == 1){
    $sql2 = "SELECT * FROM temas WHERE categoria_id='".$cid."' ORDER BY tema_respuesta_fecha DESC";
    $res2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
    if (mysqli_num_rows($res2) > 0){
    $temas .= "<table width='100%' style='border-collapse: collapse;'>";
    $temas .= "<tr><td colspan='3'><a href='/foro/index.php'>Regresar a la pagina de inicio</a>".$logged."<hr/></td></tr>";
    $temas .= "<tr style='background-color: #dddddd;'><td>Titulo del tema</td><td width='65' align='center'>Respuestas</td><td width='65' align='center'>Visitas</td></tr>";
    $temas .= "<tr><td colspan='3'><hr/></td></tr>";
    while ($row = mysqli_fetch_assoc($res2)){
        $tid = $row['id'];
        $titulo = $row['tema_titulo'];
        $visitas = $row['tema_visitas'];
        $fecha = $row['tema_fecha'];
        $creador = $row['tema_creador'];
         $sql3 = "SELECT * FROM posts WHERE categoria_id='".$cid."' AND tema_id='".$tid."'";
        $res3 = mysqli_query($con, $sql3) or die(mysqli_error($con));
        //contar respuestas
        $row_cnt = mysqli_num_rows($res3);
        $sql4 = "select username from users where id = (select tema_creador from temas where categoria_id='".$cid."' AND id='".$row['id']."')";
        $res4 = mysqli_query($con, $sql4) or die(mysqli_error($con));
        $row4 = mysqli_fetch_array($res4);
        $nombreusuario = $row4['username']; 
        $temas .= "<tr><td><a href='/foro/temas/vista_tema.php?cid=".$cid."&tid=".$tid."' class='catlinks2'>".$titulo."</a><br/><span class='postinfo'>Creado por: <i>".$nombreusuario."</i> el ".$fecha."</span></td><td align='center' class='contar'>".$row_cnt."</td><td align='center' class='contar'>".$visitas."</td></tr>";
        $temas .= "<tr><td colspan='3'><hr/></td></tr>";

    }
    $temas .="</table>";
    echo $temas;
    }else{
        echo "<a href='/foro/index.php'> Regresar a la pagina de inicio</a><hr/>";
        echo "<p>No hay temas en esta categoria todavia".$logged."</p>";
    }
}else{
    echo "<a href='/foro/index.php'> Regresar a la pagina de inicio</a><hr/>";
    echo "<p>Estas intentando ver una categoria que no existe todavia";
}

?>
            </div>
    </div>
</body>

</html>