<?php

//Nos conectamos con la base de datos.
include('db.php');

//Insertamos datos.
$query = "INSERT INTO alta(Usuario_nombre, Usuario_apellido1, Usuario_apellido2, Usuario_clave, Usuario_fecha_alta, Usuario_email) values 
                        ('$_REQUEST[nombre]',
                         '$_REQUEST[apellido1]',
                         '$_REQUEST[apellido2]',
                         '$_REQUEST[clave]',
                         '$fecha_alta',
                         '$_REQUEST[email]')";

        $registro = mysqli_query($conexion, $query) or die("Problemas al registrar usuario: " . mysqli_error($conexion));

?>
