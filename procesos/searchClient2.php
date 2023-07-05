<?php
session_start();
require_once dirname(dirname(__FILE__)) . "/includes.php";
require_once PATH_CCLASS . DS . 'client.class.php';

extract($_POST);
$client = new Client();
$result_search = $client->search($criterio1, $criterio2, $texto);
$count_results = mysqli_num_rows($result_search);
$clis = Client::buscarCliente($criterio1, $criterio2, $texto);
if($count_results <= 0){
    echo "-1";
	exit;
}
?>
<table>
	<thead>
		<tr>
			<th>Tipo</th>
			<th>Identificación</th>
			<th>Nombre</th>
			<th>&Uacute;ltimo movimiento</th> 
			<th>Estado de la informaci&oacute;n</th>
			<th>Sucursal</th>
<?php
if(isset($_SESSION['group']) && $_SESSION['group'] != "9"){
?>
			<th>Acciones</th>
<?php
}
?>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="6">
				<div class="pagination">
					<a href="#" title="First Page">&laquo; Primero</a><a href="#" title="Previous Page">&laquo; Anterior</a>
					<a href="#" class="number current" title="1">1</a>
					<a href="#" title="Next Page">Siguiente &raquo;</a><a href="#" title="Last Page">Último &raquo;</a>
				</div> <!-- End .pagination -->
				<div class="clear"></div>
			</td>
		</tr>
	</tfoot>
	<tbody id="list_users">
<?php
while($client_enabled = mysqli_fetch_array($result_search)){
	$ultimomovimiento = $client->getUltimoMovimiento($client_enabled['id']);
	$ultimoestado = 'No vigente';
	if($client_enabled['vigente'] == '0' && $client_enabled['sucursal'] != 'MIGRACION'){
		$ultimoestado = $client->getEstadoInformacion($client_enabled['id']);
	}
?>
		<tr>
			<td>
<?php
	echo $client_enabled['type']; 
	if($client_enabled['capi'] == "Si"){
		if($client_enabled['type'] == "")
			echo " Capi";
		else
			echo "<br/> Capi";
	}
?>
			</td>
			<td><?=$client_enabled['document']?></td>
			<td><?=$client_enabled['firstname']?></td>
			<td><?=$ultimomovimiento?></td>
			<td><?=$ultimoestado?></td>
			<td><?=(($client_enabled['sucursal'] == 'MIGRACION') ? 'No vigente por migraci&oacute;n' : $client_enabled['sucursal'])?></td>
			<td>
<?php
	if(isset($_SESSION['group']) && $_SESSION['group'] != "9"){
?>
				<span style="text-align:center ">
					<a href="viewClient.php?id_client=<?php echo $client_enabled['id']; ?>" title="Ver detalles del cliente">
						<img src="../resources/images/icons/show.jpg" alt="Ver detalles del cliente" />
					</a>
				</span>
<?php
	}
?>
			</td>
		</tr>
<?php
}
?>
	</tbody>
</table>
<?php
if(isset($_SESSION['group']) && $_SESSION['group'] == "6"){
?>
<table>
	<thead>
		<tr>
			<th>Documento</th>
			<th>Nombre</th>
		</tr>
	</thead>
	<tbody>
		<tr></tr>
	</tbody>
</table>
<?php
}
