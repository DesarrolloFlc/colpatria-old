<?php
session_start();
require_once '../../includes.php';
require_once PATH_CCLASS.DS.'supermercado.class.php';
//echo json_encode($_POST);
//extract($_POST);
if((isset($_POST['id_client']) && $_POST['id_client'] != "") && (isset($_POST['id_contact']) && $_POST['id_contact'] != "") && (isset($_POST['persontype']) && $_POST['persontype'] == "1")) {
	$_POST['fechanacimiento'] = '0000-00-00';
	if((isset($_POST['fechanacimiento_a']) && $_POST['fechanacimiento_a'] != '') && (isset($_POST['fechanacimiento_m']) && $_POST['fechanacimiento_m'] != '') && (isset($_POST['fechanacimiento_d']) && $_POST['fechanacimiento_d'] != ''))
		$_POST['fechanacimiento'] = trim($_POST['fechanacimiento_a'])."-".trim($_POST['fechanacimiento_m'])."-".trim($_POST['fechanacimiento_d']);

	if(!isset($_POST['documento']))$_POST['documento'] = '';
	elseif(empty($_POST['documento']))$_POST['documento'] = '';

    if(!isset($_POST['primerapellido']))$_POST['primerapellido'] = '';
    elseif(empty($_POST['primerapellido']))$_POST['primerapellido'] = '';

    if(!isset($_POST['segundoapellido']))$_POST['segundoapellido'] = '';
    elseif(empty($_POST['segundoapellido']))$_POST['segundoapellido'] = '';

    if(!isset($_POST['nombres']))$_POST['nombres'] = '';
    elseif(empty($_POST['nombres']))$_POST['nombres'] = '';

    if(!isset($_POST['numerohijos']))$_POST['numerohijos'] = '0';
    elseif(empty($_POST['numerohijos']))$_POST['numerohijos'] = '0';

    if(!isset($_POST['estadocivil']))$_POST['estadocivil'] = 'NULL';
    elseif(empty($_POST['estadocivil']))$_POST['estadocivil'] = 'NULL';

    if(!isset($_POST['nivelestudios']))$_POST['nivelestudios'] = 'NULL';
    elseif(empty($_POST['nivelestudios']))$_POST['nivelestudios'] = 'NULL';

    if(!isset($_POST['id_profesion']))$_POST['id_profesion'] = 'NULL';
    elseif(empty($_POST['id_profesion']))$_POST['id_profesion'] = 'NULL';

    if(!isset($_POST['id_ciudad']))$_POST['id_ciudad'] = 'NULL';
    elseif(empty($_POST['id_ciudad']))$_POST['id_ciudad'] = 'NULL';

    if(!isset($_POST['direccionresidencia']))$_POST['direccionresidencia'] = '';
    elseif(empty($_POST['direccionresidencia']))$_POST['direccionresidencia'] = '';

    if(!isset($_POST['telefonoresidencia']))$_POST['telefonoresidencia'] = '0';
    elseif(empty($_POST['telefonoresidencia']))$_POST['telefonoresidencia'] = '0';

    if(!isset($_POST['empresa']))$_POST['empresa'] = '';
    elseif(empty($_POST['empresa']))$_POST['empresa'] = '';

    if(!isset($_POST['direccionlaboral']))$_POST['direccionlaboral'] = '';
    elseif(empty($_POST['direccionlaboral']))$_POST['direccionlaboral'] = '';

    if(!isset($_POST['id_ingresos']))$_POST['id_ingresos'] = 'NULL';
    elseif(empty($_POST['id_ingresos']))$_POST['id_ingresos'] = 'NULL';

    if(!isset($_POST['id_egresos']))$_POST['id_egresos'] = 'NULL';
    elseif(empty($_POST['id_egresos']))$_POST['id_egresos'] = 'NULL';

    if(!isset($_POST['activos']))$_POST['activos'] = '0';
    elseif(empty($_POST['activos']))$_POST['activos'] = '0';

    if(!isset($_POST['pasivos']))$_POST['pasivos'] = '0';
    elseif(empty($_POST['pasivos']))$_POST['pasivos'] = '0';

    if(!isset($_POST['celular']))$_POST['celular'] = '0';
     elseif(empty($_POST['celular']))$_POST['celular'] = '0';

    if(!isset($_POST['correoelectronico']))$_POST['correoelectronico'] = '';
    elseif(empty($_POST['correoelectronico']))$_POST['correoelectronico'] = '';

    if(!isset($_POST['observacion']))$_POST['observacion'] = '';
    elseif(empty($_POST['observacion']))$_POST['observacion'] = '';

    if($resultado = Supermercado::addConfirmCapi($_POST)){
    	if(isset($resultado['error']))
    		echo "<script>parent.alert('Ocurrio el siguiente error: ".$resultado['error']."');</script>";
    	else{
    		if($_POST['id_contact'] == "1" || $_POST['id_contact'] == "2" || $_POST['id_contact'] == "3" || $_POST['id_contact'] == "4" || $_POST['id_contact'] == "6" || $_POST['id_contact'] == "7"){	
				if($recorResp = Supermercado::addRecordCapi($resultado['lastid'],$_FILES)) {
					if(isset($recorResp['error'])) 
    					echo "<script>parent.alert('Ocurrio el siguiente error: ".$recorResp['error']."');</script>";
					else{
						echo "<script>
								parent.alert('Exito! se realizo la gestion satisfactoriamente');
								parent.window.location.href ='viewClientSup.php?id_client=".$_POST['id_client']."';
							</script>";
					}
				}else{
					echo "<script>parent.alert('No se pudo guardar la grabacion, por favor contacte con el administrador.');</script>";
				}
			}else{
                echo "<script>
                        parent.alert('Exito! se realizo la gestion satisfactoriamente...');
                        parent.window.location.href ='viewClientSup.php?id_client=".$_POST['id_client']."';
                    </script>";
            }
    	}
    }else{
    	echo "<script>parent.alert('La insercion no se pudo realizar, por favor contacte con el administrador.');</script>";
    }	
}
if((isset($_POST['id_client']) && $_POST['id_client'] != "") && (isset($_POST['id_contact']) && $_POST['id_contact'] != "") && (isset($_POST['persontype']) && $_POST['persontype'] == "2")) {
}
?>