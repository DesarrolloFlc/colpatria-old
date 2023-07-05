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
    //$('#imgdownpdf').tipsy({gravity: 's'});
    //$('#tab2 [title]').tipsy({trigger: 'focus', gravity: 'w'});
    /*$.fn.abrirBox1 = function(e){
     (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
     jQuery.facebox({ 
     div: '#box1',
     /*'hideOnOverlayClick':false,
     'hideOnContentClick':false 
     });
     //$('#box1').facebox();
     }*/

    $("#tab_adduser").click(function() {
        $("#result_notif").css("display", "none");
    });
    $("#enviar").click(function() {
        $("#enviar").attr("disabled", "disabled");
        /*if( $("#num_images").val() >  0) {
         alert("No puede indexar más imágenes .. termine las que tiene en cola.");
         $("#enviar").removeAttr("disabled");
         return false;
         }*/
        $('#msg_indexacion').html('<img src="../../images/icons/preload.gif"/>');
        $.post('loadImages.php', function(data) {
            $('#msg_indexacion').html(data);
            $("#result_indexacion").css("display", "block");
        });
    });
    /** BUSQUEDA DE CLIENTES ***/
    $("#form_clientsearch").submit(function() {
        $("#box_search_result").css('display', 'none');
        $("#result_search").css('display', 'none');
        $("#tab_resultsearch").html("");
        if ($("#criterio1").val() == "") {
            alert("Por favor valide el criterio de búsqueda.");
            $("#criterio1").focus();
            return false;
        } else if ($("#criterio2").val() == "") {
            alert("Por favor valide el segundo criterio de búsqueda.");
            $("#criterio2").focus();
            return false;
        } else if ($("#texto").val() == "") {
            alert("Por favor valide el segundo criterio de búsqueda.");
            $("#criterio2").focus();
            return false;
        } else {
            $.post('searchClient.php', $("#form_clientsearch").serialize(), function(data) {
                if (data == "-1") {
                    $('#msg_result_search').html("No se encontraron coincidencias para la información dada.");
                    $("#result_search").css('display', 'block');
                } else {
                    $("#tab_resultsearch").html(data);
                }
                $("#box_search_result").css('display', 'block');
            });
        }
        return false;
    });
    /*
     * AREA CREADA PARA EL MANEJO
     * DEL NUEVO MODULO
     * SUPERMERCADO
     *
     **/
    $("#form_clientsearch_sup").submit(function() {
        $("#box_search_result").css('display', 'none');
        $("#result_search").css('display', 'none');
        $("#tab_resultsearch").html("");
        if ($("#criterio1").val() == "") {
            alert("Por favor valide el criterio de búsqueda.");
            $("#criterio1").focus();
            return false;
        } else if ($("#criterio2").val() == "") {
            alert("Por favor valide el segundo criterio de búsqueda.");
            $("#criterio2").focus();
            return false;
        } else if ($("#texto").val() == "") {
            alert("Por favor valide el segundo criterio de búsqueda.");
            $("#criterio2").focus();
            return false;
        } else {
            $.post('searchClient.php', $("#form_clientsearch_sup").serialize(), function(data) {
                if (data == "-1") {
                    $('#msg_result_search').html("No se encontraron coincidencias para la información dada.");
                    $("#result_search").css('display', 'block');
                } else {
                    $("#tab_resultsearch").html(data);
                }
                $("#box_search_result").css('display', 'block');
            });
        }
        return false;
    });
    $("#consolidadoClientesSup").submit(function() {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($('form#consolidadoClientesSup input#fecha_inicio').val() == '') {
            alert('Por favor seleccion una fecha inicial');
            $('form#consolidadoClientesSup input#fecha_inicio').focus();
            return false;
        }
        if ($('form#consolidadoClientesSup input#fecha_fin').val() == '') {
            alert('Por favor seleccion una fecha final');
            $('form#consolidadoClientesSup input#fecha_fin').focus();
            return false;
        }
        var formu = document.consolidadoClientesSup;
        formu.submit();
    });
    /*
     * FINAL DEL BLOQUE DE SUPERMERCADO
     */
    $("form#reporteLotesPlanillas").submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($(this).find('input[name="fecha_inicio"]').val() == '') {
            $('#boxError').html('Por favor seleccione una fecha para la generacion de la planilla.');
            $.facebox({div: '#boxError'});
            $(this).find('input[name="fecha_inicio"]').focus();
            return false;
        }
        $('#imgdownpdf').html('<a href="generarReporteXLS.php?' + datos + '&consR=download"><img id="imgloading" src="../../images/icons/pdf_download_8.gif" />');
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
        var datos = $(this).serialize();
        $.ajax({
            beforeSend: function() {
            },
            data: datos,
            type: 'POST',
            url: '../includes/controllerRadicado.php',
            dataType: 'json',
            success: function(dato) {
                //alert(dato);                      
            }
        });
    });
    $("form#verificarCambioEstadoRadicado").submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($(this).find('input[name="id"]').val() == '') {
            $('#boxError').html('Por favor digite el numero de radicado.');
            $.facebox({div: '#boxError'});
            $(this).find('input[name="id"]').focus();
            return false;
        }
        if ($(this).find('input[name="documento"]').val() == '') {
            $('#boxError').html('Por favor digite el numero de documento del cliente a cambiar el estado.');
            $.facebox({div: '#boxError'});
            $(this).find('input[name="documento"]').focus();
            return false;
        }
        var conf = true;
        if (conf) {
            var datos = $(this).serialize();
            //alert(datos);
            $.ajax({
                beforeSend: function() {
                },
                data: datos,
                type: 'POST',
                url: '../includes/controllerRadicado.php',
                dataType: 'json',
                success: function(dato) {
                    //alert(dato);
                    if(dato.exito){
                        if(dato.item){
                            var estado = '';
                            var estados = ["Radicado", "No fue enviado", "Recibido", "Devuelto"];
                            var excluido = 0;
                            if(dato.item.estado == '0'){
                                estado = 'Radicado';
                                excluido = 0;
                            }else if(dato.item.estado == 1){
                                estado = 'No fue enviado';
                                excluido = 1;
                            }else if(dato.item.estado == 2){
                                estado = 'Recibido';
                                excluido = 2;
                            }else if(dato.item.estado == 3){
                                estado = 'Devuelto';
                                excluido = 3;
                            }
                            $('td#estado_actualClientetd').html(estado);
                            $('tr#estado_actualCliente').show();
                            $('tr#nuevo_estadoCliente').show();
                            var strSelect = '<select id="nuevo_estado" name="nuevo_estado"><option value="">seleccionar...</option>';
                            for(var i = 0; i <= 3; i++){
                                if(excluido != i && estados[i] != 'Radicado')
                                    strSelect += '<option value="'+i+'">'+estados[i]+'</option>';
                            }
                            strSelect += '</select>';
                            $('td#nuevo_estadoClientetd').html(strSelect);
                            $('form#devolverRadicadoForm input#id_sucursal').val(dato.item.id_sucursal);
                            $('form#devolverRadicadoForm input#id_official').val(dato.item.id_usuarioenvia);
                            $('form#devolverRadicadoForm input#radicado_id').val(dato.item.id_radicados);
                            $('form#devolverRadicadoForm input#clienteid_dev').val(dato.item.radicado_item_id);
                            $('form#devolverRadicadoForm input#typepos').val('0');
                            $('form#devolverRadicadoForm input#opcion').val('2');
                            $('form#cambioEstadoRadicadoCliente input#id_cliente_c').val(dato.item.radicado_item_id);
                            $('div#div_cambioEstado').show();
                        }else{
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
                        }
                    }else{
                        alert(dato.error);
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
                    }
                }
            });
        }
    });
    $('form#cambioEstadoRadicadoCliente').submit(function(){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($('form#verificarCambioEstadoRadicado').find('select[name="nuevo_estado"]').val() == '') {
            $('#boxError').html('Por favor seleccione el nuevo estado.');
            $.facebox({div: '#boxError'});
            $('form#verificarCambioEstadoRadicado').find('select[name="nuevo_estado"]').focus();
            return false;
        }
        var nuevo_estado = $('form#verificarCambioEstadoRadicado').find('select[name="nuevo_estado"]').val();
        $(this).find('input[name="nuevo_estado_c"]').val(nuevo_estado);
        if(nuevo_estado == '3'){
            jQuery.facebox({
                div: '#box1'
            });
        }else
            $.fn.cambiarEstadoClientefn();
    });
    $('#radicadosyClientesxSucursal').submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($('form#radicadosyClientesxSucursal input#fecha_inicio').val() == '') {
            alert('Por favor seleccione una fecha inicial.');
            $('form#radicadosyClientesxSucursal input#fecha_inicio').focus();
            return false;
        }
        if ($('form#radicadosyClientesxSucursal input#fecha_fin').val() == '') {
            alert('Por favor seleccione una fecha final.');
            $('form#radicadosyClientesxSucursal input#fecha_fin').focus();
            return false;
        }
        if ($('form#radicadosyClientesxSucursal select#sucursales').val() == '') {
            alert('Por favor seleccione una sucursal.');
            $('form#radicadosyClientesxSucursal select#sucursales').focus();
            return false;
        }
        /*if($('form#radicadosyClientesxSucursal select#tiporadicado').val() == ''){
         alert('Por favor seleccione un tipo de radicado.');
         $('form#radicadosyClientesxSucursal select#tiporadicado').focus();
         return false;
         }*/
        var datos = $('form#radicadosyClientesxSucursal').serialize();
        $.ajax({
            beforeSend: function() {
                $('#botoncrearRadicado').attr('disabled', 'disabled');
                $('#imgloading').show();
            },
            data: datos,
            type: 'POST',
            url: '../includes/controllerRadicado.php',
            dataType: 'json',
            success: function(dato) {
                //alert(dato);
                if (dato.exito) {
                    var strHTML = '<tr>' +
                            '<td width="6%"># de radicado</td>' +
                            '<td width="18%">Sucursal</td>' +
                            '<td width="16%">Oficial</td>' +
                            '<td width="10%"># Documento</td>' +
                            '<td width="22%">Nombre y/o Raz&oacute;n Social del cliente</td>' +
                            '<td width="14%">Fecha de radicacion</td>' +
                            '<td width="6%">Fecha de envio</td>' +
                            '<td width="6%" align="center" valign="middle">Estado</td>' +
                            '</tr>';
                    var tam = dato.items.length;
                    for (var i = 0; i < tam; i++) {
                        strHTML += '<tr>' +
                                '<td>' + dato.items[i].id_radicados + '</td>' +
                                '<td>' + dato.items[i].sucursal + '</td>' +
                                '<td>' + dato.items[i].oficial + '</td>' +
                                '<td>' + dato.items[i].documento + '</td>' +
                                '<td>' + dato.items[i].descripcion + '</td>' +
                                '<td>' + dato.items[i].fecha_creacion + '</td>' +
                                '<td>' + dato.items[i].fecha_envio + '</td>' +
                                '<td align="center" valign="middle">' + $.fn.getEstados(dato.items[i].estado) + '</td>' +
                                '</tr>';
                    }
                    ;
                    $('#listadeRadicados').html(strHTML);
                    $('#imgdownpdf').html('<a href="generarReporteXLS.php?' + datos + '&consR=download&type=sucur"><img id="imgloading" src="../../images/icons/xlsx_icon.png" />');
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
    });
    $('#radicadosyClientesxOfficial').submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($('form#radicadosyClientesxOfficial input#fecha_inicio').val() == '') {
            alert('Por favor seleccione una fecha inicial.');
            $('form#radicadosyClientesxOfficial input#fecha_inicio').focus();
            return false;
        }
        if ($('form#radicadosyClientesxOfficial input#fecha_fin').val() == '') {
            alert('Por favor seleccione una fecha final.');
            $('form#radicadosyClientesxOfficial input#fecha_fin').focus();
            return false;
        }
        if ($('form#radicadosyClientesxOfficial select#oficiales').val() == '') {
            alert('Por favor seleccione una sucursal.');
            $('form#radicadosyClientesxOfficial select#oficiales').focus();
            return false;
        }
        var datos = $('form#radicadosyClientesxOfficial').serialize();
        //alert(datos);
        //return false;
        $.ajax({
            beforeSend: function() {
                $('#botoncrearRadicado').attr('disabled', 'disabled');
                $('#imgloading').show();
            },
            data: datos,
            type: 'POST',
            url: '../includes/controllerRadicado.php',
            dataType: 'json',
            success: function(dato) {
                /*alert(dato);
                 $('#prueba').html(dato);*/
                if (dato.exito) {
                    var strHTML = '<tr>' +
                            '<td width="6%"># de radicado</td>' +
                            '<td width="18%">Sucursal</td>' +
                            '<td width="20%">Oficial</td>' +
                            '<td width="16%">Documento de identificaci&oacute;n</td>' +
                            '<td width="22%">Nombre y/o Raz&oacute;n Social del cliente</td>' +
                            '<td width="10%">Fecha de radicacion</td>' +
                            '<td width="6%" align="center" valign="middle">Estado</td>' +
                            '</tr>';
                    var tam = dato.items.length;
                    for (var i = 0; i < tam; i++) {
                        strHTML += '<tr>' +
                                '<td>' + dato.items[i].id_radicados + '</td>' +
                                '<td>' + dato.items[i].sucursal + '</td>' +
                                '<td>' + dato.items[i].oficial + '</td>' +
                                '<td>' + dato.items[i].documento + '</td>' +
                                '<td>' + dato.items[i].descripcion + '</td>' +
                                '<td>' + dato.items[i].fecha_creacion + '</td>' +
                                '<td align="center" valign="middle">' + $.fn.getEstados(dato.items[i].estado) + '</td>' +
                                '</tr>';
                    }
                    ;
                    $('#listadeRadicados_2').html(strHTML);
                    $('#imgdownpdf_2').html('<a href="generarReporteXLS.php?' + datos + '&consR=download&type=ofic"><img id="imgloading" src="../../images/icons/xlsx_icon.png" />');
                    $('#imgdownpdf_2').qtip({
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
    });
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
    /** EDICION DE NUMERO DE DOCUMENTO **/
    $("#editardocumento").click(function() {
        var valor = $("#identificacionid").html();
        var id_client = $("#id_client1").val();
        $("#identificacionid").html("<form method='post' name='formeditardocumento' id='formeditardocumento'><input type='hidden' name='action' value='editardocumento' /><input type='hidden' name='id_client' value='" + id_client + "' /><input type='text' name='nuevodocumento' id='nuevodocumento' value='" + valor + "' /><input name='btn_editardocumento' id='btn_editardocumento' type='submit' value='Guardar >>' class='button'/></form>");
        $("#editardocumento").html("");
    });
    $("#btn_editardocumento").on("click", function() {
        $.post('../lib/general/procesos.php', $("#formeditardocumento").serialize(), function(data) {
            alert(data);
            if (data == "Actualizacion exitosa.") {
                $("#identificacionid").html("<span id='identificacionid' style='border:0;padding:0;margin:0'>" + $("#nuevodocumento").val() + "</span>");
            }
        });
        return false;
    });
    $("#editardocumentoSup").click(function() {
        var valor = $("#identificacionid").html();
        var id_client = $("#id_client1").val();
        $("#identificacionid").html("<form method='post' name='formeditardocumentoSup' id='formeditardocumentoSup'><input type='hidden' name='action' value='editardocumento' /><input type='hidden' name='id_client' value='" + id_client + "' /><input type='text' name='nuevodocumento' id='nuevodocumento' value='" + valor + "' /><input name='btn_editardocumentoSup' id='btn_editardocumentoSup' type='submit' value='Guardar >>' class='button'/></form>");
        $("#editardocumento").html("");
    });
    $("#btn_editardocumentoSup").on("click", function() {
        $.post('../includes/controllerSupermercado.php', $("#formeditardocumentoSup").serialize(), function(data) {
            alert(data);
            if (data == "Actualizacion exitosa.") {
                $("#identificacionid").html("<span id='identificacionid' style='border:0;padding:0;margin:0'>" + $("#nuevodocumento").val() + "</span>");
            }
        });
        return false;
    });
    /* VALIDACION DE FORMULARIO PARA AGREGAR UN USUARIO */
    $("#form_useradd").submit(function() {
        if ($("#id_group").val() == "") {
            alert("Por favor valide el campo de perfil de usuario.");
            $("#id_group").focus();
            return false;
        } else if ($("#username").val() == "") {
            alert("Por favor valide el campo de nombre de usuario.");
            $("#username").focus();
            return false;
        } else if ($("#password").val() == "") {
            alert("Por favor valide el campo de contraseña del usuario.");
            $("#password").focus();
            return false;
        } else if ($("#name").val() == "") {
            alert("Por favor valide el campo de nombre del usuario.");
            $("#name").focus();
            return false;
        } else if ($("#identificacion").val() == "") {
            alert("Por favor valide el campo de identificación del usuario.");
            $("#identificación").focus();
            return false;
        } else {
            $.post('../../lib/general/procesos.php', $("#form_useradd").serialize(), function(data) {
                if (data == "-1") {
                    $('#msg_adduser').html("El usuario no se pudo crear, valide los campos.");
                } else if (data == "0") {
                    $('#msg_adduser').html("Usuario creado con éxito.");
                    $("#result_notif").css("display", "block");
                    $('#divpadreoficial').slideUp('medium');
                    $("#form_useradd").reset();
                }
            });
        }
        return false;
    });
    /* BUSQUEDA DE USUARIO */
    $("#search_user").submit(function() {

        if ($("#criterio").val() == "" || $("#texto").val() == "") {
            alert("Por favor complete todos los campos de búsqueda.");
            return false;
        }
        $.post('../../procesos/admin/searchUser.php', $("#search_user").serialize(), function(data) {
            if (data == "-1") {
                $('#msg_result_search').html("No se encontraron coincidencias para la información dada.");
                $("#result_search").css("display", "block");
                return false;
            } else {
                $("#list_users").html(data);
            }
        });
        return false;
    });
    /** CLAVE PERSONAL **/

    jQuery.fn.fortalezaClave = function() {
        $(this).each(function() {
            elem = $(this);
            //creo el elemento HTML para el mensaje
            msg = $('<span class="fortaleza">No segura</span>');
            //inserto el mensaje en la p�gina, justo despu�s del campo input password
            elem.after(msg);
            //almaceno la referencia del elemento del mensaje dentro del campo input
            elem.data("mensaje", msg);
            elem.keyup(function(e) {
                elem = $(this);
                //recupero la referencia al elemento del mensaje 
                msg = elem.data("mensaje");
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
    };
    $("#pass2").fortalezaClave();
    $("#form_changepass").submit(function() {
        if ($("#pass2").val() != $("#pass3").val()) {
            alert("Por favor valide la nueva contraseña, los campos no coinciden.");
            return false;
        } else {
            $("#form_changepass").submit();
        }
        return false;
    });
    $("#form_user_indexacion").submit(function() {
        $.post('../../procesos/internal/showIndexacionUser.php', $("#form_user_indexacion").serialize(), function(data) {
            $("#user_images").html(data);
        });
        return false;
    });
    /** REPORTES **/
    $("#reportPlanillas_planilla").change(function() {
        if ($("#reportPlanillas_planilla").val() != "") {
            $.post('libraryFunctions.php', {planilla: $("#reportPlanillas_planilla").val(), reporte: 'reportPlanillas.php'}, function(data) {
                $('#reportPlanillas_lote').html(data);
                $('#reportPlanillas_lote').removeAttr('disabled');
            });
        }
    });
    $("#reportPlanillas_sucursal").change(function() {
        if ($("#reportPlanillas_sucursal").val() != "") {
            $('#reportPlanillasSuc_planilla').html("<option>Seleccione una planilla...</option>");
            //alert($("#reportPlanillas_sucursal").val());
            $.post('libraryFunctions.php', {planilla: $("#reportPlanillas_sucursal").val(), reporte: 'reportPlanillas.php', accion: 'sucursales', fec_ini: $("#fecha_inicio").val(), fec_fin: $("#fecha_fin").val()}, function(data) {
                //alert(data);
                $('#reportPlanillasSuc_planilla').html(data);
                $('#reportPlanillasSuc_planilla').removeAttr('disabled');
            });
        }
    });
    $("#reportPlanillasSuc_planilla").change(function() {
        if ($("#reportPlanillasSuc_planilla").val() != "") {
            var planilla_s = $("#reportPlanillasSuc_planilla").val();
            var sucursal_s = $("#reportPlanillas_sucursal").val();
            var fecha_inicio = $("#fecha_inicio").val();
            var fecha_fin = $("#fecha_fin").val();
            $.post('libraryFunctions.php', {planilla: planilla_s, reporte: 'reportPlanillas.php', sucursal: sucursal_s, fec_ini: fecha_inicio, fec_fin: fecha_fin, accion: 'lotesSuc'}, function(data) {
                //alert(data);
                $('#reportPlanillasSuc_lote').html(data);
                $('#reportPlanillasSuc_lote').removeAttr('disabled');
            });
        }
    });
    $("#reportPlanillas_form").submit(function() {
//alert('aca');
        $.post('libraryFunctions.php', $("#reportPlanillas_form").serialize(), function(data) {
            $("#clientlist_div").html(data);
        });
        return false;
    });
    $("#reportPlanillasSuc_form").submit(function() {
//alert('aca');
//alert($("#reportPlanillasSuc_form").serialize());
        $.post('libraryFunctions.php', $("#reportPlanillasSuc_form").serialize(), function(data) {
//alert(data);
            $("#clientlist_div").html(data);
        });
        return false;
    });
    /** FIN REPORTES **/

    $("#user_edit").submit(function() {
        if ($("#pass1").val() == $("#pass2").val()) {
            $.post('../../lib/general/procesos.php', $("#user_edit").serialize(), function(data) {
                alert("Cambio de clave exitoso.");
            });
        }
        else {
            alert("Las claves no coinciden, por favor valide la informacion.");
        }
        return false;
    });
    /** CONFIRMACION **/
    $("#confirmClient").submit(function() {
        if ($("#contact").val() == "") {
            alert("El campo de contacto no puede estar vacio.");
            $("#contact").css('background', 'red');
            return false;
        }

        if ($("#correoelectronico").val() != "") {
            var status = false;
            var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
            if (document.getElementById("correoelectronico").value.search(emailRegEx) == -1) {
                alert("Por favor ingrese un mail valido.");
                $("#correoelectronico").css('background-color', 'red');
                return false;
            }
        }
        if ($("#contact").val() == "1" || $("#contact").val() == "2" || $("#contact").val() == "3" || $("#contact").val() == "4" || $("#contact").val() == "6" || $("#contact").val() == "7" || $("#contact").val() == "9" || $("#contact").val() == "11" || $("#contact").val() == "13") {
            if ($("#grabacion").val() == "") {
                alert("Por favor cargue la llamada de la gestion.");
                $("#grabacion").css('background', 'red');
                return false;
            }
        }
        $('#btnguardaractu').attr('disabled', 'disabled');

        //----------------------------------------------------------------------
        var resp_news = '';
        var i_cont = 0;
        var ing_n = '';

        $('form#confirmClient [data-oldValue]').each(function(index, value) {
            if ($(this).val() != $(value).attr('data-oldValue')) {
                if (i_cont === 0) {
                    resp_news += $(value).attr('name') + ':' + $(this).val();
                } else {
                    resp_news += '|' + $(value).attr('name') + ':' + $(this).val();
                }
                i_cont++;
            }
            if ($(value).attr('name') == 'ingresosmensuales' || $(value).attr('name') == 'ingresosmensualesemp') {
                ing_n = $(value).attr('data-oldValue');
            }
        });
        if (resp_news != '') {
            $('form#confirmClient input#confirmdata').val(resp_news);
        }
        if (ing_n != '') {
            $('form#confirmClient input#alertingresos').val(ing_n);
        }
        //----------------------------------------------------------------------
    });
    /** INDEXACION DE USUARIO **/
    $("#showIndexacion").submit(function() {
        $.post('showIndexacionUser.php', $("#showIndexacion").serialize(), function(data) {
            $("#user_images").html(data);
        });
        return false;
    });
    /** BUSQUEDA DE ORDENES DE PRODUCCION ***/
    $("#form_ordensearch").submit(function() {
        $.post('../../lib/general/procesos.php', $("#form_ordensearch").serialize(), function(data) {
            $("#tab_resultsearch").html(data);
            $("#box_search_result").css('display', 'block');
        });
        return false;
    });
    $("#confirmClientCapi").submit(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($("#respuesta_libre").val() == "") {
            alert("Debe seleccionar una respuesta a la pregunta de marcacion.");
            $("#respuesta_libre").css('background', 'red');
            return false;
        }
        if ($("#correoelectronico").val() != "") {
            var status = false;
            var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
            if (document.getElementById("correoelectronico").value.search(emailRegEx) == -1) {
                alert("Por favor ingrese un mail valido.");
                $("#correoelectronico").css('background-color', 'red');
                return false;
            }
        }
        if($('select[name="nacionalidad_otra"]').val() == ''){
            alert('Debe seleccionar una opcion para la pregunta "Tiene otra nacionalidad?".');
            $('select[name="nacionalidad_otra"]').focus();
            return false;
        }else if($('select[name="nacionalidad_otra"]').val() == '1' && $('select[name="nacionalidad_cual"]').val() == ''){
            alert('Debe seleccionar "Cual?" nacionalidad tiene como otra nacionalidad.');
            $('select[name="nacionalidad_cual"]').focus();
            return false;
        }
        if($('select[name="obligaciones_otras"]').val() == ''){
            alert('Debe seleccionar una opcion para la pregunta "Sujeto a obligaciones en otros paises?".');
            $('select[name="obligaciones_otras"]').focus();
            return false;
        }else if($('select[name="obligaciones_otras"]').val() == '1' && $('input[name="obligaciones_paises"]').val() == ''){
            alert('Debe digitar en "Cuales?" paises tiene obligaciones.');
            $('input[name="obligaciones_paises"]').focus();
            return false;
        }
        if ($("#id_contact").val() == "") {
            alert("El campo de contacto no puede estar vacio.");
            $("#id_contact").css('background', 'red');
            return false;
        }
        if ($("#id_contact").val() == "1" || $("#id_contact").val() == "2" || $("#id_contact").val() == "3" || $("#id_contact").val() == "4" || $("#id_contact").val() == "6" || $("#id_contact").val() == "7" || $("#id_contact").val() == "9" || $("#id_contact").val() == "11" || $("#id_contact").val() == "13") {
            if ($("#grabacion").val() == "") {
                alert("Por favor cargue la llamada de la gestion.");
                $("#grabacion").css('background', 'red');
                return false;
            }
        }
        var form = this;
        form.submit();
    });
    $(".desactivaruser").click(function() {
        $.post($(this).attr('href'), function(data) {
            if (data == "1") {
                alert("Usuario desactivado con exito.");
                location.reload();
            }
            else
                alert("Ocurrio un problema, por favor contacte al administrador.");
        });
        return false;
    });
    $(".number").click(function() {
        $.get($(this).attr('href'), function(data) {
            $("#ordenes_show").html(data);
        });
        return false;
    });
    $("form#creaciondeRadicado").submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($('form#creaciondeRadicado #id_sucursal').val() == '') {
            alert('Por favor seleccione una sucursal');
            $('form#creaciondeRadicado #id_sucursal').focus();
            return false;
        }
        if ($('form#creaciondeRadicado #id_sucursal option:selected').text().search('CORREDORES') >= 0 && $('form#creaciondeRadicado #utc').val() == '') {
            alert('Por favor digite el codigo de corredor');
            $('form#creaciondeRadicado #utc').focus();
            return false;
        }
        if ($('form#creaciondeRadicado #telefono').val() == '') {
            alert('Por favor digite un numero de telefono');
            $('#telefono').focus();
            return false;
        }
        if ($('form#creaciondeRadicado #tipo').val() == '') {
            alert('Debe seleccionar el tipo de radicado para continuar.');
            $('#telefono').focus();
            return false;
        }
        if ($('form#creaciondeRadicado #clientes').val() == '') {
            alert('No ha agregado clientes para esta orden por favor agregue su listado');
            return false;
        }
        var conf = confirm('Esta seguro que la informaci\xF3n que radic\xF3 y va a enviar de todos los clientes esta completa, debidamente diligenciada y tiene todos los documentos adicionales para cumplir con los p\xE1rametros exigidos por SARLAFT, y que son su responsabilidad, y por lo tanto estos clientes no tendr\xE1n ninguna causal de devoluci\xF3n?');
//        alert ($("#creaciondeRadicado").serialize());
//        return false;
        if (conf) {
            var datos = $("#creaciondeRadicado").serialize();
            $.ajax({
                beforeSend: function() {
                    $('form#creaciondeRadicado #botoncrearRadicado').attr('disabled', 'disabled');
                    $('form#creaciondeRadicado #imgloading').show();
                },
                data: datos,
                type: 'POST',
                url: '../includes/controllerRadicado.php',
                dataType: 'json',
                success: function(dato) {
                    $('form#creaciondeRadicado #imgloading').hide();
                    $('form#creaciondeRadicado #botoncrearRadicado').removeAttr('disabled');
                    //alert(dato);
                    if (dato.exito) {
                        //alert(dato.radicado['id'])
                        var id = dato.radicado['id'];
                        //alert("esta es la id: "+id);
                        $('form#creaciondeRadicado #msg_adduser').html(dato.exito); //msg_erradduser
                        $("form#creaciondeRadicado #result_notif").slideDown('medium');
                        $("form#creaciondeRadicado").reset();
                        var strtable = '<tr><td>Nombre Cliente</td><td>Documento</td><td width="16" align="center" valign="middle">Borrar</td></tr>';
                        $('form#creaciondeRadicado #listaclientes').html(strtable);
                        $('form#creaciondeRadicado #clientes').val('');
                        window.location.href = "generarReportePDF.php?idradicado=" + id;
                    } else {
                        $('form#creaciondeRadicado #msg_erradduser').html(dato.errorr);
                    }
                    /*if(dato == 'ok'){
                     alert('sesion iniciada correctamente');
                     }else{
                     alert('erros');
                     }*/
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " : " + xhr.responseText);
                }
            });
        }
    });
    $("form#creaciondeRadicadoMasivo").submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($('form#creaciondeRadicadoMasivo #id_sucursal').val() == '') {
            alert('Por favor seleccione una sucursal');
            $('form#creaciondeRadicadoMasivo #id_sucursal').focus();
            return false;
        }
        if ($('form#creaciondeRadicadoMasivo #id_sucursal option:selected').text().search('CORREDORES') >= 0 && $('form#creaciondeRadicadoMasivo #utc').val() == '') {
            alert('Por favor digite el codigo de corredor');
            $('form#creaciondeRadicadoMasivo #utc').focus();
            return false;
        }
        if ($('form#creaciondeRadicadoMasivo #telefono').val() == '') {
            alert('Por favor digite un numero de telefono');
            $('form#creaciondeRadicadoMasivo #telefono').focus();
            return false;
        }
        if($(this).find('[name="tipo"]').val() == ''){
            alert('Debe seleccionar el tipo de radicado a crear.');
            $(this).find('[name="tipo"]').focus();
            return false;
        }
        if ($('form#creaciondeRadicadoMasivo #file_masivo').val() == '') {
            alert('Debe selecionar un archivo a cargar, recuerde que son minimo 5 cliente.');
            $('form#creaciondeRadicadoMasivo #file_masivo').focus();
            return false;
        }else{
            var fparts = $('form#creaciondeRadicadoMasivo #file_masivo').val().split(".");
            var exten = fparts[(fparts.length - 1)];
            if(exten != 'xls' && exten != 'xlsx'){
                alert("Debe cargar un archivo con formato permitido (xls, xlsx)");
                $('form#creaciondeRadicadoMasivo #file_masivo').focus();
                return false;
            }
        }
        var conf = confirm('Esta seguro que la informaci\xF3n que radic\xF3 y va a enviar de todos los clientes esta completa, debidamente diligenciada y tiene todos los documentos adicionales para cumplir con los p\xE1rametros exigidos por SARLAFT, y que son su responsabilidad, y por lo tanto estos clientes no tendr\xE1n ninguna causal de devoluci\xF3n?');
        //alert ($("#creaciondeRadicadoMasivo").serialize());
//        return false;
        if(conf){
            /*var formData = new FormData();
            formData.append('file_masivo', document.getElementById("file_masivo").files[0]);
            var otros_datos = $(this).serializeArray();
            $.each(otros_datos, function(key, input){
                formData.append(input.name, input.value);
            });
            $.ajax({
                beforeSend: function(){
                    $('form#creaciondeRadicadoMasivo #botoncrearRadicado').attr('disabled', 'disabled');
                    $('form#creaciondeRadicadoMasivo #imgloading').show();
                },
                url: '../includes/controllerRadicado.php',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(dato) {
                    console.log(dato);
                },
                complete: function(jqXHR, textStatus){
                    $('form#creaciondeRadicadoMasivo #botoncrearRadicado').removeAttr('disabled');
                    $('form#creaciondeRadicadoMasivo #imgloading').hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                    $('form#creaciondeRadicadoMasivo #botoncrearRadicado').removeAttr('disabled');
                    $('form#creaciondeRadicadoMasivo #imgloading').hide();
                    alert('<strong>Error!</strong> '+errorThrown+': '+jqXHR.responseText);
                }
            });*/
            $('form#creaciondeRadicadoMasivo #botoncrearRadicado').attr('disabled', 'disabled');
            $('form#creaciondeRadicadoMasivo #imgloading').show();
            var forma = document.creaciondeRadicadoMasivo;
            forma.submit();
        }
    });
    $("#busquedadeRadicado").submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($('#id').val() == '') {
            alert('Por favor digite el numero de radicado');
            $('#id').focus();
            return false;
        }
        var conf = true;
        if (conf) {
            var datos = $("#busquedadeRadicado").serialize();
            $.ajax({
                beforeSend: function() {
                },
                data: datos,
                type: 'POST',
                url: '../includes/controllerRadicado.php',
                dataType: 'json',
                success: function(dato) {
                    console.log(dato);
                    if (dato.exito) {
                        var estado = 'Recibido';
                        if (dato.radicado['estado'] == '0')
                            estado = 'Radicado';
                        estado = $.fn.getEstados(dato.radicado['estado']);
                        var strHTML = '<td>' + dato.radicado['id'] + '</td>' +
                                '<td>' + dato.sucursal + '</td>' +
                                '<td>' + dato.funcionario + '</td>' +
                                '<td>' + dato.radicado['fecha_creacion'] + '</td>' +
                                '<td>' + estado + '</td>' +
                                '<td><a href="generarReportePDF.php?idradicado=' + dato.radicado['id'] + '&downpdf=download"><img src="../../resources/images/icons/pdf_icon.gif" title="Descargar PDF" alt="Descargar PDF" /></a></td>';
                        strItems = '<tr>' +
                                '<td width="20%">Documento</td>' +
                                '<td>Nombre</td>' +
                                '<td width="10%">Estado</td>' +
                                '</tr>';
                        if (dato.items) {
                            var lengtitems = dato.items.length;
                            for (var i = 0; i < lengtitems; i++) {
                                strItems += '<tr>' +
                                        '<td width="20%">' + dato.items[i].documento + '</td>' +
                                        '<td>' + dato.items[i].descripcion + '</td>';
                                if (dato.radicado['estado'] == '2') {
                                    strItems += '<td width="10%">' + $.fn.getEstados(dato.items[i].estado) + '</td>';
                                } else {
                                    strItems += '<td width="10%">Radicado</td>';
                                }
                                strItems += '</tr>';
                            }
                        }
                        $('#radicadoBuscado').html(strHTML);
                        $('#listadoClientes').html(strItems);
                        //window.open("generarReportePDF.php?idradicado="+id, '_blanck');
                    } else {
                        $('#msg_warningradicado').html(dato.errorr);
                        $('#result_notifwr').slideDown('medium');
                    }
                }
            });
        }
    }); //formprueba
    $("form#aprobarClientes").submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($(this).find('input[name="fecha_envio"]').val() == '') {
            alert('Por favor seleccione la fecha de envio de Copatria');
            $(this).find('input[name="fecha_envio"]').focus();
            return false;
        }
        if (!$('#cliente').is(":checked")) {
            if (!confirm('Seguro que no quiere checkear ningun cliente?'))
                return false;
        }
        var datos = $(this).serialize();
        $.ajax({
            beforeSend: function() {
            },
            data: datos,
            type: 'POST',
            url: '../includes/controllerRadicado.php',
            dataType: 'json',
            success: function(dato) {
                //alert(dato);return false;
                $('#aprobareRadicado').submit();
                if (dato.errorr) {
                    $('#msg_warningradicado').html(dato.errorr);
                    $('#result_notifwr').slideDown('medium');
                } else {
                    $('#msg_addradicado').html(dato.exito);
                    $('#result_notifok').slideDown('medium');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown+': '+jqXHR.responseText);
                return false;
            }
        });
    });
    $("#aprobareRadicado").submit(function(event) {//radicadosyClientesxoficial
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($('input[name="id"]', this).val() == '') {
            alert('Por favor digite el numero de radicado');
            $('input[name="id"]', this).focus();
            return false;
        }
        $('#acordeonClientes').slideUp('medium');
        const form = this;
        $.ajax({
            beforeSend: function() {
                $("#id_radicado").remove();
                $("#tableLote").remove();
                $('#div_fechaenvio').remove();
                $('#result_notifwr').slideUp('medium');
            },
            data: $(form).serialize(),
            type: 'POST',
            url: '../includes/controllerRadicado.php',
            dataType: 'json',
            success: function(dato) {
                if (!dato.exito) {
                    $('#msg_warningradicado').html(dato.errorr);
                    $('#result_notifwr').slideDown('medium');
                    return false;
                }
                let estado = 'Radicado';
                let lengtcant = 0;
                let strLote = `<div id="div_fechaenvio">
                    <table id="table_fechaenvio">
                        <tr>
                            <td width="60">Fecha Envio:</td>
                            <td><input type="text" name="fecha_envio" id="fecha_envio" class="one" readonly>(YYYY-MM-DD)</td>
                        </tr>
                        <tr>
                            <td width="60">Observacion:</td>
                            <td><textarea rows="4" name="observacion" id="observacion"></textarea></td>
                        </tr>
                    </table>
                    <br><input type="submit" id="buttonAprobar" class="button" value="Aprobar clientes del radicado">
                    <input type="hidden" id="fecha_creacionR" name="fecha_creacionR" value="${dato.radicado['fecha_creacion']}">
                    <input type="hidden" id="tipo_radicadoR" name="tipo_radicadoR" value="${dato.radicado['tipo']}">
                </div>`;
                if (dato.items) lengtcant = dato.items.length;

                let strItems = `<tr>
                    <td></td>
                    <td width="15%"></td>
                    <td width="58%"></td>
                    <td width="15%"></td>
                    <td width="2%">todo</td>
                    <td width="2%">nada</td>
                    <td width="10%">todo</td>
                </tr>
                <tr>
                    <td></td>
                    <td width="15%"></td>
                    <td width="58%"></td>
                    <td width="15%"></td>
                    <td width="2%">
                        <input type="radio" name="cli_select" id="cli_select" value="" onchange="$.fn.seleccionarTodo(event, this, 1, ${lengtcant});">
                    </td>
                    <td width="2%">
                        <input type="radio" name="cli_select" id="cli_select" value="" onchange="$.fn.seleccionarTodo(event, this, 3, ${lengtcant});">
                    </td>
                    <td width="10%">
                        <input type="radio" name="cli_select" id="cli_select" value="" onchange="$.fn.seleccionarTodo(event, this, 2, ${lengtcant});">
                    </td>
                </tr>`;
                
                if (dato.radicado['estado'] == '2' || dato.radicado['estado'] == '4') {
                    estado = 'Recibido';
                    strLote = '';
                    strItems = '';
                }
                const strHTML = `<td>${dato.radicado['id']}</td>
                    <td>${dato.sucursal}</td>
                    <td>${dato.funcionario}</td>
                    <td>${dato.radicado['fecha_creacion']}</td>
                    <td>${$.fn.getEstados(dato.radicado['estado'])}</td>
                    <td>
                        <a href="generarReportePDF.php?idradicado=${dato.radicado['id']}&downpdf=download"><img src="../../resources/images/icons/pdf_icon.gif" title="Descargar PDF" alt="Descargar PDF" /></a>
                </td>`;
                
                strItems += `<tr>
                    <td></td>
                    <td width="15%">Documento</td>
                    <td width="58%">Nombre</td>
                    <td>Evidencias</td>
                    <td width="15%">Documento especial?</td>`;
                if (dato.radicado['estado'] == '2' || dato.radicado['estado'] == '4') {
                    strItems += `<td width="2%">Estado</td>`;
                } else {
                    strItems += `<td width="2%">Aprobar</td>
                    <td width="2%">Devolver</td>
                    <td width="10%">No enviado</td>`;
                }
                strItems += `</tr>`;
                if (dato.items) {
                    const suc = dato.sucursal.replace(/\ /g, '_');
                    const lengtitems = dato.items.length;
                    for (let i = 0; i < lengtitems; i++) {
                        const filename = dato.items[i].file_name;
                        strItems += `<tr id="trcl_${i}">`;

                        strItems += `<td>
                            <a href="#" title="Edit" onclick="$.fn.edCliente('${dato.radicado['estado']}', ${dato.radicado['id']}, ${dato.items[i].id}, '${dato.items[i].documento_especial}', event);">
                                <img src="../../resources/images/icons/pencil.png" alt="Edit" />
                            </a>
                        </td>`;

                        strItems += `<td width="20%">
                            <a href="#" onclick="$.fn.mostrarCliente(event, '${dato.items[i].documento}', '${filename}', '${suc}', '${dato.radicado['estado']}', ${dato.radicado['id']}, ${(i + 1)});">${dato.items[i].documento}</a>
                        </td>
                        <td>${dato.items[i].descripcion}</td>
                        <td id="td-evidencias-${(i + 1)}">
                            <div style="display: flex">
                                <a 
                                    href="#" 
                                    onclick="$(this).mostrarDivEvidencias(event, ${dato.items[i].id}, '${dato.items[i].documento}', ${(i + 1)}, '${dato.items[i].descripcion}');"
                                    style="align-self: center;"
                                >
                                    <img src="../../resources/images/icons/show.jpg" alt="Agregar Evidencia" title="Agregar Evidencia" />
                                </a>
                                <a 
                                    href="#" 
                                    onclick="$(this).mostrarEvidencias(event, ${(i + 1)}, ${dato.items[i].radicado_item_id});"
                                    style="padding-left: 5px;${dato.items[i].radicado_item_id ? '' : ' filter: grayscale(1); cursor: not-allowed;'}"
                                    id="evidencias-check-${i + 1}"
                                >
                                    <img src="../../resources/images/icons/tick_circle.png" alt="Mostrar Evidencia" title="Mostrar Evidencia" />
                                </a>
                                <a 
                                    href="#" 
                                    onclick="$(this).eliminarEvidencias(event, ${(i + 1)}, ${dato.items[i].radicado_item_id});"
                                    style="padding-left: 5px;${dato.items[i].radicado_item_id ? '' : ' filter: grayscale(1); cursor: not-allowed;'}"
                                    id="evidencias-del-${i + 1}"
                                >
                                    <img src="../../resources/images/icons/cross_circle.png" alt="Eliminar Evidencia" title="Eliminar Evidencia" />
                                </a>
                            </div>
                        </td>
                        <td>${((dato.items[i].documento_especial == '1') ? 'Si' : 'No')}</td>`;
                        if (dato.radicado['estado'] == '2' || dato.radicado['estado'] == '4') {
                            strItems += `<td width="10%">${$.fn.getEstados(dato.items[i].estado)}</td>`;
                        } else {
                            strItems += `<td width="2%">
                                <input type="radio" name="cliente[${i}]" id="cliente" value="${dato.items[i].id}|2" onchange="$.fn.devolverItem(event, this, ${i});">
                            </td>
                            <td width="2%">
                                <input type="radio" name="cliente[${i}]" id="cliente" value="${dato.items[i].id}|3" onchange="$.fn.devolverItem(event, this, ${i});">
                            </td>
                            <td width="10%">
                                <input type="radio" name="cliente[${i}]" id="cliente" value="${dato.items[i].id}|1" onchange="$.fn.devolverItem(event, this, ${i});">
                            </td>`;
                        }
                        strItems += '</tr>';
                    }
                }
                $('#radicadoBuscado').html(strHTML);
                $('#listadoClientes').html(strItems);
                $('#aprobarClientes').append(`<input type="hidden" id="id_radicado" name="id_radicado" value="${dato.radicado['id']}">`);
                $('#aprobarClientes').append(strLote);
                $('#acordeonClientes').slideDown('medium');
                $('input#fecha_envio').simpleDatepicker();
                //window.open("generarReportePDF.php?idradicado="+id, '_blanck');
                $('form#devolverRadicadoForm input#id_sucursal').val(dato.radicado['id_sucursal']);
                $('form#devolverRadicadoForm input#id_official').val(dato.radicado['id_usuarioenvia']);
                $('form#devolverRadicadoForm input#radicado_id').val(dato.radicado['id']);
                $('form#devolverRadicadoForm input#opcion').val('1');
            }
        });
    });
    function validaAgregarCliente(docespe) {
        if (!confirm('Esta seguro que la informaci\xF3n que radic\xF3 y va a enviar esta completa, debidamente diligenciada y tiene todos los documentos adicionales para cumplir con los p\xE1rametros exigidos por SARLAFT, y que son su responsabilidad, y por lo tanto este cliente no tendr\xE1 ninguna causal de devoluci\xF3n?')) {
            return false;
        }
        const cant = $("input[name^=load_file]").length;
        for (let i = 0; i < cant; i++) {
            if ($(`input[name=load_file[${i}]]`).val() == '') {
                alert('Por favor seleccione el archivo numero ' + (1 + i));
                $(`input[name=load_file[${i}]]`).focus();
                return false;
            }
            const valorfile = $(`input[name=load_file[${i}]]`).val().split('.');
            const tam_valorfile = valorfile.length;
            if (['pdf', 'jpg', 'jpeg'].includes(valorfile[(tam_valorfile - 1)].toLowerCase())) {
                alert(`Por favor seleccione para el archivo numero ${(1 + i)} un formato valido ( jpg, jpeg, pdf ).`);
                $(`input[name=load_file[${i}]]`).focus();
                return false;
            }
        }
        const nom = $('#nombre_cli').val();
        const ced = $('#documento_cli').val();
        if ($('#clientes').val() != '') {
            const clientes = $('#clientes').val().split('|');
            const tamano = clientes.length;
            let i = 1;
            while (i < tamano) {
                if (clientes[i] == ced) {
                    alert('Ya ha agregado un cliente con este numero de cedula, por favor verifique');
                    $('#documento_cli').focus();
                    return false;
                }
                i = i + 2;
            }
        }
        const clis = $('#clientes').val();
        let valueclis = '';
        if (clis == '') {
            valueclis = nom + '|' + ced + '|' + docespe;
            $('#clientes').val(valueclis);
        } else {
            valueclis += clis + '|' + nom + '|' + ced + '|' + docespe;
            $('#clientes').val(valueclis); //enviar las variables
        }

        let optesp = "No";
        if ($('#chkoptesp').is(':checked'))
            optesp = "Si";
        const listaclientes = `<tr class="tr_content">
            <td>${nom.toUpperCase()}</td>
            <td>${ced}</td>
            <td>${optesp}</td>
            <td align="center" valign="middle" class="td_formatopiso">
                <a href="#${nom}|${ced}|${docespe}" onclick="$(this).hidetr(event);">
                    <img src="../../resources/images/icons/cross_circle.png" title="Eliminar" alt="Eliminar" />
                </a>
            </td>
        </tr>`;
        $('#listaclientes').append(listaclientes);
        //empieza a tratar la imagen
        $('form#form_load_file img#imgloading').show();
        $('form#form_load_file input#buttonAgregarCliente').attr('disabled', 'disabled');
        const str = $('#id_sucursal option:selected').text();
        $('#documento_sub').val(ced);
        $('#sucursal_sub').val(str);
        $('#nombre_cli').val('');
        $('#documento_cli').val('');
        if ($('form#creaciondeRadicado #tipo').val() == '1' || $('form#creaciondeRadicado #tipo').val() == '5') {
            $('#botoncrearRadicado').attr('disabled', 'disabled');
            document.form_load_file.submit();
        }
    }
    $.fn.agregarCliente = function(e) {
        (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
        if ($('#id_sucursal').val() == '') {
            alert('Por favor seleccione una sucursal');
            $('#id_sucursal').focus();
            return false;
        }
        if ($('#nombre_cli').val() == '') {
            alert('Por favor digite el nombre del cliente si piensa agregar uno nuevo');
            $('#nombre_cli').focus();
            return false;
        }
        if ($('#documento_cli').val() == '') {
            alert('Por favor digite el documento del cliente si piensa agregar uno nuevo');
            $('#documento_cli').focus();
            return false;
        }
        if ($('#chkoptesp').is(':checked')) {
            $.ajax({
                data: 'cliente=' + $('#documento_cli').val() + '&action=validarCliente',
                type: 'POST',
                url: '../includes/controllerRadicado.php',
                //dataType: 'json',
                success: function(dato) {
                    console.log('dato de revision: ');
                    console.log(dato);
                    if (dato == "No") {
                        alert("No se puede radicar el cliente porque no tiene Formulario de Conocimiento del Cliente de Vinculación Inicial.");
                    } else {
                        validaAgregarCliente('1');
                    }
                }
            });
        } else {
            validaAgregarCliente('0');
        }
    };
    $.fn.pruebaTag = function() {
        alert('prueba');
    };
    $.fn.archivosSubidos = function(obj) {
        if (!obj.exito) {
            alert(obj.er_folder + obj.er_file);
            return false;
        }
        const strHTML = `<tbody>
            <tr class="alt-row">
                <td width="8%">Archivo:</td>
                <td><input type="file" id="load_file" name="load_file[0]">
                    <div style="width:50px; display: inline; margin-left:20px;">
                        <a href="#" onclick="$.fn.agregarCargaarchivos(event);">
                            <img src="../../resources/images/icons/show.jpg" title="Agregar archivos" alt="Agregar">
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>`;
        $('#files_loaders').html(strHTML);
        $('form#form_load_file img#imgloading').hide();
        $('form#form_load_file input#buttonAgregarCliente').removeAttr('disabled');
        $('#botoncrearRadicado').removeAttr('disabled');
    };
    $.fn.hidetr = function(e) {
        (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
        var resp = confirm(String.fromCharCode(191) + 'Seguro que desea borrar este cliente?');
        if (resp) {
            var str = $(this).attr('href').split('#')[1];
            if (str == $('#clientes').val()) {
                $('#clientes').val('');
            } else {
                var str1 = $('#clientes').val();
                var posstr = str1.indexOf(str);
                if (posstr == 0) {
                    var str2 = str1.replace(str + '|', '');
                } else {
                    if (posstr > 0)
                        var str2 = str1.replace('|' + str, '');
                }
                $('#clientes').val(str2);
            }
            var par = $(this).parent('.td_formatopiso');
            var tr = $(par).parent('.tr_content');
            $(tr).animate({opacity: 'hide'}, "slow");
        }
    };
    $("#pruebaedit").click(function() {
        alert("test");
    });
    $(".disable_form").click(function() {
        if (confirm("Esta seguro?")) {
            $.get($(this).attr('href'), function(data) {
                if (data == "0") {
                    alert("Formulario desactivado.");
                    location.reload();
                }
                else {
                    alert("Hubo problemas con la desactivacion.");
                }

            });
        }
        return false;
    });
    $('a[href][title]').qtip({
        content: {
            attr: 'title' // Use each elements title attribute
        },
        style: {
            classes: 'qtip-dark qtip-shadow qtip-youtube'
        }, // Give it some style
        position: {// Position my top left...
            my: 'center left', // Position my top left...
            at: 'center right' // at the bottom right of...
        }
    });
    $('#tab2 [alt]').qtip({
        show: {
            event: 'focus'
        },
        hide: {
            event: 'blur'
        },
        content: {
            attr: 'alt'
        },
        style: {
            width: '350px',
            classes: 'qtip-dark qtip-shadow qtip-tipsy'
        },
        position: {// Position my top left...
            my: 'center left', // Position my top left...
            at: 'center right' // at the bottom right of...
        }
    });
    $('#tab3 [alt]').qtip({
        show: {
            event: 'focus'
        },
        hide: {
            event: 'blur'
        },
        content: {
            attr: 'alt'
        },
        style: {
            width: '350px',
            classes: 'qtip-dark qtip-shadow qtip-tipsy'
        },
        position: {// Position my top left...
            my: 'center left', // Position my top left...
            at: 'center right' // at the bottom right of...
        }
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

    $("form#frmactualizaug").submit(function(event) {//validaciones formato UG045
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if ($('#razonsocial').val() == '') {
            alert('No ha ingresado Nombre/Razon social.');
            $('#razonsocial').focus();
            return false;
        }
        if ($('#numero').val() == '') {
            alert('No ha ingresado Numero de documento.');
            $('#numero').focus();
            return false;
        }
        if ($('#ocupacti').val() == '') {
            alert('No ha ingresado ocupacion');
            $('#ocupacti').focus();
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
            if (telefono.length < 7 || telefono.length == 8) {
                alert('Ingrese un numero telefonico valido');
                $('#telefono').focus();
                return false;
            }
        }
        if ($('#email').val() == '') {
            alert('No ha ingresado el email');
            $('#email').focus();
            return false;
        } else {
            var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
            if (document.getElementById("email").value.search(emailRegEx) == -1) {
                alert("Por favor ingrese un mail valido.");
                $('#email').focus();
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

        var datos = $("form#frmactualizaug").serialize();
        $.ajax({
            data: datos,
            type: 'POST',
            url: '../includes/controllerConfirmData.php',
            success: function(dato) {
//                $('#msg_adduser').html(dato);
//                $("#result_notif").css("display", "block");
                if (dato == "SI") {
                    $('#msg_adduser').html("Actualizado Correctamente.");
                    $("#result_notif").css("display", "block");
                } else {
                    $('#msg_adduser').html("Error Actualizando la información.");
                    $("#result_notif").css("display", "block");
                }
            }
        });
        return false;
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
    $("form#generarBaseMarcador").submit(function(event){
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($('form#generarBaseMarcador select#proceso_id').val() == ''){
            alert('Debe seleccionar un proceso.');
            $('form#generarBaseMarcador select#proceso_id').focus();
            return false;
        }
        if($('form#generarBaseMarcador select#tipo_marcacion').val() == ''){
            alert('Debe seleccionar un tipo de marcacion.');
            $('form#generarBaseMarcador select#tipo_marcacion').focus();
            return false;
        }
        if($('form#generarBaseMarcador #file_marcador').val() == ''){
            alert('Debe seleccionar un archivo a subir para la creacion de la nueva base.');
            $('form#generarBaseMarcador #file_marcador').focus();
            return false;
        }else{
            var p_part = $('form#generarBaseMarcador input#file_marcador').val().split('.');
            var tam_p = p_part.length;
            if(p_part[(tam_p - 1)] !== 'csv'){
                alert('Debe adjuntar un archivo con extension valida (csv), para generacion');
                $('form#generarBaseMarcador input#file_marcador').focus();
                return false;
            }
        }
        var forma = document.generarBaseMarcador;
        forma.submit();
    });
    $('form#reportDigitacionFATCA').submit(function(event){
        /* Act on the event */
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        if($('form#reportDigitacionFATCA input#fecha_inicio').val() == ''){
            alert('Debe seleccionar una fecha inicio.');
            $('form#reportDigitacionFATCA input#fecha_inicio').focus();
            return false;
        }
        if($('form#reportDigitacionFATCA input#fecha_fin').val() == ''){
            alert('Debe seleccionar una fecha fin.');
            $('form#reportDigitacionFATCA input#fecha_fin').focus();
            return false;
        }
        var formu = document.reportDigitacionFATCA;
        formu.submit();
    });

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
    radioSelected.checked = false;
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
    const tam = tamVentana();
    const widtam = (60 * tam[0]) / 100;
    const parts = filename.split('.');
    let strHTML = '';
    if (estado == '2') {
        let numstr = '0' + consecutivo;
        if (consecutivo.length > 1) numstr = consecutivo;

        if (parts[parts.length - 1] == 'tiff'){
            strHTML = `<object id="tiffobj0" width=620 height=650 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
                <param name="src" value="/Colpatria/virtuales_doc/virtuales_aceptados/${sucursal}/LOTE_${id_radicado}_${numstr}.tiff">
                <embed width=620 height=650 src="/Colpatria/virtuales_doc/virtuales_aceptados/${sucursal}$/LOTE_${id_radicado}_${numstr}.tiff" type="image/tiff">
            </object>`;
        } else if (parts[parts.length - 1] == 'pdf') {
            strHTML = `<div id="muestra-pdf"></div>
            <script>
                var opt = {
                    width: "${widtam}px",
                    height: "650px",
                    pdfOpenParams: {
                        view: "FitH"
                    }
                };
                const file = "/Colpatria/virtuales_doc/virtuales_aceptados/${sucursal}/${filename}";
                PDFObject.embed(file, "#muestra-pdf", opt);
            </script>`;
        }
    } else {
        if (parts[parts.length - 1] == 'tiff') {
            strHTML = `<object id="tiffobj0" width=620 height=650 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
                <param name="src" value="/Colpatria/virtuales_doc/virtuales/${sucursal}/${documento}/${filename}">
                <embed width=620 height=650 src="/Colpatria/virtuales_doc/virtuales/${sucursal}/${documento}/${filename}" type="image/tiff">
            </object>`;
        } else if (parts[parts.length - 1] == 'pdf') {
            strHTML = `<div id="muestra-pdf"></div>
            <script>
                var opt = {
                    width: "${widtam}px",
                    height: "650px",
                    pdfOpenParams: {
                        view: "FitH"
                    }
                };
                var file = "/Colpatria/virtuales_doc/virtuales/${sucursal}/${documento}/${filename}";
                PDFObject.embed(file, "#muestra-pdf", opt);
            </script>`;
        }
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
$.fn.mostrarManual = function(e){
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    var strHTML = '<div id="object_pdf"></div>'+
    '<script>'+
    'var options = {'+
        'width: "550px",'+
        'height: "500px"'+
    '};'+
    'var file = "/Colpatria/procesos/radicado/UD-M-003_MANUAL_USUARIO_MODULO_RADICACION_COLPATRIA_V3.pdf";'+
    'PDFObject.embed(file, "#object_pdf", options);'+
    '</script>';
    $('#box-manual-radicacion').html(strHTML);
    jQuery.facebox({
        div: '#box-manual-radicacion'
    });
}
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