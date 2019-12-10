<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Foro - Crear Usuario</title>
    <link rel="stylesheet" type="text/css" href="/foro/estilos/style.php" />
</head>

<body>
    <div id="wraper">
        <?php echo "<a href='logout_parse.php'>Regresar a la pagina de inicio</a>";?>

            <?php
$nuevouser = "";
$nuevopass = "";
$nuevoemail = "";
?>
                <hr />
                <br />
                <br />
                <br />
                <div id="contenido">
                    <div id="encabezadoreg">
                        <h3>Registro de usuario</h3>
                        <hr />
                    </div>

                    <form action="crear_usuario_parse.php" method="post">
                        <p>Nombre usuario: </p>
                        <input type="text" name="usuarionuevo" class="entradas" value="<?php echo $nuevouser ?>" autocomplete="off" />
                        <p>Contrase&ntilde;a: </p>
                        <input type="password" name="passnuevo" class="entradas" value="<?php echo $nuevopass ?>" autocomplete="new-password" />
                        <p>Email: </p>
                        <input type="email" name="emailnuevo" class="entradas" value="<?php echo $nuevoemail ?>" autocomplete="off" />
                        <br />
                        <input type="hidden" name="registro" value="1" />
                        <input type="submit" name="crear_usuario" class="entradas" value="Crear usuario" />
                    </form>
                </div>
    </div>
</body>

</html>