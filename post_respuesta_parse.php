<?php
session_start();
if (($_SESSION['uid'])){
    if (isset($_POST['respuesta_enviar'])){
        include_once("../conexion.php");
        $creador = $_SESSION['uid'];
        $cid = $_POST['cid'];
        $tid = $_POST['tid'];
        $respuesta_contenido = $_POST['respuesta_contenido'];
        $sql = "INSERT INTO posts (categoria_id, tema_id, post_creador, post_contenido, post_fecha) VALUES ('".$cid."', '".$tid."',
        '".$creador."', '".$respuesta_contenido."', now())";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));
        $sql2 = "UPDATE categorias SET ultimo_post_fecha=now(), ultimo_usuario_post='".$creador."' WHERE id='".$cid."' LIMIT 1";
        $res2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
        $sql3 = "UPDATE temas SET tema_respuesta_fecha=now(), tema_ultimo_usuario='".$creador."'WHERE id='".$tid."' LIMIT 1";
        $res3 = mysqli_query($con, $sql3) or die(mysqli_error($con));
        $sql6 = "SELECT username FROM users WHERE id='".$creador."' LIMIT 1";
        $res6 = mysqli_query($con, $sql6) or die(mysqli_error($con));
        $row6 = mysqli_fetch_assoc($res6);
        
        //Enviar correo
        $userids = array();
        $email = "";
        $nombreusuario = "";
        $nombreusuariocreador = $row6['username'];
        $sql4 = "SELECT post_creador FROM posts WHERE categoria_id='".$cid."' AND tema_id='".$tid."' GROUP BY post_creador";
        $res4 = mysqli_query($con, $sql4) or die(mysqli_error($con));
        while ($row4 = mysqli_fetch_assoc($res4)){
            $userids[] .= $row4['post_creador'];
        }
        foreach ($userids as $key) {
            $sql5 = "SELECT id, username, email FROM users WHERE id='".$key."' AND foro_notificacion='1' LIMIT 1";
            $res5 = mysqli_query($con, $sql5) or die(mysqli_error($con));
            if (mysqli_num_rows($res5) > 0){
                $row5 = mysqli_fetch_assoc($res5);
                if ($row5['id'] != $creador){
                    $email .= $row5['email'].", ";
                    $nombreusuario .= $row5['username']."! ";
                    
                }
            }
        }
        $asunto = "Respuesta post";
        $mensaje = "Hola $nombreusuario el usuario <b><i>$nombreusuariocreador</i></b> ha respondido a tu post.";
        $from = "Foro Respuesta";
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: ".$from."\r\n";

        mail($email,$asunto,$mensaje,$headers);
        if (($res) && ($res2) && ($res3)){
            echo "<p>Tu respuesta ha sido posteada. <a href='/foro/categorias/vista_categoria.php?cid=".$cid."&tid=".$tid."'>Clic para regresar a temas</a></p>";
        } else{
            echo "<p>Ha habido un problema posteando tu respuesta. Intentalo de nuevo mas tarde</p>";
        }
    } else{
        exit();
    }
} else{
    exit();
}
?>