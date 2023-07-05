<?php
require_once '../../lib/class/general.class.php';
$type = $_POST['type'];
?>
<script type="text/javascript">

	function cambiarEstadoActividad() {
		if( document.getElementById("actividadeconomicappal").value == "810") {
			document.getElementById("otrosactividad").style.display = "block";
			document.getElementById("detalleactividadeconomicappal").disabled = false;
		} else {
			document.getElementById("otrosactividad").style.display = "none";
		}
	}

    $(document).ready(function() {
        $("#tipopersona").change(function(){
            if( $('#tipopersona').val() != "") {
                $.post('fields.php', {type_person: $('#tipopersona').val()},function( data) {
                    $('#fields_persona').html(data);                          
                });
            }
        });              
        
        $("#form_fingering").submit( function() {
            if(  $("#type").val()  == "1" ) {
		  if( $("#documento").val() != $("#documento2").val() ) {
			alert("El No. de documento no coincide.");
			$("#documento").css('background-color','red');  
			return false;
		  }

		  if( $("#telefonoresidencia").val() != "" ) {
			if( $("#telefonoresidencia").val().length != "7"  &&  $("#telefonoresidencia").val().length != "9"  ) {
				alert("El numero de telefono no es valido");	
				 $("#telefonoresidencia").css('background-color','red');  			
				return false;
			}
		  }	

		  if( $("#celular").val() != ""  ) {
			if( $("#celular").val().length != "10"  || $("#celular").val().length < 10 || $("#celular").val().length > 10 ) {
				alert("El numero de celular no es valido");	
				$("#celular").css('background-color','red');  			
				return false;
			}
		  }


                $(".obligatorio").each( function() {
                    count = 0;
                    if( $(this).val() == "" ) {
                        $(this).css('background-color','red');    
                        count++;
                    }                    
                });  
                if( count > 0 )  {
                    alert("Por favor complete los campos obligatorios.");
                    return false;
                }
/*		  if( $("#correoelectronico").val() != "" ) {
			var status = false;     
			var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
			if (document.getElementById("correoelectronico").value.search(emailRegEx) == -1) {
				alert("Por favor ingrese un mail valido.");
				$("#correoelectronico").css('background-color','red');
				return false;
			}
		  }		*/
            } 

	   if( $("#type").val() == "2")  {

		 $(".obligatorio").each( function() {
                    count = 0;
                    if( $(this).val() == "" ) {
                        $(this).css('background-color','red');    
                        count++;
                    }                    
                });  
		 if( count > 0 )  {
                   alert("Por favor complete los campos obligatorios.");
                    return false;
                }

		} 

		  if( $("#nit").val() != $("#nit2").val() ) {
			alert("El No. de NIT no coincide.");
			$("#nit").css('background-color','red');  
			return false;
		  }
	   }         

	$("#actividadeconomicappal").change( function() {
		alert("HOLA");
	});

            
        });
    });                    

</script>
<script language="javascript">
    function onlyNumbers(){
        var key=window.event.keyCode;
        if (key < 48 || key > 57){
            window.event.keyCode=0;
        }
    }
    
    function onlyChars() {
        if (event.keyCode < 65 || event.keyCode > 90 )  {
		if( event.keyCode != 32 )
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


    <?php
} else if ($type == "2") {
    ?>
    <?php
    require_once 'fields2.php';
    ?>   
    <input type="hidden" name="type" id="type" value="2" />    
    <?php
} else if ($type == "3") {
    ?>
    <p>El anexo no tiene campos para diligenciar.</p>
    <input type="hidden" name="type" id="type" value="3" />
    <input type="submit" value="Anexar documento" />    
    <?php
}