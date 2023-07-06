<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_COMPOSER . DS . 'vendor' . DS . 'autoload.php';

require_once PATH_CCLASS . DS . 'radicados.class.php';
require_once PATH_CCLASS . DS . 'MYPDF1.php';
require_once PATH_CCLASS . DS . 'MYPDF2.php';

if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], ["1", "2", "6", "8", "10"])) {
?>
	<script>
		alert('Usted no tiene permisos para ingresar a esta area, contacte con el administrador.');
	</script>
<?php

}
//require_once PATH_CLASS.DS.'config'.DS.'lang'.DS.'eng.php';
//require_once PATH_CLASS.DS.'tcpdf.php';
if (isset($_GET['consR']) && $_GET['consR'] == 'download') {
	$data = Radicados::clientesDelOficial($_GET['fecha_inicio'], $_GET['fecha_fin']);
	if ($data === false) {
		exit;
	}
	$header = ['# RADICADO', 'NIT/CEDULA', 'NOMBRE/RAZON SOCIAL', 'CREACION', 'ESTADO'];

	$pdf = new MYPDF1(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('FINLECOBPO');
	$pdf->SetTitle('Reporte de Planilla de envio de formularios de clientes');
	$pdf->SetSubject('Planilla de envio de formularios de conocimiento del cliente');
	$pdf->SetKeywords('planilla, formularios, conocimiento de cliente, finlecobpo');

	// set default header data
	$pdf->SetHeaderData('', 0, 'PLANILLA DE CLIENTES RADICADOS CON FORMULARIO DE CONOCIMIENTO DE CLIENTE', 'Listado de clientes radicados');

	// set header and footer fonts
	$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	//set margins
	$pdf->SetMargins(15, 31, 15);
	$pdf->SetHeaderMargin(20);
	$pdf->SetFooterMargin(10);

	//set auto page breaks
	$pdf->SetAutoPageBreak(true, 25);

	//set image scale factor
	$pdf->setImageScale(1.25);

	//set some language-dependent strings
	$pdf->setLanguageArray(['w_page'=> 'page']);


	// ---------------------------------------------------------

	// set font
	$pdf->SetFont('helvetica', '', 12);
	//$fun = '';
	//$fun = Radicados::getJustFuncionario();
	// add a page
	$pdf->AddPage();
	$html = '<table>
		<tr>
		<td width="85">Funcionario:</td>
		<td width="470">&nbsp;' . Radicados::getJustFuncionario() . '</td>
		<td  width="76" rowspan="4" align="center" valign="middle"><img src="images.jpg" width="65" /></td>
		</tr>
	</table>';
	@$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

	$pdf->ColoredTable($header, $data);
	$pdf->Output('reporte_ClientesRadicados_' . date('Ymdhis') . '.pdf', 'D');

} else {
	$metod = 'D';
	$idradicado = $_GET['idradicado'];
	if (isset($_GET['downpdf']) && $_GET['downpdf'] == 'download')
		$metod = 'D';

	$header = array('ITEM', 'CLIENTE', 'NIT/CEDULA');
	$radicado = new Radicados();
	$radicado->setId($idradicado);
	$radicado->getRadicado();
	$data = $radicado->getItemsDeRadicado();


	$pdf = new MYPDF2(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('FINLECOBPO');
	$pdf->SetTitle('Reporte de Planilla de envio de formularios de clientes');
	$pdf->SetSubject('Planilla de envio de formularios de conocimiento del cliente');
	$pdf->SetKeywords('planilla, formularios, conocimiento de cliente, finlecobpo');

	// set default header data
	$pdf->SetHeaderData('', 0, 'PLANILLA DE ENVIO DE FORMULARIO DE CONOCIMIENTO DE CLIENTE', 'Listado de clientes enviado');

	// set header and footer fonts
	$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	//set margins
	$pdf->SetMargins(15, 31, 15);
	$pdf->SetHeaderMargin(20);
	$pdf->SetFooterMargin(10);

	//set auto page breaks
	$pdf->SetAutoPageBreak(true, 25);

	//set image scale factor
	$pdf->setImageScale(1.25);

	//set some language-dependent strings
	$pdf->setLanguageArray(['w_page'=> 'page']);


	// ---------------------------------------------------------

	// set font
	$pdf->SetFont('helvetica', '', 12);

	// add a page
	$pdf->AddPage();
	$estado = 'Activo';
	if ($radicado->getEstado() == 1)
		$estado = 'Aprobado';
	$tipo = 'Fisico';
	if ($radicado->getTipo() == 1)
		$tipo = 'Virtual';
	elseif ($radicado->getTipo() == 3)
		$tipo = 'Financial virtual';
	elseif ($radicado->getTipo() == 5)
		$tipo = 'Contingencia Virtual';
	$html = '<table>
  <tr>
    <td width="82">Radicado #:</td>
    <td width="470">&nbsp;' . $radicado->getId() . '</td>
    <td  width="76" rowspan="4" align="center" valign="middle"><img src="images.jpg" width="65" /></td>
  </tr>
  <tr>
    <td>Tipo:</td>
    <td>&nbsp;' . $tipo . '</td>
  </tr>
  <tr>
    <td>Sucursal:</td>
    <td>&nbsp;' . $radicado->getSucursal() . '</td>
  </tr>
  <tr>
    <td>Fecha:</td>
    <td>&nbsp;' . $radicado->getFecha_creacion() . '</td>
  </tr>
</table>
<table>
  <tr>
    <td width="160">Funcionario que envia:</td>
    <td>' . $radicado->getFuncionario() . '</td>
  </tr>
</table>  
<table>
  <tr>
    <td width="82">Estado:</td>
    <td>' . getEstados($radicado->getEstado()) . '</td>
  </tr>';
	if ($radicado->getUtc() != 0) {
		$html .= '<tr>
    <td width="82">Utc:</td>
    <td>' . $radicado->getUtc() ?? '' . '</td>
  </tr>';
	}
	$html .= '</table>';
	@$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

	//print_r($data);
	// print colored table
	$pdf->ColoredTable($header, $data, $radicado);

	// ---------------------------------------------------------

	//Close and output PDF document
	$pdf->Output('reporte_planillasClientes_' . $radicado->getId() . '_' . date('Ymdhis') . '.pdf', $metod);

	//============================================================+
	// END OF FILE
	//============================================================+
}


function getEstados($id)
{
	$estados = ['Radicado', 'No enviado', 'Recibido', 'Devuelto'];
	return $estados[$id] ?? 'Radicado';
}
