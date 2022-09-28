<?php

//Nos conectamos con la base de datos.
include('db.php');

$fecha_alta  = date('Y-m-d');
$contrasenna = password_hash($_REQUEST['contrasenna'], PASSWORD_DEFAULT);

$numConfirmacion = rand(1000, 9999);
$bloqueado = '1';

//Insertamos datos.
$query = "INSERT INTO usuarios(Usuario_nombre, Usuario_apellido1, Usuario_apellido2, Usuario_clave, Usuario_fecha_alta, Usuario_email, Usuario_bloqueado, Usuario_token_aleatorio) values 
                        ('$_REQUEST[nombre]',
                         '$_REQUEST[apellido1]',
                         '$_REQUEST[apellido2]',
                         '$contrasenna',
                         '$fecha_alta',
                         '$_REQUEST[email]',
                         '$bloqueado',
                         '$numConfirmacion')";

$registro = mysqli_query($conexion, $query) or die("Problemas al registrar usuario: " . mysqli_error($conexion));

//Buscamo el usuario que acabamos de registrar para ver si existe
$sql = "SELECT * FROM usuarios WHERE Usuario_email = '$_REQUEST[email]'";
$result = $conexion->query($sql);

//Si existe
if (mysqli_num_rows($result) > 0) {
    
    $codigo = 'Para confirmar tu correo clica en <a href="https://aitormenachovega.000webhostapp.com/PHP/confirmacion.php?usuario='.$_REQUEST['email'].'&clave='.$numConfirmacion.'">Activar</a>';

    //Mandamos un email de confirmación
    $email   = $_REQUEST['email'];
    $asunto  = 'Confirmación de aitormenachovega.com';
    $msg     = "$codigo";
    $header  = 'From: noreply@aitormv.com' . '\r\n';
    $header .= 'Reply-to: noreply@aitormv.com' . '\r\n';
    $header .= 'X-Mailer: PHP/'. phpversion();
    
    $mail = @mail($email, $asunto, $msg, $header);
    
    if($mail){
    
        //Si se envía mandamos mensaje de confirmación
        $confirmado = "true";
        header("location:../index.php?confirmado=$confirmado");
        
    } else {
        
        //Si no mandamos mensaje de error
        $confirmado = "false";
        header("location:../index.php?confirmado=$confirmado");
        
    }

//Si no
} else {

    //Mandamos mensaje de error
    $confirmado = "false";
    header("location:../index.php?confirmado=$confirmado");
}

?>