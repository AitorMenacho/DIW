<?php

include('../../PHP/db.php');

$email = $_REQUEST['email'];

$usuario = "SELECT * FROM usuarios WHERE Usuario_email = '$email'";

$datos = mysqli_query($conexion, $usuario)
                or die( "Problemas al buscar usuario: ".mysqli_error($conexion) );

while( $dat = mysqli_fetch_array($datos) ){

    $nombre = $dat['Usuario_nombre'];
    $apellido1 = $dat['Usuario_apellido1'];
    $apellido2 = $dat['Usuario_apellido2'];
    $email = $dat['Usuario_email'];

    //Mandamos mensaje de error
    echo 'Nombre: ' . $nombre . ' ' . $apellido1 . ' ' . $apellido2 . "</br>" . 'Email: ' . $email;

}
?>