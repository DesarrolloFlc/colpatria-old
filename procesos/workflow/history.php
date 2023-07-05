<?php 
session_start();

if( $_SESSION['group'] == "6" ) {
	extract($_GET);
	if( !empty($id_case)) {
	?>
	<html>
	<body>	
	<table style="border: 1px solid black;">
	<tr style="font-size: 16px; font-weight: bold">
		<td>Lote</td>
		<td>Fecha entrega</td>
		<td>Usuario</td>
		<td>Fecha creaci&oacute;n</td>
	</tr>
	<?php
		require_once '../../lib/class/retroalimentar.class.php';
		$retro = new Retroalimentar();
		$result_retro = $retro->history($id_case);	
		while( $re = mysqli_fetch_array($result_retro))   {
			?>
			<tr>
				<td><?php echo $re['lote']?></td>
				<td><?php echo $re['fechaentrega']?></td>
				<td><?php echo $re['id_user']?></td>
				<td><?php echo $re['date_created']?></td>
			</tr>	
			<?php
		}
	?>
	</table>
	</body>
	</html>
	<?php
	}
} else {
	echo "Error de permisos";
}
?>