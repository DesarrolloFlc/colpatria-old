var radioSelected;
function pantallaCompleta(pagina) {
    window.open(pagina, 'windowname1', 'fulscreen=yes');
}

$(document).ready(function() {
//$.facebox.settings.opacity = 0.7
    jQuery.fn.reset = function() {
        $(this).each(function() {
            this.reset();
        });
    };
    /*
     * AREA CREADA PARA EL MANEJO
     * DEL NUEVO MODULO
     * SUPERMERCADO
     *
     **/
    /*
     * FINAL DEL BLOQUE DE SUPERMERCADO
     */
    $('#form_caseadd').submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($('form#form_caseadd input#documento').val() == '') {
            alert('Por favor el documento del cliente.');
            $('form#form_caseadd input#documento').focus();
            return false;
        }
        if ($('form#form_caseadd select#persontype').val() == '') {
            alert('Por favor seleccione el tipo de persona.');
            $('form#form_caseadd select#persontype').focus();
            return false;
        }
        if ($('form#form_caseadd input#nombre').val() == '') {
            alert('Por favor digite el nombre.');
            $('form#form_caseadd input#nombre').focus();
            return false;
        }
        if ($('form#form_caseadd input#lote').val() == '') {
            alert('Por favor digite el numero de lote.');
            $('form#form_caseadd input#lote').focus();
            return false;
        }
        if ($('form#form_caseadd select#area').val() == '') {
            alert('Por favor seleccione area.');
            $('form#form_caseadd select#area').focus();
            return false;
        }
        if ($('form#form_caseadd select#sucursal').val() == '') {
            alert('Por favor seleccione una sucursal.');
            $('form#form_caseadd select#sucursal').focus();
            return false;
        }
        if ($('form#form_caseadd select#causaldevolucion').val() == '') {
            alert('Por favor seleccione una causal de devolucion.');
            $('form#form_caseadd select#causaldevolucion').focus();
            return false;
        }
        if ($('form#form_caseadd select#official').val() == '') {
            alert('Por favor seleccione a el oficial asignado para esta devolucion.');
            $('form#form_caseadd select#official').focus();
            return false;
        }
        /*if($('form#form_caseadd input#documento').val() == ''){
         alert('Por favor seleccione una fecha inicial.');
         $('form#form_caseadd input#documento').focus();
         return false;
         }*/
        var forma = document.form_caseadd;
        forma.submit();
    });
    /** BUSQUEDA DE ORDENES DE PRODUCCION ***/
    $("#form_ordensearch").submit(function() {
        $.post('../../lib/general/procesos.php', $("#form_ordensearch").serialize(), function(data) {
            $("#tab_resultsearch").html(data);
            $("#box_search_result").css('display', 'block');
        });
        return false;
    });
    $(".number").click(function() {
        $.get($(this).attr('href'), function(data) {
            $("#ordenes_show").html(data);
        });
        return false;
    });
    $.fn.pruebaTag = function() {
        alert('prueba');
    };
    $("#pruebaedit").click(function() {
        alert("test");
    });

    $('input#fecha_inicio').simpleDatepicker();
    $('input#fecha_inicio').simpleDatepicker();
    $('input#fechaentrega').simpleDatepicker();
    $('input#fecha_fin').simpleDatepicker();
    $('input#fecha_envio').simpleDatepicker();
    $('input#fecharadicado').simpleDatepicker();
    $('input#fechasolicitud').simpleDatepicker();
    $('input#fechaexpedicion').simpleDatepicker();
    $('.classpickerfecha').simpleDatepicker();
    $('input#fechanacimiento').simpleDatepicker({startdate: 2008, enddate: 2014});
});
$.fn.buscarCliente = function(e, valor) {
    //alert(valor);

    $.ajax({
        beforeSend: function() {
            $('#imgloading').show();
        },
        data: 'documento=' + valor + '&action=buscarCliente',
        type: 'POST',
        url: '../includes/controllerWorkflow.php',
        //dataType: 'json',
        success: function(dato) {
            alert(dato)
        }
    });
};
function ingresadia() {
    $('#dia').html("<option value=" + 6 + ">Junio</option>");
}
$.fn.comprobarOficial = function(e, input) {
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    //alert($(input).val());
    if ($(input).is(":checked")) {
        $('#divpadreoficial').slideDown('medium');
    } else {
        $('#divpadreoficial').slideUp('medium');
    }
};
$.fn.verificarCorredores = function(e, este, form) {
    //alert('acaaa');
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    var str = $('form#'+form+' #id_sucursal option:selected').text();
    var resp = str.search('CORREDORES');
    if (resp >= 0) {
        $('form#'+form+' #utc').removeAttr('disabled');
        //$('#utc').focus();
    } else {
        $('form#'+form+' #utc').attr('disabled', 'disabled');
        $('form#'+form+' #utc').val('');
        //$('#telefono').focus();
    }
};
function checkall() {
    $(".checkall").each(function() {
        if ($(this).attr('checked')) {
            $(this).attr('checked', false);
            $("#marcar").attr('value', 'Seleccionar todas');
        }
        else {
            $(this).attr('checked', true);
            $("#marcar").attr('value', 'Deseleccionar todas');
        }
    });
}

