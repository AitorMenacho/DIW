<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/style.css">

    <!-- Iconos Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Inicio de sesión</title>
</head>

<body>

    <main>
        <div class="container">
            <?php

            if (empty($_REQUEST['confirmado'])) {
                $confirmado = "";
            } else {
                $confirmado = $_REQUEST['confirmado'];
            }

            if ($confirmado == "false") {
            ?>
                <h1 class="entrada text-center p-2">Oh no...</h1>
                <img class="mx-auto d-block carita" src="../IMG/Sadface.svg" alt="Carita feliz">

            <?php
            } else {
            ?>

                <h1 class="entrada text-center p-2">¡ Hola de nuevo !</h1>
                <img class="mx-auto d-block carita" src="../IMG/Happyface.svg" alt="Carita feliz">

            <?php
            }
            ?>

            <form class="formulario" action="../PHP/inicioSesion.php" method="post">

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-envelope'></i></span>
                    <input type="email" class="form-control" placeholder="Email" aria-label="email" name="email" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-key'></i></span>
                    <input type="password" class="form-control" id="contrasenna" placeholder="Contraseña" aria-label="contrasenna" name="contrasenna" aria-describedby="basic-addon1">
                </div>

                <!-- MODAL CONFIRMACIÓN -->
                <?php

                if ($confirmado == "false") { ?>
                    <div class="alert alert-danger" role="alert">
                        Contraseña o usuario incorrecto.
                    </div>
                <?php } ?>
                <!-- MODAL CONFIRMACIÓN -->

                <button type="submit">Inciar sesión</button>
            </form>
            
            <!-- MODAL BLOQUEADO -->
            <?php
            if (empty($_REQUEST['bloqueado'])) {
                $bloqueado = "";
            } else {
                $bloqueado = $_REQUEST['bloqueado'];
            }
            
            if ($bloqueado == "true") { ?>

                <script lang="JavaScript">

                    var link  = "https://aitormenachovega.000webhostapp.com/PHP/confirmacion.php?usuario=$email&clave=$numConfirmacion"

                    Swal.fire({
                        icon: 'info',
                        title: 'Vaya vaya..',
                        text: 'Parece que tienes la cuenta bloqueada.... Activala con el email que te hemos mandado mandamos.'
                    })

                </script>
            <?php } ?>
            <!-- MODAL BLOQUEADO -->
            
            <div class="enlace-contenedor">
                <a class="enlace" href="../index.php"> o Registrate</a>
            </div>
        </div>

    </main>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"/>
    </body>

</html>