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

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link href="../../CSS/style-usuario.css" rel="stylesheet">
    <link href="../../CSS/style.css" rel="stylesheet">

    <!-- Iconos Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Busqueda</title>
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
        $id     = $usuario['Usuario_id'];
        $imagen = $usuario['Usuario_fotografia_enlace'];
    }
    ?>

    <input type="hidden" name="email" id="email" value="<?php echo $email ?>">

    <nav class="navbar navbar-expand-lg text-align-center">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <button type="button" class="navbar-brand btn text-light" id="foto" style="margin-left: 15px;" data-bs-toggle="modal" data-bs-target="#cambioPerfil"><img class="img-perfil" style="width: 50px; height: 50px;" src=" <?php if ($imagen != null) { ?> ../../IMG/perfiles/<?php echo $id . "/" . $imagen;
                                                                                                                                                                                                                                                                                    } else { ?> ../../IMG/usuario.jpg  <?php } ?>" alt="foto de perfil"> <?php echo $nombre ?> </button>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 mx-auto">
                <li class="nav-item active">
                    <a class="nav-link text-light" href="./index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="./busqueda.php">Busqueda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="./usuario.php">Perfil</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a class="btn btn-outline-light my-2 my-sm-0" style="margin-right: 15px;" href="../../PHP/cierra_sesion.php">Cerrar sesión</a>
            </form>
        </div>
    </nav>

    <main>
        <div class="container">
            <div class="formulario">
                <form action="filtrado.php" method="get" id="f1">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class='bx bx-key'></i></span>
                        <select class="form-control" name="estado" id="estado">
                            <option value="">Escoge un estado</option>
                            <option value="0">Desbloqueados</option>
                            <option value="1">Bloqueados</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class='bx bx-user'></i></span>
                        <input type="text" class="form-control" id="nombre" placeholder="nombre" aria-label="nombre" name="nombre" aria-describedby="basic-addon1">
                    </div>
                    <div class="">
                        <button class="boton btn" type="submit">Filtrar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>


</body>

</html>