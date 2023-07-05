<?php
require_once PATH_SITE . DS . 'config/globalParameters.php';

class Contactcapi
{

	function addConfirm($id_client, $id_contact, $id_user, $documento, $primerapellido, $segundoapellido, $nombres, $fechanacimiento, $id_profesion, $empresa, $id_ingresos, $id_egresos, 
				$activos, $pasivos, $direccionlaboral, $id_ciudad, $direccionresidencia, $celular, $correoelectronico, $telefonoresidencia, $numerohijos, $estadocivil, $nivelestudios, $observacion, $respuesta_libre, $nacionalidad, $nacionalidad_otra, $nacionalidad_cual, $pais_residencia, $obligaciones_otras, $obligaciones_paises) {
			$sql = "INSERT INTO data_capi_confirm
					(
						id_client, id_contact, id_user, documento, primerapellido, segundoapellido, nombres, fechanacimiento, 
						id_profesion, empresa, id_ingresos, id_egresos, activos, pasivos, direccionlaboral, id_ciudad, 
						direccionresidencia, celular, correoelectronico, telefonoresidencia, numerohijos, estadocivil, 
						nivelestudios, observacion, respuesta_libre, nacionalidad, nacionalidad_otra, nacionalidad_cual, 
						pais_residencia, obligaciones_otras, obligaciones_paises
					) 
					VALUES
					(
						'$id_client', '$id_contact', '$id_user', '$documento', '$primerapellido', '$segundoapellido', 
						'$nombres', '$fechanacimiento', '$id_profesion', '$empresa', '$id_ingresos', '$id_egresos', 
						'$activos', '$pasivos', '$direccionlaboral', '$id_ciudad', '$direccionresidencia', '$celular', 
						'$correoelectronico', '$telefonoresidencia', '$numerohijos', '$estadocivil', '$nivelestudios', 
						'$observacion', '$respuesta_libre', '$nacionalidad', '$nacionalidad_otra', '$nacionalidad_cual', 
						'$pais_residencia', '$obligaciones_otras', '$obligaciones_paises'
					)";

		echo $sql;
			if( mysqli_query($GLOBALS['link'], $sql) ) {
			?>
			<script type="text/javascript">
				alert("Confirmacion exitosa.");
				location.href="../viewClient.php?id_client=<?php echo $id_client;?>";
			</script>
			<?php 
         		}   
	        	else {
		 	?>
			<script type="text/javascript">
				alert("Hubo problemas con la confirmacion, contacte al administrador del sistema.");
			</script>
			<?php
		      } 	
	}	
	
	function addConfirmJuridico($id_client, $id_contact, $id_user, $razonsocial, $nit, $digitochequeo, $ciudadoficina, $direccionoficinappal, $telefonoficina, $actividadeconomicappal, 
        $activosemp, $pasivosemp, $ingresosmensualesemp, $egresosmensualesemp, $correoelectronico, $observacion, $respuesta_libre, $nacionalidad, $nacionalidad_otra, $nacionalidad_cual, $pais_residencia, $obligaciones_otras, $obligaciones_paises) {
        $sql = "INSERT INTO data_capi_confirm
        		(
        			id_client, id_contact, id_user, nombres, documento, codigochequeo, id_ciudad, direccionlaboral, 
        			telefonoresidencia, id_actividadeconomicappal, activos, pasivos, id_ingresos, id_egresos, 
        			correoelectronico, observacion, respuesta_libre, nacionalidad, nacionalidad_otra, 
        			nacionalidad_cual, pais_residencia, obligaciones_otras, obligaciones_paises
        		)
        		VALUES
        		(
        			'$id_client', '$id_contact', '$id_user', '$razonsocial', '$nit', '$digitochequeo', '$ciudadoficina', 
        			'$direccionoficinappal', '$telefonoficina', '$actividadeconomicappal', '$activosemp', '$pasivosemp', 
        			'$ingresosmensualesemp', '$egresosmensualesemp', '$correoelectronico', '$observacion', '$respuesta_libre',
        			'$nacionalidad', '$nacionalidad_otra', '$nacionalidad_cual', '$pais_residencia', '$obligaciones_otras', '$obligaciones_paises'
        		)";
        echo $sql;

			if( mysqli_query($GLOBALS['link'], $sql) ) {
			?>
			<script type="text/javascript">
				alert("Confirmacion exitosa.");
				location.href="../viewClient.php?id_client=<?php echo $id_client;?>";
			</script>
			<?php
         		}
	        	else {
		 	?>
			<script type="text/javascript">
				alert("Hubo problemas con la confirmacion, contacte al administrador del sistema.");
			</script>
			<?php
		      }

	}

