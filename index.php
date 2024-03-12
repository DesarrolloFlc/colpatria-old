<?php
session_start();
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    header('Location: procesos/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Gestor documental. FinlecoBPO - Colpatria</title>
        <!-- Source File -->
        <link type="image/x-icon" href="images/icons/favicon.ico" rel="icon" />

        <!--                       CSS                       -->
        <!-- Reset Stylesheet -->
        <link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
        <!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
        <link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />
        <!-- Internet Explorer Fixes Stylesheet -->
        <!--[if lte IE 7]>
                        <link rel="stylesheet" href="resources/css/ie.css" type="text/css" media="screen" />
                <![endif]-->

        <!--                       Javascripts                       -->
        <!-- jQuery -->
        <script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
        <!-- jQuery Configuration -->
        <script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
        <!-- Facebox jQuery Plugin -->
        <script type="text/javascript" src="resources/scripts/facebox.js"></script>
        <!-- jQuery WYSIWYG Plugin -->
        <script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
        <!-- Internet Explorer .png-fix -->
        <!--[if IE 6]>
                <script type="text/javascript" src="resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
                <script type="text/javascript">
                                DD_belatedPNG.fix('.png_bg, img, li');
                        </script>
                <![endif]-->
        <!--<script type="text/javascript" src="resources/scripts/nieve.js"></script>-->
        <script type="text/javascript">
            $(document).ready(function() {
                $("form#login_form").submit(function(event) {
                    (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
                    if ($('input[name="username"]', this).val().trim() === "") {
                        alert("Por favor complete el campo de usuario.");
                        $('input[name="username"]', this).focus();
                        return false;
                    } 
                    if ($('input[name="password"]', this).val().trim() === "") {
                        alert("Por favor complete el campo de contraseña.");
                        $('input[name="password"]', this).focus();
                        return false;
                    }
                    const form = this;
                    $.ajax({
                        beforeSend: function(){
                            $('input#entrar').attr('disabled', true);
                            $.facebox.loading();
                        },
                        data: $(form).serialize(),
                        type: 'GET',
                        url: 'lib/general/validacion.php',
                        dataType: 'json',
                        success: function(dato){
                            if ((!dato.exito)) {
                                alert(dato.error ? dato.error : 'Ocurrio un error al momento de realizar la consulta, contacte con el administrador.');
                                if (!dato.error) console.log(dato);
                                return false;
                            }
                            if (dato.user.change_password === 0) {
                                window.location.replace("procesos/change_password.php");
                                return false;
                            }
                            window.location.replace("procesos/index.php");
                        },
                        complete: function(jqXHR, textStatus){
                            $('input#entrar').removeAttr('disabled');
                            $.facebox.close();
                        },
                        error: function(xhr, ajaxOptions, thrownError){
                            console.log(xhr, ajaxOptions, thrownError);
                            $('p.text-center > span').html(`Error(cargueBaseGestorVentas): ${xhr.status} Error: ${xhr.responseText}`);
                            $.facebox({
                                div: '#box-errores'
                            });
                        }
                    });
                });
            });
        </script>
    </head>
    <body id="login">
        <div id="login-wrapper" class="png_bg">
            <div id="login-top">

                <h1>Simpla Admin</h1>
                <!-- Logo (221px width) -->
                <img id="logo" src="resources/images/logo.png" alt="Simpla Admin logo" />
            </div> <!-- End #logn-top -->

            <div id="login-content">

                <form name="login_form" method="GET" id="login_form" action="lib/general/validacion.php">
                    <div class="notification information png_bg">
                        <div id="msg">
                            Por favor complete los campos y haga click en "Acceder".
                        </div>
                    </div>
                    <p>
                        <label>Usuario:</label>
                        <input class="text-input" type="text" name="username" autofocus placeholder="Usuario" />
                    </p>
                    <div class="clear"></div>
                    <p>
                        <label>Contraseña:</label>
                        <input class="text-input" type="password" name="password" placeholder="Contraseña" />
                    </p>
                    <div class="clear"></div>

                    <p>
                        <input id="entrar" type="submit" value="Acceder >>" />
                    </p>
                </form>
                <div>
                    <p>
                        <a href="#" onclick="window.open('WhatisMyUser.php', 'MiUsuario', 'width=320, height=160');"> 
                            <font color="red">Cu&aacute;l es mi usuario?</font>
                        </a>
                    </p>
                </div> <!-- End #login-content -->

            </div> <!-- End #login-wrapper -->
    </body>
</html>
