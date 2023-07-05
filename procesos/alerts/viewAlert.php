<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'alert.class.php';

extract($_GET);
$form = new Alert();

if ($id_alert == 2) $infoalert = $form->getInfoAlert2();

if ($id_alert == 3) $infoalert = $form->getInfoAlert3();

if ($id_alert == 5) $infoalert = $form->getInfoAlert5();

if ($id_alert == 7) $infoalert = $form->getInfoAlert7();

if ($id_alert == 12) $infoalert = $form->getInfoAlert12();

if ($id_alert == 14) $infoalert = $form->getInfoAlert14();

if ($id_alert == 15) $infoalert = $form->getInfoAlert15();

if ($id_alert == 4) $infoactividad = $form->getActividad();
?>
<html>
    <body>
        <form action="alert.xls.php" method="POST" name="reportAlert" id="reportAlert"/>
			<table>
				<tr>
					<td><input type="hidden" value="<?php echo $id_alert ?>"></td>
					<td colspan="2"><input type="submit" class="button" value="Generar alerta >>"/></td>

				</tr>
			</table>
		</form>
<?php
if ($id_alert == 4) {
?>
		<form action="viewAlert.php" method="POST" name="reportAlerta" id="reportAlerta"/>
			<table>
				<tr>
					<td>Tipo Actividad:</td>
					<td>
						<select name="actividad">
							<option value="">-- Todas --</option>
<?php 
	while ($acti = mysqli_fetch_array($infoactividad)) {
?>
							<option value="<?=$acti['id']?>"><?=$acti['description']?></option>
<?php
	}
?>
						</select>
					</td>
				</tr>
			</table>
		</form>
<?php
}
?>
<table>
    <th>Nombre</th>
    <th>Cédula</th>
<?php
	while ($thumb = mysqli_fetch_array($infoalert)) {
?>
	<tr>
		<td><?=$thumb['nombre']?></td>
		<td><?=$thumb['documento']?></td>
	</tr>
<?php
}
?>
</table>
</body>
</html>
