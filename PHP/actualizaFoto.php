<?php

/* Iniciar conexión con la base de datos */
include("db.php");

# definimos la carpeta destino
$carpetaDestino = "../IMG/perfiles/" . $_REQUEST['id'] . "/";

$fecha = date('d-m-Y');

if (isset($_FILES["foto"]) && $_FILES["foto"]["name"][0]) {

    # si es un formato de imagen
    if ($_FILES["foto"]["type"] == "image/jpeg" || $_FILES["foto"]["type"] == "image/pjpeg" || $_FILES["foto"]["type"] == "image/jpg" || $_FILES["foto"]["type"] == "image/png") {

        # si exsite la carpeta o se ha creado
        if (file_exists($carpetaDestino) || @mkdir($carpetaDestino)) {

            $origen = $_FILES["foto"]["tmp_name"];
            $destino = $carpetaDestino . $fecha . "_" . $_FILES["foto"]["name"];

            # movemos el archivo
            if (@move_uploaded_file($origen, $destino)) {
                $nombre = $fecha."_".$_FILES["foto"]["name"];

                /* Actualiza los datos */
                mysqli_query($conexion, "UPDATE usuarios SET     
                                    
                            Usuario_fotografia_enlace = '$nombre'
     
                WHERE Usuario_id='$_REQUEST[id]'") or
                    die("Problemas al actualizar:" . mysqli_error($conexion));

                header("location:../HTML/USUARIO/index.php");
            }
        }
    } else {

        header("location:../HTML/USUARIO/index.php?confirmacion=false");
    }
}
