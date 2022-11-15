<?php

include("../db.php");

$usuarios = $_REQUEST['usuarios'];
$tamaño   = sizeof($usuarios);

for ($x=0; $x < $tamaño; $x++) { 
    
    $usuario = $usuarios[$x];
    $sql = "UPDATE usuarios SET Usuario_bloqueado = 0 WHERE Usuario_id = $usuario";
    $result = mysqli_query($conexion, $sql);

}

header("location:../../HTML/USUARIO/index.php?actualizado=true");

?>