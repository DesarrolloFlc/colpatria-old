<?php
session_start();
if(!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["6", "1", "8"]) || (!isset($_SESSION['id']) || !in_array($_SESSION['id'], ["1184", "1305"]))) {
	echo "No tiene permiso para esta �rea";
	exit;
}

require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header.php';
require_once PATH_CCLASS . DS . 'form.class.php';
require_once PATH_CCLASS . DS . 'general.class.php';

$form = new Form();
$planillas = $form->getPlanillasLog();
$general = new General();
$sucursales = $general->getSucursales();
?>
<!-- Page Head -->
<h2>Reporte interno de indexaci&oacute;n</h2>
<p id="page-intro">Detalle de los formularios indexados en DocFinder.</p>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"  id="box_search_result">    
      <div class="content-box-header">
        <h3>Parametros de generaci&oacute;n</h3>

        <ul class="content-box-tabs">
            <li><a href="#tab2" class="default-tab">Reporte interno</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab3">Reporte interno por Sucursal</a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">        
         <div class="tab-content default-tab" id="tab2">
	     <form method="POST" name="reportPlanillas_form" id="reportPlanillas_form">	
            <table>
                <tbody>
                   <tr>
			<td>Planilla No.:</td>
			<td>
			<select name="reportPlanillas_planilla" id="reportPlanillas_planilla">
			<option>Seleccione una planilla</option>
			<?php while( $planilla = mysqli_fetch_array($planillas) ): ?>
			<option value="<?=$planilla['planilla']?>"><?=$planilla['planilla']?></option>
			<?php endwhile;?>
			<!--<option value="121">121</option>
			<option value="122">122</option>
			<option value="123">123</option>-->
			</select>
			</td>
		     </tr>
     			<tr>
			<td>Lote:</td>
			<td>
			<select name="reportPlanillas_lote" id="reportPlanillas_lote" disabled>
				<option>Seleccione el lote</option>		
			<select>
			</td>
		     </tr>			    
                </tbody>
		<tfoot>
			<tr>
				<td colspan="2"><input type="submit" class="button" value="Generar reporte >>"/></td>
			</tr>
		</tfoot>
            </table>
		<input type="hidden" name="action" id="action" value="showClientsLote" />
	     </form>
        </div>
        <div class="tab-content" id="tab3">
	     <form method="POST" name="reportPlanillasSuc_form" id="reportPlanillasSuc_form">	
            <table>
                <tbody>
		    	   <tr>
					<td>Fecha inicio:</td>
					<td><input type="text" name="fecha_inicio" id="fecha_inicio" />(YYYY-MM-DD)</td>
		     	   </tr>
     			   <tr>
					<td>Fecha fin:</td>
					<td><input type="text" name="fecha_fin" id="fecha_fin" />(YYYY-MM-DD)</td>
		     	   </tr>
                   <tr>
					<td>Sucursales:</td>
					<td>
					<select name="reportPlanillas_sucursal" id="reportPlanillas_sucursal">
					<option>Seleccione una sucursal</option>
					<?php while( $sucursal = mysqli_fetch_array($sucursales) ): ?>
					<option value="<?=$sucursal['id']?>"><?=$sucursal['sucursal']?></option>
					<?php endwhile;?>
					</select>
					</td>
		     	   </tr>
		     	   <tr>
					<td>Planilla No.:</td>
					<td>
					<select name="reportPlanillasSuc_planilla" id="reportPlanillasSuc_planilla" disabled>
						<option>Seleccione una planilla</option>					
					</select>
					</td>
				     </tr>
		     			<tr>
					<td>Lote:</td>
					<td>
					<select name="reportPlanillasSuc_lote" id="reportPlanillasSuc_lote" disabled>
						<option>Seleccione el lote</option>		
					<select>
					</td>
		    	 </tr>
                </tbody>
				<tfoot>
					<tr>
						<td colspan="2"><input type="submit" class="button" value="Generar reporte >>"/></td>
					</tr>
				</tfoot>
            </table>
			<input type="hidden" name="action" id="action" value="showClientsLoteSuc" />
	     </form>
        </div>
    </div>
</div>
<div id="clientlist_div"></div>
