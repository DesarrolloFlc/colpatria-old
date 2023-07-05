<?php
session_start();
require_once '../../template/general/header.php';
require_once '../../lib/class/form.class.php';
require_once '../../lib/class/case.class.php';
require_once '../../lib/class/ordenproduccion.class.php';

$orden = new Ordenproduccion();
$totalordenes = $orden->getNumOrdenes();
$totalpaginas = $totalordenes / 40;

$case = new Cases();
$form = new Form();

$pagina = 1;
$inicio = 0;
$inicio = ($pagina - 1) * 40;
$ordenes = $orden->getOrdenes($inicio);
?>
<!-- Page Head -->
<h2>Ordenes de producci&oacute;n</h2>
<p id="page-intro">Ordenes de producci&oacute;n creadas por Finleco</p>
<div class="clear"></div> <!-- End .clear -->
<ul class="shortcut-buttons-set"> <!-- Replace the icons URL's with your own -->
    <li>
    	<a class="shortcut-button" href="formulario.php">
    		<span>
                <img src="../../resources/images/icons/pencil.png" alt="icon" />
               	<br>
                Crear orden de producción
            </span>
        </a>
    </li>
</ul>
<div class="clear"></div> <!-- End .clear -->
<div class="content-box"  id="box_search_result">
    <div class="content-box-header">
    	<h3>B&uacute;squeda de ordenes de producci&oacute;n</h3>
    	<ul class="content-box-tabs">
            <li><a href="#tab2" class="default-tab">Buscador</a></li> <!-- href must be unique and match the id of target div -->            
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">                 
        <div class="tab-content default-tab" id="tab2">
            <form action="ordenesProduccion.php" method="POST" id="form_ordensearch" name="form_ordensearch">
                <p>
                	<label>Criterio de búsqueda:</label>
                    <select name="criterio1" id="criterio1" class="small-input">
                        <option value="">-- Seleccione una opción --</option>
                        <option value="1">Planilla</option>
                        <option value="2">Lote</option>
                    </select> 
                </p>
                <p>
                    <label>Texto a buscar:</label>
                    <input class="text-input medium-input" type="text" id="texto" name="texto" /> <span class="input-notification attention png_bg">Campo obligatorio</span>
                    <br /><small>Escriba la información que desea buscar(p.e: 8023656)</small>
                </p>
                <p>
                    <input type="hidden" name="action" id="action" value="search_orden0" />
                    <input class="button" type="submit" id="search_orden" value="Realizar búsqueda " />
                </p>
            </form>
        </div>
    </div>
</div>
<div class="tab-content default-tab" id="tab_resultsearch"></div>
<div class="clear"></div>
<div class="content-box" id="box_search_result">
    <div class="content-box-header">
        <h3>Ordenes de producci&oacute;n</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab2" class="default-tab">Ordenes</a></li> <!-- href must be unique and match the id of target div -->            
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab2">
            <table id="lista-ordenes">
                <thead>
                    <tr>
                        <th width="6%" align="center">Editar</th>
                        <th width="8%">Planilla</th>
                        <th width="6%">Lote</th>
                        <th width="12%">Cantidad formularios</th>
                        <th width="10%">Devoluciones</th>
                        <th width="10%">No llegaron</th>
                        <th width="12%">Total formularios</th>
                        <th width="14%" style="background-color:#ccc000;color:white">Formularios digitados</th>
                        <th width="14%" style="background-color:#ccc000;color:white">Devoluciones creadas</th>
                        <th width="19%" style="background-color:#ccc000;color:white">Marcados no llegaron</th>
                        <th width="15%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="11">
                            <table id="ordenes_show" width="100%">
<?php
while ($orden0 = mysqli_fetch_array($ordenes)): 
	$form_digitado = $form->getCountForms($orden0['planilla'], $orden0['lote']);
	$form_devolucion = $case->getCount($orden0['lote'], "0"); 
	$form_noLlegaron = Form::getNoLlegaronForms($orden0['lote']); 
	if ($orden0['estado_aprobacion'] == 'Aprobado'){
?>
								<tr style='background:#b9e9b2'>
<?php
	}else{
?>
								<tr>
<?php
	}
?>
									<td width="6%">
<?php
	if ($orden0['estado_aprobacion'] == 'Sin aprobar') {
?>
										<a href="" onClick="window.open('editOrden.php?orden=<?php echo $orden0['id'] ?>', '', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbar=no,resizable=no,width=420,height=200,top=85,left=140');
                                                                return false;">
											<img src="../../resources/images/icons/edit.png" alt="Editar"/>
										</a>
<?php
	}
?>
									</td>
									<td width="8%"><?php echo $orden0['planilla'] ?></td>
									<td width="6%"><?php echo $orden0['lote'] ?></td>
									<td width="12%"><?php echo $orden0['cantidad_formularios'] ?></td>
									<td width="10%"><?php echo $orden0['devoluciones'] ?></td>
									<td width="10%"><?php echo $orden0['no_llegaron'] ?></td>
									<td width="12%"><?php echo $orden0['total_formularios'] ?></td>
									<td width="14%"><?php echo $form_digitado ?></td>
									<td width="14%"><?php echo $form_devolucion ?></td>
									<td width="19%"><?php echo $form_noLlegaron ?></td>
									<td width="15%">
<?php
	$procesados = intval($form_digitado) + intval($form_devolucion) + intval($form_noLlegaron);
	if ($orden0['cantidad_formularios'] == $procesados && (intval($form_digitado) == $orden0['total_formularios']) && (intval($form_devolucion) == $orden0['devoluciones']) && (intval($form_noLlegaron) == $orden0['no_llegaron'])){
		if ($orden0['estado_aprobacion'] == 'Sin aprobar') {
?>
										<a href="#" onclick="window.open('validacionOrden.php?orden=<?=$orden0['id']?>&cantidad_datos=<?=($orden0['devoluciones'] + $orden0['total_formularios'])?>', '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=600, height=300, top=85, left=140');" class="button">Aprobar</a>
<?php
		}
	}else{
										echo "No esta lista para aprobaci&oacute;n.";
	}
?>
									</td>
								</tr>
<?php
endwhile;
?>
							</table>
						</td>
					</tr>
				</tbody>
				<tfoot>
                    <tr>
                        <td colspan="6">
                            <b>Total de ordenes: <?php echo $totalordenes ?></b>
                            <div class="pagination">
                                <!--                      <a href="#" title="First Page">&laquo; Primero</a><a href="#" title="Previous Page">&laquo; Anterior</a> -->
                                <?php for ($i = 1; $i <= $totalpaginas; $i++): ?>
                                    <a href="../report/libraryFunctions.php?action=loadOrdenes&pagina=<?php echo $i ?>" class="number" title="<?php echo $i ?>"><?php echo $i ?></a>
                                <?php endfor; ?>
                                <!-- <a href="#" title="Next Page">Siguiente &raquo;</a><a href="#" title="Last Page">Último &raquo;</a>                 -->
                            </div> <!-- End .pagination -->
                            <div class="clear"></div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script src="../../resources/scripts/datatables.min.js"></script>
<script>
$(document).ready(function(){
	console.log("aqui entro...");
});
</script>
<?php
require_once '../../template/general/footer.php';
?>