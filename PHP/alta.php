<?php

 use \PHPMailer\PHPMailer\PHPMailer;

//Nos conectamos con la base de datos.
include('db.php');

$fecha_alta  = date('Y-m-d');
$contrasenna = password_hash($_REQUEST['contrasenna'], PASSWORD_DEFAULT);

$numConfirmacion = rand(1000, 9999);
$bloqueado = '1';
$email     = $_REQUEST['email'];
$nombre    = $_REQUEST['nombre'];

//Insertamos datos.
$query = "INSERT INTO usuarios(Usuario_nombre, Usuario_apellido1, Usuario_apellido2, Usuario_clave, Usuario_fecha_alta, Usuario_email, Usuario_bloqueado, Usuario_token_aleatorio) values 
                        ('$_REQUEST[nombre]',
                         '$_REQUEST[apellido1]',
                         '$_REQUEST[apellido2]',
                         '$contrasenna',
                         '$fecha_alta',
                         '$_REQUEST[email]',
                         '$bloqueado',
                         '$numConfirmacion')";

$registro = mysqli_query($conexion, $query) or die("Problemas al registrar usuario: " . mysqli_error($conexion));

//Buscamo el usuario que acabamos de registrar para ver si existe
$sql = "SELECT * FROM usuarios WHERE Usuario_email = '$_REQUEST[email]'";
$result = $conexion->query($sql);

