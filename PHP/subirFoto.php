<?php

include('./db.php');

$fecha = date('d-m-Y');

# definimos la carpeta destino

$carpetaDestino="../IMG/perfiles/".$_REQUEST['id']."/";

# si hay algun foto que subir

if(isset($_FILES["foto"]) && $_FILES["foto"]["name"][0])

{

        # si es un formato de foto

        if($_FILES["foto"]["type"]=="image/jpeg" || $_FILES["foto"]["type"]=="image/pjpeg" || $_FILES["foto"]["type"]=="image/gif" || $_FILES["foto"]["type"]=="image/png")

        {

            # si exsite la carpeta o se ha creado

            if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))

            {

                $origen    = $_FILES["foto"]["tmp_name"];
                $nombreImg = $fecha."_".$_FILES["foto"]["name"];
                $destino   = $carpetaDestino.$nombreImg;

                # movemos el foto

                if(@move_uploaded_file($origen, $destino))

                {

                  mysqli_query($conexion, "UPDATE usuarios SET 
                        Usuario_fotografia_enlace = '$nombreImg'
                     WHERE Usuario_id = '$_REQUEST[id]'") or
                  die("Problemas al actualizar:" . mysqli_error($conexion));

                  header("location:../HTML/USUARIO/index.php");

                } else {

                    echo "Hola";
            
                }

            } else {

                echo "Adios";
        
            }

        }

    }

?>
