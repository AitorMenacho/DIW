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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Iconos Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Registro</title>
</head>

<body>

    <main>
        <div class="container">
            <h1 class="text-center p-4">Registro</h1>
            <form class="formulario" action="alta.php" method="post" name="f1">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-user'></i></span>
                    <input type="text" class="form-control" placeholder="Nombre" aria-label="nombre" name="nombre"
                        aria-describedby="basic-addon1">
                    <input type="text" class="form-control" placeholder="Primer apellido" aria-label="apellido1"
                        name="apellido1" aria-describedby="basic-addon1">
                    <input type="text" class="form-control" placeholder="Segundo apellido" aria-label="apellido2"
                        name="apellido2" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-envelope'></i></span>
                    <input type="email" class="form-control" placeholder="Email" aria-label="email" name="email"
                        aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-key'></i></span>
                    <input type="password" class="form-control" id="contrasenna" placeholder="Contraseña" aria-label="contrasenna" name="contrasenna" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-key'></i></span>
                    <input type="password" class="form-control" id="contrasennaR" placeholder="Repite la contraseña" aria-label="contrasenna" name="contrasenna" aria-describedby="basic-addon1">
                </div>

                <button type="submit">Registrarme</button>
            </form>
            <div class="enlace-contenedor">
                <a class="enlace" href="inicioSesion.html"> o inicia sesión</a>
            </div>
        </div>
    </main>

    <!-- MODAL CONFIRMACIÓN -->
    <?php
    if (empty($_REQUEST['confirmado'])) {
        $confirmado = "";
    } else {
        $confirmado = $_REQUEST['confirmado'];
    }
    if ($confirmado == "true") { ?>
        <script lang="JavaScript">
            Swal.fire({
                icon: 'success',
                title: '¡Genial!',
                text: 'Ya estás registrado.'
            })
        </script>
    <?php }
    if ($confirmado == "false") { ?>
        <script lang="JavaScript">
            Swal.fire({
                icon: 'error',
                title: '¡Oh...!',
                text: 'Ha ocurrido algun error, prueba más tarde o contacta con nosotros.'
            })
        </script>
    <?php } ?>
    <!-- MODAL CONFIRMACIÓN -->

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>