//Si existe
if (mysqli_num_rows($result) > 0) {
    
    $codigo = "
    <!doctype html>
<html ⚡4email data-css-strict>

<head>
    <meta charset='utf-8'>
    <style amp4email-boilerplate>
        body {
            visibility: hidden
        }
    </style>
    <script async src='https://cdn.ampproject.org/v0.js'></script>
    <style amp-custom>
        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
        }

        .es-button-border:hover a.es-button,
        .es-button-border:hover button.es-button {
            background: #3498DB;
            border-color: #3498DB;
        }

        .es-button-border:hover {
            border-color: #42D159 #42D159 #42D159 #42D159;
            background: #3498DB;
        }

        td .es-button-border:hover a.es-button-2 {
            background: #583046;
            border-color: #583046;
        }

        td .es-button-border-3:hover {
            background: #583046;
            border-style: solid solid solid solid;
            border-color: #42D159 #42D159 #42D159 #42D159;
        }

        s {
            text-decoration: line-through;
        }

        body {
            width: 100%;
        }

        body {
            font-family: roboto, 'helvetica neue', helvetica, arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0px;
        }

        table td,
        html,
        body,
        .es-wrapper {
            padding: 0;
            Margin: 0;
        }

        .es-content,
        .es-header,
        .es-footer {
            table-layout: fixed;
            width: 100%;
        }

        p,
        hr {
            Margin: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            Margin: 0;
            line-height: 120%;
            font-family: roboto, 'helvetica neue', helvetica, arial, sans-serif;
        }

        .es-left {
            float: left;
        }

        .es-right {
            float: right;
        }

        .es-p5 {
            padding: 5px;
        }

        .es-p5t {
            padding-top: 5px;
        }

        .es-p5b {
            padding-bottom: 5px;
        }

        .es-p5l {
            padding-left: 5px;
        }

        .es-p5r {
            padding-right: 5px;
        }

        .es-p10 {
            padding: 10px;
        }

        .es-p10t {
            padding-top: 10px;
        }

        .es-p10b {
            padding-bottom: 10px;
        }

        .es-p10l {
            padding-left: 10px;
        }

        .es-p10r {
            padding-right: 10px;
        }

        .es-p15 {
            padding: 15px;
        }

        .es-p15t {
            padding-top: 15px;
        }

        .es-p15b {
            padding-bottom: 15px;
        }

        .es-p15l {
            padding-left: 15px;
        }

        .es-p15r {
            padding-right: 15px;
        }

        .es-p20 {
            padding: 20px;
        }

        .es-p20t {
            padding-top: 20px;
        }

        .es-p20b {
            padding-bottom: 20px;
        }

        .es-p20l {
            padding-left: 20px;
        }

        .es-p20r {
            padding-right: 20px;
        }

        .es-p25 {
            padding: 25px;
        }

        .es-p25t {
            padding-top: 25px;
        }

        .es-p25b {
            padding-bottom: 25px;
        }

        .es-p25l {
            padding-left: 25px;
        }

        .es-p25r {
            padding-right: 25px;
        }

        .es-p30 {
            padding: 30px;
        }

        .es-p30t {
            padding-top: 30px;
        }

        .es-p30b {
            padding-bottom: 30px;
        }

        .es-p30l {
            padding-left: 30px;
        }

        .es-p30r {
            padding-right: 30px;
        }

        .es-p35 {
            padding: 35px;
        }

        .es-p35t {
            padding-top: 35px;
        }

        .es-p35b {
            padding-bottom: 35px;
        }

        .es-p35l {
            padding-left: 35px;
        }

        .es-p35r {
            padding-right: 35px;
        }

        .es-p40 {
            padding: 40px;
        }

        .es-p40t {
            padding-top: 40px;
        }

        .es-p40b {
            padding-bottom: 40px;
        }

        .es-p40l {
            padding-left: 40px;
        }

        .es-p40r {
            padding-right: 40px;
        }

        .es-menu td {
            border: 0;
        }

        a {
            text-decoration: underline;
        }

        p,
        ul li,
        ol li {
            font-family: roboto, 'helvetica neue', helvetica, arial, sans-serif;
            line-height: 150%;
        }

        ul li,
        ol li {
            Margin-bottom: 15px;
            margin-left: 0;
        }

        .es-menu td a {
            text-decoration: none;
            display: block;
            font-family: roboto, 'helvetica neue', helvetica, arial, sans-serif;
        }

        .es-menu amp-img,
        .es-button amp-img {
            vertical-align: middle;
        }

        .es-wrapper {
            width: 100%;
            height: 100%;
        }

        .es-wrapper-color,
        .es-wrapper {
            background-color: #583046;
        }

        .es-header {
            background-color: transparent;
        }

        .es-header-body {
            background-color: #FFFFFF;
        }

        .es-header-body p,
        .es-header-body ul li,
        .es-header-body ol li {
            color: #333333;
            font-size: 14px;
        }

        .es-header-body a {
            color: #1376C8;
            font-size: 14px;
        }

        .es-content-body {
            background-color: #FFFFFF;
        }

        .es-content-body p,
        .es-content-body ul li,
        .es-content-body ol li {
            color: #666666;
            font-size: 14px;
        }

        .es-content-body a {
            color: #2980D9;
            font-size: 14px;
        }

        .es-footer {
            background-color: transparent;
        }

        .es-footer-body {
            background-color: #FFFFFF;
        }

        .es-footer-body p,
        .es-footer-body ul li,
        .es-footer-body ol li {
            color: #EFEFEF;
            font-size: 14px;
        }

        .es-footer-body a {
            color: #FFFFFF;
            font-size: 14px;
        }

        .es-infoblock,
        .es-infoblock p,
        .es-infoblock ul li,
        .es-infoblock ol li {
            line-height: 120%;
            font-size: 12px;
            color: #CCCCCC;
        }

        .es-infoblock a {
            font-size: 12px;
            color: #CCCCCC;
        }

        h1 {
            font-size: 30px;
            font-style: normal;
            font-weight: normal;
            color: #3F3D3D;
        }

        h2 {
            font-size: 22px;
            font-style: normal;
            font-weight: bold;
            color: #3F3D3D;
        }

        h3 {
            font-size: 20px;
            font-style: normal;
            font-weight: bold;
            color: #3F3D3D;
        }

        .es-header-body h1 a,
        .es-content-body h1 a,
        .es-footer-body h1 a {
            font-size: 30px;
        }

        .es-header-body h2 a,
        .es-content-body h2 a,
        .es-footer-body h2 a {
            font-size: 22px;
        }

        .es-header-body h3 a,
        .es-content-body h3 a,
        .es-footer-body h3 a {
            font-size: 20px;
        }

        a.es-button,
        button.es-button {
            border-style: solid;
            border-color: #2980D9;
            border-width: 10px 40px 10px 40px;
            display: inline-block;
            background: #2980D9;
            border-radius: 5px;
            font-size: 18px;
            font-family: roboto, 'helvetica neue', helvetica, arial, sans-serif;
            font-weight: normal;
            font-style: normal;
            line-height: 120%;
            color: #FFFFFF;
            text-decoration: none;
            width: auto;
            text-align: center;
        }

        .es-button-border {
            border-style: solid solid solid solid;
            border-color: #2CB543 #2CB543 #2CB543 #2CB543;
            background: #2980D9;
            border-width: 0px 0px 0px 0px;
            display: inline-block;
            border-radius: 5px;
            width: auto;
        }

        @media only screen and (max-width:600px) {

            p,
            ul li,
            ol li,
            a {
                line-height: 150%
            }

            h1,
            h2,
            h3,
            h1 a,
            h2 a,
            h3 a {
                line-height: 120%
            }

            h1 {
                font-size: 26px;
                text-align: center
            }

            h2 {
                font-size: 24px;
                text-align: center
            }

            h3 {
                font-size: 20px;
                text-align: center
            }

            .es-header-body h1 a,
            .es-content-body h1 a,
            .es-footer-body h1 a {
                font-size: 26px
            }

            .es-header-body h2 a,
            .es-content-body h2 a,
            .es-footer-body h2 a {
                font-size: 24px
            }

            .es-header-body h3 a,
            .es-content-body h3 a,
            .es-footer-body h3 a {
                font-size: 20px
            }

            .es-menu td a {
                font-size: 13px
            }

            .es-header-body p,
            .es-header-body ul li,
            .es-header-body ol li,
            .es-header-body a {
                font-size: 13px
            }

            .es-content-body p,
            .es-content-body ul li,
            .es-content-body ol li,
            .es-content-body a {
                font-size: 14px
            }

            .es-footer-body p,
            .es-footer-body ul li,
            .es-footer-body ol li,
            .es-footer-body a {
                font-size: 13px
            }

            .es-infoblock p,
            .es-infoblock ul li,
            .es-infoblock ol li,
            .es-infoblock a {
                font-size: 11px
            }

            *[class='gmail-fix'] {
                display: none
            }

            .es-m-txt-c,
            .es-m-txt-c h1,
            .es-m-txt-c h2,
            .es-m-txt-c h3 {
                text-align: center
            }

            .es-m-txt-r,
            .es-m-txt-r h1,
            .es-m-txt-r h2,
            .es-m-txt-r h3 {
                text-align: right
            }

            .es-m-txt-l,
            .es-m-txt-l h1,
            .es-m-txt-l h2,
            .es-m-txt-l h3 {
                text-align: left
            }

            .es-m-txt-r amp-img {
                float: right
            }

            .es-m-txt-c amp-img {
                margin: 0 auto
            }

            .es-m-txt-l amp-img {
                float: left
            }

            .es-button-border {
                display: block
            }

            a.es-button,
            button.es-button {
                font-size: 14px;
                display: block;
                border-left-width: 0px;
                border-right-width: 0px
            }

            .es-btn-fw {
                border-width: 10px 0px;
                text-align: center
            }

            .es-adaptive table,
            .es-btn-fw,
            .es-btn-fw-brdr,
            .es-left,
            .es-right {
                width: 100%
            }

            .es-content table,
            .es-header table,
            .es-footer table,
            .es-content,
            .es-footer,
            .es-header {
                width: 100%;
                max-width: 600px
            }

            .es-adapt-td {
                display: block;
                width: 100%
            }

            .adapt-img {
                width: 100%;
                height: auto
            }

            td.es-m-p0 {
                padding: 0px
            }

            td.es-m-p0r {
                padding-right: 0px
            }

            td.es-m-p0l {
                padding-left: 0px
            }

            td.es-m-p0t {
                padding-top: 0px
            }

            td.es-m-p0b {
                padding-bottom: 0
            }

            td.es-m-p20b {
                padding-bottom: 20px
            }

            .es-mobile-hidden,
            .es-hidden {
                display: none
            }

            tr.es-desk-hidden,
            td.es-desk-hidden,
            table.es-desk-hidden {
                width: auto;
                overflow: visible;
                float: none;
                max-height: inherit;
                line-height: inherit
            }

            tr.es-desk-hidden {
                display: table-row
            }

            table.es-desk-hidden {
                display: table
            }

            td.es-desk-menu-hidden {
                display: table-cell
            }

            .es-menu td {
                width: 1%
            }

            table.es-table-not-adapt,
            .esd-block-html table {
                width: auto
            }

            table.es-social {
                display: inline-block
            }

            table.es-social td {
                display: inline-block
            }

            .es-desk-hidden {
                display: table-row;
                width: auto;
                overflow: visible;
                max-height: inherit
            }
        }
    </style>
