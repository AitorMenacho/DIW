<?php

//Nos conectamos a la base de datos
include('db.php');

//Guardamos los datos en variables para que sea más facil trabajar con ellos
$email = $_REQUEST['usuario'];
$clave = $_REQUEST['clave'];

//Comprobamos si esos datos coinciden con alguno de la base
$consulta = "SELECT * FROM usuarios WHERE Usuario_email = '$email' AND Usuario_token_aleatorio = '$clave'";

$resultado = mysqli_query($conexion, $consulta)
    or die( "Problemas al buscar usuario: ".mysqli_error($conexion) );

while( $res = mysqli_fetch_array($resultado) ){

    mysqli_query($conexion, "UPDATE usuarios SET Usuario_bloqueado = '0' WHERE Usuario_id = '$res[Usuario_id]'") or
        die("Problemas al actualizar:" . mysqli_error($conexion));

    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['contrasenna'] = $contrasenna;

    header("location:../HTML/USUARIO/index.php?confirmacion=true");

    
}

?>