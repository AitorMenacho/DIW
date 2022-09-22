<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
    <?php
    
    include('../../PHP/db.php');

    if(isset($_SESSION['email'], $_SESSION['contrasenna']) ){

        $email = $_SESSION['email'];

        $datos = "SELECT * FROM usuarios WHERE Usuario_email = '$email'";
        $resultado = mysqli_query($conexion, $datos)
            or die( "Problemas al buscar usuario: ".mysqli_error($conexion) );

        while( $usuario = mysqli_fetch_array($resultado) ){

            $nombre = $usuario['Usuario_nombre'] . " " . $usuario['Usuario_apellido1'] . " " . $usuario['Usuario_apellido2'];

        }

    } else {

        header('location:../inicioSesion.php');

    }

    ?>


    <h1>Hola <?php echo $nombre ?></h1>
</body>
</html>