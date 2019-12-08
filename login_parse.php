<?php

session_start();
include_once("../conexion.php");

if(isset($_POST['username'])){
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $sql = "SELECT * FROM users WHERE username='".$username."' LIMIT 1";
    $resultado = mysqli_query($con, $sql) or die(mysql_error());
    if (mysqli_num_rows($resultado) == 0){
        echo "No hay usuarios existentes con la informacion proporcionada.";
        }else{
        $fila = mysqli_fetch_assoc($resultado);
        if(password_verify($password,$fila['password'])){
        $_SESSION['uid'] = $fila['id'];
        $_SESSION['username'] = $fila['username'];
        header("location: /foro/index.php");
        exit();
    
}else{
    echo "Informacion de inicio de sesion incorrecta. Por favor regrese a la <a href='/foro/index.php'>pagina anterior.</a>";
    exit();
    }
}
}
?>