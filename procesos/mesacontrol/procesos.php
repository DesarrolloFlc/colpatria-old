<?php
session_start();
ini_set('memory_limit', '-1');
set_time_limit(0);
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CLASS . DS . '_conexion.php';
require_once PATH_CCLASS . DS . 'user.class.php';
require_once PATH_CCLASS . DS . 'ordenproduccion.class.php';
require_once PATH_CLASS . DS . 'config' . DS . 'lang' . DS . 'eng.php';
require_once PATH_CLASS . DS . 'tcpdf.php';
if(isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] == "generarPlanillaGeneral"){
	$conn = new Conexion();
	$SQL = "SELECT COUNT('x') AS cantidad 
			  FROM ordenproduccion 
			 WHERE planilla = :planilla 
			   AND estado_aprobacion = :estado_aprobacion";
	if($conn->consultar($SQL, array(':planilla'=> $_GET['planilla'], ':estado_aprobacion'=> 'Sin aprobar'))){
		if($conn->getNumeroRegistros() == 1){
			$dat = $conn->sacarRegistro('str');
			if($dat['cantidad'] > 0){
				echo json_encode(array('error'=> 'Aun no estan aprobados todos los lotes de esta planilla, para poder generarla, por favor apruebe todos los lotes.'));
				exit();
			}else{
				$SQL = "SELECT o.id, 
							   user.name, 
							   o.planilla, 
							   o.lote, 
							   o.cantidad_formularios, 
							   o.devoluciones, 
							   o.total_formularios, 
							   o.estado_aprobacion, 
							   o.no_llegaron,
							   o.fecha,
							   d.total AS form_devolucio,
							   r.total AS form_noLlegaron
						  FROM ordenproduccion o 
						  LEFT JOIN user ON(user.id = o.id_user)
						  LEFT JOIN (SELECT COUNT('x') AS total,
						  					lote
						  			   FROM workflow 
						  			  WHERE status = '1'
						  			  GROUP BY lote
						  	 ) AS d ON(d.lote = o.lote)
						  LEFT JOIN (SELECT COUNT('x') AS total,
						  					t1.id
									   FROM radicados AS t1
									  INNER JOIN radicados_items AS t2 ON(t2.id_radicados = t1.id)
									  WHERE t1.estado = 2
									    AND t2.estado = 1
									  GROUP BY 2
							 ) AS r ON(r.id = o.lote)
						 WHERE o.planilla = :planilla
						 ORDER BY o.planilla DESC, o.lote ASC";
				if($conn->consultar($SQL, array(':planilla'=> $_GET['planilla']))){
					if($conn->getNumeroRegistros() > 0){
						$objs = array();
						while($da = $conn->sacarRegistro('str')){
							$da['form_digitado'] = Ordenproduccion::getCountForms2($_GET['planilla'], $da['lote']);
							$loteArr = Ordenproduccion::informacionRadicado($da['lote']);
							$da['sucursal'] = (isset($loteArr['sucursal']) && !empty($loteArr['sucursal'])) ? $loteArr['sucursal'] : "";
							$da['oficial_nombre'] = (isset($loteArr['oficial_nombre']) && !empty($loteArr['oficial_nombre'])) ? $loteArr['oficial_nombre'] : "";
							$da['fecha_recep'] = date('Y-m-d', strtotime(str_replace('/', '-', trim($da['fecha']))));
							if(!is_null($da['form_devolucio']) && intval($da['form_devolucio']) > 0){
								$da['form_devolucion'] = $da['form_devolucio']." en devoluci&oacute;n.";
							}else{
								$da['form_devolucion'] = "0 en devoluci&oacute;n.";
							}
							$objs[] = $da;
						}
						$header = array('N° PLANILLA FINLECO', 'N° DE LOTE', 'DEVUELTO', 'NO ENVIADO', 'TOTAL PUBLICADO', 'TOTAL FORMULARIOS', 'SUCURSAL', 'FUNCIONARIO', 'FECHA RECEPCION FINLECO');
						class MYPDF extends TCPDF {
							// Colored table
							public function ColoredTable($header,$data) {
								// Colors, line width and bold font
								$this->SetFillColor(204, 204, 204);
								$this->SetTextColor(0, 0, 0);
								$this->SetDrawColor(170, 170, 170);
								$this->SetLineWidth(0.2);
								$this->SetFont('helvetica', 'B', 7.5);
								// Header
								$w = array(20, 20, 20, 15, 20, 24, 53, 80, 25);
								$num_headers = count($header);
								for($i = 0; $i < $num_headers; ++$i) {
									//$this->Cell($w[$i], 15, $header[$i], 1, 0, 'C', 1);
          							$this->MultiCell($w[$i], 12, $header[$i], 1, 'C', 1, 0, '', '', true, 0, false, true, 12, 'M'); 
								}
								$this->Ln();
								// Color and font restoration
								$this->SetFillColor(255, 255, 255);
								$this->SetTextColor(0);
								$this->SetFont('');
								// Data
								$fill = 0;
								$ext = '';
								$pag_b = 13;

								if(is_array($data)){

									$this->setAutoPageBreak(false);
									$this->startTransaction();
									foreach($data as $row){
										$this->MultiCell($w[0], 5, $row['planilla'], 1, 'C', 1, 0, '', '', true, 0, false, true, 5, 'M');
										$this->MultiCell($w[1], 5, $row['lote'], 1, 'C', 1, 0, '', '', true, 0, false, true, 5, 'M');
										$this->MultiCell($w[2], 5, $row['devoluciones'], 1, 'C', 1, 0, '', '', true, 0, false, true, 5, 'M');
										$this->MultiCell($w[3], 5, $row['no_llegaron'], 1, 'C', 1, 0, '', '', true, 0, false, true, 5, 'M');
										$this->MultiCell($w[4], 5, $row['form_digitado'], 1, 'C', 1, 0, '', '', true, 0, false, true, 5, 'M');
										$this->MultiCell($w[5], 5, $row['total_formularios'], 1, 'C', 1, 0, '', '', true, 0, false, true, 5, 'M');
										$this->MultiCell($w[6], 5, $row['sucursal'], 1, 'C', 1, 0, '', '', true, 0, false, true, 5, 'M');
										$this->MultiCell($w[7], 5, $row['oficial_nombre'], 1, 'C', 1, 0, '', '', true, 0, false, true, 5, 'M');
										$this->MultiCell($w[8], 5, $row['fecha_recep'], 1, 'C', 1, 0, '', '', true, 0, false, true, 5, 'M');
										$this->Ln();
										$fill=!$fill;

										if($this->getY() > $this->getPageHeight() - $pag_b){
											$pag_b = 30;
											$this->rollbackTransaction(true);
											$this->AddPage();
											//$this->MultiCell(279, 2, '', 0, 'C', 0, 0, '', '', true, 0, false, true, 2, 'M');
											//$this->ln();
											$this->SetFooterMargin(PDF_MARGIN_FOOTER);
										}
										$this->commitTransaction();
										$this->setAutoPageBreak(true, 12);
									}
									//$this->Cell(array_sum($w), 0, '', 'T');
								}
							}
						}
						$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
						// set document information
						$pdf->SetCreator(PDF_CREATOR);
						$pdf->SetAuthor('FINLECOBPO');
						$pdf->SetTitle('Reporte de Planilla de envio de formularios de clientes');
						$pdf->SetSubject('Planilla de envio de formularios de conocimiento del cliente');
						$pdf->SetKeywords('planilla, formularios, conocimiento de cliente, finlecobpo');
						// set default header data
						$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'PLANILLA GENERAL', 'Listado de lotes que conforman la planilla general');
						// set header and footer fonts
						$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
						$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
						// set default monospaced font
						$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
						//set margins
						$pdf->SetMargins(10, PDF_MARGIN_TOP, 10);
						$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
						$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
						//set auto page breaks
						$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
						//set image scale factor
						$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
						//set some language-dependent strings
						$pdf->setLanguageArray($l);
						// ---------------------------------------------------------
						// set font
						$pdf->SetFont('helvetica', '', 12);
						//$fun = '';
						//$fun = Radicados::getJustFuncionario();
						// add a page
						$pdf->AddPage();
						/*$html = '<table>
						<tr>
						<td width="85">Funcionario:</td>
						<td width="470">&nbsp;DANIEL CHICO</td>
						<td  width="76" rowspan="4" align="center" valign="middle"></td>
						</tr>
						</table>';
						$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true,'', true);*/
						$file_name = 'planilla_general'.date('Ymdhis').'.pdf';
						//print_r($data);
						// print colored table
						$pdf->ColoredTable($header, $objs);
						// ---------------------------------------------------------
						//Close and output PDF document
						$pdf->Output('files'.DS.$file_name, 'F');
						//$pdf->Output($file_name, 'I');
						echo json_encode(array('exito'=> 'Se generaron los datos exitosamente', /*'items'=> $objs, */'file_name'=> $file_name, 'path'=> 'files/'));
					}else{
						echo json_encode(array('exito'=> 'No se encontraron datos.'));
					}
				}else
					echo json_encode(array('error'=> 'No se pudo ejecutar la consulta, contacte con el administrador...'));
			}
		}
	}
}
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == "aprobarOrderProduccion"){
	if($ord = Ordenproduccion::obtenerOrderId($_POST['orden_id'])){
		$lote = $ord['lote'];
		$planilla = $ord['planilla'];
		$digitados = Ordenproduccion::obtenerClientesDigitados($ord['lote'], $ord['planilla']);
		$devueltos = Ordenproduccion::obtenerClientesDevueltos($ord['lote']);
		$nollegaron = Ordenproduccion::obtenerClientesNoLlegaron($ord['lote']);
		$totalClientes = intval($digitados['total_digitados']) + intval($devueltos['total_devueltos']);
		if($totalClientes != intval($_POST['cantidad_datos'])){
			echo json_encode(array('error'=> 'La cantidad de clientes de la orden no cuadra con la cantidad de clientes procesado en el lote (clientes de la orden: '.$_POST['cantidad_datos'].' ; clientes procesados: '.$totalClientes.')'));
			exit();
		}
		if(intval($devueltos['total_devueltos']) != intval($ord['devoluciones'])){
			echo json_encode(array('error'=> 'La cantidad de clientes devuletos de la orden no cuadra con la cantidad de clientes devueltos del lote (clientes de la orden: '.$ord['devoluciones'].' ; clientes devuelto del lote: '.$devueltos['total_devueltos'].')'));
			exit();
		}
		if(intval($nollegaron['total_nollegaron']) != intval($ord['no_llegaron'])){
			echo json_encode(array('error'=> 'La cantidad de clientes que no llegaron de la orden no cuadra con la cantidad de clientes que no llegaron del lote (clientes no llegaron de la orden: '.$ord['no_llegaron'].' ; clientes no llegaron del lote: '.$nollegaron['total_nollegaron'].')'));
			exit();
		}
		$resp = Ordenproduccion::aprobarOrden($_POST['orden_id'], 'Aprobado');
		//$resp = Ordenproduccion::aprobarOrden($_POST['orden_id'], 'Sin aprobar');
		echo json_encode($resp);
	}else{
		echo json_encode(array('error'=> 'Ocurrio un error al momento de buscar la orden, contacte con el administrador.'));
	}
}
if(isset($_POST['action']) && !empty($_POST['action']) && $_POST['action'] == "eliminarOrderProduccion"){
	if($ord = Ordenproduccion::eliminarOrden($_POST['orden_id'])){
		echo json_encode($ord);
	}else{
		echo json_encode(array('error'=> 'Ocurrio un error al momento de buscar la orden, contacte con el administrador.'));
	}
}
