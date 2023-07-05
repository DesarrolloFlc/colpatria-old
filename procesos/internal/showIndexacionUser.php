<?php
session_start();

require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'image.class.php';
extract($_POST);

if( $type_indexacion == "1" ) {
	$sql = "SELECT * FROM image_tmp WHERE directory = '$id_user' AND status = '2' AND filename LIKE 'LOTE_%'ORDER BY filename,date_uploaded ASC LIMIT 15";
	$result = mysqli_query($GLOBALS['link'], $sql);
	?>
	<form id="showIndexacionUser" name="showIndexacionUser" method="POST">
	<table>
	<thead>
	<tr>
		<td width="20px"></td>
		<th>Nombre de archivo</th>
		<th>Fecha de cargue</th>
		<th>Usuario cargue</th>
		<th>Acciones</th>
	</tr>
	</thead>
	<tbody>
	<?php
	while($image_tmp = mysqli_fetch_array($result)) {
	?>
	<tr>
		<td width="20px"><input type="checkbox" name="id_image_tmp[]" id="id_image_tmp[]" class="checkall" value="<?php echo $image_tmp['id'];?>"/></td>
		<td><?php echo $image_tmp['filename'];?></td>
		<td><?php echo $image_tmp['date_uploaded'];?></td>
		<td><?php echo $image_tmp['id_user'];?></td>
		<td>Desactivar</td>
	</tr>
	<?php
	}
	?>
	</tbody>
	<tfoot>
	<tr>
		<td colspan="4">Se presentan las 10 primeras im&aacute;genes que tiene el usuario para indexar.</td>
	</tr>
	</tfoot>
	</table>
	<input type="hidden" name="action" id="action" value="desactivarImages" />
	</form>
	<?php
}


if( $type_indexacion == "2" ) {
	$sql = "SELECT * FROM image_tmp WHERE directory = '$id_user' AND status = '1' AND filename LIKE 'LOTE_%'ORDER BY filename,date_uploaded ASC LIMIT 15";
	$result = mysqli_query($GLOBALS['link'], $sql);
	?>
	<form id="showIndexacionUser" name="showIndexacionUser" method="POST">
	<table>
	<thead>
	<tr>
		<td width="20px"></td>
		<th>Nombre de archivo</th>
		<th>Fecha de cargue</th>
		<th>Usuario cargue</th>
		<th>Acciones</th>
	</tr>
	</thead>
	<tbody>
	<?php
	while($image_tmp = mysqli_fetch_array($result)) {
	?>
	<tr>
		<td width="20px"><input type="checkbox" name="id_image_tmp[]" id="id_image_tmp[]" class="checkall" value="<?php echo $image_tmp['id'];?>"/></td>
		<td><?php echo $image_tmp['filename'];?></td>
		<td><?php echo $image_tmp['date_uploaded'];?></td>
		<td><?php echo $image_tmp['id_user'];?></td>
		<td>Desactivar</td>
	</tr>
	<?php
	}
	?>
	</tbody>
	<tfoot>
	<tr>
		<td colspan="4">Se presentan las 10 primeras im&aacute;genes que tiene el usuario para indexar.</td>
	</tr>
	</tfoot>
	</table>
	<input type="hidden" name="action" id="action" value="desactivarImages" />
	</form>
	<?php
}
?>

<input type="button" class="button" id="marcar" value="Seleccionar todas" name="selectall" id="selectall" onClick="checkall();" />
<input type="button" class="button" id="desactivarImages" value="Desactivar im&aacute;genes seleccionadas" onClick="desactivarImages();" />
<br /><br />
<div class="notification information png_bg" id="notif_result" style="display:none;">
    <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
    <div id="result_images">

    </div>
</div>