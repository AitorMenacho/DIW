<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    
    <title>Perfil</title>
</head>
<body>
    <?php
    
    include('../../PHP/db.php');

    if(isset($_SESSION['email'], $_SESSION['contrasenna']) ){

        $email = $_SESSION['email'];

    } else {

        header('location:../inicioSesion.php');

    }

    

    $datos = "SELECT * FROM usuarios WHERE Usuario_email = '$email'";
    $resultado = mysqli_query($conexion, $datos)
                or die( "Problemas al buscar usuario: ".mysqli_error($conexion) );

    while( $usuario = mysqli_fetch_array($resultado) ){

        $nombre = $usuario['Usuario_nombre'] . " " . $usuario['Usuario_apellido1'] . " " . $usuario['Usuario_apellido2'];
    
    }

    if (empty($_REQUEST['confirmacion'])) {
        $confirmado = "";
    } else {
        $confirmado = $_REQUEST['confirmacion'];
    }

    if ($confirmado == "true") { ?>
        <script lang="JavaScript">
            Swal.fire({
                icon: 'success',
                title: '¡Confirmado!',
                text: 'Ya puedes usar la web con normalidad'
            })
        </script>
    <?php } ?>

    

    <h1>Hola <?php echo $nombre ?></h1>
</body>
</html>