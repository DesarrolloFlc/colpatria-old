<?php
session_start();
if(!isset($_SESSION['id'])){
    echo "Su sesi&oacute;n ha caducado, por favor inicie sesi&oacute;n para poder seguir digitando...";
    exit();
}
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'image.class.php';
require_once PATH_CCLASS . DS . 'log.class.php';

$image = new Image();
$image_now = $image->getImageDB($_SESSION['id']);
$image_now = mysqli_fetch_array($image_now);
$images_faltantes = $image->getImages(1, $_SESSION['id']);
$images_faltantes = mysqli_fetch_array($images_faltantes);
$lote = explode("_", $image_now['filename']);
$marca = "";
if (isset($lote[3]) && strlen($lote[3]) != 3) {
    $marca = explode(".", $lote[3]);
    $marca = $marca[0];
}
$lote = isset($lote[1]) ? ($lote[0] . "_" . $lote[1]) : ($lote[0] . "_");

$planilla = mysqli_fetch_array($image->getPlanilla($_SESSION['id']));
//$next_images = $image->getNextImages($_SESSION['id'], $image_now['id']);
$planilla_lote = mysqli_fetch_array($image->getPlanillaLote($_SESSION['id'], $lote));

$planilla1 = explode("_", $planilla['filename']);
$planilla1 = $planilla1[0];

extract($_GET);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Gestor documental. FinlecoBPO - Colpatria</title>        
    <!-- Source File -->
    <link rel="stylesheet" href="<?=SITE_ROOT?>/css/general.css" type="text/css" />
    <link type="image/x-icon" href="<?=SITE_ROOT?>/images/icons/favicon.ico" rel="icon" />
    <script src="<?=SITE_ROOT?>/resources/scripts/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="<?=SITE_ROOT?>/resources/scripts/pdfobject/pdfobject/pdfobject.min.js" type="text/javascript"></script>
