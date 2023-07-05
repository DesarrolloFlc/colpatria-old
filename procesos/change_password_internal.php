<?php
session_start();
if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["1", "2" , "3", "4", "5"]) ) {
    echo "<h2>No tiene permisos para acceder a esta �rea</h2>";
    exit;
}
require_once dirname(dirname(__FILE__)) . '/template/general/header.php';
?>
<!-- Page Head -->
<h2>Cambio de clave personal</h2>
<p id="page-intro">Es importante realizar el cambio de su clave personal de manera peri&oacute;dica.  </p>
<div class="clear"></div> <!-- End .clear -->
<div class="content-box" ><!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Cambio de contraseña</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Clave personal</a></li> <!-- href must be unique and match the id of target div -->
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
			<input type="hidden" name="accion_pass" id="accion_pass" value="1"/>
            </form>
        </div> <!-- End #tab2 -->    
    </div> <!-- End .content-box-content -->
</div> <!-- End .content-box -->
<?php
require_once PATH_SITE . DS . 'template/general/footer.php';
