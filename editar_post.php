<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Editar Post</title>
  <link rel="stylesheet" type="text/css" href="/foro/estilos/style.php"/>
</head>
<?php
session_start();
include_once("../conexion.php");
$cid = $_GET['cid'];
$tid = $_GET['tid'];
$pid = $_GET['pid'];
if (isset($_SESSION['uid'])){
    $usuariolog = $_SESSION['uid'];
    $sql = "SELECT * FROM posts WHERE categoria_id='".$cid."' AND tema_id='".$tid."' AND id='".$pid."'";
    $res = mysqli_query($con, $sql) or die(mysqli_error($con));
    while($row = mysqli_fetch_assoc($res)){
    if($row['post_creador']==$usuariolog){
        $contenidopostviejo = $row['post_contenido'];
        echo "<div id='contenido2'><form action='' method='post'>
            <textarea name='contenido' rows='5' cols='75'>$contenidopostviejo</textarea> &nbsp;
            <br /><br />
            <input type='submit' name='editar' value='Editar' /></div>";
        if(isset($_POST['editar'])){
            $contenidopostnuevo = $_POST['contenido'];
            $sql2 = "UPDATE posts SET post_contenido='".$contenidopostnuevo."' WHERE categoria_id='".$cid."' AND tema_id='".$tid."' AND id='".$pid."'";
            $res2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
            echo '<script type="text/javascript">
            alert("Post editado con exito.");
            location="/foro/temas/vista_tema.php?cid='.$cid.'&tid='.$tid.'";
            </script>';
            
        }
    }else{
        echo "Accion denegada. No eres el creador de este post.";
    }
     }   
}else{
    echo "Debes iniciar sesion para editar este post.";
}
?>
</html>