<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header.php';
require_once PATH_CCLASS . DS . 'user.class.php';
extract($_GET);
?>
<!-- Page Head -->
<h2>Edici&oacute;n de usuario</h2>
<p id="page-intro">Edici&oacute;n de clave persona de usuario en Doc. Finder</p>

<div class="clear"></div> <!-- End .clear -->

<div class="notification information png_bg">
    <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
    <div>
        La creación, edición o desactivación de un usuario unicamente la puedes ejecutar con perfil de administrador.
    </div>
</div>


<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Edici&oacute;n de usuario</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab3" class="default-tab">Usuario</a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab3"> <!-- This is the target div. id must match the href of this div's tab -->
            <form method="POST" id="user_edit2" name="user_edit2" onsubmit="$(this).cambiarPassword(event);">
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>Clave personal actual:</label>
                        <input class="text-input medium-input" type="password" name="anterior_password" /> <span class="input-notification attention png_bg">Campo obligatorio</span>
                    </p>
                    <p>
                        <label>Nueva clave personal:</label>
                        <input class="text-input medium-input" type="password" name="nuevo_password" /> <span class="input-notification attention png_bg">Campo obligatorio</span>
                    </p>
                    <p>
                        <label>Re-escribir clave personal:</label>
                        <input class="text-input medium-input" type="password" name="nuevo_password2" /> <span class="input-notification attention png_bg">Campo obligatorio</span>
                    </p>
                    <p>
                        <input class="button" type="submit" value="Asignar esta clave >>" />
                    </p>
                </fieldset>
                <input type="hidden" name="domain" value="user">
                <input type="hidden" name="action" value="cambiarPassword">
                <input type="hidden" name="meth" value="js">
                <div class="clear"></div><!-- End .clear -->
            </form>
        </div> <!-- End #tab2 -->
    </div> <!-- End .content-box-content -->
</div> <!-- End .content-box -->