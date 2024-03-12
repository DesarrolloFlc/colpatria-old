<?php
session_start();

if ($_SESSION['change_password'] != "0") {
    header('Location: index.php');
    exit;
}
require_once dirname(dirname(__FILE__)) . "/includes.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Gestor documental. FinlecoBPO - Colpatria</title>        
        <!-- Source File -->
        <link type="image/x-icon" href="<?=SITE_ROOT?>/images/icons/favicon.ico" rel="icon" />

        <!--                       CSS                       -->
        <!-- Reset Stylesheet -->
        <link rel="stylesheet" href="<?=SITE_ROOT?>/resources/css/reset.css" type="text/css" media="screen" />
        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="<?=SITE_ROOT?>/resources/css/style.css" type="text/css" media="screen" />
        <!-- <script type="text/javascript" src="<?//=SITE_ROOT?>/resources/scripts/jquery-1.3.2.min.js"></script> -->
        <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/jquery-1.12.4.min.js"></script>
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
                    <a href="#" class="close"><img src="<?=SITE_ROOT?>/resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                    <div>Por su seguridad es importante que realice el cambio de su contraseña periodicamente.</div>
                </div> 
                <div class="tab-content default-tab" id="tab1">
                    <form method="POST" id="form_changepass" name="form_changepass">
                        <fieldset>
                            <p>
                                <label>Contraseña actual:</label>              
                                <input type="text" name="anterior_password" />
                            </p>                
                            <p>
                                <label>Contraseña nueva:</label>              
                                <input type="password" name="nuevo_password" />
                            </p>
                            <p>
                                <label>Re escribir contraseña nueva:</label>
                                <input type="password" name="nuevo_password2" />
                            </p>
                            <p>
                                <input class="button" type="submit" id="change_password" value="Realizar búsqueda " />
                            </p>
                        </fieldset>
                        <div class="clear"></div><!-- End .clear -->
                        <input type="hidden" name="domain" value="user">
                        <input type="hidden" name="action" value="cambiarPassword">
                        <input type="hidden" name="meth" value="js">
                        <input type="hidden" name="redirect" value="index.php">
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
            $("#form_changepass").submit(function(event) {
                (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
                if ($('input[name="anterior_password"]', this).val().trim() === '') {
                    alert("Debe digitar la contraseña actual del usuario.");
                    return false;
                }
                if ($('input[name="nuevo_password"]', this).val().trim() === '') {
                    alert("Debe digitar la nueva contraseña del usuario.");
                    return false;
                }
                if ($('input[name="nuevo_password"]', this).val().trim() !== $('input[name="nuevo_password2"]', this).val().trim()) {
                    alert("La nueva contraseña no coincide.");
                    return false;
                }
                if ($('input[name="anterior_password"]', this).val().trim() === $('input[name="nuevo_password"]', this).val().trim()) {
                    alert("La contraseña nueva debe ser diferente a la contraseña actual.");
                    return false;
                }
                const form = this;
                $.ajax({
                    beforeSend: function(){
                        $('input#cambiar_pass').attr('disabled', true);
                        $('img#imgloading-cambiar-password').show();
                    },
                    data: $(form).serialize(),
                    type: 'GET',
                    url: '../procesos/includes/Controller.php',
                    dataType: 'json',
                    success: function(dato){
                        if ((!dato.exito)) {
                            alert(dato.error ? dato.error : 'Ocurrio un error al momento de realizar la consulta, contacte con el administrador.');
                            if (!dato.error) console.log(dato);
                            return false;
                        }
                        alert(dato.exito);
                        if ($('input[name="redirect"]', form).val() !== "" && $('input[name="redirect"]', form).val() !== undefined) {
                            window.location.replace($('input[name="redirect"]', form).val());
                        }
                    },
                    complete: function(jqXHR, textStatus){
                        $('input#cambiar_pass').removeAttr('disabled');
                        $('img#imgloading-cambiar-password').hide();
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        console.log(xhr, ajaxOptions, thrownError);
                        alert(`Error(cargueBaseGestorVentas): ${xhr.status} Error: ${xhr.responseText}`);
                    }
                });
            });
        });
    </script>
</body>
</html>