function test1() {
    alert("test1");
}

function desactivarImages() {
    var r = confirm("Esta totalmente seguro?");
    if (r) {
        $("#notif_result").css('display', 'block');
        $.post('../../lib/general/procesos.php', $("#showIndexacionUser").serialize(), function(data) {
            $("#result_images").html(data);
        });
    }
}
function validar_num(e){
    //(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    tecla_codigo = (document.all) ? e.keyCode : e.which;
    if (tecla_codigo == 8 || tecla_codigo == 9)
        return true;
    patron = /^\d+$/;
    tecla_valor = String.fromCharCode(tecla_codigo);
    return patron.test(tecla_valor);
}
$.fn.getEstados = function(id) {
    switch (parseInt(id)) {
        case 0:
            return 'Radicado';
            break;
        case 1:
            return 'No Enviado';
            break;
        case 2:
            return 'Recibido';
            break;
        case 3:
            return 'Devuelto';
            break;
        case 4:
            return 'Cancelado';
            break;
    }
};
$.fn.devolverItem = function(e, este, pos) {
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    var valor = $(este).val();
    valorp = valor.split('|');
    if (valorp[1] == '3') {
        radioSelected = este;
        if (confirm('Esta seguro que desea devolver este cliente, si lo hace ya no podra cambiar su estado')) {
            $('form#devolverRadicadoForm input#clienteid_dev').val(valorp[0]);
            $('form#devolverRadicadoForm input#typepos').val(pos);
            jQuery.facebox({
                div: '#box1'
            });
        } else
            este.checked = false; //$(este).prop('checked', false);
    }
};
$.fn.seleccionarTodo = function(e, este, pos, cant){
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    if(pos == 1){
        $("input[value$='|2']").attr('checked', 'checked');
    }else if(pos == 2){
        $("input[value$='|1']").attr('checked', 'checked');
    }else if(pos == 3){
        $("input[value$='|1']").attr('checked', false);
        $("input[value$='|2']").attr('checked', false);
    }
}
$.fn.devolverRadicadoForm = function(e, este) {
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    var datos = $(este).serialize().split('&');
    for (var i = 0; i < 4; i++) {
        var dato = datos[i].split('=');
        if (dato[1] == '') {
            alert('Por favor diligencie todos los campos.');
            $('#' + dato[0]).focus();
            return false;
        }
    }
    var dat = $(este).serialize();
    var pos = $('#typepos').val();
    //alert(dat);
    $.ajax({
        beforeSend: function() {
        },
        data: dat,
        type: 'POST',
        url: '../includes/controllerRadicado.php',
        dataType: 'json',
        success: function(dato) {
            /*alert(dato);
             $('#respuesta').text(dato);*/
            if (dato.exito) {
                alert(dato.exito);
                $.facebox.close();
                //document.getElementsByName('cliente')[pos].disabled = true;
                //$('input[name=cliente]').attr('disabled', 'disabled');
                if($('form#devolverRadicadoForm input#opcion').val() == '1'){
                    $("input[name=cliente[" + pos + "]]").attr("disabled", "disabled");
                    var newVal = $('input#clienteid_dev').val();
                    $("tr#trcl_" + pos).append('<input type="hidden" name="cliente[' + pos + ']" value="' + newVal + '|3">');
                }else if($('form#devolverRadicadoForm input#opcion').val() == '2'){
                    $.fn.cambiarEstadoClientefn();
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown+': '+jqXHR.responseText);
           return false;
        }
    });
};
$.fn.cambiarEstadoClientefn = function(){
    var id = $('form#cambioEstadoRadicadoCliente input#id_cliente_c').val();
    var estado = $('form#cambioEstadoRadicadoCliente input#nuevo_estado_c').val();

    $.ajax({
        beforeSend: function() {
        },
        data: 'action=cambioEstadoRadicadoCliente&id='+id+'&estado='+estado,
        type: 'POST',
        url: '../includes/controllerRadicado.php',
        dataType: 'json',
        success: function(dato) {
            //alert(dato);
            if(dato.exito){
                alert(dato.exito);
                $('td#estado_actualClientetd').html('');
                $('tr#estado_actualCliente').hide();
                $('tr#nuevo_estadoCliente').hide();
                $('td#nuevo_estadoClientetd').html('');
                $('form#devolverRadicadoForm input#id_sucursal').val('');
                $('form#devolverRadicadoForm input#id_official').val('');
                $('form#devolverRadicadoForm input#radicado_id').val('');
                $('form#devolverRadicadoForm input#clienteid_dev').val('');
                $('form#devolverRadicadoForm input#typepos').val('');
                $('form#devolverRadicadoForm input#opcion').val('1');
                $('form#cambioEstadoRadicadoCliente input#id_cliente_c').val('');
                $('div#div_cambioEstado').hide();
            }else
                alert(dato.error);
        }
    });
}
$.fn.cerrarVentana = function() {
    if($('#facebox .content > #box-descarga-archivo').length == 0){
        if($('#facebox .content > #box-errores').length == 0)
            radioSelected.checked = false;
    }else{
        console.log('si existe');
        var file = $('#facebox .content > #box-descarga-archivo > p > a').attr('href').split('#')[1];
        $.ajax({
            data: {
                domain: 'reporte',
                action: 'eliminaArchivoReporte',
                meth: 'js',
                file: file
            },
            type: 'get',
            url: '../includes/Controller.php',
            dataType: 'json',
            success: function(dato){
                console.log(dato);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
                console.log(ajaxOptions);
                console.log(thrownError);
                alert("Error(eliminarArchivoReporte): "+xhr.status+" Error: "+xhr.responseText);
            }
        });
    }
};
$.fn.agregarCargaarchivos = function(e) {
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    var cant = $("input[name^=load_file]").length;
    var strHTML = '<tr>' +
            '<td width="8%"></td>' +
            '<td><input type="file" id="load_file" name="load_file[' + cant + ']">' +
            '<div style="width:50px; display: inline; margin-left:20px;">' +
            '<a href="#" onclick="$.fn.quitarCargaarchivos(event,this);"><img src="../../resources/images/icons/cross_small.png" title="Eliminar archivo" alt="Eliminar" /></a>' +
            '</div>' +
            '<span class="input-notification attention png_bg">Utilice este icono para eliminar este cargue de la imagen en caso de haberlo agregado por error.</span>' +
            '</tr>';
    $('#files_loaders').append(strHTML);
};
$.fn.quitarCargaarchivos = function(e, este) {
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    var pos = $(este).parent().parent().find('#load_file').attr('name').split('[')[1].split(']')[0];
    //alert(pos);
    var cant = $("input[name^=load_file]").length;
    //alert("pos: "+pos+" ; cant:"+cant);
    for (var i = pos; i < cant; i++) {
        if ((i + 1) <= cant) {
            //alert('entro aca');
            var input = $("input[name=load_file[" + i + "]]");
            $(input).removeAttr('name');
            $(input).attr('name', 'load_file[' + (i - 1) + ']');
        }
    }
    var tr = $(este).parent().parent().parent();
    $(tr).remove();
};
$.fn.radicadosyClientesxoficial = function(e) {//
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    if ($('form#radicadosyClientesxoficial input#fecha_inicio').val() == '') {
        alert('Por favor seleccione una fecha inicial.');
        $('form#radicadosyClientesxoficial input#fecha_inicio').focus();
        return false;
    }
    if ($('form#radicadosyClientesxoficial input#fecha_fin').val() == '') {
        alert('Por favor seleccione una fecha final.');
        $('form#radicadosyClientesxoficial input#fecha_fin').focus();
        return false;
    }
    var conf = true;
    if (conf) {
        var datos = $("#radicadosyClientesxoficial").serialize();
        $.ajax({
            beforeSend: function() {
            },
            data: datos,
            type: 'POST',
            url: '../includes/controllerRadicado.php',
            dataType: 'json',
            success: function(dato) {
                //alert(dato);
                if (dato.exito) {
                    var strHTML = '<tr>' +
                            '<td width="10%"># de radicado</td>' +
                            '<td width="20%">Documento de identificaci&oacute;n</td>' +
                            '<td width="44%">Nombre y/o Raz&oacute;n Social del cliente</td>' +
                            '<td width="14%">Fecha de envio</td>' +
                            '<td width="10%" align="center" valign="middle">Estado</td>' +
                            '<td width="2%" align="center" valign="middle">Descargar</td>' +
                            '</tr>';
                    var tam = dato.items.length;
                    for (var i = 0; i < tam; i++) {
                        strHTML += '<tr>' +
                                '<td>' + dato.items[i].id_radicados + '</td>' +
                                '<td>' + dato.items[i].documento + '</td>' +
                                '<td>' + dato.items[i].descripcion + '</td>' +
                                '<td>' + dato.items[i].fecha_creacion + '</td>' +
                                '<td align="center" valign="middle">' + $.fn.getEstados(dato.items[i].estado) + '</td>' +
                                '<td align="center" valign="middle">Descargar</td>' +
                                '</tr>';
                    }
                    ;
                    $('#listadeRadicados').html(strHTML);
                    $('#imgdownpdf').html('<a href="generarReportePDF.php?' + datos + '&consR=download"><img id="imgloading" src="../../images/icons/pdf_download_8.gif" />');
                    $('#imgdownpdf').qtip({
                        content: {
                            text: 'Por medio de este icono, descargue una copia del reporte con la informacion consultada'
                        },
                        show: {
                            ready: true
                        },
                        hide: {
                            target: $('.content-box-tabs'),
                            event: 'mouseover'
                        },
                        style: {
                            width: '350px',
                            classes: 'qtip-dark qtip-shadow qtip-tipsy'
                        },
                        position: {// Position my top left...
                            my: 'bottom right', // Position my top left...
                            at: 'left top' // at the bottom right of...
                        }
                    });
                } else {
                    $('#msg_notieneradicados').html('Usted no tiene radicados en el rango de fechas especificado.');
                    $("#result_notif_busradicofi").slideDown('medium');
                }

            }
        });
    }
};
$.fn.mostrarCliente = function(e, documento, filename, sucursal, estado, id_radicado, consecutivo) {
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    radioSelected = false;
    var strHTML = '';
    if (estado == '2') {
        var numstr = '0' + consecutivo;
        if (consecutivo.length > 1)
            numstr = consecutivo;
        var strHTML = '<object id="tiffobj0" width=620 height=650 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">' +
                '<param name="src" value="/Colpatria/virtuales_doc/virtuales_aceptados/' + sucursal + '/LOTE_' + id_radicado + '_' + numstr + '.tiff">' +
                '<embed width=620 height=650 src="/Colpatria/virtuales_doc/virtuales_aceptados/' + sucursal + '/LOTE_' + id_radicado + '_' + numstr + '.tiff" type="image/tiff">' +
                '</object>';
    } else {
        var strHTML = '<object id="tiffobj0" width=620 height=650 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">' +
                '<param name="src" value="/Colpatria/virtuales_doc/virtuales/' + sucursal + '/' + documento + '/' + filename + '">' +
                '<embed width=620 height=650 src="/Colpatria/virtuales_doc/virtuales/' + sucursal + '/' + documento + '/' + filename + '" type="image/tiff">' +
                '</object>';
    }
    $('#box2').html(strHTML);
    jQuery.facebox({
        div: '#box2'
    });
};
$.fn.edCliente = function(estado, id_radicado, id_item, docespe, e) {
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    $('#hddestado').val(estado);
    $('#hddradicado').val(id_radicado);
    $('#hdditem').val(id_item);
    $('#hddocespe').val(docespe);
    radioSelected = false;
    if (docespe == 1) {
        $('#dvalerta').html('<span class="input-notification attention png_bg">El cliente debe tener formato Sarlaft.</span>');
    } else {
        $('#dvalerta').html('');
    }
    jQuery.facebox({
        div: '#box3'
    });
};

$.fn.NdocCliente = function(e, texto) {
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;

    if (texto == '') {
        alert('Por favor ingrese un documento.');
        return false;
    } else {
        var datos = "idncliente=" + texto + "&estado=" + $('#hddestado').val() + "&idradicado=" + $('#hddradicado').val() + "&iditem=" + $('#hdditem').val() + "&docespecial=" + $('#hddocespe').val() + "&action=actualizaCliente";
        $.ajax({
            data: datos,
            type: 'POST',
            url: '../includes/controllerRadicado.php',
            dataType: 'json',
            success: function(dato) {
                if (dato.exito == true) {
                    $('#aprobareRadicado').submit();
                } else {
                    alert(dato.error);
                }
            }
        });
        //location.reload();
    }
};

function onlyChars() {
    if (event.keyCode < 65 || event.keyCode > 90) {
        if (event.keyCode != 32)
            event.returnValue = false;
    }
}
function validar_letra(e){
    tecla_codigo = (document.all) ? e.keyCode : e.which;
    if(((e.keyCode || e.which) == 8) || ((e.keyCode || e.which) == 9))return true;
    patron =/^[A-ZÑÁÉÍÓÚ0-9@#-_\s\.]*$/;
    tecla_valor = String.fromCharCode(tecla_codigo);
    return patron.test(tecla_valor);
} 