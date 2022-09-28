<?php

    //Nos conectamos con la bbdd
    require('db.php');

    //Si viene definido
    if(isset($_POST)){

        //Guardamos el teléfono en una variable
        $email = $_POST['email'];

        //Sacamos si existe
        $resultaoPre = $conexion -> query(
            "SELECT * FROM usuarios WHERE Usuario_email = '$email'"
        );

        //Si existe
        if($resultaoPre->num_rows >= 1){

            //Mandamos mensaje de error
            echo '<div class="alert alert-danger"> este email está registrado </div>';

        }
    }

    //Cerramos la conexión
    mysqli_close($conexion)

?>