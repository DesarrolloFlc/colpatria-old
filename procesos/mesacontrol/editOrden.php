<?php
session_start();
if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["5", "6"])) {
	echo "<br><h2>Lo sentimos, no tiene permisos suficientes para esta �rea.</h2>";
	exit;
}
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'ordenproduccion.class.php';
?>
<html>
<style>
body {
	text-align:center;
	font-family: Arial;
}
thead tr th {
	font-size: 14px;
	padding: 10px;
	background-color: #a40e0e;
	color: white;
}
tbody tr td {
	padding: 5px;
}
p {
	font-size: 12px;
}
.button {
	font-family: Verdana, Arial, sans-serif;
	display: inline-block;
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
<?php 
	if(empty($_POST['btn_enviar'])){
		$obj_orden = new Ordenproduccion();
		$datos_orden = mysqli_fetch_array( $obj_orden->getOrden($_GET['orden']));
?>
	<form method="POST" action="editOrden.php" enctype="multipart/form-data">
		<table width="100px">
			<tbody>
				<tr>
					<td>Planilla:</td>
					<td><input type="text" size="5" name="planilla" id="planilla" value="<?php echo $datos_orden['planilla']?>"/></td>
					<td>Lote:</td>
					<td><input type="text" size="5" name="lote" id="lote" value="<?php echo $datos_orden['lote']?>"/></td>
				</tr>
				<tr>
					<td>Cantidad formularios:</td>
					<td><input type="text" size="5" name="cantidad_formularios" id="cantidad_formularios"  value="<?php echo $datos_orden['cantidad_formularios']?>"/></td>
					<td>Devoluciones:</td>
					<td><input type="text" size="5" name="devoluciones" id="devoluciones" value="<?php echo $datos_orden['devoluciones']?>"/></td>
				</tr>
				<tr>
					<td>No llegaron:</td>
					<td><input type="text" size="5" name="no_llegaron" id="no_llegaron" value="<?php echo $datos_orden['no_llegaron']?>"/></td>
					<td>Total formularios:</td>
					<td><input type="text" size="5" name="total_formularios" id="total_formularios" value="<?php echo $datos_orden['total_formularios']?>"/></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" align="center"><input type="submit" name="btn_enviar" value="Guardar cambios >>" class="button"/></td>
				</tr>
			</tfoot>
		</table>
		<input type="hidden" name="orden" id="orden" value="<?php echo $_GET['orden']?>">
	</form>
<?php
	}else{
		extract($_POST);
		if(!empty( $orden)){
			$sql = "UPDATE ordenproduccion 
					   SET planilla = '$planilla', lote ='$lote', 
						   cantidad_formularios = '$cantidad_formularios', 
						   devoluciones = '$devoluciones', no_llegaron = '$no_llegaron',
						   total_formularios = '$total_formularios'
					 WHERE id = '$orden'";
			if( mysqli_query($GLOBALS['link'], $sql)){
?>
	<script>
		alert("Cambio efectuado correctamente.");
		window.close();
	</script>
<?php
			}else{
?>
	<script>
		alert("Cambio efectuado correctamente.");
	</script>
<?php
			}
		}
	}
?>
</body>
</html>
