<?php
session_start();
if(!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["1", "6", "8"]) && !isset($_SESSION['id']) || !in_array($_SESSION['id'], ["1305", "1184"])) {
	echo "No tiene permisos para acceder a esta �rea";
	exit;
}
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CLASS . DS . 'form.class.php';
extract($_POST);
/** FUNCIONES PARA REPORTES **/
if (isset($reporte) && $reporte == "reportPlanillas.php" && !empty($planilla)) {
	if (isset($accion)) {
		if ($accion == 'sucursales') {
			require_once PATH_CLASS . DS . 'general.class.php';
			$gen = new General();
			$planillas = $gen->getPlanillasSucursal($planilla, $fec_ini, $fec_fin);
?>
<option>Seleccione una planilla</option>
<?php
			while( $planilla_s = mysqli_fetch_array($planillas)){
?>
<option value="<?=$planilla_s['planilla']?>"><?=$planilla_s['planilla']?></option>
<?php
			}
		} else {
			require_once PATH_CLASS . DS . 'case.class.php';
			require_once PATH_CLASS . DS . 'general.class.php';
			$gen = new General();
			$lotes = $gen->getLoteSucursal( $sucursal, $planilla, $fec_ini, $fec_fin );
			$case = new Cases();	
			while ($lote = mysqli_fetch_array($lotes)) {
?>
<option value="<?=$lote['lote']?>"><?=$lote['lote'] . $case->getCount( $lote['lote'],"1")?></option>
<?php
			}
		}
	} else {
		require_once PATH_CLASS . DS . 'case.class.php';
		$form = new Form();
		$lotes = $form->getLotesPlanilla( $planilla );
		$case = new Cases();	
		while ($lote = mysqli_fetch_array($lotes)) {
?>
<option value="<?=$lote['lote']?>"><?=$lote['lote'] . $case->getCount( $lote['lote'],"1")?></option>
<?php
		}
	}
} else if (isset($_GET['action']) && $_GET['action'] == "loadOrdenes") {
	require_once PATH_CLASS . DS . 'ordenproduccion.class.php';
	require_once PATH_CLASS . DS . 'case.class.php';
	$ordenn = new Ordenproduccion();
	$inicio = ($_GET['pagina'] - 1) * 40;
	$ordeness = $ordenn->getOrdenes($inicio);
	$form = new Form();
	$case = new Cases();
	$contador = 1;
	while ($orden1= mysqli_fetch_array($ordeness)) {
		$form_digitado = $form->getCountForms($orden1['planilla'],$orden1['lote']);
		$form_devolucion = $case->getCount($orden1['lote'],"0");
		$form_noLlegaron = Form::getNoLlegaronForms($orden1['lote']);
		if (($contador % 2) == 0) {
			$complemento = " style='background-color:#F3F3F3' ";
		}
		if ($orden1['estado_aprobacion'] == 'Aprobado') {
			$complemento = " style='background-color:#b9e9b2' ";
		}
?>
<tr <?=$complemento?>>
	<td width="6%">
<?php 
			if( $orden1['estado_aprobacion'] == 'Sin aprobar') {
?>
		<a href="" onClick="window.open('editOrden.php?orden=<?=$orden1['id']?>','','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbar=no,resizable=no,width=420,height=200,top=85,left=140'); return false;"><img src="../../resources/images/icons/edit.png" alt="Editar" /><?php //echo $orden1['planilla']?></a>
<?php 
			}
?>
	</td>
	<td width="8%"><?=$orden1['planilla']?></td>
	<td width="6%"><?=$orden1['lote']?></td>
	<td width="12%"><?=$orden1['cantidad_formularios']?></td>
	<td width="10%"><?=$orden1['devoluciones']?></td>
	<td width="10%"><?=$orden1['no_llegaron'] ?></td>
	<td width="12%"><?=$orden1['total_formularios']?></td>
	<td width="14%"><?=$form_digitado?></td>
	<td width="14%"><?=$form_devolucion?></td>
    <td width="19%"><?=$form_noLlegaron?></td>
	<td width="15%">
<?php
		$procesados = intval($form_digitado) + intval($form_devolucion) + intval($form_noLlegaron);
		if ($orden1['cantidad_formularios'] == $procesados && (intval($form_digitado) == $orden1['total_formularios']) && (intval($form_devolucion) == $orden1['devoluciones']) && (intval($form_noLlegaron) == $orden1['no_llegaron'])) {
			if ($orden1['estado_aprobacion'] == 'Sin aprobar') {
?>
		<a href="#" onclick="window.open('validacionOrden.php?orden=<?=$orden1['id']?>&cantidad_datos=<?=$orden1['devoluciones']+$orden1['total_formularios']?>','','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=600, height=300, top=85, left=140');" class="button">Aprobar</a>
<?php
			}
		} else { 
			echo "No esta lista para aprobaci&oacute;n.";
		}
?>
	</td>
</tr>	
<?php
	$contador++;
	$complemento = "";
	}
} else if (isset($action) &&  $action == "showClientsLote" ) {
	if (isset($reportPlanillas_planilla) && isset($reportPlanillas_lote)) {
		$form = new Form();
		$clientslotes = $form->getClientsLote($reportPlanillas_planilla,$reportPlanillas_lote);
		$devo = $form->getDevolucionLote( $reportPlanillas_lote ); 
?>
<div class="clear"></div> <!-- End .clear -->
<div id="planillas">
	<table>
		<tr>		
			<td><a href="" onClick="window.open('viewPlanilla.php?planilla=<?=$reportPlanillas_planilla?>&type=planilla', 'windowplanillas', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=960, height=620, top=85, left=140');return false;" target="_blank"><img src="../../resources/images/icons/show.jpg" />&nbsp;&nbsp;Ver planilla general</a></td>
			<td><a href="" onClick="window.open('viewPlanilla.php?planilla=<?=$reportPlanillas_planilla?>&lote=<?=$reportPlanillas_lote?>&type=lote', 'windowplanillas', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=960, height=620, top=85, left=140');return false;" target="_blank"><img src="../../resources/images/icons/show.jpg" />&nbsp;&nbsp;Ver planilla del lote</a></td>
		</tr>
	</table>	
</div>
<div class="clear"></div> <!-- End .clear -->
<br />
<div class="content-box"  id="box_search_result">    
	<div class="content-box-header">
		<h3>Resultado de reporte de clientes por lote</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab2" class="default-tab">Reporte clientes por lote</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->
	<div class="content-box-content">        
		<div class="tab-content default-tab" id="tab2">
			<table>
				<thead>
					<tr>
						<th>Documento</th>
						<th>Tipo cliente</th>
					</tr>
				</thead>
				<tbody>
<?php
		while ($client = mysqli_fetch_array($clientslotes)) {
?>
					<tr>
						<td><a href="../viewClient.php?id_client=<?=$client['id'] ?>" target="_blank"><?=$client['document']?></a></td>
						<td><?=$client['persontype']?></td></tr>
<?php
		}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="content-box"  id="box_search_result">    
	<div class="content-box-header">
		<h3>Devoluciones para este lote</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab2" class="default-tab">Devoluciones</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->
	<div class="content-box-content">        
		<div class="tab-content default-tab" id="tab2">
			<table>
				<thead>
					<tr>
						<th>Documento</th>
						<th>Nombre</th>
						<th>Observaci&oacute;</th>
						<th>Fecha creaci&oacute;n</th>
						<th>Detalle</th>
					</tr>
				</thead>
				<tbody>
<?php 
		while ($devolucion=mysqli_fetch_array($devo)) {
?>
					<tr>
						<td><?=$devolucion['documento']?></td>
						<td><?=$devolucion['nombre']?></td>
						<td><?=$devolucion['observation']?></td>
						<td><?=$devolucion['date_created']?></td>
						<td>
							<a href="" onClick="window.open('../viewDevolucion.php?id_devolucion=<?=$devolucion['id']?>', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=300, height=280, top=85, left=140');return false;" target="_blank">
								<img src="../../resources/images/icons/show.jpg" alt="Ver detalles del cliente" />
							</a>
						</td>
					</tr>
<?php
		}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php
	}
} else if ($action == "showClientsLoteSuc") {
	$form = new Form();
	$clientslotes = $form->getClientsLote($reportPlanillasSuc_planilla,$reportPlanillasSuc_lote);
	$devo = $form->getDevolucionLote( $reportPlanillasSuc_lote ); 
?>
<div class="clear"></div> <!-- End .clear -->
<div id="planillas">
	<table>
		<tr>		
			<td>
				<a href="" onClick="window.open('viewPlanilla.php?planilla=<?=$reportPlanillasSuc_planilla?>&type=planilla', 'windowplanillas', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=960, height=620, top=85, left=140');return false;" target="_blank">
					<img src="../../resources/images/icons/show.jpg" />
					&nbsp;&nbsp;Ver planilla general
				</a>
			</td>
			<td>
				<a href="" onClick="window.open('viewPlanilla.php?planilla=<?=$reportPlanillasSuc_planilla?>&lote=<?=$reportPlanillasSuc_lote?>&type=lote', 'windowplanillas', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=960, height=620, top=85, left=140');return false;" target="_blank">
					<img src="../../resources/images/icons/show.jpg" />
					&nbsp;&nbsp;Ver planilla del lote
				</a>
			</td>
		</tr>
	</table>
</div>
<div class="clear"></div> <!-- End .clear -->
<br />
<div class="content-box"  id="box_search_result">    
	<div class="content-box-header">
		<h3>Resultado de reporte de clientes por lote</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab2" class="default-tab">Reporte clientes por lote</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->
	<div class="content-box-content">        
		<div class="tab-content default-tab" id="tab2">
			<table>
				<thead>
					<tr>
						<th>Documento</th>
						<th>Tipo cliente</th>
					</tr>
				</thead>
				<tbody>
<?php
	while ($client = mysqli_fetch_array($clientslotes)) {
?>
					<tr>
						<td><a href="../viewClient.php?id_client=<?=$client['id'] ?>" target="_blank"><?=$client['document']?></a></td>
						<td><?=$client['persontype']?></td>
					</tr>
<?php
	}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="content-box"  id="box_search_result">    
	<div class="content-box-header">
		<h3>Devoluciones para este lote</h3>
		<ul class="content-box-tabs">
			<li><a href="#tab2" class="default-tab">Devoluciones</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
		<div class="clear"></div>
	</div> <!-- End .content-box-header -->
	<div class="content-box-content">        
		<div class="tab-content default-tab" id="tab2">
			<table>
				<thead>
					<tr>
						<th>Documento</th>
						<th>Nombre</th>
						<th>Observaci&oacute;</th>
						<th>Fecha creaci&oacute;n</th>
						<th>Detalle</th>
					</tr>
				</thead>
				<tbody>
<?php 
	while ($devolucion = mysqli_fetch_array($devo)) {
?>
					<tr>
						<td><?=$devolucion['documento']?></td>
						<td><?=$devolucion['nombre']?></td>
						<td><?=$devolucion['observation']?></td>
						<td><?=$devolucion['date_created']?></td>
						<td><a href="" onClick="window.open('../viewDevolucion.php?id_devolucion=<?=$devolucion['id']?>', 'windowname1', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=300, height=280, top=85, left=140');return false;" target="_blank" ><img src="../../resources/images/icons/show.jpg" alt="Ver detalles del cliente" /></a></td>
					</tr>
<?php
	}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php
	}
