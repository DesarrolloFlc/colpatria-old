<?php
session_start();

if( $_SESSION['group'] == "5" OR $_SESSION['group'] == "6") {
require_once '../../lib/class/case.class.php';
?>
<html>
<style>
body {
	text-align:center;
   font-family: Arial;   
}

thead tr th{
  font-size: 14px;
  padding: 10px;
  background-color: #a40e0e;
  color: white;
}

tbody tr td{
  padding: 5px;
}

p {
  font-size: 12px;
}


.button {
				font-family: Verdana, Arial, sans-serif;
                display: inline-block;
                /*background: #459300 url('../images/bg-button-green.gif') top left repeat-x !important;*/
			background: #a40e0e;
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
				
a.remove-link {
				color: #bb0000;
				}

a.remove-link:hover {
				color: #000;
				}

.error {
	color: red;
	text-align:left;
}
</style>
<body>
<?php if( empty($_POST['btn_enviar'] )){ ?>

<?php 
	$obj_case = new Cases();
	$datos_case = mysqli_fetch_array( $obj_case->getCase($_GET['case']));
?>
<form method="POST" action="editCase.php" enctype="multipart/form-data">
<table width="100px">
<tbody>
<tr>
	<td>Documento:</td>
	<td><input type="text" size="10" name="documento" id="documento" value="<?php echo $datos_case['documento']?>"/></td>
</tr>
<tr>
	<td>Nombre:</td>
	<td><input type="text" size="35" name="nombre" id="nombre" value="<?php echo $datos_case['nombre']?>"/></td>
</tr>
<tr>
	<td>Lote:</td>
	<td><input type="text" size="5" name="lote" id="lote" value="<?php echo $datos_case['lote']?>"/></td>
</tr>
</tbody>
<tfoot>
<tr>
	<td colspan="4" align="center"><input type="submit" name="btn_enviar" value="Guardar cambios >>" class="button"/></td>
</tr>
</tfoot>
</table>
<input type="hidden" name="case" id="case" value="<?php echo $_GET['case']?>" />
</form>
<?php } else {
	extract($_POST);
	?>
	<?php if( !empty( $case))  { ?> 
			<?php 
				$sql = "UPDATE workflow SET documento = '$documento',nombre ='$nombre',lote = '$lote'
					WHERE id='$case'";
			if( mysqli_query($GLOBALS['link'], $sql)) {
					?>
					<script>
					alert("Cambio efectuado correctamente.");
					window.close();
					</script>
					<?php
				} else {
					?>
					<script>
					alert("Cambio efectuado correctamente.");
					</script>
					<?php
				}
			?>

	<?php } ?>
<?php }?>
</body>
</html>
<?php
} else {
	echo "<br><h2>Lo sentimos, no tiene permisos suficientes para esta área.</h2>";
}
?>