</head>

<body>
    <div class='es-wrapper-color'>
        <!--[if gte mso 9]><v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'> <v:fill type='tile' color='#583046'></v:fill> </v:background><![endif]-->
        <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0'>
            <tr>
                <td valign='top'>
                    <table class='es-content' cellspacing='0' cellpadding='0' align='center'>
                        <tr>
                            <td align='center'>
                                <table class='es-content-body' style='background-color: transparent' width='600'
                                    cellspacing='0' cellpadding='0' bgcolor='transparent' align='center'>
                                    <tr>
                                        <td class='es-p25t' style='background-position: center top' align='left'>
                                            <table width='100%' cellspacing='0' cellpadding='0'>
                                                <tr>
                                                    <td width='600' valign='top' align='center'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'>
                                                            <tr>
                                                                <td align='center' style='font-size: 0px'><a
                                                                        target='_blank'>
                                                                        <amp-img class='adapt-img'
                                                                            src='https://aeeyup.stripocdn.email/content/guids/videoImgGuid/images/happy_face_outline.png'
                                                                            alt style='display: block' width='100'
                                                                            height='80' layout='responsive'></amp-img>
                                                                    </a></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='background-position: center bottom' align='left'>
                                            <table width='100%' cellspacing='0' cellpadding='0'>
                                                <tr>
                                                    <td width='600' valign='top' align='center'>
                                                        <table
                                                            style='background-position: center bottom;background-color: #ffffff'
                                                            width='100%' cellspacing='0' cellpadding='0'
                                                            bgcolor='#ffffff' role='presentation'>
                                                            <tr>
                                                                <td class='es-p10t es-p5b es-p20r es-p20l es-m-txt-l'
                                                                    bgcolor='transparent' align='left'>
                                                                    <h3 style='color: #583046'>Hola $nombre,</h3>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class='es-p10t es-p20r es-p20l'
                                                                    bgcolor='transparent' align='left'>
                                                                    <p style='color: #583046'>Muchas gracias por unirte
                                                                        a nuestra gran comunidad.</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class='es-p5t es-p20r es-p20l' bgcolor='transparent'
                                                                    align='left'>
                                                                    <p style='color: #583046'>Para poder usar la web con
                                                                        total normalidad deberás activarla clicando
                                                                        sobre el botón que está justo debajo.</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='es-p20t es-p20r es-p20l' style='background-color: #ffffff'
                                            bgcolor='#ffffff' align='left'>
                                            <table cellspacing='0' cellpadding='0' width='100%'>
                                                <tr>
                                                    <td width='560' align='left'>
                                                        <table width='100%' cellspacing='0' cellpadding='0'
                                                            role='presentation'>
                                                            <tr>
                                                                <td class='es-p10' align='center'><span
                                                                        class='es-button-border-3 es-button-border'
                                                                        style='border-radius: 20px;border-color: #2cb543;background: #583046'><a
                                                                            href='https://aitor.works/PHP/confirmacion.php?usuario=$email&clave=$numConfirmacion'
                                                                            class='es-button es-button-1'
                                                                            target='_blank'
                                                                            style='background: #583046;border-color: #583046;border-radius: 20px;border-width: 20px 60px'>Activar
                                                                            cuenta</a></span></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='background-position: center bottom' align='left'>
                                            <table width='100%' cellspacing='0' cellpadding='0'>
                                                <tr>
                                                    <td width='600' valign='top' align='center'>
                                                        <table
                                                            style='background-position: center bottom;background-color: #ffffff;border-radius: 0px 0px 5px 5px;border-collapse: separate'
                                                            width='100%' cellspacing='0' cellpadding='0'
                                                            bgcolor='#ffffff' role='presentation'>
                                                            <tr>
                                                                <td height='32' align='center'></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class='es-content' cellspacing='0' cellpadding='0' align='center'>
                        <tr>
                            <td align='center'>
                                <table class='es-content-body' style='background-color: transparent' width='600'
                                    cellspacing='0' cellpadding='0' bgcolor='transparent' align='center'>
                                    <tr>
                                        <td class='es-p20t es-p20b' align='left'>
                                            <table width='100%' cellspacing='0' cellpadding='0'>
                                                <tr>
                                                    <td width='600' align='left'>
                                                        <table
                                                            style='background-color: #ffffff;border-radius: 5px 5px 0px 0px;border-collapse: separate'
                                                            width='100%' cellspacing='0' cellpadding='0'
                                                            bgcolor='#ffffff' role='presentation'>
                                                            <tr>
                                                                <td>
                                                                    <table class='es-table-not-adapt' cellspacing='0'
                                                                        cellpadding='0' role='presentation'>
                                                                        <tr>
                                                                            <td class='es-p10t es-p5b es-p10r es-p20l'
                                                                                valign='top' align='left'
                                                                                style='font-size:0'>
                                                                                <amp-img
                                                                                    src='https://aeeyup.stripocdn.email/content/guids/CABINET_b748f68723c08ea6110c059c05f4df42/images/48681566985721743.png'
                                                                                    alt style='display: block'
                                                                                    width='18' height='24'></amp-img>
                                                                            </td>
                                                                            <td align='left'>
                                                                                <table width='100%' cellspacing='0'
                                                                                    cellpadding='0' role='presentation'>
                                                                                    <tr>
                                                                                        <td class='es-p5t es-p5b'
                                                                                            align='center'>
                                                                                            <p
                                                                                                style='color: #583046;line-height: 16px;font-size: 13px'>
                                                                                                Jerez de la
                                                                                                Frontera&nbsp;<br>Calle
                                                                                                Mulhacén, 14</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class='es-footer' cellspacing='0' cellpadding='0' align='center'>
                        <tr>
                            <td align='center'>
                                <table class='es-footer-body' style='background-color: transparent' width='600'
                                    cellspacing='0' cellpadding='0' bgcolor='rgba(0, 0, 0, 0)' align='center'>
                                    <tr>
                                        <td class='es-p5t es-p20b es-p20r es-p20l'
                                            style='background-position: center bottom;background-color: transparent'
                                            bgcolor='transparent' align='left'>
                                            <!--[if mso]><table width='560' cellpadding='0' cellspacing='0'><tr><td width='270' valign='top'><![endif]-->
                                            <table class='es-left' cellspacing='0' cellpadding='0' align='left'>
                                                <tr>
                                                    <td width='270' valign='top' align='center'>
                                                        <table style='background-position: center top' width='100%'
                                                            cellspacing='0' cellpadding='0' role='presentation'>
                                                            <tr>
                                                                <td class='es-m-txt-c es-p5t es-p15b' align='left'>
                                                                    <p>Si quieres enterarte de todas nuestras
                                                                        actualizaciones no dudes en seguirnos.</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td>
