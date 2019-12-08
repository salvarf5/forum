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
        $sql2 = "DELETE FROM posts WHERE categoria_id='".$cid."' AND tema_id='".$tid."' AND id='".$pid."'";
        $res2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
        echo '<script type="text/javascript">
            alert("Post borrado con exito.");
            location="/foro/temas/vista_tema.php?cid='.$cid.'&tid='.$tid.'";
            </script>';
            
    }else{
        echo "Accion denegada. No eres el creador de este post.";
    }
     }   
}else{
    echo "Debes iniciar sesion para borrar este post.";
}
?>