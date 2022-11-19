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

    <title>Filtrado</title>
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
        <form action="../../PHP/ADMIN/activarMultiplesUsuarios.php" method="post">
            <div class="subMenu">
                <p class="text-light">Botones generales</p>
                <button type="submit" class="btn boton"><i class='bx bx-key'></i></button>
            </div>
            <div class="cuerpo">

                <?php

                //Número de resultados por páginass que queremos.
                if (!isset($_GET['ressultados'])) {

                    $resultado_por_pagina = 6;
                }

                //Sacamos todos los usuarios de la página
                $sql = 'SELECT * FROM usuarios';

                $clauses = array();
                //These two variables might be created via a form request.
                $column1 = $_GET['nombre'];
                $column2 = $_GET['estado'];

                if ( !empty($column1) ) {
                    $clauses[] = 'Usuario_nombre = "' . $column1 . '"';
                }
                if ( !empty($column2) | $column2 == 0 ) {
                    $clauses[] = 'Usuario_bloqueado = "' . $column2 . '"';
                }

                if (count($clauses) > 0) {
                    $sql .= ' WHERE ' . implode(' AND ', $clauses);
                }

                $resultado = mysqli_query($conexion, $sql)
                    or die("Problemas al buscar usuario: " . mysqli_error($conexion));

                //Guardamos el número de resultados que tenemos.
                $numero_de_resultados = mysqli_num_rows($resultado);                

                /* Número de páginas que vamos a tener dependiendo de lo resultado que tengamos y
                        queramos ver. */
                $numero_de_paginas = ceil($numero_de_resultados / $resultado_por_pagina);

                //Determina el número de páginas
                if (!isset($_GET['pagina'])) {

                    $pagina = 1;
                    
                } else {

                    $pagina = $_GET['pagina'];
                }

                //Determinamos el número de la primera página
                $pagina_primer_resutlado = ($pagina - 1) * $resultado_por_pagina;

                //Sacamos el resultado limitado
                $sql .= " LIMIT " . $pagina_primer_resutlado . ',' . $resultado_por_pagina.';';
                $result = mysqli_query($conexion, $sql);

                while ($usuario = mysqli_fetch_array($result)) {

                    if ($usuario['Usuario_bloqueado'] == 1) {

                ?>

                        <div class="card-block" style="width: 18rem;">
                            <div class="checkBorrar">
                                <input type="checkbox" name="usuarios[]" id="check-usu" value="<?php echo $usuario['Usuario_id'] ?>">
                                <span class="checkmark"></span>
                            </div>
                            <div class="card-body">
                                <?php

                                if (!empty($usuario['Usuario_fotografia_enlace'])) {

                                ?>

                                    <img class="img-perfil img-modal" src="../../IMG/perfiles/<?php echo $usuario['Usuario_id'] . "/" . $usuario['Usuario_fotografia_enlace'] ?>" alt="usuario" style="width: 100px; height: 100px;">

                                <?php

                                } else {

                                ?>

                                    <img class="img-perfil img-modal" src="../../IMG/usuario.jpg" alt="usuario" style="width: 100px; height: 100px;">

                                <?php

                                }

                                ?>

                                <h5 class="text-center text-light"><?php echo $usuario['Usuario_nombre'] . " " . $usuario['Usuario_apellido1'] . " " . $usuario['Usuario_apellido2'] ?></h5>
                                <div class="card-button row align-items-center">
                                    <div class="col text-center">
                                        <a href="../../PHP/ADMIN/eliminarUsuario.php" class="btn btn-danger"> <i class='bx bx-trash'></i></a>
                                        <a href="../../PHP/ADMIN/editarUsuario.php" class="btn btn-secondary"> <i class='bx bx-pencil'></i></a>
                                        <a href="../../PHP/ADMIN/activarUsuario.php" class="btn btn-light"> <i class='bx bx-key'></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php

                    } else {

                    ?>

                        <div class="card" style="width: 18rem;">
                            <div class="checkBorrar">
                                <input type="checkbox" name="usuarios[]" id="check-usu" value="<?php echo $usuario['Usuario_id'] ?>">
                                <span class="checkmark"></span>
                            </div>
                            <div class="card-body">
                                <?php

                                if (!empty($usuario['Usuario_fotografia_enlace'])) {

                                ?>

                                    <img class="img-perfil img-modal" src="../../IMG/perfiles/<?php echo $usuario['Usuario_id'] . "/" . $usuario['Usuario_fotografia_enlace'] ?>" alt="usuario" style="width: 100px; height: 100px;">

                                <?php

                                } else {

                                ?>

                                    <img class="img-perfil img-modal" src="../../IMG/usuario.jpg" alt="usuario" style="width: 100px; height: 100px;">

                                <?php

                                }

                                ?>

                                <h5 class="text-center text-light"><?php echo $usuario['Usuario_nombre'] . " " . $usuario['Usuario_apellido1'] . " " . $usuario['Usuario_apellido2'] ?></h5>
                                <div class="card-button row align-items-center">
                                    <div class="col text-center">
                                        <a href="../../PHP/ADMIN/eliminarUsuario.php" class="btn btn-danger"> <i class='bx bx-trash'></i></a>
                                        <a href="../../PHP/ADMIN/editarUsuario.php" class="btn btn-secondary"> <i class='bx bx-pencil'></i></a>
                                        <a href="../../PHP/ADMIN/activarUsuario.php" class="btn btn-light"> <i class='bx bx-key'></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php
                    }
                }

                ?>

            </div>
            <div class="paginacion justify-content-center">
                <div class="col-auto text-center">
                    <?php

                    if ($pagina <= 1) {

                        echo '<a class="btn m-2 text-light" href="filtrado.php?estado='.$column2.'&nombre='.$column1.'&pagina=1"> <i class="bx bx-left-arrow-alt"></i> </a>';

                    } else {

                        echo '<a class="btn m-2 text-light" href="filtrado.php?estado='.$column2.'&nombre='.$column1.'&pagina=' . $pagina - 1 . '"> <i class="bx bx-left-arrow-alt"></i> </a>';

                    }

                    //Link de las páginaciones.
                    for ($pagina = 1; $pagina <= $numero_de_paginas; $pagina++) {

                        echo '<a class="btn m-1 text-light" href = "filtrado.php?estado='.$column2.'&nombre='.$column1.'&pagina=' . $pagina . '">' . $pagina . ' </a>';
                    }

                    if (!empty($_GET['pagina'])) {

                        $pagina = $_GET['pagina'];

                        if ($_GET['pagina'] >= $numero_de_paginas) {

                            echo '<a class="btn m-2 text-light" href="filtrado.php?estado='.$column2.'&nombre='.$column1.'&pagina=' . $numero_de_paginas . '"> <i class="bx bx-right-arrow-alt"></i> </a>';
                        
                        } else {

                            echo '<a class="btn m-2 text-light" href="filtrado.php?estado='.$column2.'&nombre='.$column1.'&pagina=' . $pagina + 1 . '"> <i class="bx bx-right-arrow-alt"></i> </a>';
                        }
                    } else {

                        echo '<a class="btn m-2 text-light" href="filtrado.php?estado='.$column2.'&nombre='.$column1.'&pagina=2"> <i class="bx bx-right-arrow-alt"></i> </a>';
                    }



                    ?>

                </div>
            </div>

        </form>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="cambioPerfil" tabindex="-1" aria-labelledby="cambioPerfilLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="cambioPerfilLabel">Cambiar foto de perfil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../../PHP/subirFoto.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <img class="img-perfil img-modal" src="../../IMG/PERFILES/<?php echo $id . "/" . $imagen ?>" id="imagenPrevisualizacion" alt="usuario" style="width: 15rem; height: 15rem;">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input class="m-3" id="seleccionArchivos" accept="image/*" type="file" name="foto" id="foto">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Subir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php



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
    <?php }

    if (empty($_REQUEST['actualizado'])) {
        $confirmado = "";
    } else {
        $confirmado = $_REQUEST['actualizado'];
    }

    if ($confirmado == "true") { ?>
        <script lang="JavaScript">
            Swal.fire({
                icon: 'success',
                title: '¡Actualizados!',
                text: 'Los usuarios han sido activados correctamente'
            })
        </script>
    <?php } ?>

    <!-- Previsualizar la imagen -->
    <script>
        const $seleccionArchivos = document.querySelector("#seleccionArchivos"),
            $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

        // Escuchar cuando cambie
        $seleccionArchivos.addEventListener("change", () => {
            // Los archivos seleccionados, pueden ser muchos o uno
            const archivos = $seleccionArchivos.files;
            // Si no hay archivos salimos de la función y quitamos la imagen
            if (!archivos || !archivos.length) {
                $imagenPrevisualizacion.src = "";
                return;
            }
            // Ahora tomamos el primer archivo, el cual vamos a previsualizar
            const primerArchivo = archivos[0];
            // Lo convertimos a un objeto de tipo objectURL
            const objectURL = URL.createObjectURL(primerArchivo);
            // Y a la fuente de la imagen le ponemos el objectURL
            $imagenPrevisualizacion.src = objectURL;
        });
    </script>

</body>

</html>