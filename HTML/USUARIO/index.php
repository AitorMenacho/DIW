<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CSS -->
    <link href="../../CSS/style-usuario.css" rel="stylesheet">

    <!-- Iconos Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Perfil</title>

    <script>
        $(document).ready(function() {

            $('#foto').on('click', function() {

                var email = $('#email').val();
                var dataString = 'email=' + email;

                Swal.fire({
                    title: 'Introduce la nueva foto de perfil',
                    input: 'file',
                    showCancelButton: true,
                    confirmButtonText: 'Subir',
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,

                    preConfirm: (login) => {

                        return fetch(`//api.github.com/users/${login}`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(response.statusText)
                                }
                                return response.json()
                            })
                            .catch(error => {
                                Swal.showValidationMessage(
                                    `Request failed: ${error}`
                                )
                            })
                    },

                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {

                    if (result.isConfirmed) {
                        Swal.fire({
                            title: `${result.value.login}'s avatar`,
                            imageUrl: result.value.avatar_url
                        })
                    }
                    
                })

            });

        });
    </script>
</head>

<body>
    <?php

    include('../../PHP/db.php');

    if (isset($_SESSION['email'], $_SESSION['contrasenna'])) {

        $email = $_SESSION['email'];
    } else {

        header('location:../inicioSesion.php');
    }



    $datos = "SELECT * FROM usuarios WHERE Usuario_email = '$email'";
    $resultado = mysqli_query($conexion, $datos)
        or die("Problemas al buscar usuario: " . mysqli_error($conexion));

    while ($usuario = mysqli_fetch_array($resultado)) {

        $nombre = $usuario['Usuario_nombre'];

    ?>

        <input type="hidden" name="email" id="email" value="<?php echo $email ?>">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark text.align-center">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand btn" id="foto" style="margin-left: 15px;"><img class="img-perfil" width="50px" src="../../IMG/usuario.jpg" alt="foto de perfil"> <?php echo $nombre ?> </a>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Página</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Página</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <a class="btn btn-outline-danger my-2 my-sm-0" style="margin-right: 15px;" type="submit">Cerrar sesión</a>
                </form>
            </div>
        </nav>

    <?php
    }





    if (empty($_REQUEST['confirmacion'])) {
        $confirmado = "";
    } else {
        $confirmado = $_REQUEST['confirmacion'];
    }

    if ($confirmado == "true") { ?>
        <script lang="JavaScript">
            Swal.fire({
                icon: 'success',
                title: '¡Confirmado!',
                text: 'Ya puedes usar la web con normalidad'
            })
        </script>
    <?php } ?>



</body>

</html>