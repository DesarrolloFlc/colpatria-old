<?php

?>
<html>
<head>
<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>

<script type="text/javascript">
$(document).ready( function(){
$("#form_miuser").submit( function(){
	$.post('getUser.php',$("#form_miuser").serialize(), function(data) {
		if( data == -1) {	
			$("#print_user").html("El usuario no existe, valide su documento de identificación.");
		} else {	
			$("#print_user").html("Su nombre de usuario es: <b>"+data+"</b>");

		}	
});
	return false;
}); 
});
</script>
<style type="text/css">
body {
font-family:calibri, Verdana;
}


form input.text-input,
form select,
form textarea,
form .wysiwyg {
                padding: 6px;
                font-size: 13px;
                background: #fff url('../images/bg-form-field.gif') top left repeat-x;
                border: 1px solid #d5d5d5;
				color: #333;
                }
            
form .large-input {
                width: 97.5% !important;
				font-size: 16px !important;
				padding: 8px !important;
                }

tfoot {
text-align:center;
}

                
.button {
                background: #950000 url('resources/images/bg-button-red.gif') top left repeat-x !important;
                border-color: #940000 !important;

                }

.button {
				font-family: Verdana, Arial, sans-serif;
                display: inline-block;

                border: 1px solid #459300 !important;
                padding: 4px 7px 4px 7px !important;
                color: #fff !important;
                font-size: 11px !important;
                cursor: pointer;
                }
                
.button:hover {
                text-decoration: underline;
                }
                
.button:active {
                padding: 5px 7px 3px 7px !important;
                }
				
</style>
</head>
<body>
<form name="form_miuser" id="form_miuser" method="post">
<table >
<thead>
<tr>
<th colspan="2">INGRESE SU NÚMERO DE IDENTIFICACIÓN</th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="text" name="documento" id="documento" size="40" class="large-input" /></td>
</tr>
</tbody>
<tfoot>
<tr>
<td colspan="2"><input type="submit" value="Conocer mi usuario >>" class="button" /></td>
</tr>
</tfoot>
</table>
</form>
<div id="print_user"></div>
</body>
</html>