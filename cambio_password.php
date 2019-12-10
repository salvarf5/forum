<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Foro - Crear Usuario</title>
    <link rel="stylesheet" type="text/css" href="/foro/estilos/style.php" />
</head>

<body>
    <div id="wraper">
        <?php echo "<a href='/foro/usuarios/logout_parse.php'>Regresar a la pagina de inicio</a>";?>

            <?php
$usuemail = "";
$nuevopass = "";
?>
                <hr />
                <br />
                <br />
                <br />
                <div id="contenido">
                    <div id="encabezadoreg">
                        <h3>Cambio Contrase&ntilde;a</h3>
                        <hr />
                    </div>

                    <form action="cambio_password_parse.php" method="post">
                        <p>Verifique su nombre de usuario o correo electronico </p>
                        <input type="text" name="usuemail" class="entradas" value="<?php echo $usuemail ?>" autocomplete="off" />
                        <p>Introduzca la nueva Contrase&ntilde;a </p>
                        <input type="password" name="nuevopass" class="entradas" value="<?php echo $nuevopass ?>" autocomplete="new-password" />
                        <br />
                        <input type="hidden" name="cambiopass" value="1" />
                        <input type="submit" name="cambiopass" class="entradas" value="Cambiar contrase&ntilde;a" />
                    </form>
                </div>
    </div>
</body>

</html>