</head>
<body>
<?php
if($images_faltantes['total'] <= 0){
	$num_planillas_faltantes = mysqli_fetch_array($image->getPlanillaActiva($_SESSION['id']));
?>
	<h1>No hay m&aacute;s im&aacute;genes para indexar en estos momentos.</h1>
	<h4>Numero de planillas para indexar: <?=$num_planillas_faltantes['total']?></h4>
<?php
	if($num_planillas_faltantes['total'] > 0){
?>
	<form method="POST" id="desactivarPlanillas" name="desactivarPlanillas">
        <input type="submit" class="button" value="Archivar planillas >>" id="button_desactivarPlanillas">
        <input type="hidden" value="<?=$_SESSION['id']?>" name="id_user" id="id_user">
		<input type="hidden" name="domain" id="domain" value="form">
		<input type="hidden" name="action"   id="action" value="desactivarPlanillas">
		<input type="hidden" name="meth" id="meth" value="js">
		<input type="hidden" name="respOut" id="respOut" value="json">
    </form>
	<script languaje="javascript" type="text/javascript">
	$(document).ready(function(){
		$('form#desactivarPlanillas').submit(function(event) {
			(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
			var resp = confirm('Esta seguro que quiere archivar planilla?');
			if(resp){
				var data = $(this).serialize();
				$.ajax({
					beforeSend: function(){
						$('form#desactivarPlanillas input#button_desactivarPlanillas').attr('disabled', true);
					},
					data: data,
					type: 'POST',
					url: '../includes/Controller.php',
					dataType: 'json',
					success: function(dato){
						if(dato.exito){
							alert(dato.exito);
							window.location.href = 'fingering2.php';
						}else if(dato.error){
							alert(dato.error);
						}else{
							alert('Ocurrio un error al momento de agregar el nuevo formulario, contacte con el administrador por favor..');
							console.log(dato);
						}
					},
					complete: function(jqXHR, textStatus){
						//$('form#desactivarPlanillas input#button_desactivarPlanillas').removeAttr('disabled');
					},
					error: function(xhr, ajaxOptions, thrownError) {
						console.log(xhr, ajaxOptions, thrownError);
						$('form#desactivarPlanillas input#button_desactivarPlanillas').removeAttr('disabled');
						alert("Error(desactivarPlanillas): "+xhr.status+" Error: "+xhr.responseText);
					}
				});
			}
		});
	});
	</script>
<?php
	}
	exit;
}
if(empty($id_form)){
	$log = new Log();
	$id_form_log = mysqli_fetch_array($log->getIdIndexacion($_SESSION['id']));
	$id_form = $id_form_log['id_form'];
}
?>
<?="<!--" . $PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $image_now['filename'] ." -->";?>
    <div id="digitalizar_left" style="padding-right: 10px;">
<?php
$pathFiles = $PATH_IMAGES_TMP . $_SESSION['id'] . "/";
$file = $PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $image_now['filename'];
$mimeTipeForm = mime_content_type(PATH_SITE . DS . "tmp_images" . DS . $_SESSION['id'] . "/" . $image_now['filename']);
if($mimeTipeForm == 'application/pdf'){
?>
		<div id="muestra-pdf"></div>
		<script>
		var opt = {
			width: '100%',
			height: '100%',
			pdfOpenParams: {
				view: 'FitH'
			}
		};
		PDFObject.embed("<?=$file?>", "#muestra-pdf", opt);
		</script>
<?php
}else if($mimeTipeForm == 'image/tiff'){
?>
        <object id="tiffobj0" width=620 height=650 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
            <param name="src" value="<?=$PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $image_now['filename'];?>">                
            <embed width=620 height=650 src="<?=$PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $image_now['filename'];?>" type="image/tiff">
        </object>
<?php
}else{
?>
	<div style="width: 400px; height: 300px; margin-left: auto; margin-right: auto;"><img src="<?=SITE_ROOT?>/imgages/general/Imagen_no_disponible.jpg"></div>
    <div class="alert" style="width: 500px;">
      <strong>Ups!</strong> Parece que algo salio mal, contacta con el administrador.
    </div>
<?php
}
?>
    </div>
    <p><?=$image_now['filename'];?></p>
    <div id="digitalizar_right">
        <table>              
            <tr>
                <td>Lote</td>
                <td><input type="text" name="lote" id="lote" value="<?=$lote;?>" disabled/></td>
                <td>Marca:</td>
                <td><input type="text" name="marca" id="marca" value="<?=$marca;?>" disabled/></td>
            </tr>
            <tr>
                <td>Documento:</td>
                <td>
                    <select name="tipodocumento_1" id="tipodocumento_1">
                        <option value="">-- Seleccione un tipo de documento --</option>
                        <option value="1">Formulario</option>
						<option value="6">Formulario nuevo</option>
						<option value="7">Formulario nuevo(CE027/20)</option>
						<option value="8">Formato regimen simplificado(tirilla)</option>
						<option value="9">Formato sector asegurado(CE027/20)</option>
                        <!-- <option value="2">Formulario Cara B</option>
                        <option value="3">Documento Anexo</option> -->
                        <option value="4">Formato Renovacion Autos</option>
                        <option value="5">Documentacion Complementaria</option>
                    </select>
                </td>
            </tr>
        </table>
        <form method="POST" id="form_fingering" name="form_fingering">
            <div id="fields_form" style="width:100%; height: auto;"></div>
            <input type="hidden" name="id_imagen_tmp" id="id_imagen_tmp" value="<?=$image_now['id']?>">
            <input type="hidden" name="id_form" id="id_form" value="<?=$id_form?>">
            <input type="hidden" name="id_user" id="id_user" value="<?=$_SESSION['id']?>">
            <input type="hidden" name="lote" id="lote" value="<?=$lote?>">
            <input type="hidden" name="planilla1" id="planilla1" value="<?=$planilla1?>">
            <input type="hidden" name="marca" id="marca" value="<?=$marca ?>">
            <input type="hidden" name="planilla_lote" id="planilla_lote" value="<?=$planilla_lote['filename']?>">
        </form>
    </div>
    <div id="thumbs_images">
<?php
if($mimeTipeForm == 'image/tiff'){
?>
        <object width=110 height=160 TOOLBAR=off classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
            <param name="src" TOOLBAR=off value="<?=$PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $planilla['filename'];?>">                
            <embed width=110 TOOLBAR=off height=160 src="<?=$PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $planilla['filename'];?>" type="image/tiff">
        </object>
        <object width=110 height=160 TOOLBAR=off classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
            <param name="src" TOOLBAR=off value="<?=$PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $planilla_lote['filename'];?>">                
            <embed width=110 TOOLBAR=off height=160 src="<?=$PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $planilla_lote['filename'];?>" type="image/tiff">
        </object>
<?php
		/*while($next_img = mysqli_fetch_array($next_images)){
?>
        <object width=110 height=160 TOOLBAR=off classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
            <param name="src" TOOLBAR=off value="<?=$PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $next_img['filename'];?>">                
            <embed width=110 TOOLBAR=off height=160 src="<?=$PATH_IMAGES_TMP . $_SESSION['id'] . "/" . $next_img['filename'];?>" type="image/tiff">
        </object>
<?php
		}*/
}else if($mimeTipeForm == 'application/pdf'){
?>
		<ul>
			<li style="display: block;"><a href="#" onclick="$(this).mostrarPdfFuncion(event, '<?=$image_now['filename']?>');">Formulario</a></li>
			<li style="display: block;"><a href="#" onclick="$(this).mostrarPdfFuncion(event, '<?=$planilla['filename']?>');">Planilla</a></li>
			<li style="display: block;"><a href="#" onclick="$(this).mostrarPdfFuncion(event, '<?=$planilla_lote['filename']?>');">Planilla lote</a></li>
<?php
		/*while($next_img = mysqli_fetch_array($next_images)){
?>
			<li style="display: block;"><a href="#" onclick="$(this).mostrarPdfFuncion(event, '<?=$next_img['filename']?>');"><?=$next_img['filename']?></a></li>
<?php
		}*/
?>
		</ul>
<?php
}
?>
</div>
<script languaje="javascript" type="text/javascript">
$(document).ready(function(){
	var tam = tamVentana();
	var tamRight = tam[0] - 580;
	$('#digitalizar_left').css('width', tamRight);
	window.moveTo(0, 0);
	window.resizeTo(window.screen.width, window.screen.height - 25);
	$("#tipodocumento_1").change(function(){
		if($(this).val() != ""){
			var tipo = $(this).val();
			$.ajax({
				data: {
					domain: 'form',
					action: 'formularioDigitar',
					type: tipo,
					meth: 'js',
					respOut: 'html'
				},
				type: 'GET',
				url: '../includes/Controller.php',
				dataType: 'html',
				success: function(dato){
					$('#fields_form').html(dato);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert("Error(guardarGestionDeposito): "+xhr.status+" Error: "+xhr.responseText);
				}
			});
		}
	});
	$("#tipopersona").change(function() {
		/* if( $('#tipopersona').val() != "") {
		$.post('fields.php', {type_person: $('#tipopersona').val()},function( data) {
		$('#fields_persona').html(data);                          
		});
		}*/
	});
});
/*function validar_num(e) {
	tecla_codigo = (document.all) ? e.keyCode : e.which;
	if (tecla_codigo == 8)
	return true;
	patron = /^\d+$/;
	tecla_valor = String.fromCharCode(tecla_codigo);
	return patron.test(tecla_valor);
}*/
function validar_num(e){
	tecla_codigo = (document.all) ? e.keyCode : e.which;
	if(((e.keyCode || e.which) == 8) || ((e.keyCode || e.which) == 9) || tecla_codigo == 42)return true;
	patron =/^[0-9\t]+$/;
	tecla_valor = String.fromCharCode(tecla_codigo);
	return patron.test(tecla_valor);
} 
function validar_letra(e){
	tecla_codigo = (document.all) ? e.keyCode : e.which;
	if(((e.keyCode || e.which) == 8) || ((e.keyCode || e.which) == 9))return true;
	patron =/^[A-ZÑÁÉÍÓÚ0-9@#-_\s\.]*$/;
	tecla_valor = String.fromCharCode(tecla_codigo);
	return patron.test(tecla_valor);
}
$.fn.verificarFecha = function(e, call, tipo){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	var f_a = $('select#f_'+call+'_a').val();
	var f_m = $('select#f_'+call+'_m').val();
	if((f_a != '' && f_a != 'ND') && (f_m != '' && f_m != 'ND')){
		var d = new Date(f_a, f_m, 0).getDate();
		var d_str = '';
		str_d = '<option value="">Dia</option>';
		for(var i=1;i<=d;i++){
			d_str = '0'+i;
			if(i > 9)
				d_str = i;
			str_d += '<option value="'+d_str+'">'+d_str+'</option>';
		}
		$('select#f_'+call+'_d').html(str_d);
	}else if(f_a == 'ND' || f_m == 'ND'){
		//$('select#f_'+call+'_a option[value="ND"]').prop('selected', true);
		$('select#f_'+call+'_m option[value="ND"]').prop('selected', true);
		$('select#f_'+call+'_d').html('<option value="">Dia</option><option value="ND">ND</option>');
		$('select#f_'+call+'_d option[value="ND"]').prop('selected', true);
	}
}
$.fn.verificarFechaMultiple = function(e, call, tipo, pos){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	var f_a = $('select#f_'+call+'_a\\['+pos+'\\]').val();
	var f_m = $('select#f_'+call+'_m\\['+pos+'\\]').val();
	if((f_a != '' && f_a != 'ND') && (f_m != '' && f_m != 'ND')){
		var d = new Date(f_a, f_m, 0).getDate();
		var d_str = '';
		str_d = '<option value="">Dia</option>';
		for(var i = 1; i <= d; i++){
			d_str = '0'+i;
			if(i > 9)
				d_str = i;
			str_d += '<option value="'+i+'">'+d_str+'</option>';
		}
		$('select#f_'+call+'_d\\['+pos+'\\]').html(str_d);
	}else if(f_a == 'ND' || f_m == 'ND'){
		$('select#f_'+call+'_m\\['+pos+'\\] option[value="ND"]').prop('selected', true);
		$('select#f_'+call+'_d\\['+pos+'\\]').html('<option value="">Dia</option><option value="ND">ND</option>');
		$('select#f_'+call+'_d\\['+pos+'\\]').val('ND').change();
	}
}
$.fn.verificarFechaDoble = function(e, call, tipo){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	if(tipo == '1'){
		var f_a = $('select#f_'+call+'_a').val();
		var f_m = $('select#f_'+call+'_m').val();
		var f_d = $(this).val();
		if(f_a != '' && f_m != '' && f_d != ''){
			if(call == 'nac'){
				var fNac = f_a + '-' + f_m + '-' + f_d;
				var fExp = $('select#f_exp_a').val() + '-' + $('select#f_exp_m').val() + '-' + $('select#f_exp_d').val();
				var dif = diff_years(new Date(fExp), new Date(fNac));
				if(dif < 18){
					alert('La diferencia entre fecha de nacimiento y fecha de expedicion debe ser mayor a 18 años');
					$('select#f_'+call+'_a').val('').change();
					$('select#f_'+call+'_m').val('').change();
					$(this).val('').change();
					$('select#f_'+call+'_a').focus();
					return false;
				}
			}
			$('select#f_'+call+'_a').hide();
			$('select#f_'+call+'_m').hide();
			$(this).hide();
		}
	}else if(tipo == '2'){
		var f_1 = $('select#f_'+call+'_a').val()+'-'+$('select#f_'+call+'_m').val()+'-'+$('select#f_'+call+'_d').val();
		var f_2 = $('select#f_'+call+'2_a').val()+'-'+$('select#f_'+call+'2_m').val()+'-'+$('select#f_'+call+'2_d').val();
		if(f_1 != f_2){
			alert("Las fechas no coinciden, por favor validelas.");
			$('select#f_'+call+'_a').show();
			$('select#f_'+call+'_a').val('');
			$('select#f_'+call+'_a').change();
			$('select#f_'+call+'_m').show();
			$('select#f_'+call+'_m').val('');
			$('select#f_'+call+'_m').change();
			$('select#f_'+call+'_d').show();
			$('select#f_'+call+'_d').val('');
			$('select#f_'+call+'_d').change();

			$('select#f_'+call+'2_a').val('');
			$('select#f_'+call+'2_a').change();
			$('select#f_'+call+'2_m').val('');
			$('select#f_'+call+'2_m').change();
			$('select#f_'+call+'2_d').val('');
			$('select#f_'+call+'2_d').change();

			$('select#f_'+call+'_a').focus();
		}
	}
}
function diff_years(dt2, dt1){
	var diff =(dt2.getTime() - dt1.getTime()) / 1000;
	diff /= (60 * 60 * 24);
	return Math.abs(Math.round(diff/365.25));
}
$.fn.ocultarEsteCampo = function(e){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	if($(this).val() != '')
		$(this).hide();
};
$.fn.checkTamanoTele = function(e, leng) {
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	var valotel = $(this).val();
	if (valotel != '' && valotel != '*') {
		var idcampo = $(this).attr('id');
		if (valotel.length < leng) {
			alert('Por favor verifique el campo telefonico que debe tener exactamente ' + leng + ' digitos');
			setTimeout(function() { document.getElementById("" + idcampo).focus(); }, 1);
			return false;
		}
		if (idcampo == 'telefonoresidencia' || idcampo == 'celular' || idcampo == 'telefonoficina' || idcampo == 'celularoficina')
			$(this).hide();
	}
}
$.fn.validarCampoReescrito = function(e, tipo, formu, nombre, mensaje){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	if($(this).val() != $('form#'+ formu +' '+ tipo +'[name="'+ nombre +'"]').val()){
		alert(mensaje);
		$('form#'+ formu +' '+ tipo +'[name="'+ nombre +'"]').val('');
		$(this).val('');
		$('form#'+ formu +' '+ tipo +'[name="'+ nombre +'"]').show();
		$('form#'+ formu +' '+ tipo +'[name="'+ nombre +'"]').focus();
	}
};
$.fn.revisarTipoPersona = function(e){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	if($(this).val() != '' && $(this).val() != $('form#form_fingering select[name="tipopersona"]').val()){
		alert('Los tipos de persona no coinciden, por favor verifiquelos.');
		$('form#form_fingering select[name="tipopersona"]').val('').change();
		$(this).val('').change();
		$('form#form_fingering select[name="tipopersona"]').focus();
		return false;
	}
}
$.fn.mostrarPdfFuncion = function(e, fileName){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	if(fileName != ''){

		var opt = {
			width: '100%',
			height: '100%',
			pdfOpenParams: {
				view: 'FitH'
			}
		};
		var file = '<?=$pathFiles?>' + fileName;
		PDFObject.embed(file, "#muestra-pdf", opt);
	}
};
function tamVentana(){
    var tam = [0, 0];
    if (typeof window.innerWidth != 'undefined')
    {
        tam = [window.innerWidth,window.innerHeight];
    }
    else if (typeof document.documentElement != 'undefined'
      && typeof document.documentElement.clientWidth !=
      'undefined' && document.documentElement.clientWidth != 0)
    {
        tam = [
            document.documentElement.clientWidth,
            document.documentElement.clientHeight
        ];
    }
    else   {
        tam = [
            document.getElementsByTagName('body')[0].clientWidth,
            document.getElementsByTagName('body')[0].clientHeight
        ];
    }
    return tam;
}
</script>
</body>
</html>