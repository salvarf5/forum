<?php
session_start();
if (($_SESSION['uid'] == "")){
    header("Location: /foro/index.php");
    exit();
   }
 if (isset($_POST['tema_enviar'])){
    if(($_POST['tema_titulo'] == "") && ($_POST['tema_contenido'] == "")){
        echo "Debe rellenar ambos campos para crear un tema. Por favor regrese a la pagina anterior";
        exit();
    }else{
        include_once("../conexion.php");
        $cid = $_POST['cid'];
        $titulo = $_POST['tema_titulo'];
        $contenido = $_POST['tema_contenido'];
        $creador = $_SESSION['uid'];
        $sql = "INSERT INTO temas (categoria_id, tema_titulo, tema_creador, tema_fecha, tema_respuesta_fecha) VALUES ('".$cid."', 
        '".$titulo."', '".$creador."', now(), now())";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));
        $nuevo_tema_id = mysqli_insert_id($con);
        $sql2 = "INSERT INTO posts (categoria_id, tema_id, post_creador, post_contenido, post_fecha) VALUES ('".$cid."', 
        '".$nuevo_tema_id."', '".$creador."', '".$contenido."', now())";
        $res2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
        $sql3 = "UPDATE categorias SET ultimo_post_fecha=now(), ultimo_usuario_post='".$creador."' WHERE id='".$cid."' LIMIT 1";
        $res3 = mysqli_query($con, $sql3) or die(mysqli_error($con));
        if (($res) && ($res2) && ($res3)){
            header("Location:/foro/temas/vista_tema.php?cid=".$cid."&tid=".$nuevo_tema_id);
        }else{
            echo "Ha habido un problema creando tu tema. Por favor intentelo de nuevo";
        }
    }
 } 
?>