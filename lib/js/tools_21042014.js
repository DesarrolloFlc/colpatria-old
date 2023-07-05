var radioSelected;
function pantallaCompleta(pagina) { 
    window.open(pagina, 'windowname1', 'fulscreen=yes');
}
        
$(document).ready(function() {
  //$.facebox.settings.opacity = 0.7
    jQuery.fn.reset = function () {
        $(this).each (function() {
            this.reset();
        });
    }
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
    
    $("#enviar").click( function() {
        $("#enviar").attr("disabled", "disabled");
        /*if( $("#num_images").val() >  0) {
            alert("No puede indexar más imágenes .. termine las que tiene en cola.");
            $("#enviar").removeAttr("disabled");
            return false;
        }*/              
        $('#msg_indexacion').html('<img src="../../images/icons/preload.gif"/>');
        $.post('loadImages.php', function( data) {
            $('#msg_indexacion').html(data);        
            $("#result_indexacion").css("display", "block");            
        });
    });    
    
    /** BUSQUEDA DE CLIENTES ***/
    $("#form_clientsearch").submit( function() {
        $("#box_search_result").css('display','none');
        $("#result_search").css('display','none');
        $("#tab_resultsearch").html("");
        if( $("#criterio1").val() == "" ) {
            alert("Por favor valide el criterio de búsqueda.");
            $("#criterio1").focus();
            return false;
        } else if($("#criterio2").val() == "" ) {
            alert("Por favor valide el segundo criterio de búsqueda.");
            $("#criterio2").focus();
            return false;            
        } else if($("#texto").val() == "" ) {
            alert("Por favor valide el segundo criterio de búsqueda.");
            $("#criterio2").focus();
            return false;            
        } else {            
         $.post('searchClient.php', $("#form_clientsearch").serialize(), function(data) {
             if( data== "-1") {
                 $('#msg_result_search').html("No se encontraron coincidencias para la información dada.");                                     
                 $("#result_search").css('display','block');
             } else {
                $("#tab_resultsearch").html(data);
             }
             $("#box_search_result").css('display','block');
         })
        }
        return false;
    });
    /*
    * AREA CREADA PARA EL MANEJO
    * DEL NUEVO MODULO
    * SUPERMERCADO
    *
    **/
    $("#form_clientsearch_sup").submit( function() {
        $("#box_search_result").css('display','none');
        $("#result_search").css('display','none');
        $("#tab_resultsearch").html("");
        if( $("#criterio1").val() == "" ) {
            alert("Por favor valide el criterio de búsqueda.");
            $("#criterio1").focus();
            return false;
        } else if($("#criterio2").val() == "" ) {
            alert("Por favor valide el segundo criterio de búsqueda.");
            $("#criterio2").focus();
            return false;            
        } else if($("#texto").val() == "" ) {
            alert("Por favor valide el segundo criterio de búsqueda.");
            $("#criterio2").focus();
            return false;            
        } else {
         $.post('searchClient.php', $("#form_clientsearch_sup").serialize(), function(data) {
             if( data== "-1") {
                 $('#msg_result_search').html("No se encontraron coincidencias para la información dada.");
                 $("#result_search").css('display','block');
             } else {
                $("#tab_resultsearch").html(data);
             }
             $("#box_search_result").css('display','block');
         })
        }
        return false;
    });
    $("#consolidadoClientesSup").submit(function(){
      (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
      if($('form#consolidadoClientesSup input#fecha_inicio').val() == ''){
        alert('Por favor seleccion una fecha inicial');
        $('form#consolidadoClientesSup input#fecha_inicio').focus();
        return false;
      }
      if($('form#consolidadoClientesSup input#fecha_fin').val() == ''){
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
$("#reporteLotesPlanillas").submit( function(event) {
  (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
  if($('form#reporteLotesPlanillas input#fecha_inicio').val() == ''){
    $('#boxError').html('Por favor seleccione una fecha para la generacion de la planilla.');
    $.facebox({ div: '#boxError' });
    $('form#reporteLotesPlanillas input#fecha_inicio').focus();
    return false;
  }
  $('#imgdownpdf').html('<a href="generarReporteXLS.php?'+datos+'&consR=download"><img id="imgloading" src="../../images/icons/pdf_download_8.gif" />');
            $('#imgdownpdf').qtip({
              content: {
                  text:'Por medio de este icono, descargue una copia del reporte con la informacion consultada'
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
              position: {  // Position my top left...
                my: 'bottom right',  // Position my top left...
                at: 'left top' // at the bottom right of...
              }
            });
  var conf = true;
  if(conf){
    var datos = $("#reporteLotesPlanillas").serialize();
    $.ajax({
      beforeSend: function(){
      },
      data: datos,
      type: 'POST',
      url: '../includes/controllerRadicado.php',
      dataType: 'json',
      success: function(dato){
          //alert(dato);                      
      }
    });
  }
});
$('#radicadosyClientesxSucursal').submit(function(event){
  (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
  if($('form#radicadosyClientesxSucursal input#fecha_inicio').val() == ''){
    alert('Por favor seleccione una fecha inicial.');
    $('form#radicadosyClientesxSucursal input#fecha_inicio').focus();
    return false;
  }
  if($('form#radicadosyClientesxSucursal input#fecha_fin').val() == ''){
    alert('Por favor seleccione una fecha final.');
    $('form#radicadosyClientesxSucursal input#fecha_fin').focus();
    return false;
  }
  if($('form#radicadosyClientesxSucursal select#sucursales').val() == ''){
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
        beforeSend: function(){
          $('#botoncrearRadicado').attr('disabled','disabled');
          $('#imgloading').show();
        },
        data: datos,
        type: 'POST',
        url: '../includes/controllerRadicado.php',
        dataType: 'json',
        success: function(dato){
          //alert(JSON.stringify(dato));
          if(dato.exito){
            var strHTML = '<tr>'+
                '<td width="6%"># de radicado</td>'+
                '<td width="18%">Sucursal</td>'+
                '<td width="16%">Oficial</td>'+
                '<td width="10%"># Documento</td>'+
                '<td width="22%">Nombre y/o Raz&oacute;n Social del cliente</td>'+
                '<td width="14%">Fecha de radicacion</td>'+
                '<td width="6%">Fecha de envio</td>'+
                '<td width="6%" align="center" valign="middle">Estado</td>'+
              '</tr>';
            var tam = dato.items.length;
            for (var i = 0; i < tam; i++) {
              strHTML += '<tr>'+
                '<td>'+dato.items[i].id_radicados+'</td>'+
                '<td>'+dato.items[i].sucursal+'</td>'+
                '<td>'+dato.items[i].oficial+'</td>'+
                '<td>'+dato.items[i].documento+'</td>'+
                '<td>'+dato.items[i].descripcion+'</td>'+
                '<td>'+dato.items[i].fecha_creacion+'</td>'+
                '<td>'+dato.items[i].fecha_envio+'</td>'+
                '<td align="center" valign="middle">'+$.fn.getEstados(dato.items[i].estado)+'</td>'+
                '</tr>';
            };
            $('#listadeRadicados').html(strHTML);
            $('#imgdownpdf').html('<a href="generarReporteXLS.php?'+datos+'&consR=download&type=sucur"><img id="imgloading" src="../../images/icons/xlsx_icon.png" />');
            $('#imgdownpdf').qtip({
              content: {
                  text:'Por medio de este icono, descargue una copia del reporte con la informacion consultada'
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
              position: {  // Position my top left...
                my: 'bottom right',  // Position my top left...
                at: 'left top' // at the bottom right of...
              }
            });
          }else{
            $('#msg_notieneradicados').html('Usted no tiene radicados en el rango de fechas especificado.');            
            $("#result_notif_busradicofi").slideDown('medium');
          }
        }
      });
})
$('#radicadosyClientesxOfficial').submit(function(event){
  (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
  if($('form#radicadosyClientesxOfficial input#fecha_inicio').val() == ''){
    alert('Por favor seleccione una fecha inicial.');
    $('form#radicadosyClientesxOfficial input#fecha_inicio').focus();
    return false;
  }
  if($('form#radicadosyClientesxOfficial input#fecha_fin').val() == ''){
    alert('Por favor seleccione una fecha final.');
    $('form#radicadosyClientesxOfficial input#fecha_fin').focus();
    return false;
  }
  if($('form#radicadosyClientesxOfficial select#oficiales').val() == ''){
    alert('Por favor seleccione una sucursal.');
    $('form#radicadosyClientesxOfficial select#oficiales').focus();
    return false;
  }
  var datos = $('form#radicadosyClientesxOfficial').serialize();
  //alert(datos);
  //return false;
  $.ajax({
        beforeSend: function(){
          $('#botoncrearRadicado').attr('disabled','disabled');
          $('#imgloading').show();
        },
        data: datos,
        type: 'POST',
        url: '../includes/controllerRadicado.php',
        dataType: 'json',
        success: function(dato){
          /*alert(dato);
          $('#prueba').html(dato);*/
          if(dato.exito){
            var strHTML = '<tr>'+
                '<td width="6%"># de radicado</td>'+
                '<td width="18%">Sucursal</td>'+
                '<td width="20%">Oficial</td>'+
                '<td width="16%">Documento de identificaci&oacute;n</td>'+
                '<td width="22%">Nombre y/o Raz&oacute;n Social del cliente</td>'+
                '<td width="10%">Fecha de radicacion</td>'+
                '<td width="6%" align="center" valign="middle">Estado</td>'+
              '</tr>';
            var tam = dato.items.length;
            for (var i = 0; i < tam; i++) {
              strHTML += '<tr>'+
                '<td>'+dato.items[i].id_radicados+'</td>'+
                '<td>'+dato.items[i].sucursal+'</td>'+
                '<td>'+dato.items[i].oficial+'</td>'+
                '<td>'+dato.items[i].documento+'</td>'+
                '<td>'+dato.items[i].descripcion+'</td>'+
                '<td>'+dato.items[i].fecha_creacion+'</td>'+
                '<td align="center" valign="middle">'+$.fn.getEstados(dato.items[i].estado)+'</td>'+
                '</tr>';
            };
            $('#listadeRadicados_2').html(strHTML);
            $('#imgdownpdf_2').html('<a href="generarReporteXLS.php?'+datos+'&consR=download&type=ofic"><img id="imgloading" src="../../images/icons/xlsx_icon.png" />');
            $('#imgdownpdf_2').qtip({
              content: {
                  text:'Por medio de este icono, descargue una copia del reporte con la informacion consultada'
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
              position: {  // Position my top left...
                my: 'bottom right',  // Position my top left...
                at: 'left top' // at the bottom right of...
              }
            });
          }else{
            $('#msg_notieneradicados').html('Usted no tiene radicados en el rango de fechas especificado.');            
            $("#result_notif_busradicofi").slideDown('medium');
          }
        }
      });
})
$('#form_caseadd').submit(function(event){
  (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
  if($('form#form_caseadd input#documento').val() == ''){
    alert('Por favor el documento del cliente.');
    $('form#form_caseadd input#documento').focus();
    return false;
  }
  if($('form#form_caseadd select#persontype').val() == ''){
    alert('Por favor seleccione el tipo de persona.');
    $('form#form_caseadd select#persontype').focus();
    return false;
  }
  if($('form#form_caseadd input#nombre').val() == ''){
    alert('Por favor digite el nombre.');
    $('form#form_caseadd input#nombre').focus();
    return false;
  }
  if($('form#form_caseadd input#lote').val() == ''){
    alert('Por favor digite el numero de lote.');
    $('form#form_caseadd input#lote').focus();
    return false;
  }
  if($('form#form_caseadd select#area').val() == ''){
    alert('Por favor seleccione area.');
    $('form#form_caseadd select#area').focus();
    return false;
  }
  if($('form#form_caseadd select#sucursal').val() == ''){
    alert('Por favor seleccione una sucursal.');
    $('form#form_caseadd select#sucursal').focus();
    return false;
  }
  if($('form#form_caseadd select#causaldevolucion').val() == ''){
    alert('Por favor seleccione una causal de devolucion.');
    $('form#form_caseadd select#causaldevolucion').focus();
    return false;
  }
  if($('form#form_caseadd select#official').val() == ''){
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
	$("#editardocumento").click( function() {
		var valor = $("#identificacionid").html();
		var id_client = $("#id_client1").val();
		$("#identificacionid").html("<form method='post' name='formeditardocumento' id='formeditardocumento'><input type='hidden' name='action' value='editardocumento' /><input type='hidden' name='id_client' value='"+id_client+"' /><input type='text' name='nuevodocumento' id='nuevodocumento' value='"+valor+"' /><input name='btn_editardocumento' id='btn_editardocumento' type='submit' value='Guardar >>' class='button'/></form>");
		$("#editardocumento").html("");
	});
    
	$("#btn_editardocumento").live("click", function() {
		$.post('../lib/general/procesos.php', $("#formeditardocumento").serialize(), function(data) {
			alert(data);
			if( data == "Actualizacion exitosa.") {
				$("#identificacionid").html("<span id='identificacionid' style='border:0;padding:0;margin:0'>"+$("#nuevodocumento").val()+"</span>");
			}
		});
		return false;
	});
  $("#editardocumentoSup").click( function() {
    var valor = $("#identificacionid").html();
    var id_client = $("#id_client1").val();
    $("#identificacionid").html("<form method='post' name='formeditardocumentoSup' id='formeditardocumentoSup'><input type='hidden' name='action' value='editardocumento' /><input type='hidden' name='id_client' value='"+id_client+"' /><input type='text' name='nuevodocumento' id='nuevodocumento' value='"+valor+"' /><input name='btn_editardocumentoSup' id='btn_editardocumentoSup' type='submit' value='Guardar >>' class='button'/></form>");
    $("#editardocumento").html("");
  });
  $("#btn_editardocumentoSup").live("click", function() {
    $.post('../includes/controllerSupermercado.php', $("#formeditardocumentoSup").serialize(), function(data) {
      alert(data);
      if( data == "Actualizacion exitosa.") {
        $("#identificacionid").html("<span id='identificacionid' style='border:0;padding:0;margin:0'>"+$("#nuevodocumento").val()+"</span>");
      }
    });
    return false;
  });

    /* VALIDACION DE FORMULARIO PARA AGREGAR UN USUARIO */
    $("#form_useradd").submit( function() {
        if( $("#id_group").val() == "" ) {
            alert("Por favor valide el campo de perfil de usuario.");
            $("#id_group").focus();
            return false;
        } else if( $("#username").val() == "" ) {
            alert("Por favor valide el campo de nombre de usuario.");
            $("#username").focus();
            return false;
        } else if( $("#password").val() == "" ) {
            alert("Por favor valide el campo de contraseña del usuario.");
            $("#password").focus();
            return false;
        } else if( $("#name").val() == "" ) {
            alert("Por favor valide el campo de nombre del usuario.");
            $("#name").focus();
            return false;
        } else if( $("#identificacion").val() == "" ) {
            alert("Por favor valide el campo de identificación del usuario.");
            $("#identificación").focus();
            return false;
        } else {
            $.post('../../lib/general/procesos.php',$("#form_useradd").serialize(), function( data) {
                if( data == "-1" ) {
                    $('#msg_adduser').html("El usuario no se pudo crear, valide los campos.");
                } else if(data == "0") {
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
    $("#search_user").submit( function() {
        
        if( $("#criterio").val() == "" || $("#texto").val() == "") {
            alert("Por favor complete todos los campos de búsqueda.");           
            return false;    
        }        
        $.post('../../procesos/admin/searchUser.php', $("#search_user").serialize(), function( data ) {
            if( data == "-1") {
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

jQuery.fn.fortalezaClave = function(){
   $(this).each(function(){
      elem = $(this);
      //creo el elemento HTML para el mensaje
      msg = $('<span class="fortaleza">No segura</span>');
      //inserto el mensaje en la p�gina, justo despu�s del campo input password
      elem.after(msg)
      //almaceno la referencia del elemento del mensaje dentro del campo input
      elem.data("mensaje", msg);
      
      elem.keyup(function(e){
         elem = $(this);
         //recupero la referencia al elemento del mensaje 
         msg = elem.data("mensaje")
         //miro la fortaleza
         //extraigo el atributo value del campo input password
         claveActual = elem.attr("value");
         var fortalezaActual = "";
         //saco la fortaleza en funci�n de los caracteres que tenga la clave
         if (claveActual.length < 5){
            fortalezaActual = "No segura";
         }else{
            if(claveActual.length < 8){
               fortalezaActual = "Medianamente segura";
            }else{
               fortalezaActual = "Segura";
            }
         }
         //cambio el texto del elemento mensaje para mostrar la fortaleza actual
         msg.html(fortalezaActual);
      });
   });
   return this;
}
  $("#pass2").fortalezaClave();
                $("#form_changepass").submit( function(){
                    if( $("#pass2").val() != $("#pass3").val() ) {
                        alert("Por favor valide la nueva contraseña, los campos no coinciden.");
                        return false;
                    } else {
                        $("#form_changepass").submit();
                    }
                    return false;
                });


   $("#form_user_indexacion").submit( function() {
        $.post('../../procesos/internal/showIndexacionUser.php', $("#form_user_indexacion").serialize(), function(data){
            $("#user_images").html(data);
            
        });
        return false;
    });


	/** REPORTES **/
	$("#reportPlanillas_planilla").change( function(){
		if( $("#reportPlanillas_planilla").val() != "" ) {
			$.post('libraryFunctions.php', { planilla: $("#reportPlanillas_planilla").val(), reporte: 'reportPlanillas.php'}, function(data) {
				$('#reportPlanillas_lote').html(data);
				$('#reportPlanillas_lote').removeAttr('disabled');
			});
		}
	});

    $("#reportPlanillas_sucursal").change( function(){
        if( $("#reportPlanillas_sucursal").val() != "" ) {
            $('#reportPlanillasSuc_planilla').html("<option>Seleccione una planilla...</option>");
            //alert($("#reportPlanillas_sucursal").val());
            $.post('libraryFunctions.php', { planilla: $("#reportPlanillas_sucursal").val(), reporte: 'reportPlanillas.php', accion: 'sucursales', fec_ini: $("#fecha_inicio").val(), fec_fin: $("#fecha_fin").val()}, function(data) {
                //alert(data);
                $('#reportPlanillasSuc_planilla').html(data);
                $('#reportPlanillasSuc_planilla').removeAttr('disabled');
            });
        }
    });

    $("#reportPlanillasSuc_planilla").change( function(){
        if( $("#reportPlanillasSuc_planilla").val() != "" ) {
            var planilla_s = $("#reportPlanillasSuc_planilla").val();
            var sucursal_s = $("#reportPlanillas_sucursal").val();
            var fecha_inicio = $("#fecha_inicio").val();
            var fecha_fin = $("#fecha_fin").val();
            $.post('libraryFunctions.php', { planilla: planilla_s, reporte: 'reportPlanillas.php', sucursal: sucursal_s, fec_ini: fecha_inicio, fec_fin: fecha_fin, accion: 'lotesSuc'}, function(data) {
                //alert(data);
                $('#reportPlanillasSuc_lote').html(data);
                $('#reportPlanillasSuc_lote').removeAttr('disabled');
            });
        }
    });

	$("#reportPlanillas_form").submit( function() {
        //alert('aca');
		$.post('libraryFunctions.php', $("#reportPlanillas_form").serialize(), function(data) {
			$("#clientlist_div").html(data);
		});

		return false;
	});

    $("#reportPlanillasSuc_form").submit( function() {
        //alert('aca');
        //alert($("#reportPlanillasSuc_form").serialize());
        $.post('libraryFunctions.php', $("#reportPlanillasSuc_form").serialize(), function(data) {
            //alert(data);
            $("#clientlist_div").html(data);
        });

        return false;
    });

	/** FIN REPORTES **/

	$("#user_edit").submit( function(){
		if( $("#pass1").val() == $("#pass2").val() ) {
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
	$("#confirmClient").submit( function() {
		if( $("#contact").val() == "" ) {
			alert("El campo de contacto no puede estar vacio.");
			$("#contact").css('background','red');
			return false;
		} 

		if( $("#correoelectronico").val() != "" ) {
			var status = false;     
			var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
			if (document.getElementById("correoelectronico").value.search(emailRegEx) == -1) {
				alert("Por favor ingrese un mail valido.");
				$("#correoelectronico").css('background-color','red');
				return false;
			}
		  }
		 if( $("#contact").val() == "1" || $("#contact").val() == "2" || $("#contact").val() == "3" || $("#contact").val() == "4" || $("#contact").val() == "6" || $("#contact").val() == "7") {			
			if( $("#grabacion").val() == "" ) {
				alert("Por favor cargue la llamada de la gestion.");
				$("#grabacion").css('background','red');
				return false;
			}	
		 }
		$('#btnguardaractu').attr('disabled', 'disabled');	
	});	

       /** INDEXACION DE USUARIO **/
	$("#showIndexacion").submit( function() {
		$.post('showIndexacionUser.php', $("#showIndexacion").serialize(), function( data ) {
			$("#user_images").html(data);
		});
		return false;
	});	

    /** BUSQUEDA DE ORDENES DE PRODUCCION ***/
    $("#form_ordensearch").submit( function() {               
         $.post('../../lib/general/procesos.php', $("#form_ordensearch").serialize(), function(data) {             
                $("#tab_resultsearch").html(data);  
                $("#box_search_result").css('display','block');
         })        
        return false;
    });


	$("#confirmClientCapi").submit( function() {
		if( $("#id_contact").val() == "" ) {
			alert("El campo de contacto no puede estar vacio.");
			$("#id_contact").css('background','red');
			return false;
		} 

		if( $("#correoelectronico").val() != "" ) {
			var status = false;     
			var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
			if (document.getElementById("correoelectronico").value.search(emailRegEx) == -1) {
				alert("Por favor ingrese un mail valido.");
				$("#correoelectronico").css('background-color','red');
				return false;
			}
		  }
	 if( $("#id_contact").val() == "1" || $("#id_contact").val() == "2" || $("#id_contact").val() == "3" || $("#id_contact").val() == "4" || $("#id_contact").val() == "6" || $("#id_contact").val() == "7") {			
			if( $("#grabacion").val() == "" ) {
				alert("Por favor cargue la llamada de la gestion.");
				$("#grabacion").css('background','red');
				return false;
			}	
		 }

	});


	$(".desactivaruser").click( function() {
		$.post($(this).attr('href'), function(data) {             
               if( data == "1") {
			alert("Usuario desactivado con exito.");
			location.reload();
		}
   		else 
			alert("Ocurrio un problema, por favor contacte al administrador.");

         })        
        	return false;
	});

	$(".number").click( function() {
		$.get($(this).attr('href'), function(data) {
			$("#ordenes_show").html(data);
		});		
		return false;
	});
  $("#creaciondeRadicado").submit( function(event) {
    (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
    if($('#id_sucursal').val() == ''){
      alert('Por favor seleccione una sucursal');
      $('#id_sucursal').focus();
      return false;
    }
    if($('#id_sucursal option:selected').text().search('CORREDORES') >= 0 && $('#utc').val() == ''){
      alert('Por favor digite el codigo de corredor');
      $('#utc').focus();
      return false;
    }
    /*if($('#fecha_envio').val() == ''){
      alert('Por favor seleccione la fecha de envio');
      $('#fecha_envio').focus();
      return false;
    }
    if($('#funcionario').val() == ''){
      alert('Por favor digite el nombre del funcionario que crea la orden');
      $('#funcionario').focus();
      return false;
    }*/
    if($('#telefono').val() == ''){
      alert('Por favor digite un numero de telefono');
      $('#telefono').focus();
      return false;
    }
    if($('#clientes').val() == ''){
      alert('No ha agregado clientes para esta orden por favor agregue su listado');
      return false;
    }
    var conf = confirm('Esta seguro que la informaci\xF3n que radic\xF3 y va a enviar de todos los clientes esta completa, debidamente diligenciada y tiene todos los documentos adicionales para cumplir con los p\xE1rametros exigidos por SARLAFT, y que son su responsabilidad, y por lo tanto estos clientes no tendr\xE1n ninguna causal de devoluci\xF3n?');
    if(conf){
      var datos = $("#creaciondeRadicado").serialize();
      $.ajax({
        beforeSend: function(){
          $('#botoncrearRadicado').attr('disabled','disabled');
          $('#imgloading').show();
        },
        data: datos,
        type: 'POST',
        url: '../includes/controllerRadicado.php',
        dataType: 'json',
        success: function(dato){
          $('#imgloading').hide();
          $('#botoncrearRadicado').removeAttr('disabled');
          //alert(dato);
          if(dato.exito){
            //alert(dato.radicado['id'])
            var id = dato.radicado['id'];
            //alert("esta es la id: "+id);
            $('#msg_adduser').html(dato.exito);//msg_erradduser
            $("#result_notif").slideDown('medium');
            $("#creaciondeRadicado").reset();
            var strtable = '<tr><td>Nombre Cliente</td><td>Documento</td><td width="16" align="center" valign="middle">Borrar</td></tr>';
            $('#listaclientes').html(strtable);
            $('#clientes').val('');
            window.location.href = "generarReportePDF.php?idradicado="+id;
          }else{
            $('#msg_erradduser').html(dato.errorr);
          }
          /*if(dato == 'ok'){
            alert('sesion iniciada correctamente');
          }else{
            alert('erros');
          }*/
        }
      });
    }
  });
  $("#busquedadeRadicado").submit( function(event) {
    (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
    if($('#id').val() == ''){
      alert('Por favor digite el numero de radicadooooo');
      $('#id').focus();
      return false;
    }
    //alert('aca');
    var conf = true;
    if(conf){
      var datos = $("#busquedadeRadicado").serialize();
      //alert(datos);
      $.ajax({
        beforeSend: function(){
        },
        data: datos,
        type: 'POST',
        url: '../includes/controllerRadicado.php',
        dataType: 'json',
        success: function(dato){
            //alert(dato);
            if(dato.exito){
              var estado = 'Recibido';
              if(dato.radicado['estado'] == '0')
                estado = 'Radicado';
              estado = $.fn.getEstados(dato.radicado['estado']);
              var strHTML = '<td>'+dato.radicado['id']+'</td>'+
                            '<td>'+dato.sucursal+'</td>'+
                            '<td>'+dato.funcionario+'</td>'+
                            '<td>'+dato.radicado['fecha_creacion']+'</td>'+
                            '<td>'+estado+'</td>'+
                            '<td><a href="generarReportePDF.php?idradicado='+dato.radicado['id']+'&downpdf=download"><img src="../../resources/images/icons/pdf_icon.gif" title="Descargar PDF" alt="Descargar PDF" /></a></td>';
              strItems = '<tr>'+
                '<td width="20%">Documento</td>'+
                '<td>Nombre</td>'+
                '<td width="10%">Estado</td>'+
                '</tr>';
              if(dato.items){                
                var lengtitems = dato.items.length;
                for (var i = 0; i < lengtitems; i++) {
                  //alert(JSON.stringify(dato.items[i]))
                  strItems += '<tr>'+
                  '<td width="20%">'+dato.items[i].documento+'</td>'+
                  '<td>'+dato.items[i].descripcion+'</td>';
                  if(dato.radicado['estado'] == '2'){
                    strItems += '<td width="10%">'+$.fn.getEstados(dato.items[i].estado)+'</td>';
                  }else{
                    strItems += '<td width="10%">Radicado</td>';
                  }
                  strItems += '</tr>';
                }
              }
              $('#radicadoBuscado').html(strHTML);
              $('#listadoClientes').html(strItems);
              //window.open("generarReportePDF.php?idradicado="+id, '_blanck');
            }else{
              $('#msg_warningradicado').html(dato.errorr);
              $('#result_notifwr').slideDown('medium');
            }
        }
      });
    }
  });//formprueba
$("#aprobarClientes").submit( function(event) {
  (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
  if($('form#aprobarClientes input#fecha_envio').val() == ''){
    alert('Por favor seleccione la fecha de envio de Copatria');
    $('form#aprobarClientes input#fecha_envio').focus();
    return false;
  }
  if(!$('#cliente').is(":checked")){
    if(!confirm('Seguro que no quiere checkear ningun cliente?'))
      return false;
  }
  /**/
  var datos = $("#aprobarClientes").serialize();
  //alert(datos);//return false;
  $.ajax({
    beforeSend: function(){
    },
    data: datos,
    type: 'POST',
    url: '../includes/controllerRadicado.php',
    dataType: 'json',
    success: function(dato){
      //alert(dato);return false;
      $('#aprobareRadicado').submit();
      if(dato.errorr){
        $('#msg_warningradicado').html(dato.errorr);
        $('#result_notifwr').slideDown('medium');
      }else{
        $('#msg_addradicado').html(dato.exito);
        $('#result_notifok').slideDown('medium');
      }
      //alert(dato);
      //$('#aprobareRadicadoButton').click(event);
    }
  });
});
$("#aprobareRadicado").submit( function(event) {//radicadosyClientesxoficial
    (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
    if($('form#aprobareRadicado input#id').val() == ''){
      alert('Por favor digite el numero de radicado');
      $('form#aprobareRadicado input#id').focus();
      return false;
    }
    var conf = true;
    if(conf){
      $('#acordeonClientes').slideUp('medium');
      var datos = $("#aprobareRadicado").serialize();
      $.ajax({
        beforeSend: function(){
          $("#id_radicado").remove();
          //$('#div_fechaenvio').hide();
          $("#tableLote").remove();
          $('#div_fechaenvio').remove();
          //$('#table_fechaenvio').remove();
          //$("#buttonAprobar").remove();
          $('#result_notifwr').slideUp('medium');
        },
        data: datos,
        type: 'POST',
        url: '../includes/controllerRadicado.php',
        dataType: 'json',
        success: function(dato){
            //alert(dato);
            if(dato.exito){
              var estado = 'Radicado';
              var strLote = '';
              var strLote = '<div id="div_fechaenvio">'+
                            '<table id="table_fechaenvio">'+
                              '<tr>'+
                                '<td width="60">Fecha Envio:</td>'+
                                '<td><input type="text" name="fecha_envio" id="fecha_envio" class="one" readonly>(YYYY-MM-DD)</td>'+
                              '</tr>'+
                            '</table>'+
                            '<br><input type="submit" id="buttonAprobar" class="button" value="Aprobar clientes del radicado">'+
                            '<input type="hidden" id="fecha_creacionR" name="fecha_creacionR" value="'+dato.radicado['fecha_creacion']+'">'+
                            '<input type="hidden" id="tipo_radicadoR" name="tipo_radicadoR" value="'+dato.radicado['tipo']+'">'+
                            '</div>';
                            /*'<table id="table_fechaenvio"><tr><td width="60">Fecha Envio:</td><td><input type="text" name="fecha_envio" id="fecha_envio" class="one">(YYYY-MM-DD)</td></tr></table>'+
                            '<br><input type="submit" id="buttonAprobar" class="button" value="Aprobar clientes del radicado">';*/
              if(dato.radicado['estado'] == '2' || dato.radicado['estado'] == '4'){
                estado = 'Recibido';
                strLote = '';                
              }
              var strHTML = '<td>'+dato.radicado['id']+'</td>'+
                            '<td>'+dato.sucursal+'</td>'+
                            '<td>'+dato.funcionario+'</td>'+
                            '<td>'+dato.radicado['fecha_creacion']+'</td>'+
                            '<td>'+$.fn.getEstados(dato.radicado['estado'])+'</td>'+
                            '<td><a href="generarReportePDF.php?idradicado='+dato.radicado['id']+'&downpdf=download"><img src="../../resources/images/icons/pdf_icon.gif" title="Descargar PDF" alt="Descargar PDF" /></a></td>';
              strItems = '<tr>'+
                '<td width="20%">Documento</td>'+
                '<td width="68%">Nombre</td>';
                if(dato.radicado['estado'] == '2' || dato.radicado['estado'] == '4'){
                  strItems += '<td width="2%">Estado</td>';
                }else{
                  strItems += '<td width="2%">Aprobar</td>'+
                  '<td width="2%">Devolver</td>'+
                  '<td width="10%">No enviado</td>';
                }
                strItems += '</tr>';
              if(dato.items){
                var suc = dato.sucursal.replace(/\ /g,'_');
                var lengtitems = dato.items.length;
                for (var i = 0; i < lengtitems; i++) {
                  //alert(JSON.stringify(dato.items[i]))
                  var filename = suc+"_"+dato.items[i].documento+"_MULTI.tiff";
                  //alert(filename);
                  strItems += '<tr id="trcl_'+i+'">'+
                  '<td width="20%">'+
                    '<a href="#" onclick="$.fn.mostrarCliente(event, \''+dato.items[i].documento+'\', \''+filename+'\', \''+suc+'\', \''+dato.radicado['estado']+'\', \''+dato.radicado['id']+'\', \''+(i+1)+'\');">'+dato.items[i].documento+'</a>'+
                    /*'<a href="#" onClick="window.open(\'showTiffClient.php?doc='+dato.items[i].documento+'&suc='+suc+'&est='+dato.radicado['estado']+'&r_id='+dato.radicado['id']+'&num='+(i+1)+'\', \'windowname1\', \'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=630, height=670, top=85, left=140\');return false;" target="_blank">'+dato.items[i].documento+'</a>'+*/
                  '</td>'+
                  '<td>'+dato.items[i].descripcion+'</td>';
                  if(dato.radicado['estado'] == '2' || dato.radicado['estado'] == '4'){
                      strItems += '<td width="10%">'+$.fn.getEstados(dato.items[i].estado)+'</td>';
                  }else{
                      strItems += '<td width="2%">'+
                                    '<input type="radio" name="cliente['+i+']" id="cliente" value="'+dato.items[i].id+'|2" onchange="$.fn.devolverItem(event,this,'+i+');">'+
                                  '</td>'+
                                  '<td width="2%">'+
                                    '<input type="radio" name="cliente['+i+']" id="cliente" value="'+dato.items[i].id+'|3" onchange="$.fn.devolverItem(event,this,'+i+');">'+
                                  '</td>'+
                                  '<td width="10%">'+
                                    '<input type="radio" name="cliente['+i+']" id="cliente" value="'+dato.items[i].id+'|1" onchange="$.fn.devolverItem(event,this,'+i+');">'+
                                  '</td>';
                      //$('#div_fechaenvio').show();
                  }
                  strItems += '</tr>';
                }
              }
              $('#radicadoBuscado').html(strHTML);
              $('#listadoClientes').html(strItems);
              $('#aprobarClientes').append('<input type="hidden" id="id_radicado" name="id_radicado" value="'+dato.radicado['id']+'">');
              $('#aprobarClientes').append(strLote);
              $('#acordeonClientes').slideDown('medium');
              $('input#fecha_envio').simpleDatepicker();
              //window.open("generarReportePDF.php?idradicado="+id, '_blanck');

              $('form#devolverRadicadoForm input#id_sucursal').val(dato.radicado['id_sucursal']);
              $('form#devolverRadicadoForm input#id_official').val(dato.radicado['id_usuarioenvia']);
              $('form#devolverRadicadoForm input#radicado_id').val(dato.radicado['id']);
            }else{
              $('#msg_warningradicado').html(dato.errorr);
              $('#result_notifwr').slideDown('medium');
            }
        }
      });
    }
  });
  $.fn.agregarCliente = function(e){
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    if($('#id_sucursal').val() == ''){
      alert('Por favor seleccione una sucursal');
      $('#id_sucursal').focus();
      return false;
    }
    if($('#nombre_cli').val() == ''){
      alert('Por favor digite el nombre del cliente si piensa agregar uno nuevo');
      $('#nombre_cli').focus();
      return false;
    }
    if($('#documento_cli').val() == ''){
      alert('Por favor digite el documento del cliente si piensa agregar uno nuevo');
      $('#documento_cli').focus();
      return false;
    }
    if (confirm('Esta seguro que la informaci\xF3n que radic\xF3 y va a enviar esta completa, debidamente diligenciada y tiene todos los documentos adicionales para cumplir con los p\xE1rametros exigidos por SARLAFT, y que son su responsabilidad, y por lo tanto este cliente no tendr\xE1 ninguna causal de devoluci\xF3n?')) {
      var cant = $("input[name^=load_file]").length;
      for (var i = 0; i < cant; i++) {
        if ($("input[name=load_file["+i+"]]").val() == '') {
          alert('Por favor seleccione el archivo numero '+(1 + i));
          $("input[name=load_file["+i+"]]").focus();
          return false;
        }else{
          var valorfile = $("input[name=load_file["+i+"]]").val().split('.');
          var tam_valorfile = valorfile.length;
          //alert(valorfile[(tam_valorfile - 1)]);
          if(valorfile[(tam_valorfile - 1)].toLowerCase() != 'pdf' && valorfile[(tam_valorfile - 1)].toLowerCase() != 'jpg' && valorfile[(tam_valorfile - 1)].toLowerCase() != 'jpeg'){
            alert('Por favor seleccione para el archivo numero '+(1 + i)+' un formato valido ( jpg, jpeg, pdf ).');
            $("input[name=load_file["+i+"]]").focus();
            return false;
          }
        }
      };
      var nom = $('#nombre_cli').val();
      var ced = $('#documento_cli').val();
      if ($('#clientes').val() != '') {
        var clientes = $('#clientes').val().split('|');
        var tamano = clientes.length;
        var i = 1;
        while(i < tamano){
          if(clientes[i] == ced){
            alert('Ya ha agregado un cliente con este numero de cedula, por favor verifique');
            $('#documento_cli').focus();
            return false;
          }
          i = i + 2;
        }
      };
      var clis = $('#clientes').val();
      var valueclis = '';
      if(clis == ''){
        valueclis = nom+'|'+ced;
        $('#clientes').val(valueclis);
      }else{
        valueclis += clis+'|'+nom+'|'+ced;
        $('#clientes').val(valueclis);
      }

      var str = '<tr class="tr_content"><td>'+nom.toUpperCase()+'</td><td>'+ced+'</td>'+
                '<td align="center" valign="middle" class="td_formatopiso"><a href="#'+nom+'|'+ced+'" onclick="$(this).hidetr(event);"><img src="../../resources/images/icons/cross_circle.png" title="Eliminar" alt="Eliminar" /></a></td></tr>';
      $('#listaclientes').append(str);

      $('form#form_load_file img#imgloading').show();
      $('form#form_load_file input#buttonAgregarCliente').attr('disabled', 'disabled');      

      var str = $('#id_sucursal option:selected').text();
      $('#documento_sub').val(ced);
      $('#sucursal_sub').val(str);

      $('#nombre_cli').val('');
      $('#documento_cli').val('');
      //alert($('#clientes').val());
      if($('form#creaciondeRadicado input#tipo').val() == '1'){
        $('#botoncrearRadicado').attr('disabled', 'disabled');
        var forma = document.form_load_file;
      //alert(forma);
      /*forma.action = "../includes/controllerRadicado.php";
      forma.target = "grp";*/
      //$("#load_file").remove();
      //alert($("input[name^=load_file]").length);
        forma.submit();
      }
    };
  }
  $.fn.pruebaTag = function(){
    alert('prueba');
  }
  $.fn.archivosSubidos = function(obj){
    if(obj.exito){
      strHTML = '<tbody><tr class="alt-row">'+
                  '<td width="8%">Archivo:</td>'+
                  '<td><input type="file" id="load_file" name="load_file[0]">'+
                    '<div style="width:50px; display: inline; margin-left:20px;">'+
                      '<a href="#" onclick="$.fn.agregarCargaarchivos(event);">'+
                        '<img src="../../resources/images/icons/show.jpg" title="Agregar archivos" alt="Agregar">'+
                      '</a>'+
                    '</div>'+
                  '</td>'+
                '</tr>'+
                '</tbody>';
      $('#files_loaders').html(strHTML);
      $('form#form_load_file img#imgloading').hide();
      $('form#form_load_file input#buttonAgregarCliente').removeAttr('disabled');
      $('#botoncrearRadicado').removeAttr('disabled');
    }else
      alert(obj.er_folder+obj.er_file);
  }
  $.fn.hidetr = function(e){
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    var resp = confirm(String.fromCharCode(191)+'Seguro que desea borrar este cliente?');  
    if(resp){
      var str = $(this).attr('href').split('#')[1];
      if(str == $('#clientes').val()){
        $('#clientes').val('');
      }else{
        var str1 = $('#clientes').val();
        var posstr = str1.indexOf(str);
        if(posstr == 0){
          var str2 = str1.replace(str+'|','');
        }else{
          if(posstr > 0)
            var str2 = str1.replace('|'+str,'');
        }
        $('#clientes').val(str2);
      }
      var par = $(this).parent('.td_formatopiso');
      var tr = $(par).parent('.tr_content');
      $(tr).animate({ opacity: 'hide' }, "slow");
    }
  };
	$("#pruebaedit").click( function(){
		alert("test");
	});


	$(".disable_form").click( function(){
		if( confirm("Esta seguro?")) {			
			$.get($(this).attr('href'),function(data) {
				if( data == "0" )  {
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
      position: {  // Position my top left...
        my: 'center left',  // Position my top left...
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
      position: {  // Position my top left...
        my: 'center left',  // Position my top left...
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
      position: {  // Position my top left...
        my: 'center left',  // Position my top left...
        at: 'center right' // at the bottom right of...
      }
    });



	$('input#fecha_inicio').simpleDatepicker();
	$('input#fechaentrega').simpleDatepicker();
	$('input#fecha_fin').simpleDatepicker();
  $('input#fecha_envio').simpleDatepicker();
	$('input#fecharadicado').simpleDatepicker();
	$('input#fechasolicitud').simpleDatepicker();
	$('input#fechaexpedicion').simpleDatepicker();
  $('.classpickerfecha').simpleDatepicker();
	$('input#fechanacimiento').simpleDatepicker({startdate:2008,enddate:2014});
});
$.fn.buscarCliente = function(e,valor){
  //alert(valor);

  $.ajax({
    beforeSend: function(){
      $('#imgloading').show();
    },
    data: 'documento='+valor+'&action=buscarCliente',
    type: 'POST',
    url: '../includes/controllerWorkflow.php',
    //dataType: 'json',
    success: function(dato){
      alert(dato)      
    }
  });
}
$.fn.comprobarOficial = function(e,input){
  (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
  //alert($(input).val());
  if($(input).is(":checked")){
    $('#divpadreoficial').slideDown('medium');
  }else{
    $('#divpadreoficial').slideUp('medium');
  }
}
$.fn.verificarCorredores = function(e,este){
  //alert('acaaa');
  (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
  var str = $('#id_sucursal option:selected').text();
  var resp = str.search('CORREDORES');
  if(resp >= 0){
    $('#utc').removeAttr('disabled');
    //$('#utc').focus();
  }else{
    $('#utc').attr('disabled', 'disabled');
    $('#utc').val('');
    //$('#telefono').focus();
  }
}
function checkall(){
	$(".checkall").each( function() {
			if( $(this).attr('checked') )  {
				$(this).attr('checked', false);
				$("#marcar").attr('value','Seleccionar todas');
			}
			else {
				$(this).attr('checked', true);
				$("#marcar").attr('value','Deseleccionar todas');
			}
	});
}

function test1() {
	alert("test1");
}

function desactivarImages() {
	var r = confirm("Esta totalmente seguro?");
	if(  r )  {
		$("#notif_result").css('display','block');
		$.post('../../lib/general/procesos.php', $("#showIndexacionUser").serialize(), function( data) {
			$("#result_images").html(data);
		});
	}
}
function validar_num(e){
  tecla_codigo = (document.all) ? e.keyCode : e.which;
  if(tecla_codigo==8)return true;
  patron =/^\d+$/;
  tecla_valor = String.fromCharCode(tecla_codigo);
  return patron.test(tecla_valor);
}
$.fn.getEstados = function(id){
  switch(id){
    case '0':
      return 'Radicado';
    break;
    case '1':
      return 'No Enviado';
    break;
    case '2':
      return 'Recibido';
    break;
    case '3':
      return 'Devuelto';
    break;
    case '4':
      return 'Cancelado';
    break;
  }
}
$.fn.devolverItem = function(e,este,pos){
  (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
  var valor = $(este).val();
  valorp = valor.split('|');
  if(valorp[1] == '3'){
    radioSelected = este;
    if(confirm('Esta seguro que desea devolver este cliente, si lo hace ya no podra cambiar su estado')){
      $('form#devolverRadicadoForm input#clienteid_dev').val(valorp[0]);
      $('form#devolverRadicadoForm input#typepos').val(pos);
      jQuery.facebox({ 
          div: '#box1'
      });
    }else
      este.checked = false;//$(este).prop('checked', false);
  }
}
$.fn.devolverRadicadoForm = function(e,este){
  (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
  var datos = $(este).serialize().split('&');
  for(var i=0; i<4; i++){
    var dato = datos[i].split('=');
    if(dato[1] == ''){
      alert('Por favor diligencie todos los campos.');
      $('#'+dato[0]).focus();
      return false;
    }
  }
  var dat = $(este).serialize();
  var pos = $('#typepos').val();
  //alert(dat);
  $.ajax({
    beforeSend: function(){
    },
    data: dat,
    type: 'POST',
    url: '../includes/controllerRadicado.php',
    dataType: 'json',
    success: function(dato){
      /*alert(dato);
      $('#respuesta').text(dato);*/
      if(dato.exito){
        alert(dato.exito);
        $.facebox.close();
        //document.getElementsByName('cliente')[pos].disabled = true;
        //$('input[name=cliente]').attr('disabled', 'disabled');
        $("input[name=cliente["+pos+"]]").attr("disabled", "disabled");
        var newVal = $('input#clienteid_dev').val();
        $("tr#trcl_"+pos).append('<input type="hidden" name="cliente['+pos+']" value="'+newVal+'|3">');
      }
    }
  });
}
$.fn.cerrarVentana = function(){
  radioSelected.checked = false;
};
$.fn.agregarCargaarchivos = function(e){
  (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
  var cant = $("input[name^=load_file]").length;
  var strHTML = '<tr>'+
                  '<td width="8%"></td>'+
                  '<td><input type="file" id="load_file" name="load_file['+cant+']">'+
                  '<div style="width:50px; display: inline; margin-left:20px;">'+
                      '<a href="#" onclick="$.fn.quitarCargaarchivos(event,this);"><img src="../../resources/images/icons/cross_small.png" title="Eliminar archivo" alt="Eliminar" /></a>'+
                    '</div>'+
                    '<span class="input-notification attention png_bg">Utilice este icono para eliminar este cargue de la imagen en caso de haberlo agregado por error.</span>'+
                '</tr>';
  $('#files_loaders').append(strHTML);
};
$.fn.quitarCargaarchivos = function(e,este){
  (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
  var pos = $(este).parent().parent().find('#load_file').attr('name').split('[')[1].split(']')[0];
  //alert(pos);
  var cant = $("input[name^=load_file]").length;
  //alert("pos: "+pos+" ; cant:"+cant);
  for(var i = pos; i < cant; i++){
    if((i + 1) <= cant){
      //alert('entro aca');
      var input = $("input[name=load_file["+i+"]]");
      $(input).removeAttr('name');
      $(input).attr('name', 'load_file['+(i - 1)+']');
    }
  }
  var tr = $(este).parent().parent().parent();
  $(tr).remove();
  
};
$.fn.radicadosyClientesxoficial = function(e) {//
    (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
    if($('form#radicadosyClientesxoficial input#fecha_inicio').val() == ''){
      alert('Por favor seleccione una fecha inicial.');
      $('form#radicadosyClientesxoficial input#fecha_inicio').focus();
      return false;
    }
    if($('form#radicadosyClientesxoficial input#fecha_fin').val() == ''){
      alert('Por favor seleccione una fecha final.');
      $('form#radicadosyClientesxoficial input#fecha_fin').focus();
      return false;
    }
    var conf = true;
    if(conf){
      var datos = $("#radicadosyClientesxoficial").serialize();
      $.ajax({
        beforeSend: function(){
        },
        data: datos,
        type: 'POST',
        url: '../includes/controllerRadicado.php',
        dataType: 'json',
        success: function(dato){
            //alert(dato);
          if(dato.exito){
            var strHTML = '<tr>'+
                '<td width="10%"># de radicado</td>'+
                '<td width="20%">Documento de identificaci&oacute;n</td>'+
                '<td width="44%">Nombre y/o Raz&oacute;n Social del cliente</td>'+
                '<td width="14%">Fecha de envio</td>'+
                '<td width="10%" align="center" valign="middle">Estado</td>'+
                '<td width="2%" align="center" valign="middle">Descargar</td>'+
              '</tr>';
            var tam = dato.items.length;
            for (var i = 0; i < tam; i++) {
              strHTML += '<tr>'+
                '<td>'+dato.items[i].id_radicados+'</td>'+
                '<td>'+dato.items[i].documento+'</td>'+
                '<td>'+dato.items[i].descripcion+'</td>'+
                '<td>'+dato.items[i].fecha_creacion+'</td>'+
                '<td align="center" valign="middle">'+$.fn.getEstados(dato.items[i].estado)+'</td>'+
                '<td align="center" valign="middle">Descargar</td>'+
                '</tr>';
            };
            $('#listadeRadicados').html(strHTML);
            $('#imgdownpdf').html('<a href="generarReportePDF.php?'+datos+'&consR=download"><img id="imgloading" src="../../images/icons/pdf_download_8.gif" />');
            $('#imgdownpdf').qtip({
              content: {
                  text:'Por medio de este icono, descargue una copia del reporte con la informacion consultada'
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
              position: {  // Position my top left...
                my: 'bottom right',  // Position my top left...
                at: 'left top' // at the bottom right of...
              }
            });
          }else{
            $('#msg_notieneradicados').html('Usted no tiene radicados en el rango de fechas especificado.');            
            $("#result_notif_busradicofi").slideDown('medium');
          }
            
        }
      });
    }
}
$.fn.mostrarCliente = function(e, documento, filename, sucursal, estado, id_radicado, consecutivo){
  (e.preventDefault) ? e.preventDefault() : e.returnValue = false;
  radioSelected = false;
  var strHTML = '';
  if(estado == '2'){
    var numstr = '0'+consecutivo;
  if(consecutivo.length > 1)
    numstr = consecutivo;
    var strHTML = '<object id="tiffobj0" width=620 height=650 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">'+
                  '<param name="src" value="/Colpatria/virtuales_doc/vurtuales_aceptados/'+sucursal+'/LOTE_'+id_radicado+'_'+numstr+'.tiff">'+
                  '<embed width=620 height=650 src="/Colpatria/virtuales_doc/vurtuales_aceptados/'+sucursal+'/LOTE_'+id_radicado+'_'+numstr+'.tiff" type="image/tiff">'+
                '</object>';
  }else{
    var strHTML = '<object id="tiffobj0" width=620 height=650 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">'+
                  '<param name="src" value="/Colpatria/virtuales_doc/virtuales/'+sucursal+'/'+documento+'/'+filename+'">'+
                  '<embed width=620 height=650 src="/Colpatria/virtuales_doc/virtuales/'+sucursal+'/'+documento+'/'+filename+'" type="image/tiff">'+
                '</object>';
  }
  $('#box2').html(strHTML);
  jQuery.facebox({ 
    div: '#box2'
  });
}