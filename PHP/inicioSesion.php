<?php

//Nos conectamos a la base de datos
include('db.php');

//Guardamos los datos en variables para que sea más facil trabajar con ellos
$email = $_REQUEST['email'];
$contrasenna = $_REQUEST['contrasenna'];

//Comprobamos si esos datos coinciden con alguno de la base
$consulta = "SELECT * FROM usuarios WHERE Usuario_email = '$email'";

$resultado = mysqli_query($conexion, $consulta)
    or die( "Problemas al buscar usuario: ".mysqli_error($conexion) );

while( $res = mysqli_fetch_array($resultado) ){

    if( !$res['Usuario_bloqueado'] ){

        if(password_verify($contrasenna, $res['Usuario_clave'])){
    
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['contrasenna'] = $contrasenna;
    
            header("location:../HTML/USUARIO/index.php");
    
        } else {
    
            $fallo = "false";
            header("location:../HTML/inicioSesion.php?confirmado=$fallo");
    
        }
    } else {
        
        $bloqueado = "true";
        header("location:../HTML/inicioSesion.php?bloqueado=true");
        
    }
    
}

?>