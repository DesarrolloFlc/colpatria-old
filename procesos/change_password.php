<?php
session_start();

if ($_SESSION['change_password'] != "0") {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Gestor documental. FinlecoBPO - Colpatria</title>        
        <!-- Source File -->
        <link type="image/x-icon" href="../images/icons/favicon.ico" rel="icon" />

        <!--                       CSS                       -->
        <!-- Reset Stylesheet -->
        <link rel="stylesheet" href="../resources/css/reset.css" type="text/css" media="screen" />
        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="../resources/css/style.css" type="text/css" media="screen" />
        <script type="text/javascript" src="../resources/scripts/jquery-1.3.2.min.js"></script>
    </head>
    <body>
    <center>
        <br /><br />
        <div class="content-box" style="width: 40%; text-align: left;"><!-- Start Content Box -->
            <div class="content-box-header">
                <h3>Cambio de contraseña</h3>
                <ul class="content-box-tabs">
                    <li><a href="#tab1" class="default-tab"></a></li> <!-- href must be unique and match the id of target div -->
                </ul>
                <div class="clear"></div>
            </div> 
            <div class="content-box-content">
                <div class="notification information png_bg">
                    <a href="#" class="close"><img src="../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                    <div>Por su seguridad es importante que realice el cambio de su contraseña periodicamente.</div>
                </div> 
                <div class="tab-content default-tab" id="tab1">
                    <form action="efectuarCambio.php" method="POST" id="form_changepass" name="form_changepass">
                        <fieldset>
                            <p>
                                <label>Contraseña actual:</label>              
                                <input type="text" name="pass1" id="pass1" />
                            </p>                
                            <p>
                                <label>Contraseña nueva:</label>              
                                <input type="password" name="pass2" id="pass2" />
                            </p>
                            <p>
                                <label>Re escribir contraseña nueva:</label>
                                <input type="password" name="pass3" id="pass3" />
                            </p>
                            <p>
                                <input class="button" type="submit" id="change_password" value="Realizar búsqueda " />
                            </p>
                        </fieldset>
                        <div class="clear"></div><!-- End .clear -->
                    </form>
                </div> <!-- End #tab2 -->    
            </div> <!-- End .content-box-content -->
        </div> <!-- End .content-box -->

    </center>
    <script type="text/javascript">
        jQuery.fn.fortalezaClave = function() {
            $(this).each(function() {
                elem = $(this);
                //creo el elemento HTML para el mensaje
                msg = $('<span class="fortaleza">No segura</span>');
                //inserto el mensaje en la p�gina, justo despu�s del campo input password
                elem.after(msg)
                //almaceno la referencia del elemento del mensaje dentro del campo input
                elem.data("mensaje", msg);

                elem.keyup(function(e) {
                    elem = $(this);
                    //recupero la referencia al elemento del mensaje 
                    msg = elem.data("mensaje")
                    //miro la fortaleza
                    //extraigo el atributo value del campo input password
                    claveActual = elem.attr("value");
                    var fortalezaActual = "";
                    //saco la fortaleza en funci�n de los caracteres que tenga la clave
                    if (claveActual.length < 5) {
                        fortalezaActual = "No segura";
                    } else {
                        if (claveActual.length < 8) {
                            fortalezaActual = "Medianamente segura";
                        } else {
                            fortalezaActual = "Segura";
                        }
                    }
                    //cambio el texto del elemento mensaje para mostrar la fortaleza actual
                    msg.html(fortalezaActual);
                });
            });
            return this;
        }

        $(document).ready(function() {
            $("#pass2").fortalezaClave();
            $("#form_changepass").submit(function() {
                if ($("#pass2").val() != $("#pass3").val()) {
                    alert("Por favor valide la nueva contraseña, los campos no coinciden.");
                    return false;
                }
                $("#form_changepass").submit();
            });
        });
    </script>
</body>
</html>