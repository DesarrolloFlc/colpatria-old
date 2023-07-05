<?php
session_start();
require_once dirname(dirname(__FILE__)) . "/includes.php";
extract($_GET);
?>

<?php 
if (!empty($_POST['btn_mover'])) {
	extract($_POST);
	if (empty($newdocument) || empty($id_form)) {
		echo "El documento no puede estar vac�o.";
		exit;
	}
	require_once PATH_CCLASS . DS . 'client.class.php';
	$client = new Client();
	$id_client = mysqli_fetch_array($client->getId($newdocument, $tipodoc));
	$id_client = $id_client['id'];
	if ($id_client <= 0) {
		echo "El cliente no existe, para transladar el formulario debe existir.";
		exit;
	}
	require_once PATH_CCLASS . DS . 'form.class.php';
	$forma = new Form();
	echo $forma->updateDocument($id_form, $id_client, $newdocument,$tipodoc)
		? "Se actualiz� correctamente."
		: "Ocurrieron errores, contacte al administrador.";

	exit;
}
?>
<html>
<body>
	<form action="moveForm.php" method="POST"> 
		<table>
		<tr>
			<td colspan="2" align="center"><b>Trasladar formulario</b></td>	
		</tr>
		<tr>
			<td>Nuevo documento:</td>
			<td><input type="text" name="newdocument" id="newdocument" /></td>
		</tr>
		<tr>
			<td>Tipo documento: </td>
			<td>
				<select name="tipodoc" id="tipodoc">
					<option value="1">CC</option>
					<option value="2">NIT</option>
				<select>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" value="Mover >>" name="btn_mover" id="btn_mover"/></td>
		</tr>
		</table>
		<input type="hidden" name="id_form" id="id_form"  value="<?php echo $id_form?>"/>
	</form>
</body>
</html>