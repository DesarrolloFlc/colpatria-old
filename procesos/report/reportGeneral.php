<?php
session_start();
if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["6", "1"])) {
	echo "No tiene permiso para esta �rea";
	exit;
}

require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header.php';
require_once PATH_CCLASS . DS . 'general.class.php';

$general = new General();
$sucursales = $general->getSucursales();
$areas = $general->getAreas();
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
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">        
         <div class="tab-content default-tab" id="tab2">
		<form action="reportGeneral.xls.php" method="POST" name="reportGeneral" id="reportGeneral"/>
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
				<td>Sucursal:</td>
				<td>
				<select name="sucursal">
					<option value="">-- Todas --</option>
					<?php while($sucursal = mysqli_fetch_array($sucursales)):?>
					<option value="<?=$sucursal['id']?>"><?=$sucursal['sucursal']?></option>
					<?php endwhile; ?>
				</select>
				</td>
			</tr>
			<tr>
				<td>&Aacute;rea:</td>
				<td>
				<select name="area">
					<option value="">-- Todas --</option>
					<?php while($area = mysqli_fetch_array($areas)):?>
					<option value="<?=$area['id']?>"><?=$area['description']?></option>
					<?php endwhile; ?>
				</select>
				</td>
			</tr>
		     <tr>
			<td>Hora:</td>
			<td>
			<select name="hora" id="hora">
				<option value="">Todo</option>
				<?php for( $i = 6; $i <= 21; $i++ ): ?>
				<option><?=$i?></option>
				<?php endfor;?>
			</select>
			</td>
			</tr>
                </tbody>
		<tfoot>
			<tr>
				<td colspan="2"><input type="submit" class="button" value="Generar reporte >>"/></td>
			</tr>
		</tfoot>
            </table>
		</form>
	     </div>       
    </div>
</div>
