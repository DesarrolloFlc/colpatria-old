<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'general.class.php';
$type = $_POST['type'];
if (isset($_POST['migracion']) && $_POST['migracion'] != '')
    $migra = $_POST['migracion'];
?>
<script type="text/javascript">

    function cambiarEstadoActividad() {
        if (document.getElementById("actividadeconomicappal").value == "810") {
            document.getElementById("otrosactividad").style.display = "block";
            document.getElementById("detalleactividadeconomicappal").disabled = false;
        } else {
            document.getElementById("otrosactividad").style.display = "none";
        }
    }

    function ocultarCampoTelf() {
        document.getElementById("telefonoresidencia").style.display = "none";
    }

    function validarCampoTelf() {
        if (document.getElementById("telefonoresidencia").value != document.getElementById("telefonoresidencia2").value) {
            alert("Los telefonos no coinciden por favor validelos.");
            document.getElementById("telefonoresidencia").value = "";
            document.getElementById("telefonoresidencia2").value = "";
            document.getElementById("telefonoresidencia").style.display = "block";
        }
    }

    function validarCampoCel() {
        if (document.getElementById("celular").value != document.getElementById("celular2").value) {
            alert("Los numeros de celular no coinciden, por favor validelos.");
            document.getElementById("celular").value = "";
            document.getElementById("celular2").value = "";
            document.getElementById("celular").style.display = "block";
        }
    }

    function validarCampoTelfOfi() {
        if (document.getElementById("telefonoficina").value != document.getElementById("telefonoficina2").value) {
            alert("Los telefonos no coinciden por favor validelos.");
            document.getElementById("telefonoficina").value = "";
            document.getElementById("telefonoficina2").value = "";
            document.getElementById("telefonoficina").style.display = "block";
        }
    }

    function validarCampoCelOfi() {
        if (document.getElementById("celularoficina").value != document.getElementById("celularoficina2").value) {
            alert("Los numeros de celular no coinciden, por favor validelos.");
            document.getElementById("celularoficina").value = "";
            document.getElementById("celularoficina2").value = "";
            document.getElementById("celularoficina").style.display = "block";
        }
    }

    function ocultarCampoDoc() {
        if (document.getElementById("documento").value != '')
            document.getElementById("documento").style.display = "none";
    }
    function validarCampoDoc() {
        if (document.getElementById("documento").value != document.getElementById("documento2").value) {
            alert("El numero de documento no coinciden por favor validelos.");
            document.getElementById("documento").value = "";
            document.getElementById("documento2").value = "";
            document.getElementById("documento").style.display = "block";
        }
    }
    function ocultarCampoNit() {
        if (document.getElementById("nit").value != '')
            document.getElementById("nit").style.display = "none";
    }
    function validarCampoNit() {
        if (document.getElementById("nit").value != document.getElementById("nit2").value) {
            alert("El numero de nit no coinciden por favor validelos.");
            document.getElementById("nit").value = "";
            document.getElementById("nit2").value = "";
            document.getElementById("nit").style.display = "block";
        }
    }
    function ocultarCampoDocAutos() {
        if (document.getElementById("numero").value != '')
            document.getElementById("numero").style.display = "none";
    }
    function validarCampoDocAutos() {
        if (document.getElementById("numero").value != document.getElementById("numero2").value) {
            alert("El numero de documento no coinciden por favor validelos.");
            document.getElementById("numero").value = "";
            document.getElementById("numero2").value = "";
            document.getElementById("numero").style.display = "block";
        }
    }
    function ocultarCampoGenero() {
        if (document.getElementById("sexo").value != '')
            document.getElementById("sexo").style.display = "none";
    }
    function validarCampoGenero() {
        if (document.getElementById("sexo").value != document.getElementById("sexo2").value) {
            alert("La opcion seleccionada para el campo de genero no coinciden por favor validelos.");
            document.getElementById("sexo").value = "";
            document.getElementById("sexo2").value = "";
            document.getElementById("sexo").style.display = "block";
        }
    }

    function mostrarCampoTelf() {
        document.getElementById("telefonoresidencia").style.display = "block";
    }
    $.fn.revisarTipoPersona = function(e){
        if($(this).val() != '' && $(this).val() != $('form#form_fingering select[name="tipopersona"]').val()){
            alert('Los tipos de persona no coinciden, por favor verifiquelos.');
            $('form#form_fingering select[name="tipopersona"]').val('').change();
            $(this).val('').change();
            $('form#form_fingering select[name="tipopersona"]').focus();
            return false;
        }
    }
    $.fn.verificarFechaSolicitud = function(){
        if($('select#fechasolicitud_a').val() == ''){
            $('select#fechasolicitud_a').focus();
            return false;
        }
        if($('select#fechasolicitud_m').val() == ''){
            $('select#fechasolicitud_m').focus();
            return false;
        }
        if($('select#fechasolicitud_d').val() == ''){
            $('select#fechasolicitud_d').focus();
            return false;
        }
        $('select#fechasolicitud_a').hide();
        $('select#fechasolicitud_m').hide();
        $('select#fechasolicitud_d').hide();
    }
    $.fn.verificarReFechaSolicitud = function(){
        if($('select#fechasolicitud2_a').val() == ''){
            $('select#fechasolicitud2_a').focus();
            return false;
        }else if($('select#fechasolicitud_a').val() != $('select#fechasolicitud2_a').val()){
            alert("Las fechas de solicitud no coinciden, por favor validelas.");
            $('select#fechasolicitud_a').show();
            $('select#fechasolicitud_m').show();
            $('select#fechasolicitud_d').show();
            $('select#fechasolicitud_a').val('');
            $('select#fechasolicitud_m').val('');
            $('select#fechasolicitud_d').val('');

            $('select#fechasolicitud_a').focus();
        }
        if($('select#fechasolicitud2_m').val() == ''){
            $('select#fechasolicitud2_m').focus();
            return false;
        }else if($('select#fechasolicitud_m').val() != $('select#fechasolicitud2_m').val()){
            alert("Las fechas de solicitud no coinciden, por favor validelas.");
            $('select#fechasolicitud_a').show();
            $('select#fechasolicitud_m').show();
            $('select#fechasolicitud_d').show();
            $('select#fechasolicitud_a').val('');
            $('select#fechasolicitud_m').val('');
            $('select#fechasolicitud_d').val('');

            $('select#fechasolicitud_a').focus();
        }
        if($('select#fechasolicitud2_d').val() == ''){
            $('select#fechasolicitud2_d').focus();
            return false;
        }else if($('select#fechasolicitud_d').val() != $('select#fechasolicitud2_d').val()){
            alert("Las fechas de solicitud no coinciden, por favor validelas.");
            $('select#fechasolicitud_a').show();
            $('select#fechasolicitud_m').show();
            $('select#fechasolicitud_d').show();
            $('select#fechasolicitud_a').val('');
            $('select#fechasolicitud_m').val('');
            $('select#fechasolicitud_d').val('');

            $('select#fechasolicitud_a').focus();
        }
    }
    $.fn.checkTamanoTele = function(leng) {
        var valotel = $(this).val();
        if (valotel != '') {
            var idcampo = $(this).attr('id');
            if (valotel.length < leng) {
                alert('Por favor verifique el campo telefonico que debe tener exactamente ' + leng + ' digitos');
                $('#' + idcampo).focus();
                return false;
            }
            if (idcampo == 'telefonoresidencia' || idcampo == 'celular' || idcampo == 'telefonoficina' || idcampo == 'celularoficina')
                $('#' + idcampo).hide();
        }

    }
    $.fn.changeTipoAtividad = function() {
        if ($(this).val() == '8')
            $('#trdetalletipoactividad').show();
        else
            $('#trdetalletipoactividad').hide();
    }
    $.fn.changeOcupacion = function() {
        if ($(this).val() == '221')
            $('#trdetalleocupacion').show();
        else
            $('#trdetalleocupacion').hide();
    }
    $.fn.verificarFecNacOcultar = function(e) {
        if ($('#fechanacimiento_a').val() != '' && $('#fechanacimiento_m').val() != '' && $('#fechanacimiento_d').val() != '') {
        	var fNac = $('#fechanacimiento_a').val() + '-' + $('#fechanacimiento_m').val() + '-' + $('#fechanacimiento_d').val();
        	var fExp = $('#fechaexpedicion_a').val() + '-' + $('#fechaexpedicion_m').val() + '-' + $('#fechaexpedicion_d').val();
            var dif = diff_years(new Date(fExp), new Date(fNac));
            if(dif < 18){
            	alert('La diferencia entre fecha de nacimiento y fecha de expedicion debe ser mayor a 18 años');
            	//$('#fechanacimiento_a').hide();
            	$('#fechanacimiento_a').val('').change();
	            //$('#fechanacimiento_m').hide();
	            $('#fechanacimiento_m').val('').change();
	            //$('#fechanacimiento_d').hide();
	            $('#fechanacimiento_d').val('').change();
	            $('#fechanacimiento_a').focus();
            	return false;
            }
            $('#fechanacimiento_a').hide();
            $('#fechanacimiento_m').hide();
            $('#fechanacimiento_d').hide();
        }
    }
    function diff_years(dt2, dt1){
    	var diff =(dt2.getTime() - dt1.getTime()) / 1000;
    	diff /= (60 * 60 * 24);
    	return Math.abs(Math.round(diff/365.25));
    }
    $.fn.checkFechaNacimiento = function(e) {
        var fec_a = ((parseInt($('#fechanacimiento_a').val()) == NaN) ? 0 : parseInt($('#fechanacimiento_a').val()));
        var fec_a2 = ((parseInt($('#fechanacimiento2_a').val()) == NaN) ? 0 : parseInt($('#fechanacimiento2_a').val()));
        var fec_m = ((parseInt($('#fechanacimiento_m').val()) == NaN) ? 0 : parseInt($('#fechanacimiento_m').val()));
        var fec_m2 = ((parseInt($('#fechanacimiento2_m').val()) == NaN) ? 0 : parseInt($('#fechanacimiento2_m').val()));
        var fec_d = ((parseInt($('#fechanacimiento_d').val()) == NaN) ? 0 : parseInt($('#fechanacimiento_d').val()));
        var fec_d2 = ((parseInt($('#fechanacimiento2_d').val()) == NaN) ? 0 : parseInt($('#fechanacimiento2_d').val()));
        if ((fec_a != fec_a2)) {
            alert("Las fechas de nacimiento no coinciden, por favor validelas.");
            $('#fechanacimiento_a').show();
            $('#fechanacimiento_m').show();
            $('#fechanacimiento_d').show();
            $('#fechanacimiento_a').val('');
            $('#fechanacimiento_m').val('');
            $('#fechanacimiento_d').val('');
            $('#fechanacimiento2_a').val('');
            $('#fechanacimiento2_m').val('');
            $('#fechanacimiento2_d').val('');
        }
        if(($('#fechanacimiento2_m').val() != '') && (fec_m != fec_m2)){
            alert("Las fechas de nacimiento no coinciden, por favor validelas.");
            $('#fechanacimiento_a').show();
            $('#fechanacimiento_m').show();
            $('#fechanacimiento_d').show();
            $('#fechanacimiento_a').val('');
            $('#fechanacimiento_m').val('');
            $('#fechanacimiento_d').val('');
            $('#fechanacimiento2_a').val('');
            $('#fechanacimiento2_m').val('');
            $('#fechanacimiento2_d').val('');
        }
        if(($('#fechanacimiento2_d').val() != '') && (fec_d != fec_d2)){
            alert("Las fechas de nacimiento no coinciden, por favor validelas.");
            $('#fechanacimiento_a').show();
            $('#fechanacimiento_m').show();
            $('#fechanacimiento_d').show();
            $('#fechanacimiento_a').val('');
            $('#fechanacimiento_m').val('');
            $('#fechanacimiento_d').val('');
            $('#fechanacimiento2_a').val('');
            $('#fechanacimiento2_m').val('');
            $('#fechanacimiento2_d').val('');
        }
    }
    $(document).ready(function() {

        //SKRV
        if ($('input:radio[name="grupodoc"]:checked').val() == '7') {
            $('#dv_ocupaciones').hide();
            $('#dv_acteconomicas').show();
        } else {
            $('#dv_ocupaciones').show();
            $('#dv_acteconomicas').hide();
        }
        $("#tipo_cliente").change(function() {
            if ($('#tipo_cliente').val() == 1) {
                $("input#numero_").attr('disabled', 'disabled');
            } else {
                $("input#numero_").removeAttr('disabled');
            }
        });
        //SKRV

        $("#tipopersona").change(function() {
            if ($('#tipopersona').val() != "" && $('#tipodocumento_1').val() == '1') {
                $.post('fields.php', {type_person: $('#tipopersona').val()}, function(data) {
                    $('#fields_persona').html(data);
                });
            }else if ($('#tipopersona').val() != "" && $('#tipodocumento_1').val() == '6') {
                $.post('fields6.php', {type_person: $('#tipopersona').val()}, function(data) {
                    $('#fields_persona6').html(data);
                });
            }
        });

        $("#doc_comple").click(function() {
            if ($("#doc_comple").is(':checked')) {
                $('#docum_complem').show();
                $('#formulari_ug045').hide();
            } else {
                $('#docum_complem').hide();
                $('#formulari_ug045').show();
            }
        });

        $("#mes_").change(function() {//sinthia
            /*
             * Treinta dias tiene Septiembre, 
             Abril(4), Junio(6) y Noviembre (11)
             Todo el resto tienen treinta y uno
             Excepto Febrero que tiene Veintiocho
             o veintinueve en años bisiestos.
             */
            var cdias = 0;
            if ($("#mes_").val() == 4 || $("#mes_").val() == 6 || $("#mes_").val() == 11) {
                cdias = 30;
            } else if ($("#mes_").val() == 2) {
                var año = (new Date).getFullYear();
                var bisiesto = (año % 4 == 0) && ((año % 100 != 0) || (año % 400 == 0));
                if (bisiesto == true) {
                    cdias = 29;
                } else {
                    cdias = 28;
                }
            } else {
                cdias = 31;
            }
            var option = "";
            for (var i = 1; i <= cdias; i++) {
                if (i <= 9) {
                    option = option + "<option value='0" + i + "'>0" + i + "</option>";
                } else {
                    option = option + "<option value='" + i + "'>" + i + "</option>";
                }
            }
            $('#dia').html(option);
        });

        $('input[name="grupodoc"]').change(function(event){//sinthia
            (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
            $('tr#tr_detalle_ocu_act').html('');
            if ($(this).val() == '7') {
                $('#actecono').val('');
                //$("input#numero_").prop('disabled', true); //jQuery 1.6+
                $("input#numero_").removeAttr('disabled');//jQuery 1.5 and below
                $("#tblnombres").html('');
                var trtable = '<tr>' +
                        '<td colspan="3">Nombre/Razón Social</td>' +
                        '</tr>' +
                        '<tr >' +
                        '<td colspan="3">' +
                        '<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;" id="razonsocial" name="razonsocial">' +
                        '</td>' +
                        '</tr>';
                $("#tblnombres").html(trtable);

                $('#dv_ocupaciones').hide();
                $('#dv_acteconomicas').show();

            } else {
                $('#ocupacti').val('');
                //$("input#numero_").prop('disabled', false);//jQuery 1.6+
                $("input#numero_").attr('disabled', 'disabled');// jQuery 1.5 and below
                $("#tblnombres").html('');
                var trtable = '<tr>' +
                        '<td>Primer Apellido</td>' +
                        '<td>Segundo Apellido</td>' +
                        '<td>Nombres</td>' +
                        '</tr>' +
                        '<tr >' +
                        '<td>' +
                        '<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;" id="txtpapellido" name="txtpapellido">' +
                        '</td>' +
                        '<td>' +
                        '<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;" id="txtsapellido" name="txtsapellido">' +
                        '</td>' +
                        '<td>' +
                        '<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 100%;" onpaste="return false;" id="txtnombres" name="txtnombres">' +
                        '</td>' +
                        '</tr>';
                $("#tblnombres").html(trtable);

                $('#dv_ocupaciones').show();
                $('#dv_acteconomicas').hide();

            }
        });

        $("#form_fingering").submit(function() {
            //Numero de imagenes del MultiTIFF
<?php
if ($_SESSION['id'] == '1') {
    ?>
                //alert('aca444:'+);
    <?php
}
?>
        if($("#type").val() == '6'){
            //FECHASOLICITUD
            if ($('#f_dil_a').val() == '') {
                alert('Por favor seleccione el año de diligenciamiento');
                $('#f_dil_a').focus();
                return false;
            }
            if ($('#f_dil_m').val() == '') {
                alert('Por favor seleccione el mes de diligenciamiento');
                $('#f_dil_m').focus();
                return false;
            }
            if ($('#f_dil_d').val() == '') {
                alert('Por favor seleccione el dia de diligenciamiento');
                $('#f_dil_d').focus();
                return false;
            }
            if ($('#sucursal').val() == '') {
                alert('Por favor seleccione una sucursal');
                $('#sucursal').focus();
                return false;
            }
            if ($('#clasecliente').val() == '') {
                alert('Por favor seleccione una clase de vinculacion');
                $('#clasecliente').focus();
                return false;
            }else if($('#clasecliente').val() == '10' && $('#cual_clasecliente').val() == ''){
                alert('Debe digitar el otro tipo de cliente.');
                $('#cual_clasecliente').focus();
                return false;
            }
            if ($("#tipopersona").val() == "1") {
                if ($("#documento").val() == '') {
                    alert("Por favor digite el numero de documento.");
                    $("#documento").css('background-color', 'red');
                    return false;
                }else if ($("#documento").val() != $("#documento2").val()) {
                    alert("El No. de documento no coincide.");
                    $("#documento").css('background-color', 'red');
                    return false;
                }
                if ($('#tipodocumento').val() == '') {
                    alert('Por favor seleccione el tipo de documento del cliente');
                    $('#tipodocumento').focus();
                    return false;
                }
                if ($('#nombres').val() == '') {
                    alert('Por favor digite el nombre del cliente');
                    $('#nombres').focus();
                    return false;
                } else if ($('#nombres').val() == 'SD' || $('#nombres').val() == 'NA') {
                    alert('Por favor digite nombre de cliente valido, no puede ser SD ni NA.');
                    $('#nombres').focus();
                    return false;
                }
                //FECHAEXPEDICION
                if ($('#f_exp_a').val() == '') {
                    alert('Por favor seleccione el a�o de expedicion');
                    $('#f_exp_a').focus();
                    return false;
                }
                if ($('#f_exp_m').val() == '') {
                    alert('Por favor seleccione el mes de expedicion');
                    $('#f_exp_m').focus();
                    return false;
                }
                if ($('#f_exp_d').val() == '') {
                    alert('Por favor seleccione el dia de expedicion');
                    $('#f_exp_d').focus();
                    return false;
                }
                //FECHANACIMIENTO
                if ($('#f_nac_a').val() == '') {
                    alert('Por favor seleccione el a�o de nacimiento');
                    $('#f_nac_a').focus();
                    return false;
                }
                if ($('#f_nac_m').val() == '') {
                    alert('Por favor seleccione el mes de nacimiento');
                    $('#f_nac_m').focus();
                    return false;
                }
                if ($('#f_nac_d').val() == '') {
                    alert('Por favor seleccione el dia de nacimiento');
                    $('#f_nac_d').focus();
                    return false;
                }
                //Confirmar que la fecha de expedicion sea mayor a la de nacimiento
                var dif_anos = parseInt($('#f_exp_a').val()) - parseInt($('#f_nac_a').val());
                if (dif_anos < 10) {
                    alert('Por favor seleccione el a�o de expedicion valido, este no puede ser menor a la fecha de nacimiento y tampoco la diferencia entre estos puede ser menor a 10 a�os de edad');
                    $('#f_exp_a').focus();
                    return false;
                }
                if ($('#lugarexpedicion').val() == '') {
                    alert('Por favor seleccione lugar de expedicion');
                    $('#lugarexpedicion').focus();
                    return false;
                }
                if ($('#nacionalidad').val() == '') {
                    alert('Por favor seleccione nacionalidad.');
                    $('#nacionalidad').focus();
                    return false;
                }
                if ($('#ciudadresidencia').val() == '') {
                    alert('Por favor seleccione una ciudad de residencia.');
                    $('#ciudadresidencia').focus();
                    return false;
                }
                if ($('#nombreempresa').val() == '') {
                    if ($('#tipoactividad').val() == '1' || $('#tipoactividad').val() != '2') {
                        alert('Por favor digite el nombre de la empresa donde trabaja.');
                        $('#nombreempresa').focus();
                        return false;
                    }
                }
                if ($('#actividadeconomicaempresa').val() == '') {
                    alert('Por favor digite actividad economica.');
                    $('#actividadeconomicaempresa').focus();
                    return false;
                }
                if ($("#correoelectronico").val() != "" && $("#correoelectronico").val() != "SD") {
                    var status = false;
                    var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
                    if (document.getElementById("correoelectronico").value.search(emailRegEx) == -1) {
                        alert("Por favor ingrese un mail valido.");
                        $("#correoelectronico").css('background-color', 'red');
                        return false;
                    }
                }
                if ($('#tipoactividad').val() == '') {
                    alert('Por favor seleccione el tipo de actividad.');
                    $('#tipoactividad').focus();
                    return false;
                }
                if ($("#profesion").val() == "" || $("#profesion").val() == "0") {
                    alert("El campo de profesion no puede estar vac�o.");
                    return false;
                }
                if ($("#cargo").val() == "") {
                    alert("El campo de cargo no puede estar vac�o.");
                    $("#cargo").focus();
                    return false;
                }
                if ($('#ingresosmensuales').val() == "") {
                    if ($("#ocupacion").val() != "404" && $("#ocupacion").val() != "405") {
                        alert('Por favor seleccione ingresos mensuales.');
                        $('#ingresosmensuales').focus();
                        return false;
                    }
                }
                if ($('#totalactivos').val() == "") {
                    if ($("#ocupacion").val() != "404" && $("#ocupacion").val() != "405") {
                        alert('Por favor digite el total activos.');
                        $('#totalactivos').focus();
                        return false;
                    }
                }
                if ($('#totalpasivos').val() == "") {
                    if ($("#ocupacion").val() != "404" && $("#ocupacion").val() != "405") {
                        alert('Por favor digite el total pasivos.');
                        $('#totalpasivos').focus();
                        return false;
                    }
                }
                if ($('#egresosmensuales').val() == "") {
                    if ($("#ocupacion").val() != "404" && $("#ocupacion").val() != "405") {
                        alert('Por favor seleccione egresos mensuales.');
                        $('#egresosmensuales').focus();
                        return false;
                    }
                }
                if ($('#otrosingresos').val() == "") {
                    alert('Por favor seleccione otros ingresos.');
                    $('#otrosingresos').focus();
                    return false;
                }
                if ($('#conceptosotrosingresos').val() == "") {
                    alert('El campo de concepto de otros ingresos no puede ir vacio, por favor digitelo.');
                    $('#conceptosotrosingresos').focus();
                    return false;
                }
                if ($('#telefonoresidencia').val() == '' && $('#celular').val() == '' && $('#telefonolaboral').val() == '' && $('#celularoficinappal').val() == '' && $('#telefonoficinappal').val() == '') {
                    alert('Esta intentando guardar un formulario sin ningun numero de telefono, esto deberia ser una devolucion y no se puede guardar la informacion de esta manera.');
                    $('#telefonoresidencia').focus();
                    return false;
                }
            }else if ($("#tipopersona").val() == "2") {
                if ($("#nit").val() != $("#nit2").val()) {
                    alert("El No. de NIT no coincide.");
                    $("#nit").css('background-color', 'red');
                    return false;
                }
                if ($('#tipoempresajur').val() == '') {
                    alert('Por favor seleccione el tipo de empresa.');
                    $('#tipoempresajur').focus();
                    return false;
                }
                if ($('#detalleactividadeconomicappal').val == '') {
                    alert('Por favor debe digitar el detalle de la actividad economica principal.');
                    $('#detalleactividadeconomicappal').focus();
                    return false;
                }
                if ($("#direccionoficinappal").val() == '') {
                    alert("Por favor digite la direccion de la oficina principal.");
                    $("#direccionoficinappal").focus();
                    return false;
                }
                if ($("#ciudadoficina").val() == '') {
                    alert("Por favor seleccione ciudadoficina.");
                    $("#ciudadoficina").focus();
                    return false;
                }
                if($('#ingresosmensualesemp').val() == ''){
                    alert('Por favor seleccione ingresos mensuales de la empresa.');
                    $('#ingresosmensualesemp').focus();
                    return false;
                }
                if($('#activosemp').val() == '' || $('#activosemp').val() == 'SD' || $('#activosemp').val() == 'NA'){
                    alert('Por favor digite un valor valido para el campo activos empresa.');
                    $('#activosemp').focus();
                    return false;
                }
                if($('#pasivosemp').val() == '' || $('#pasivosemp').val() == 'SD' || $('#pasivosemp').val() == 'NA'){
                    alert('Por favor digite un valor valido para el campo pasivos empresa.');
                    $('#pasivosemp').focus();
                    return false;
                }
                if($('#egresosmensualesemp').val() == ''){
                    alert('Por favor seleccione egresos mensuales de la empresa.');
                    $('#egresosmensualesemp').focus();
                    return false;
                }
                if ($('#telefonoresidencia').val() == '' && $('#celular').val() == '' && $('#telefonolaboral').val() == '' && $('#celularoficinappal').val() == '' && $('#telefonoficina').val() == '' && $('#celularoficina').val() == '') {
                    alert('Esta intentando guardar un formulario sin ningun numero de telefono, esto deberia ser una devolucion y no se puede guardar la informacion de esta manera.');
                    $('#telefonoresidencia').focus();
                    return false;
                }
            }
            //FECHAENTREVISTAformulario
            if ($('#formulario').val() != '' && $('#formulario').val() != '12') {
                if ($('#f_ent_a').val() == '') {
                    alert('Por favor seleccione el a�o de entrevista');
                    $('#f_ent_a').focus();
                    return false;
                }
                if ($('#f_ent_m').val() == '') {
                    alert('Por favor seleccione el mes de entrevista');
                    $('#f_ent_m').focus();
                    return false;
                }
                if ($('#f_ent_d').val() == '') {
                    alert('Por favor seleccione el dia de entrevista');
                    $('#f_ent_d').focus();
                    return false;
                }
            } else if ($('#formulario').val() == '') {
                alert('Por favor seleccione el tipo de formulario.');
                $('#formulario').focus();
                return false;
            }
        }else{

            /*tiff0=document.getElementById('tiffobj0');
             //alert('ACA');
             var pp=tiff0.GetNumberOfPages();
             $("#num_images").val(pp);
             
             if( $("#num_images").val() == "" ) {
             alert("No ha sido posible contar las imagenes, contacte al administrador.");
             return false;
             } //Descativo este codigo el dia 20/06/2013 06:27*/

            if ($("#telefonoresidencia").val() != $("#telefonoresidencia2").val()) {
                alert("Los telefonos de residencia no coinciden.");
                return false;
            }

            //FECHARADICADO
            if ($('#fecharadicado_a').val() == '') {
                alert('Por favor seleccione el año de radicacion');
                $('#fecharadicado_a').focus();
                return false;
            }
            if ($('#fecharadicado_m').val() == '') {
                alert('Por favor seleccione el mes de radicacion');
                $('#fecharadicado_m').focus();
                return false;
            }
            if ($('#fecharadicado_d').val() == '') {
                alert('Por favor seleccione el dia de radicacion');
                $('#fecharadicado_d').focus();
                return false;
            }
            //FECHASOLICITUD
            if ($('#fechasolicitud_a').val() == '') {
                alert('Por favor seleccione el año de solicitud');
                $('#fechasolicitud_a').focus();
                return false;
            }
            if ($('#fechasolicitud_m').val() == '') {
                alert('Por favor seleccione el mes de solicitud');
                $('#fechasolicitud_m').focus();
                return false;
            }
            if ($('#fechasolicitud_d').val() == '') {
                alert('Por favor seleccione el dia de solicitud');
                $('#fechasolicitud_d').focus();
                return false;
            }
            if ($('#sucursal').val() == '') {
                alert('Por favor seleccione una sucursal');
                $('#sucursal').focus();
                return false;
            }
            if ($('#area').val() == '') {
                alert('Por favor seleccione un area');
                $('#area').focus();
                return false;
            }
            if ($('#id_official').val() == '') {
                alert('Por favor digite el nombre del oficial');
                $('#id_official').focus();
                return false;
            } else if ($('#id_official').val() == 'SD' || $('#id_official').val() == 'NA') {
                alert('Por favor digite el nombre del oficial, no puede ser SD ni NA.');
                $('#id_official').focus();
                return false;
            }
            if ($('#clasecliente').val() == '') {
                alert('Por favor seleccione una clase de cliente');
                $('#clasecliente').focus();
                return false;
            }

            /*if( $("#formulario").val() == "Ug-045 Abril 2007") {
             $("#lugarentrevista").removeClass("obligatorio");
             $("#fechaentrevista_a").removeClass("obligatorio");
             $("#fechaentrevista_m").removeClass("obligatorio");
             $("#fechaentrevista_m").removeClass("obligatorio");
             $("#fechaentrevista_d").removeClass("obligatorio");
             $("#horaentrevista").removeClass("obligatorio");
             $("#tipohoraentrevista").removeClass("obligatorio");
             $("#resultadoentrevista").removeClass("obligatorio");
             }*/


            if ($("#type").val() == "1") {
                if ($("#documento").val() == '') {
                    alert("Por favor digite el numero de documento.");
                    $("#documento").css('background-color', 'red');
                    return false;
                }
                if ($("#documento").val() != $("#documento2").val()) {
                    alert("El No. de documento no coincide.");
                    $("#documento").css('background-color', 'red');
                    return false;
                }
                if ($('#tipodocumento').val() == '') {
                    alert('Por favor seleccione el tipo de documento del cliente');
                    $('#tipodocumento').focus();
                    return false;
                }
                if ($('#nombres').val() == '') {
                    alert('Por favor digite el nombre del cliente');
                    $('#nombres').focus();
                    return false;
                } else if ($('#nombres').val() == 'SD' || $('#nombres').val() == 'NA') {
                    alert('Por favor digite nombre de cliente valido, no puede ser SD ni NA.');
                    $('#nombres').focus();
                    return false;
                }
                if ($("#tipopersona").val() == "1") {

                    //FECHANACIMIENTO
                    if ($('#fechanacimiento_a').val() == '') {
                        alert('Por favor seleccione el a�o de nacimiento');
                        $('#fechanacimiento_a').focus();
                        return false;
                    }
                    if ($('#fechanacimiento_m').val() == '') {
                        alert('Por favor seleccione el mes de nacimiento');
                        $('#fechanacimiento_m').focus();
                        return false;
                    }
                    if ($('#fechanacimiento_d').val() == '') {
                        alert('Por favor seleccione el dia de nacimiento');
                        $('#fechanacimiento_d').focus();
                        return false;
                    }
                    //FECHAEXPEDICION
                    if ($('#fechaexpedicion_a').val() == '') {
                        alert('Por favor seleccione el a�o de expedicion');
                        $('#fechaexpedicion_a').focus();
                        return false;
                    }
                    if ($('#fechaexpedicion_m').val() == '') {
                        alert('Por favor seleccione el mes de expedicion');
                        $('#fechaexpedicion_m').focus();
                        return false;
                    }
                    if ($('#fechaexpedicion_d').val() == '') {
                        alert('Por favor seleccione el dia de expedicion');
                        $('#fechaexpedicion_d').focus();
                        return false;
                    }
                    //Confirmar que la fecha de expedicion sea mayor a la de nacimiento
                    var dif_anos = parseInt($('#fechaexpedicion_a').val()) - parseInt($('#fechanacimiento_a').val());
                    if (dif_anos < 10) {
                        alert('Por favor seleccione el a�o de expedicion valido, este no puede ser menor a la fecha de nacimiento y tampoco la diferencia entre estos puede ser menor a 10 a�os de edad');
                        $('#fechaexpedicion_a').focus();
                        return false;
                    }
                    if ($('#lugarexpedicion').val() == '') {
                        alert('Por favor seleccione lugar de expedicion');
                        $('#lugarexpedicion').focus();
                        return false;
                    }
                    if ($('#sexo').val() == '') {
                        alert('Por favor seleccione sexo.');
                        $('#sexo').focus();
                        return false;
                    }
                    if ($('#nacionalidad').val() == '') {
                        alert('Por favor seleccione nacionalidad.');
                        $('#nacionalidad').focus();
                        return false;
                    }
                    if ($('#numerohijos').val() == '') {
                        alert('Por favor seleccione numero de hijos.');
                        $('#numerohijos').focus();
                        return false;
                    }
                    if ($('#ciudadresidencia').val() == '') {
                        alert('Por favor seleccione una ciudad de residencia.');
                        $('#ciudadresidencia').focus();
                        return false;
                    }
                    /*if( $("#telefonoresidencia").val() != "" ) {
                     if( $("#telefonoresidencia").val().length != "7"  &&  $("#telefonoresidencia").val().length != "9"  ) {
                     alert("El numero de telefono no es valido");	
                     $("#telefonoresidencia").css('background-color','red');  			
                     return false;
                     }
                     }*/
                    if ($('#nombreempresa').val() == '') {
                        if ($('#tipoactividad').val() == '1' || $('#tipoactividad').val() != '2') {
                            alert('Por favor digite el nombre de la empresa donde trabaja.');
                            $('#nombreempresa').focus();
                            return false;
                        }
                    }
                    /*if( $("#celular").val() != ""  ) {
                     if( $("#celular").val().length != "10"  || $("#celular").val().length < 10 || $("#celular").val().length > 10 ) {
                     alert("El numero de celular no es valido");	
                     $("#celular").css('background-color','red');  			
                     return false;
                     }
                     }*/
                    if ($('#actividadeconomicaempresa').val() == '') {
                        alert('Por favor seleccione actividad economica.');
                        $('#actividadeconomicaempresa').focus();
                        return false;
                    }
                    if ($("#correoelectronico").val() != "" && $("#correoelectronico").val() != "SD") {
                        var status = false;
                        var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
                        if (document.getElementById("correoelectronico").value.search(emailRegEx) == -1) {
                            alert("Por favor ingrese un mail valido.");
                            $("#correoelectronico").css('background-color', 'red');
                            return false;
                        }
                    }
                    if ($("#cargo").val() == "") {
                        alert("El campo de cargo no puede estar vac�o.");
                        $("#cargo").focus();
                        return false;
                    }
                    if ($("#profesion").val() == "" || $("#profesion").val() == "0") {
                        alert("El campo de profesion no puede estar vac�o.");
                        $("#profesion").css('background-color', 'red');
                        return false;
                    }
                    if ($("#ocupacion").val() == "" || $("#ocupacion").val() == "0") {
                        alert("El campo de ocupaci�n no puede estar vac�o.");
                        $("#ocupacion").css('background-color', 'red');
                        return false;
                    } else if ($("#ocupacion").val() == "221" && $("#detalleocupacion").val() == "") {//trdetalleocupacion
                        alert("El campo de detalle de ocupaci�n no puede estar vac�o.");
                        $("#detalleocupacion").focus();
                        return false;
                    }
                    if ($('#ingresosmensuales').val() == "") {
                        if ($("#ocupacion").val() != "404" && $("#ocupacion").val() != "405") {
                            alert('Por favor seleccione ingresos mensuales.');
                            $('#ingresosmensuales').focus();
                            return false;
                        }
                    }
                    if ($('#otrosingresos').val() == "") {
                        alert('Por favor seleccione otros ingresos.');
                        $('#otrosingresos').focus();
                        return false;
                    }
                    if ($('#egresosmensuales').val() == "") {
                        if ($("#ocupacion").val() != "404" && $("#ocupacion").val() != "405") {
                            alert('Por favor seleccione egresos mensuales.');
                            $('#egresosmensuales').focus();
                            return false;
                        }
                    }
                    if ($('#conceptosotrosingresos').val() == "") {
                        alert('El campo de concepto de otros ingresos no puede ir vacio, por favor digitelo.');
                        $('#conceptosotrosingresos').focus();
                        return false;
                    }
                    if ($('#tipoactividad').val() == '') {
                        alert('Por favor seleccione el tipo de actividad.');
                        $('#tipoactividad').focus();
                        return false;
                    }
                    if ($('#tipoactividad').val() == '8' && $('#detalletipoactividad').val() == '') {
                        alert('Por favor digite el tipo de actividad para otros.');
                        $('#detalletipoactividad').focus();
                        return false;
                    }
                    //$('#').val() == ''
                    if ($('#totalactivos').val() == "") {
                        if ($("#ocupacion").val() != "404" && $("#ocupacion").val() != "405") {
                            alert('Por favor digite el total activos.');
                            $('#totalactivos').focus();
                            return false;
                        }
                    }
                    if ($('#totalpasivos').val() == "") {
                        if ($("#ocupacion").val() != "404" && $("#ocupacion").val() != "405") {
                            alert('Por favor digite el total pasivos.');
                            $('#totalpasivos').focus();
                            return false;
                        }
                    }
                    if ($('#estrato').val() == '') {
                        alert('Por favor seleccione estrato.');
                        $('#estrato').focus();
                        return false;
                    }
                    if($('#expuesta_publica').val() == ''){
                        alert('Seleccione persona publicamente expuesta.');
                        $('#expuesta_publica').focus();
                        return false;
                    }
                    if($('#servidor_publico').val() == ''){
                        alert('Seleccione vinculo con persona publicamente expuesta.');
                        $('#servidor_publico').focus();
                        return false;
                    }
                    if($('#recursos_publicos').val() == ''){
                        alert('Seleccione si administra recursos publicos.');
                        $('#recursos_publicos').focus();
                        return false;
                    }
                    if($('#tributarias_otro_pais').val() == ''){
                        alert('Seleccione si tiene obligaciones tributarias en otro pais.');
                        $('#tributarias_otro_pais').focus();
                        return false;
                    }
                    if($('#tributarias_otro_pais').val() == '-1' && $('#tributarias_paises').val() == ''){
                        alert('Debe digitar el pais o los paises en donde tiene obligaciones tributarias');
                        $('#tributarias_paises').focus();
                        return false;
                    }
                    $(".obligatorio").each(function() {
                        count = 0;

                        if ($(this).val() == "") {
                            $(this).css('background-color', 'red');
                            count++;
                        }
                    });
                    if (count > 0) {
                        alert("Por favor complete los campos obligatorios.");
                        return false;
                    }
                }else if ($("#tipopersona").val() == "2") {
                    //FECHAEXPEDICION
                    if ($('#fechaexpedicion_a').val() == '') {
                        alert('Por favor seleccione el a�o de expedicion');
                        $('#fechaexpedicion_a').focus();
                        return false;
                    }
                    if ($('#fechaexpedicion_m').val() == '') {
                        alert('Por favor seleccione el mes de expedicion');
                        $('#fechaexpedicion_m').focus();
                        return false;
                    }
                    if ($('#fechaexpedicion_d').val() == '') {
                        alert('Por favor seleccione el dia de expedicion');
                        $('#fechaexpedicion_d').focus();
                        return false;
                    }
                    $(".obligatorio").each(function() {
                        count = 0;
                        if ($(this).val() == "") {
                            $(this).css('background-color', 'red');
                            count++;
                        }
                    });
                    if (count > 0) {
                        alert("Por favor complete los campos obligatorios.");
                        return false;
                    }
                    if ($("#nit").val() != $("#nit2").val()) {
                        alert("El No. de NIT no coincide.");
                        $("#nit").css('background-color', 'red');
                        return false;
                    }
                    if ($("#ciudadoficina").val() == '') {
                        alert("Por favor seleccione ciudadoficina.");
                        $("#ciudadoficina").focus();
                        return false;
                    }
                    if ($("#direccionoficinappal").val() == '') {
                        alert("Por favor digite la direccion de la oficina principal.");
                        $("#direccionoficinappal").focus();
                        return false;
                    }
                    if ($('#actividadeconomicappal').val() == '810' && $('#detalleactividadeconomicappal').val == '') {
                        alert('Por favor debe digitar el detalle de la actividad economica principal.');
                        $('#detalleactividadeconomicappal').focus();
                        return false;
                    }
                    if ($('#tipoempresaemp').val() == '') {
                        alert('Por favor seleccione el tipo de empresa.');
                        $('#tipoempresaemp').focus();
                        return false;
                    }
                    if($('#activosemp').val() == '' || $('#activosemp').val() == 'SD' || $('#activosemp').val() == 'NA'){
                        alert('Por favor digite un valor valido para el campo activos empresa.');
                        $('#activosemp').focus();
                        return false;
                    }
                    if($('#pasivosemp').val() == '' || $('#pasivosemp').val() == 'SD' || $('#pasivosemp').val() == 'NA'){
                        alert('Por favor digite un valor valido para el campo pasivos empresa.');
                        $('#pasivosemp').focus();
                        return false;
                    }
                    if($('#ingresosmensualesemp').val() == ''){
                        alert('Por favor seleccione ingresos mensuales de la empresa.');
                        $('#ingresosmensualesemp').focus();
                        return false;
                    }
                    if($('#egresosmensualesemp').val() == ''){
                        alert('Por favor seleccione egresos mensuales de la empresa.');
                        $('#egresosmensualesemp').focus();
                        return false;
                    }
                    if($('#expuesta_publica').val() == ''){
                        alert('Seleccione persona publicamente expuesta.');
                        $('#expuesta_publica').focus();
                        return false;
                    }
                    /*if($('#servidor_publico').val() == ''){
                        alert('Seleccione vinculo con persona publicamente expuesta.');
                        $('#servidor_publico').focus();
                        return false;
                    }*/
                    if($('#recursos_publicos').val() == ''){
                        alert('Seleccione si administra recursos publicos.');
                        $('#recursos_publicos').focus();
                        return false;
                    }
                    if($('#tributarias_otro_pais').val() == ''){
                        alert('Seleccione si tiene obligaciones tributarias en otro pais.');
                        $('#tributarias_otro_pais').focus();
                        return false;
                    }
                    if($('#tributarias_otro_pais').val() == '-1' && $('#tributarias_paises').val() == ''){
                        alert('Debe digitar el pais o los paises en donde tiene obligaciones tributarias');
                        $('#tributarias_paises').focus();
                        return false;
                    }
                }

                if ($("#tipopersona").val() == "1") {
                    if ($('#telefonoresidencia').val() == '' && $('#telefonolaboral').val() == '' && $('#celular').val() == '') {
                        alert('Esta intentando guardar un formulario sin ningun numero de telefono, esto deberia ser una devolucion y no se puede guardar la informacion de esta manera.');
                        $('#telefonoresidencia').focus();
                        return false;
                    }
                }
                if ($("#tipopersona").val() == "2") {
                    if ($('#telefonoficina').val() == '' && $('#faxoficina').val() == '' && $('#celularoficina').val() == '') {
                        alert('Esta intentando guardar un formulario sin ningun numero de telefono, esto deberia ser una devolucion y no se puede guardar la informacion de esta manera.');
                        $('#telefonoficina').focus();
                        return false;
                    }
                }
                //FECHAENTREVISTAformulario
                if ($('#formulario').val() != '' && $('#formulario').val() != '12') {
                    if ($('#fechaentrevista_a').val() == '') {
                        alert('Por favor seleccione el a�o de entrevista');
                        $('#fechaentrevista_a').focus();
                        return false;
                    }
                    if ($('#fechaentrevista_m').val() == '') {
                        alert('Por favor seleccione el mes de entrevista');
                        $('#fechaentrevista_m').focus();
                        return false;
                    }
                    if ($('#fechaentrevista_d').val() == '') {
                        alert('Por favor seleccione el dia de entrevista');
                        $('#fechaentrevista_d').focus();
                        return false;
                    }
                } else if ($('#formulario').val() == '') {
                    alert('Por favor seleccione el tipo de formulario.');
                    $('#formulario').focus();
                    return false;
                }
            }else if ($("#type").val() == "4") {
                if ($('input:radio[name="grupodoc"]:checked').val() == '7') {
                    if ($('#razonsocial').val() == '') {
                        alert('No ha ingresado Nombre/Razon social.');
                        $('#razonsocial').focus();
                        return false;
                    }
                    if ($('#numero_').val() == '') {
                        alert('No ha ingresado Cod. Verf..');
                        $('#numero_').focus();
                        return false;
                    }
                    if ($('#numero').val().length == 10) {
                        alert('Ingrese un documento valido.');
                        $('#numero').focus();
                        return false;
                    }
                    if ($('#actecono').val() == '') {
                        alert('No ha ingresado actividad economica');
                        $('#actecono').focus();
                        return false;
                    }
                } else {
                    if ($('#ocupacti').val() == '') {
                        alert('No ha ingresado ocupacion');
                        $('#ocupacti').focus();
                        return false;
                    }
                    if ($('#txtpapellido').val() == '') {
                        alert('No ha ingresado un primer apellido.');
                        $('#txtpapellido').focus();
                        return false;
                    }
                    if ($('#txtnombres').val() == '') {
                        alert('No ha ingresado Nombre.');
                        $('#txtnombres').focus();
                        return false;
                    }
                }
                if ($('#numero').val() == '') {
                    alert('No ha ingresado Numero de documento.');
                    $('#numero').focus();
                    return false;
                }

                if ($('#ciudad').val() == '') {
                    alert('No ha ingresado una ciudad');
                    $('#ciudad').focus();
                    return false;
                }
                if ($('#direccion').val() == '') {
                    alert('No ha ingresado la direccion');
                    $('#direccion').focus();
                    return false;
                }
                if ($('#telefono').val() == '') {
                    alert('No ha ingresado el telefono');
                    $('#telefono').focus();
                    return false;
                } else {
                    var telefono = $('#telefono').val();
                    if (telefono.length < 7 || telefono.length == 8 || telefono.length == 9) {
                        alert('Ingrese un numero telefonico valido');
                        $('#telefono').focus();
                        return false;
                    }
                }
                if ($('#email').val() == '') {
                    alert('No ha ingresado el email');
                    $('#email').focus();
                    return false;
                } else if($('#email').val() !== 'SD') {
                    var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
                    if (document.getElementById("email").value.search(emailRegEx) == -1) {
                        alert("Por favor ingrese un mail valido.");
                        $("#email").css('background-color', 'red');
                        return false;
                    }
                }
                if ($('#mes').val() == '') {
                    alert("Por favor seleccione un mes.");
                    return false;
                }
                if ($('#dia').val() == '') {
                    alert("Por favor seleccione un dia.");
                    return false;
                }
            }else if ($("#type").val() == "5") {
                if ($('#tipo_cliente').val() == 2) {
                    if ($('#numero').val().length == 10) {
                        alert("Ingrese un documento correcto");
                        return false;
                    }
                }
            }
        }
        });
    });

</script>
<script language="javascript">
    function onlyNumbers() {
        var key = window.event.keyCode;
        if (key < 48 || key > 57) {
            window.event.keyCode = 0;
        }
    }

    function onlyChars() {
        if (event.keyCode < 65 || event.keyCode > 90) {
            if (event.keyCode != 32)
                event.returnValue = false;
        }
    }
</script>
<?php
if ($type == "1") {
    $general = new General();
    $tipo_persona = $general->getTipoPersona();
    ?>
    <br />
    <table>
        <tr>
            <td>Tipo persona: </td>
            <td><select id="tipopersona" name="tipopersona">
                    <option value=""> -- Seleccione una opción -- </option>
                    <?php
                    while ($result = mysqli_fetch_array($tipo_persona)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <br />
    <div id="fields_persona" style="width:100%; height: auto;"></div>    
    <input type="hidden" name="type" id="type" value="1" />
    <input type="hidden" name="num_images" id="num_images" value="" />
<?php
} else if ($type == "2") {
    require_once 'fields2.php';
?>   
    <input type="hidden" name="type" id="type" value="2" />    
    <input type="hidden" name="num_images" id="num_images" value="" />
    <?php
} else if ($type == "3") {
    ?>
    <p>El anexo no tiene campos para diligenciar.</p>
    <input type="hidden" name="type" id="type" value="3" />
    <input type="submit" value="Anexar documento" />    
    <input type="hidden" name="num_images" id="num_images" value="" />
    <?php
} else if ($type == "4") {
    require_once 'fields3.php';
?>   
    <input type="hidden" name="type" id="type" value="4" />
    <input type="hidden" name="num_images" id="num_images" value="" />
    <?php
} else if ($type == "5") {
    ?>
    <table style="width: 100%;">
        <tr>
            <td  colspan="3" align="center">
                <select id="tipo_cliente" name="tipo_cliente">
                    <option value="1">Natural</option>
                    <option value="2">Juridico</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                Documento:<input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 25%;" onkeypress="return validar_num(event)" onpaste="return false;" id="numero" name="numero" maxlength="10" >
                <br>
                Cod. Verf.
                <input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 20%;" onkeypress="return validar_num(event)" onpaste="return false;" id="numero_" name="numero_" disabled="true" maxlength="1">
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <input type="submit" value="Indexar Imagen" />
            </td>
        </tr>
    </table>
    <input type="hidden" name="type" id="type" value="5" />
    <input type="hidden" name="num_images" id="num_images" value="" />
<?php
}elseif($type == "6"){
    //require_once 'fields6.php';
    $general = new General();
    $tipo_persona = $general->getTipoPersona();
?>
    <br>
    <table>
        <tr>
            <td>Tipo persona: </td>
            <td><select id="tipopersona" name="tipopersona">
                    <option value=""> -- Seleccione una opción -- </option>
                    <?php
                    while ($result = mysqli_fetch_array($tipo_persona)) {
                        echo "<option value='{$result['id']}'>{$result['description']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <br>
    <div id="fields_persona6" style="width:100%; height: auto;">
    </div>    
    <input type="hidden" name="type" id="type" value="6">
    <input type="hidden" name="num_images" id="num_images" value="">
<?php
}
