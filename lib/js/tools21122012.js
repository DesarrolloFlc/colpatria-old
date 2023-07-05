function pantallaCompleta(pagina) { 
    window.open(pagina, 'windowname1', 'fulscreen=yes');
}
        
$(document).ready(function() {
    jQuery.fn.reset = function () {
        $(this).each (function() {
            this.reset();
        });
    }
    
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

	$("#reportPlanillas_form").submit( function() {
		$.post('libraryFunctions.php', $("#reportPlanillas_form").serialize(), function(data) {
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
         text: false // Use each elements title attribute
      },
      style: 'cream' // Give it some style
	});



	$('input#fecha_inicio').simpleDatepicker();
	$('input#fechaentrega').simpleDatepicker();
	$('input#fecha_fin').simpleDatepicker();
	$('input#fecharadicado').simpleDatepicker();
	$('input#fechasolicitud').simpleDatepicker();
	$('input#fechaexpedicion').simpleDatepicker();
	$('input#fechanacimiento').simpleDatepicker({startdate:2008,enddate:2014});
});

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