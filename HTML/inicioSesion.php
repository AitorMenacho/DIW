<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y06BZPV9VE"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-Y06BZPV9VE');
    </script>
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
    <link rel="stylesheet" href="../CSS/style-registro.css">
    <link rel="stylesheet" href="../CSS/style-login.css">

    <!-- Iconos Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Inicio de sesión</title>

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                document.getElementById("longitud").innerHTML = "Sin geolocalización no puedes iniciar sesión.";
            }
        }

        function showPosition(position) {
            document.getElementById("latitud").value = position.coords.latitude
            document.getElementById("longitud").value = position.coords.longitude

        }
    </script>

</head>

<body onload="getLocation()">

    <main>
        <div class="container">
            <div class="formulario inicio">
                <?php

                if (empty($_REQUEST['confirmado'])) {
                    $confirmado = "";
                } else {
                    $confirmado = $_REQUEST['confirmado'];
                }

                if ($confirmado == "false") {
                ?>
                    <img class="img-port" src="../IMG/Sadface.svg" width="80%" alt="Carita triste">
                    <h1 class="text-center p-4 text-white">Oh no...</h1>

                <?php
                } else {
                ?>

                    <img class="img-port" src="../IMG/saludaFace.svg" width="80%" alt="Carita feliz">
                    <h1 class="text-center p-4 text-white">¡ Hola de nuevo !</h1>

                <?php
                }
                ?>
            </div>
            <div class="formulario">
                <form action="../PHP/inicioSesion.php" method="post">

                    <input type="hidden" id="latitud" name="latitud" value="">
                    <input type="hidden" id="longitud" name="longitud" value="">

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
                            Contraseña o usuario incorrecto o no es la ubicación donde iniciaste por primera vez.
                        </div>
                    <?php } ?>
                    <!-- MODAL CONFIRMACIÓN -->

                    <button class="btn boton" type="submit">
                        <p>Inciar sesión</p>
                    </button>
                    <a class="m-2 p-2" href="../index.php">Registrate</a>
                </form>
            </div>
        </div>
    </main>

    <!-- MODAL BLOQUEADO -->
    <?php
    if (empty($_REQUEST['bloqueado'])) {
        $bloqueado = "";
    } else {
        $bloqueado = $_REQUEST['bloqueado'];
    }

    if ($bloqueado == "true") { ?>

        <script lang="JavaScript">
            Swal.fire({
                icon: 'warning',
                title: 'Vaya vaya..',
                text: 'Parece que tienes la cuenta bloqueada.... Activala con el email que te hemos mandado.'
            })
        </script>
    <?php } ?>
    <!-- MODAL BLOQUEADO -->

    <!-- MODAL UBICACION -->
    <?php
    if (empty($_REQUEST['ubicacion'])) {
        $bloqueado = "";
    } else {
        $bloqueado = $_REQUEST['ubicacion'];
    }

    if ($bloqueado == "true") { ?>

        <script lang="JavaScript">
            Swal.fire({
                icon: 'info',
                title: 'Ups!',
                text: 'Tu ubicación actual no es la misma con la que te registraste.'
            })
        </script>
    <?php } ?>
    <!-- MODAL UBICACION -->

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" />
</body>

</html>