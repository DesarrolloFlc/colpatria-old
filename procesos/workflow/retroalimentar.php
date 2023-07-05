<?php
session_start();
if( $_SESSION['group'] == "6" ) {
extract($_GET);
?>

<?php if( !empty($case) && empty($btn_retroalimentar) ) { ?>
<html>
<head>
    <script type="text/javascript" src="/Colpatria/resources/scripts/jquery-1.3.2.min.js"></script>
    <link rel="stylesheet" href="/Colpatria/resources/css/calendar.css" type="text/css" media="screen" />	
    <script type="text/javascript" src="/Colpatria/lib/js/tools.js"></script>
    <script type="text/javascript" src="/Colpatria/lib/js/cal.js"></script>
    <script type="text/javascript" src="/Colpatria/resources/scripts/jquery.qtip-1.0.0-rc3.min.js"></script>
</head>
<body>
<form action="retroalimentar.php" method="POST">
<table>
<tr>
	<td colspan="2" align="center"><b>Retroalimentar</b></td>
</tr>
<tr>
	<td>Lote: </td>
	<td><input type="text" name="lote" id="lote" /></td>
</tr>
<tr>
	<td>Fecha de entrega:</td>
	<td><input type="text" name="fechaentrega" id="fechaentrega" /></td>	
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" value="Guardar >>" name="btn_retroalimentar" id="btn_retroalimentar"/></td>
</tr>
</table>
<input type="hidden" name="id_case" id="id_case" value="<?php echo $case?>" />
</form>
<?php
} else if( !empty($_POST['btn_retroalimentar']) ){ 	
	extract($_POST);
	if( !empty($lote) AND !empty($id_case) AND !empty($fechaentrega) AND !empty($_SESSION['id'])) {
		require_once '../../lib/class/retroalimentar.class.php';
		$retro = new Retroalimentar();
		if( $retro->add($id_case, $_SESSION['id'], $lote, $fechaentrega) ) {
			echo "<h2>Insertado correctamente.</h2>";
		} else {
			echo "Error insertando.";
		}
	} else {
		echo "Por favor valide los campos.";
	}
}?>
</body>
</html>
<?php	
} else  {
	echo "<h2>No tiene permisos.</h2>";
}
?>