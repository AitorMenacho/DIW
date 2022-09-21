<?php

//Nos conectamos con la base de datos.
include('db.php');

$fecha_alta = date('Y-m-d');

//Insertamos datos.
$query = "INSERT INTO usuarios(Usuario_nombre, Usuario_apellido1, Usuario_apellido2, Usuario_clave, Usuario_fecha_alta, Usuario_email) values 
                        ('$_REQUEST[nombre]',
                         '$_REQUEST[apellido1]',
                         '$_REQUEST[apellido2]',
                         '$_REQUEST[contrasenna]',
                         '$fecha_alta',
                         '$_REQUEST[email]')";

$registro = mysqli_query($conexion, $query) or die("Problemas al registrar usuario: " . mysqli_error($conexion));

//Buscamo el usuario que acabamos de registrar para ver si existe
$sql = "SELECT * FROM usuarios WHERE Usuario_email = '$_REQUEST[email]'";
$result = $conexion->query($sql);

//Si existe
if ($result > 0) {

    //Mandamos mensaje de confirmación
    $confirmado = "true";
    header("location:registro.php?confirmado=$confirmado");

//Si no
} else {

    //Mandamos mensaje de error
    $confirmado = "false";
    header("location:registro.php?confirmado=$confirmado");
}

?>