	function lastId() {
		return mysqli_insert_id($GLOBALS['link']);
	}

	function getContactTelf( $id_client ) {
		$sql = "SELECT confirm.observacion, confirm.id AS id, confirm.date_created, us.name, param_contact.type,param_contact.description, CONCAT(recorde.directory,'/',recorde.filename) AS filename    
				FROM client cli INNER JOIN data_capi_confirm confirm ON cli.id = confirm.id_client 
				INNER JOIN param_contact ON param_contact.id = confirm.id_contact
				INNER JOIN user us ON us.id = confirm.id_user 
				LEFT JOIN recordcapi AS recorde ON recorde.id_data_confirm = confirm.id 
				WHERE confirm.id_client = '$id_client' 
				ORDER BY confirm.date_created DESC";

		return mysqli_query($GLOBALS['link'], $sql);
	}
	function getContactTelfSup( $id_client ) {
		$sql = "SELECT confirm.observacion, confirm.id AS id, confirm.date_created, us.name, param_contact.type,param_contact.description, CONCAT(recorde.directory,'/',recorde.filename) AS filename    
				FROM client cli INNER JOIN sup_data_capi_confirm confirm ON cli.id = confirm.id_client 
				INNER JOIN param_contact ON param_contact.id = confirm.id_contact
				INNER JOIN user us ON us.id = confirm.id_user 
				LEFT JOIN recordcapi AS recorde ON recorde.id_data_confirm = confirm.id 
				WHERE confirm.id_client = '$id_client' 
				ORDER BY confirm.date_created DESC";

		return mysqli_query($GLOBALS['link'], $sql);
	}


	function getLastConfirm( $id_client ) {
		$sql = "SELECT date_created FROM data_capi_confirm WHERE ( id_contact BETWEEN '1' AND '4' ) AND id_client='$id_client' ORDER BY date_created DESC LIMIT 1";
		$result = mysqli_fetch_array(mysqli_query($GLOBALS['link'], $sql));
		return $result['date_created'];
	}


	function getContact( $id ) {
		$sql = "SELECT confirm.observacion, confirm.id AS id, confirm.date_created, us.name, param_contact.type,param_contact.description, CONCAT(recorde.directory,'/',recorde.filename) AS filename 
					,confirm.documento, confirm.primerapellido, confirm.segundoapellido, confirm.nombres, confirm.fechanacimiento, confirm.empresa, confirm.direccionlaboral, confirm.direccionresidencia, confirm.telefonoresidencia
					, confirm.celular, confirm.correoelectronico, confirm.numerohijos, confirm.estadocivil, confirm.nivelestudios 
			FROM client cli INNER JOIN data_capi_confirm confirm ON cli.id = confirm.id_client 
					  INNER JOIN param_contact ON param_contact.id = confirm.id_contact
					  INNER JOIN user us ON us.id = confirm.id_user 
					  LEFT JOIN recordcapi AS recorde ON recorde.id_data_confirm = confirm.id 
					  WHERE confirm.id = '$id' 
					   ORDER BY confirm.date_created DESC";
		return mysqli_query($GLOBALS['link'], $sql);
	}
}