<td width='20'></td><td width='270' valign='top'><![endif]-->
                                            <table class='es-right' cellspacing='0' cellpadding='0' align='right'>
                                                <tr>
                                                    <td width='270' align='left'>
                                                        <table style='background-position: center top' width='100%'
                                                            cellspacing='0' cellpadding='0' role='presentation'>
                                                            <tr>
                                                                <td class='es-p5t es-p5b es-m-txt-c' align='right'
                                                                    style='font-size:0'>
                                                                    <table class='es-table-not-adapt es-social'
                                                                        cellspacing='0' cellpadding='0'
                                                                        role='presentation'>
                                                                        <tr>
                                                                            <td class='es-p10r' valign='top'
                                                                                align='center'>
                                                                                <amp-img title='Facebook'
                                                                                    src='https://aeeyup.stripocdn.email/content/assets/img/social-icons/rounded-white/facebook-rounded-white.png'
                                                                                    alt='Fb' width='32' height='32'>
                                                                                </amp-img>
                                                                            </td>
                                                                            <td class='es-p10r' valign='top'
                                                                                align='center'>
                                                                                <amp-img title='Twitter'
                                                                                    src='https://aeeyup.stripocdn.email/content/assets/img/social-icons/rounded-white/twitter-rounded-white.png'
                                                                                    alt='Tw' width='32' height='32'>
                                                                                </amp-img>
                                                                            </td>
                                                                            <td class='es-p10r' valign='top'
                                                                                align='center'>
                                                                                <amp-img title='Instagram'
                                                                                    src='https://aeeyup.stripocdn.email/content/assets/img/social-icons/rounded-white/instagram-rounded-white.png'
                                                                                    alt='Inst' width='32' height='32'>
                                                                                </amp-img>
                                                                            </td>
                                                                            <td valign='top' align='center'>
                                                                                <amp-img title='Youtube'
                                                                                    src='https://aeeyup.stripocdn.email/content/assets/img/social-icons/rounded-white/youtube-rounded-white.png'
                                                                                    alt='Yt' width='32' height='32'>
                                                                                </amp-img>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table cellpadding='0' cellspacing='0' class='es-content' align='center'>
                        <tr>
                            <td align='center'>
                                <table bgcolor='transparent' class='es-content-body' align='center' cellpadding='0'
                                    cellspacing='0' width='600' style='background-color: transparent'>
                                    <tr>
                                        <td class='es-p30t es-p30b es-p20r es-p20l' align='left'>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>";

    require '../vendor/autoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.hostinger.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'info@aitor.works';
    $mail->Password = 'A*9pi#i@gAXb4z';
    $mail->setFrom('info@aitor.works', 'Activación aitor.works');
    $mail->addReplyTo('info@aitor.works', 'aitor.works');
    $mail->addAddress($_REQUEST['email'], $_REQUEST['nombre']);
    $mail->Subject = 'Activación cuenta';
    $mail->IsHTML(true);
    $mail->Charset = 'UTF-8';
    $mail->Body = sprintf('<p>%s</p>', $codigo);
    //$mail->Body = "Hola";
    
    if($mail->send()){
    
        //Si se envía mandamos mensaje de confirmación
        $confirmado = "true";
        header("Location:../index.php?confirmado=$confirmado");
        die();
        
    } else {
        
        //Si no mandamos mensaje de error
        $confirmado = "false";
        header("Location:../index.php?confirmado=$confirmado");
        die();
        
    }


} else {

    //Si no existe mandamos mensaje de error
    $confirmado = "false";
    header("location:../index.php?confirmado=$confirmado");
}

?>