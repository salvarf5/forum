<?php
session_start();
if (($_SESSION['uid'] == "")){
    
}else{
    echo "Debes iniciar sesion para poder borrar un post.";
}
?>