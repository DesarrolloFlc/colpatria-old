<?php
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_SITE . DS . "config/globalParameters.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Doc. Finder | Finleco BPO - Colpatria</title>
    <!--                       CSS                       -->
    <!-- Reset Stylesheet -->
    <link rel="stylesheet" href="<?=SITE_ROOT?>/resources/css/reset.css" type="text/css" media="screen" />
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?=SITE_ROOT?>/resources/css/style.css" type="text/css" media="screen" />
    <!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
    <link rel="stylesheet" href="<?=SITE_ROOT?>/resources/css/invalid.css" type="text/css" media="screen" />	
    <link rel="stylesheet" href="<?=SITE_ROOT?>/resources/css/calendar.css" type="text/css" media="screen" />
    <!-- css file qtip-->
    <link type="text/css" rel="stylesheet" href="<?=SITE_ROOT?>/resources/css/jquery.qtip.css" />
    <!-- Colour Schemes
    Default colour scheme is green. Uncomment prefered stylesheet to use it.
    <link rel="stylesheet" href="resources/css/blue.css" type="text/css" media="screen" />-->		
    <link rel="stylesheet" href="<?=SITE_ROOT?>/resources/css/red.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?=SITE_ROOT?>/resources/css/datatables.min.css">
    <!-- Internet Explorer Fixes Stylesheet -->
    <!--[if lte IE 7]>
    <link rel="stylesheet" href="resources/css/ie.css" type="text/css" media="screen" />
    <![endif]-->
    <!--                       Javascripts                       -->
    <!-- jQuery -->
    <!--<script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/jquery-1.3.2.min.js"></script>-->
    <!-- <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/jquery-1.4.2.min.js"></script> -->
    <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/jquery-1.12.4.min.js"></script>
    <!-- jQuery Configuration -->
    <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/simpla.jquery.configuration.js"></script>
    <!-- Facebox jQuery Plugin 
    <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/facebox.js"></script>-->
    <!-- jQuery WYSIWYG Plugin -->
    <!-- <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/jquery.wysiwyg.js"></script> -->
    <!--<script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/jquery.qtip-1.0.0-rc3.min.js"></script>-->
    <!-- Notice we only include the minified script here. You can include the non-minified version, just don't include both! -->
    <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/jquery.qtip.min.js"></script>
    <!-- Internet Explorer .png-fix -->
    <!--[if IE 6]>
    <script type="text/javascript" src="resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('.png_bg, img, li');
    </script>
    <![endif]-->
    <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/facebox.js"></script>
    <script type="text/javascript" src="<?=SITE_ROOT?>/resources/scripts/pdfobject/pdfobject/pdfobject.min.js"></script>
    <!--Libreria adicional de herramientas con jQuery -->
    <script type="text/javascript" src="<?=SITE_ROOT?>/lib/js/tools.js"></script>
    <script type="text/javascript" src="<?=SITE_ROOT?>/lib/js/cal.js"></script>
<?php
if(isset($_SESSION['group']) && $_SESSION['group'] == 6){
?>
<script>
	$(document).ready(function() {
		$.fn.revisarNotificacion();
		$.fn.revisarMesadeControl();
	});
	$.fn.revisarNotificacion = function() {
		$.ajax({
			beforeSend: function() {
			},
			data: 'action=enviarMailRecordatorio',
			type: 'POST',
			url: '<?=SITE_ROOT?>/procesos/includes/controllerRadicado.php',
			success: function(dato) {
			}
		});
	}
	$.fn.revisarMesadeControl = function() {
		$.ajax({
			beforeSend: function() {
			},
			data: 'action=validaFechasOrden',
			type: 'POST',
			url: '<?=SITE_ROOT?>/procesos/includes/ControllerMesadeControl.php',
			success: function(dato) {
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr, ajaxOptions, thrownError);
			}
		});
	}
