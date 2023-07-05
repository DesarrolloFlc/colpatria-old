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
                $("form#login_form").submit(function() {
                    if ($(this).find('input[name="username"]').val() == "") {
                        alert("Por favor complete el campo de usuario.");
                        $(this).find('input[name="username"]').focus();
                    } else if ($(this).find('input[name="password"]').val() == "") {
                        alert("Por favor complete el campo de contraseña.");
                        $(this).find('input[name="password"]').focus();
                    } else {
                        $.post('lib/general/validacion.php', $("#login_form").serialize(), function(data) {
                            //alert(data)
                            if (data == "102") {
                                $('#msg').html("Por favor valide los datos de acceso.");
                                return false;
                            }
                            location.href = "procesos/change_password.php";
                        });
                    }
                    return false;
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

                <form name="login_form" method="POST" id="login_form" action="lib/general/validacion.php">
                    <div class="notification information png_bg">
                        <div id="msg">
                            Por favor complete los campos y haga click en "Acceder".
                        </div>
                    </div>
                    <p>
                        <label>Usuario:</label>
                        <input class="text-input" type="text" name="username"/>
                    </p>
                    <div class="clear"></div>
                    <p>
                        <label>Contraseña:</label>
                        <input class="text-input" type="password" name="password"/>
                    </p>
                    <div class="clear"></div>

                    <p>
                        <input id="entrar" type="submit" value="Acceder >>" />
                    </p>
                </form>
                <div><p><a href="#" onclick="window.open('WhatisMyUser.php', 'MiUsuario', 'width=320, height=160');"> <font color="red">Cu&aacute;l es mi usuario?</font></a></p>
                </div> <!-- End #login-content -->

            </div> <!-- End #login-wrapper -->
    </body>
</html>
