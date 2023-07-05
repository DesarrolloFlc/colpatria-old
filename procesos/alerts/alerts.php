<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header.php';
?>
<!-- Page Head -->
<h2>Alertas Colpatria</h2>
<p id="page-intro">Informes de alertas basado en lineamientos de Colpatria.</p>

<div class="notification information png_bg">
    <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
    <div>
        Las alertas permiten encontrar inconsistencias en la informaci&oacute;n diligenciada por los clientes en los formularios.
    </div>
</div>

<ol>
	<li>Clientes reportados en las Listas de Validaci&oacute;n</li>
    <li>
		<a href="" onClick="window.open('viewAlert.php?id_alert=2', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=760, height=620, top=85, left=140');return false;" target="_blank" >Clientes con actividad Hogar que sus ingresos superen $1.000.000</a>
	</li>
	<li>
		<a href="" onClick="window.open('viewAlert.php?id_alert=3', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=760, height=620, top=85, left=140');return false;" target="_blank" >Clientes con actividad Estudiante que sus ingresos superen $1.000.000</a>
	</li>
	<li>
		<a href="" onClick="window.open('viewAlert.php?id_alert=4', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=760, height=620, top=85, left=140');return false;" target="_blank" >Lista desplegable para validaci&oacute;n por tipo de actividad</a>
	</li>
    <li>
		<a href="" onClick="window.open('viewAlert.php?id_alert=5', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=760, height=620, top=85, left=140');return false;" target="_blank" >Clientes ilocalizados</a>
	</li>
	<li>Clientes con transacciones en el exterior</li>
	<li>
		<a href="" onClick="window.open('viewAlert.php?id_alert=7', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=760, height=620, top=85, left=140');return false;" target="_blank" >Clientes naturales con Patrimonio superior a $300.000.000</a>
	</li>
    <li>Clientes con diferente No. de identificaci&oacute;n e igual direcci&oacute;n</li>
	<li>Clientes con diferente No. de identificaci&oacute;n e igual No. de tel&eacute;fono</li>
	<li>Clientes con tipo de Actividad Ganero, Agricultor, Casa de cambio, Comerciante de joyas, Cargo p&uacute;blico, Pol&iacute;tico</li>
	<li>Clientes en quienes no coincida la huella y la firma</li>
    <li>
		<a href="" onClick="window.open('viewAlert.php?id_alert=12', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=760, height=620, top=85, left=140');return false;" target="_blank" >Clientes renuentes</a>
	</li>
	<li>Cambios financieros en los clientes cuando en la actualizaci&oacute;n de la informaci&oacute;n supera entre cambio y cambio el 50% de ingresos del formulario anterior</li>	
	<li>
		<a href="" onClick="window.open('viewAlert.php?id_alert=14', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=760, height=620, top=85, left=140');return false;" target="_blank" >Cambios en los tipos de actividad de los clientes en las actualizaciones</a>
	</li>
    <li>
		<a href="" onClick="window.open('viewAlert.php?id_alert=15', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=760, height=620, top=85, left=140');return false;" target="_blank" >Reporte de clientes que cuando se confirmen cambien alg&uacute;n tipo de informaci&oacute;n</a>
	</li>
    <li>Clientes con el mismo n&uacute;mero de identificaci&oacute;n y con nombre diferente.</li>
	<li>Clientes que vivan en ciudades zona roja.</li>
</ol>
<?php
require_once PATH_SITE . DS . 'template/general/footer.php';