</script>
<?php
}
?>
</head>
<body>
    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        <div id="sidebar">
            <div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
                <h1 id="sidebar-title">
                    <a href="#">Simpla Admin</a>
                </h1>
                <!-- Logo (221px wide) -->
                <center>
                    <a href="#">
                        <img id="logo" src="<?=SITE_ROOT?>/images/general/logo_colpatria.jpg" alt="Colpatria." width="180px" height="122px">
                    </a>
                </center>
                <!-- Sidebar Profile links -->
                <div id="profile-links">
                    Hola, 
                    <a href="#" title="Edit your profile">
<?php
    if(isset($_SESSION['name'])) 
        echo utf8_encode($_SESSION['name']);
?>
                    </a>
                    , tienes 
                    <a href="#messages" rel="modal" title="3 Messages">0 Mensajes</a>
                    <br>
                    <br>
                    <a href="#" title="View the Site">Acerca de Doc. Finder</a> | <a href="<?=SITE_ROOT?>/lib/general/logout.php" title="Sign Out">Salir</a>
                </div>
                <ul id="main-nav">  <!-- Accordion Menu -->
<?php
    if(isset($_SESSION['group']) && ($_SESSION['group'] == "1" OR $_SESSION['group'] == "2" OR $_SESSION['group'] == "3" OR $_SESSION['group'] == "4" OR $_SESSION['group'] == "5" OR $_SESSION['group'] == "6" OR $_SESSION['group'] == "8" OR $_SESSION['group'] == "10" OR $_SESSION['group'] == "11")){
?>
                    <li>
                        <a href="<?=SITE_ROOT?>/procesos/index.php" class="nav-top-item no-submenu"> <!-- Add the class "no-submenu" to menu items with no sub menu -->
                            Consulta general
                        </a>
                    </li>
<?php
    }
    if(isset($_SESSION['group']) && ($_SESSION['group'] == "5" OR $_SESSION['group'] == "3" OR $_SESSION['group'] == "6" OR $_SESSION['group'] == "11")){
?>
                    <li>
                        <a href="#" class="nav-top-item"> <!-- Add the class "current" to current menu item -->
                            Módulo operativo
                        </a>
                        <ul>
<?php
        if ($_SESSION['group'] != "11") {
?>
                            <li><a href="<?=SITE_ROOT?>/procesos/internal/recordImages.php">Digitalizar imágenes</a></li>
                            <li><a href="#" onClick="pantallaCompleta('<?=SITE_ROOT?>/procesos/internal/fingering2.php'); return false;" target="_blank">Digitar imágenes</a></li>
                             <!--<li><a href="#" onClick="pantallaCompleta('<?=SITE_ROOT?>/procesos/internal/fingering.php'); return false;" target="_blank">Digitar imágenes</a></li> Add class "current" to sub menu items also -->
<?php
        }
        if(isset($_SESSION['group']) && ($_SESSION['group'] == "6" || $_SESSION['group'] == "3")):
?>
                            <li><a href="#" onClick="pantallaCompleta('<?=SITE_ROOT?>/procesos/internal/fingering_migracion.php'); return false;" target="_blank">Digitar im&aacute;genes migracion</a></li>
<?php
        endif;
        if(isset($_SESSION['group']) && ($_SESSION['group'] == "6" || $_SESSION['group'] == "11")){
            if ($_SESSION['group'] == "6"){
?>
                            <li><a href="<?=SITE_ROOT?>/procesos/internal/showIndexacion.php">Control de im&aacute;genes</a></li>
<?php
        }
?>
                            <li><a href="<?=SITE_ROOT?>/procesos/cargues/cargueBasesComplementarias.php">Cargue datas adicionales</a></li>
<?php
    }
?>
                        </ul>
                    </li>
<?php
    }else if(isset($_SESSION['group']) && ($_SESSION['group'] == "1")){
?>
                    <li>
                        <a href="#" class="nav-top-item"> <!-- Add the class "current" to current menu item -->
                            Módulo operativo
                        </a>
                        <ul>
                            <li><a href="<?=SITE_ROOT?>/procesos/cargues/cargueBasesComplementarias.php">Cargue datas adicionales</a></li>
                        </ul>
                    </li>
<?php
    }
    if(isset($_SESSION['group']) && ($_SESSION['group'] == "6" || $_SESSION['group'] == "1" || $_SESSION['group'] == '8' || (isset($_SESSION['cargo']) && $_SESSION['cargo'] == 'radicador'))){
?>
                    <li>
                        <a href="#" class="nav-top-item">M&oacute;dulo de radicaci&oacute;n</a>
                        <ul>
                            <li><a href="<?=SITE_ROOT?>/procesos/radicado/verificaCreacionVirtuales_.php">Radicar orden digital</a></li>
                            <li><a href="<?=SITE_ROOT?>/procesos/radicado/verificaCreacion.php">Radicar orden f&iacute;sico</a></li>
<?php
        if(isset($_SESSION['group']) && $_SESSION['group'] == "6" || $_SESSION['group'] == "1" || (isset($_SESSION['id']) && $_SESSION['id'] == '2956') || ($_SESSION['group'] == 3 && $_SESSION['cargo'] == 'radicador')){
?>
                            <li><a href="<?=SITE_ROOT?>/procesos/radicado/verificaAprobacion.php">Verficar / aprobar orden</a></li>
<?php
        }
        if(isset($_SESSION['group']) && $_SESSION['group'] == "6" || $_SESSION['group'] == "1" || (isset($_SESSION['id']) && $_SESSION['id'] == '2956') || ($_SESSION['group'] == 3 && $_SESSION['cargo'] == 'radicador') || ($_SESSION['group'] == "10" && $_SESSION['cargo'] == 'radicador')){
?>
                            <li><a href="<?=SITE_ROOT?>/procesos/radicado/informesRadicados.php">Informes</a></li>
<?php
        }
?>
                            <li><a href="#" onclick="$(this).mostrarManual(event);">Manual de radicaci&oacute;n</a></li>
                        </ul>
                    </li>
<?php
    }
    if(isset($_SESSION['id']) && ($_SESSION['id'] == 1 || $_SESSION['id'] == 23 || $_SESSION['id'] == 893 || $_SESSION['id'] == 3049)){
?>
                    <li>
                        <a href="#" class="nav-top-item" style="background: gray; color: #000;">M&oacute;dulo OnlineColpatria</a>
                        <ul>
                            <li><a href="<?=SITE_ROOT?>/procesos/supermercado/consulta_general.php">Consulta general</a></li>
                            <li><a href="<?=SITE_ROOT?>/procesos/supermercado/reportes.php">Reportes supermercado</a></li>
<?php
        if(isset($_SESSION['id']) && $_SESSION['id'] == 1){
?>
                            <li><a href="<?=SITE_ROOT?>/procesos/supermercado/herramientas.php">Herramientas</a></li>
<?php
        }
?>
                        </ul>
                    </li>
<?php
    }
    if(isset($_SESSION['group']) && ($_SESSION['group'] == "1" OR $_SESSION['group'] == "6")){
?>
                    <li>
                        <a href="#" class="nav-top-item"> <!-- Add the class "current" to current menu item -->
                            Herramientas admon.
                        </a>
                        <ul>
                            <li><a href="<?=SITE_ROOT?>/procesos/admin/users.php">Control de usuarios</a></li>
<?php
        if(isset($_SESSION['group']) && $_SESSION['group'] == "6"):
?>
                            <li><a href="<?=SITE_ROOT?>/procesos/admin/editImage.php">Edici&oacute;n de im&aacute;genes</a></li>
                            <li><a href="<?=SITE_ROOT?>/procesos/admin/marcadorPredictivo.php">Marcador predictivo</a></li>
                            <li><a href="<?=SITE_ROOT?>/procesos/meta/cargueMetas.php">Cargue de metas</a></li>
<?php
        endif;
?>
                        </ul>
                    </li>
<?php
    }
    if(isset($_SESSION['group']) && ($_SESSION['group'] == "5" OR $_SESSION['group'] == "6")){
?>
                    <li>
                        <a href="#" class="nav-top-item"> <!-- Add the class "current" to current menu item -->
                            Mesa de control
                        </a>
                        <ul>
<?php
        if(isset($_SESSION['group']) && ($_SESSION['group'] == "5" OR $_SESSION['group'] == "6")){
?>
                            <li><a href="<?=SITE_ROOT?>/procesos/mesacontrol/ordenesProduccion.php">Ordenes de producci&oacute;n</a></li>
<?php
        }
?>
                        </ul>
                    </li>
<?php
    }
    if(isset($_SESSION['group']) && ($_SESSION['group'] == "1" OR $_SESSION['group'] == "5" OR $_SESSION['group'] == "6")){
?>
                    <li>
                        <a href="#" class="nav-top-item"> <!-- Add the class "current" to current menu item -->
                            WorkFlow
                        </a>
                        <ul>
                            <li><a href="<?=SITE_ROOT?>/procesos/workflow/cases.php">Casos</a></li>
                        </ul>
                    </li>
<?php
    }
    if(isset($_SESSION['group']) && ($_SESSION['group'] == "1" || $_SESSION['group'] == "5" || $_SESSION['group'] == "6" ||  $_SESSION['group'] == "8" && $_SESSION['group'] != "2" || (isset($_SESSION['id']) && $_SESSION['id'] == "1184" || $_SESSION['id'] == "1305"))){
?>
                    <li>
                        <a href="#" class="nav-top-item"> <!-- Add the class "current" to current menu item -->
                            Reportes e informes
                        </a>
                        <ul>
                            <li><a href="<?=SITE_ROOT?>/procesos/report/reportPlanillas.php">Seguimiento planillas</a></li>
<?php
        if(isset($_SESSION['group']) && $_SESSION['group'] == "8"):
?>
                            <li><a href="<?=SITE_ROOT?>/procesos/report/reportCallGeneral.php">Reporte CallCenter</a></li>
<?php
        endif;
        if(isset($_SESSION['group']) && ($_SESSION['group'] == "5" OR $_SESSION['group'] == "6" OR $_SESSION['group'] == "1")):
            if (isset($_SESSION['group']) && ($_SESSION['group'] == "1" OR $_SESSION['group'] == "5" OR $_SESSION['group'] == "6" OR $_SESSION['group'] == "7")):
?>
                            <li><a href="<?=SITE_ROOT?>/procesos/report/reportCallGeneral.php">Reporte CallCenter</a></li>
                            <li><a href="<?=SITE_ROOT?>/procesos/report/reportCallCapi.php">Reporte Capi</a></li>
                            <li><a href="<?=SITE_ROOT?>/procesos/report/reportRenovacionAutos.php">Reporte renovacion autos</a></li>
<?php
            endif;
?>
                            <li><a href="<?=SITE_ROOT?>/procesos/report/reportGeneral.php">Reporte interno</a></li>
                            <li><a href="<?=SITE_ROOT?>/procesos/report/reportProductividad.php">Reporte productividad</a></li>
<?php
        endif;
        if(isset($_SESSION['group']) && ($_SESSION['group'] == "5" OR $_SESSION['group'] == "6" OR $_SESSION['group'] == "1" OR $_SESSION['group'] == "8")):
?>
                            <li><a href="<?=SITE_ROOT?>/procesos/report/reportDesactualizados.php">Reporte desactualizados</a></li>
                            <li><a href="<?=SITE_ROOT?>/procesos/report/reportSpecial.php">Reporte digitaci&oacute;n</a></li>
                            <li><a href="<?=SITE_ROOT?>/procesos/report/reportDigitacionFATCA.php">Reporte digitaci&oacute;n FATCA</a></li>
                            <li><a href="<?=SITE_ROOT?>/procesos/report/reportDevolucion.php">Reporte de devoluciones</a></li>
                            <li><a href="<?=SITE_ROOT?>/procesos/report/reportCalidad.php">Reporte de Calidad</a></li>
                            <li><a href="<?=SITE_ROOT?>/procesos/report/reportConsolidadoClientes.php">Consolidado clientes</a></li>
                            <li><a href="<?=SITE_ROOT?>/procesos/report/reportFormatoActualizacion.php">Formato de Actualizacion</a></li>
<?php
        endif;
?>
                        </ul>
                    </li>
<?php
    }
    if(isset($_SESSION['group']) && ($_SESSION['group'] == "1" OR $_SESSION['group'] == "5" OR $_SESSION['group'] == "6")){
?>
                    <li>
                        <a href="#" class="nav-top-item"> <!-- Add the class "current" to current menu item -->
                            Alertas
                        </a>
                        <ul>
                            <li><a href="<?=SITE_ROOT?>/procesos/alerts/alerts.php" >Listado de alertas</a></li>
                        </ul>
                    </li>
<?php
    }
    if(isset($_SESSION['group']) && ($_SESSION['group'] == "1" OR $_SESSION['group'] == "2" OR $_SESSION['group'] == "3" OR $_SESSION['group'] == "4" OR $_SESSION['group'] == "5" OR $_SESSION['group'] == "6" OR $_SESSION['group'] == "8" OR $_SESSION['group'] == "9")){
?>
                    <li>
                        <a href="#" class="nav-top-item current"> <!-- Add the class "current" to current menu item -->
                            Mis opciones
                        </a>
                        <ul>
                            <li><a href="#" onclick="$(this).mostrarCambiarPassword(event);">Cambiar contraseña</a></li>
                            <li><a href="<?=SITE_ROOT?>/lib/general/logout.php">Salir</a></li> <!-- Add class "current" to sub menu items also -->
                        </ul>
                    </li>
<?php
    }
