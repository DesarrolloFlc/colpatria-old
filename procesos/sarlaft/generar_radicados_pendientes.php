<?php
ini_set('memory_limit', '-1');
set_time_limit(0);
header("Content-Type: text/html;charset=utf-8");
require "includes.php";
require_once PATH_CLASS.DS.'_conexion.php';
require_once PATH_MAILER.DS.'class.phpmailer.php';
require_once PATH_PHPSHEET.DS.'vendor'.DS.'autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
dataDigitadosColpatria();
function dataDigitadosColpatria(){
	$conn = new Conexion();
	$file = 'reporteRadicadosFaltantes_'.date('YmdHis').'.xlsx';
	$filename = PATH_SITE.DS.'procesos'.DS.'sarlaft'.DS.$file;
	$fecha = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s")." +12 hour"));
	//$fecha = "2020-10-06 19:00:00";
	$SQL = "SELECT r.id,
				   r.fecha_creacion,
				   r.id_sucursal,
				   ps.sucursal,
				   r.id_usuarioenvia,
				   u.name
			  FROM radicados AS r
			  LEFT JOIN param_sucursales AS ps ON(ps.id = r.id_sucursal)
			  LEFT JOIN user AS u ON(u.id = r.id_usuarioenvia)
			 WHERE r.estado = :estado";
	if($conn->consultar($SQL, array(':estado'=> '0'))){
		if($conn->getNumeroRegistros() > 0){
			$spreadsheet = new Spreadsheet();
			$spreadsheet->getProperties()
				->setCreator('FinlecoBPO Group')
				->setLastModifiedBy('FinlecoBPO Group')
				->setTitle('Reporte de radicados proximos a vencer Colpatria')
				->setSubject('Radicados proximos a vences')
				->setDescription('Reporte que contiene los radicados proximos a vencer de la unidad Colpatria')
				->setKeywords('Reporte radicados proximos a vences')
				->setCategory('Reporte de radicados');

			$styleTittles = [
				'font' => [
					'bold' => true,
					'color'=> ['argb' => 'FFFFFF'],
				],
				'alignment' => [
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
					'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
				],
				'borders' => [
					'allborders' => [
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
						'color' => ['argb' => 'FFFFFF'],
					],
				],
				'fill' => [
					'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
					'startColor' => [
						'argb' => '285E9E',
					],
				],
			];
			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

			$spreadsheet->getActiveSheet()->getStyle('A1:E1')->applyFromArray($styleTittles);
			$spreadsheet->getActiveSheet()->fromArray(['# RADICADO', 'CREADOR', 'SUCURSAL', 'FECHA CREACION', 'HORAS DESDE LA CREACION'], NULL, 'A1');
			$cont = 2;
			while($row = $conn->sacarRegistro('str')){
				$t1 = strtotime($row['fecha_creacion']);
				$t2 = strtotime($fecha);
				$hours = round(($t2 - $t1) / 3600);
				$row['horas_diferencia'] = $hours;
				$spreadsheet->getActiveSheet()->fromArray([$row['id'], $row['name'], $row['sucursal'], PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($row['fecha_creacion']), $row['horas_diferencia']], NULL, 'A'.$cont);
				//$spreadsheet->getActiveSheet()->getStyle('D'.$cont)->getNumberFormat()->setFormatCode('dd/mm/yyyy hh:mm');
				$cont++;
			}
			$spreadsheet->getActiveSheet()->getStyle('D2:D'.($cont - 1))->getNumberFormat()->setFormatCode('dd/mm/yyyy hh:mm');
			$writer = new Xlsx($spreadsheet);
			$writer->save($filename);
			//echo json_encode(array('exito'=> 'Datos generados exitosamente'));
		}
	}
	$resp = enviarMailCreacion($filename, $file);
	if($resp === 'ok'){
		if(file_exists($filename))
			unlink($filename);
	}
}
function enviarMailCreacion($destination, $file){
	setlocale(LC_ALL, "es_CO");
	$mail = new PHPMailer();
	$mail->IsHTML(true);
	$body = "Estimados<br><br>
	El sistema confirma la remisión del listado de radicados proximos a cumplir o que ya cumplieron 48 horas desde su creacion.<br><br>
	En caso de requerir ayuda, por favor comunicarse con daniel.chico@finlecobpo.com<br>
	Atentamente,<br><br><br>
	DocFinder.";

	//$mail->IsSendmail();
	//indico a la clase que use SMTP
	$mail->IsSMTP();
	//permite modo debug para ver mensajes de las cosas que van ocurriendo
	//$mail->SMTPDebug = 2;
	//Debo de hacer autenticación SMTP
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	//indico el servidor de Gmail para SMTP
	$mail->Host = MAIL_HOST;
	//indico el puerto que usa Gmail
	$mail->Port = MAIL_PORT;
	//indico un usuario / clave de un usuario de gmail
	$mail->Username = MAIL_USER;
	$mail->Password = MAIL_PASS;
	//indico creador del mensaje
	$mail->SetFrom(MAIL_USER, MAIL_SUBJECT);
	$mail->Subject = "Confirmación de generación, archivo con radicados 48 horas o mas.";
	if(file_exists($destination)){
		$mail->AddAttachment($destination, $file);
	}

	$mail->MsgHTML($body);
	$mail->CharSet = 'UTF-8';
	$mail->AddAddress("daniel.chico@finlecobpo.com", "Daniel Chico P.");
	$mail->AddAddress("gestion.documental@finlecobpo.com", "Gestion Documental");

	if(!$mail->Send())
		return "Mailer Error: ".$mail->ErrorInfo;
	else
		return "ok";
}
?>