?>
                </ul> <!-- End #main-nav -->
                <div id="change_password" style="display: none"> <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
                    <h3>CAMBIAR CONTRASEÑA PERSONAL</h3>
                    <p>
                        El cambio de su contraseña periodicamente ayuda a mantener su cuenta 
                        más segura, evitando así que otras personas accedan sin su concentimiento.
                    </p>
                    <form method="POST" name="password_form" id="password_form" onsubmit="$(this).cambiarPassword(event);">
                        <h4>Realizar el cambio ...</h4>
                        <br>
                        <fieldset>
                            <b>Contraseña actual:</b><br/>
                            <input class="text-input medium-input" type="password" name="anterior_password" />
                        </fieldset>
                        <br>
                        <fieldset>
                            <b>Nuevo contraseña:</b><br/>
                            <input class="text-input medium-input" type="password" name="nuevo_password" />
                        </fieldset>
                        <br>
                        <fieldset>
                            <b>Re-escribir nueva contraseña:</b></br>
                            <input class="text-input medium-input" type="password" name="nuevo_password2" />
                        </fieldset>                            
                        <br><br>
                        <fieldset style="display: flex; align-items: center;">
                            <input class="button" type="submit" id="cambiar_pass" value="Cambiar contraseña >>" />
                            <div style="width: 16px; height: 16px; padding-left: 5px;">
                                <img id="imgloading-cambiar-password" src="<?=SITE_ROOT?>/images/icons/loading.gif" style="display: none;" />
                            </div>
                        </fieldset>
                        <input type="hidden" name="domain" value="user">
                        <input type="hidden" name="action" value="cambiarPassword">
                        <input type="hidden" name="meth" value="js">
                    </form>
                    <div class="notification error png_bg" id="cambiar-password-resultado-error" style="display: none; margin-top: 15px;">
                        <div id="mensaje-error" style="margin: 10px 10px;"></div>
                    </div>
                </div> <!-- End #messages -->
            </div>
        </div> <!-- End #sidebar -->
        <div id="box-manual-radicacion" style="display:none;"></div>
        <div id="main-content"> <!-- Main Content Section with everything -->