<?php
session_start();
ini_set('memory_limit', '-1');
set_time_limit(0);
require_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "includes.php";
require_once PATH_CLASS . DS . '_conexion.php';
require_once PATH_CCLASS . DS . 'user.class.php';
require_once PATH_CCLASS . DS . 'ordenproduccion.class.php';
require_once PATH_CCLASS . DS . 'meta.class.php';

if (isset($_GET['actionadmin']) && $_GET['actionadmin'] == "desactivaruser") {
    $user = new User();
    echo $user->disableUser($_GET['id_user']);
    exit;
}


extract($_POST);
if(isset($_POST['action']) && !empty($_POST['action']))
    $action = $_POST['action'];
else if(isset($_GET['action']) && !empty($_GET['action']))
    $action = $_GET['action'];


/*
 * AGREGAR UN USUARIO
 */
/*if ($action == "add_user") {
    $user = new User();
    $user->add($id_group, $username, $password, $identificacion, $name, $sucursal, $correoelectronico, $cargo, $oficial ?? '', $correojefe ?? '') === 0
        ? "0"
        : "-1";
}*/
if ($action == "add_user") {
    $user = new User();
    $user->add2($id_group, $username, $password, $identificacion, $name, $sucursal, $correoelectronico, $cargo, $oficial ?? '', $correojefe ?? '') === 0
        ? "0"
        : "-1";
}


/**
 * EDITAR UN DOCUMENTO
 */
if ($action == "editardocumento") {
    if (empty($nuevodocumento) || empty($id_client) || empty($_SESSION['id'])) {
        echo "Hubo problemas con el documento, contacte al administrador.";
        exit;
    }
    $exist_client = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT COUNT(*) as total FROM client WHERE document = '$nuevodocumento'"));
    if ($exist_client['total'] > 0) {
        echo "El cliente ya existe, contacte por favor al administrador";
        exit;
    }
    $sql = "UPDATE client 
               SET document = '$nuevodocumento',
                   last_updater = '".$_SESSION['id']."', 
                   date_updated_document = '".date('y-m-d h:m:s')."' 
             WHERE id = '$id_client'";
    if (!mysqli_query($GLOBALS['link'], $sql)) {
        echo "No se pudo realizar la actualizacion del cliente.";
        exit;
    }
    $sq1 = "UPDATE data_confirm
               SET documento = '$nuevodocumento',
                   nit = '$nuevodocumento'
             WHERE id_client = '$id_client'";
    mysqli_query($GLOBALS['link'], $sq1);
    $sq2 = "SELECT f.id,
                   c.persontype
              FROM form AS f
             INNER JOIN client AS c ON(c.id = f.id_client)
             WHERE f.id_client = '$id_client'";
    $rest = mysqli_query($GLOBALS['link'], $sq2);
    while ($fila = mysqli_fetch_array($rest, MYSQLI_ASSOC)) {
        $fila['persontype'] == '2'
            ? "UPDATE data SET nit = '$nuevodocumento' WHERE id_form = " . $fila['id']
            : "UPDATE data SET documento = '$nuevodocumento' WHERE id_form = " . $fila['id'];
        mysqli_query($GLOBALS['link'], $sq3);
    }
    echo "Actualizacion exitosa.";
}

if (isset($_GET['action']) && $_GET['action'] == "disable_form") {
    $id_form = $_GET['id_form'];
    if (mysqli_query($GLOBALS['link'], "UPDATE form SET status = '0', id_user_disabled = '{$_SESSION['id']}' WHERE id = '$id_form'"))
        echo "0";
    else
        echo "1";
}

if ($action == "desactivarImages") {
    foreach ($id_image_tmp AS $image_tmp) {
        $sql = "UPDATE image_tmp SET status = '2' WHERE id = '$image_tmp'";
        if (mysqli_query($GLOBALS['link'], $sql)) {
            echo "Imagen con Id: " . $image_tmp . " desactivada<br />";
        } else {
            echo "Error desactivando imagen con Id: " . $image_tmp . " desactivada<br />";
        }
    }
}


if (isset($_GET['action']) && $_GET['action'] == "unabled_image") {
    if ($_SESSION['group'] == "6") {
        $data_image = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT DATE_FORMAT(date_created,'%y-%m-%d_%h:%i:%s') AS fecha, filename FROM image WHERE id = '" . $_GET['id_image'] . "'"));
        //Copiar imagen
        if (copy("/var/www/images_colpatria/" . $data_image['filename'], "/home/finleco/images_faltantes/" . $data_image['fecha'] . "_" . $data_image['filename'])) {
            if (unlink("/var/www/images_colpatria/" . $data_image['filename'])) {
                if (mysqli_query($GLOBALS['link'], "INSERT INTO image_back (SELECT * FROM image WHERE id = '" . $_GET['id_image'] . "')")) {
                    if (mysqli_query($GLOBALS['link'], "DELETE FROM image WHERE id = '" . $_GET['id_image'] . "'"))
                        echo "0";
                    else
                        echo "1";
                } else
                    echo "1";
            } else
                echo "1";
        } else {
            echo "1";
        }
    }
}


if ($action == "desactivarPlanillas") {
    require_once '../class/image.class.php';
    $image = new Image();
    $result = $image->disablePlanilla($id_user);
    if ($result == "0") {
?>
        <script type="text/javascript">
            alert("Planillas desactivadas, ya puede indexar la siguiente planilla.");
            this.close();
        </script>
<?php
    } else {
?>
        <script type="text/javascript">
            alert("Error desactivando planillas.");
        </script>
<?php
    }
}



/** APROBAR ORDEN * */
if ($action == "aprobar_orden") {
    if (!empty($id_orden)) {
        $orden = new Ordenproduccion();
        if ($orden->changeStatus($id_orden, 'Aprobado')) {
            ?>
            <script type="text/javascript">
                alert("La orden se aprob� correctamente.");
                this.close();
            </script>
            <?php
        } else {
            ?>
            <script type="text/javascript">
                alert("Error aprobando orden, por favor cont�cte al administrador del sistema.");
            </script>
            <?php
        }
    } else {
        echo "<br>Hay inconvenientes por favor contacte al administrador del sistema.";
    }
}


if ($action == "add_orden") {
    $orden = new Ordenproduccion();
    $orden->addOrden($_SESSION['id'], $planilla, $lote, $asesor, $cantidad, $sucursal, $area, $devoluciones, $fecha, $total_formularios, $no_llegaron);
    header("Location:../../procesos/mesacontrol/formulario.php");
}


if (isset($_GET['action']) && $_GET['action'] == "search_orden0") {
    /*$orden = new Ordenproduccion();
    $result_search = $orden->search($criterio1, $texto);
    $count_results = mysqli_num_rows($result_search);

    if ($count_results > 0) {
        ?>
        <table>
            <thead>
                <tr>
                    <th>Consecutivo</th>
                    <th>Asignado a</th>
                    <th>Planilla</th>
                    <th>Lote</th>                        
                    <th>Cantidad Formularios</th>     
                    <th>Devoluciones</th>
                    <th>Fecha</th>
                    <th>Total Formularios</th>
                    <th>Asesor</th>
                    <th>Fecha de Creaci�n</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="6">

                        <div class="pagination">
                            <a href="#" title="First Page">&laquo; Primero</a><a href="#" title="Previous Page">&laquo; Anterior</a>
                            <a href="#" class="number current" title="1">1</a>
                            <a href="#" title="Next Page">Siguiente &raquo;</a><a href="#" title="Last Page">�ltimo &raquo;</a>
                        </div> <!-- End .pagination -->
                        <div class="clear"></div>
                    </td>
                </tr>
            </tfoot>

            <tbody id="list_users">
                <?php
                while ($orden_enabled = mysqli_fetch_array($result_search)) {
                    ?>
                    <tr>
                        <td><?php echo $orden_enabled['id']; ?></td>
                        <td><?php echo utf8_encode($orden_enabled['usuario']); ?></td>
                        <td><?php echo $orden_enabled['planilla']; ?></td>
                        <td><?php echo $orden_enabled['lote']; ?></td>
                        <td><?php echo $orden_enabled['cantidad_formularios']; ?></td>
                        <td><?php echo $orden_enabled['devoluciones']; ?></td>
                        <td><?php echo $orden_enabled['fecha']; ?></td>
                        <td><?php echo $orden_enabled['total_formularios']; ?></td>
                        <td><?php echo utf8_encode($orden_enabled['asesor']); ?></td>
                        <td><?php echo $orden_enabled['fecha_creacion']; ?></td>                    
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }*/
    $data = [];
    if((isset($_GET['criterio1']) && $_GET['criterio1'] == '1') && (isset($_GET['texto']) && $_GET['texto'] != '')){
        $where = "WHERE orden.planilla = :planilla";
        $data[':planilla'] = $_GET['texto'];
    }else if((isset($_GET['criterio1']) && $_GET['criterio1'] == '2') && (isset($_GET['texto']) && $_GET['texto'] != '')){
        $where = "WHERE orden.lote = :lote";
        $data[':lote'] = $_GET['texto'];
    }else{
        echo json_encode(['data'=> [], 'draw'=> 1, 'recordsTotal'=> '0', 'recordsFiltered'=> '0' ]);
        exit;
    }
    $objs = array();
    $conn = new Conexion();
    $SQL = "SELECT orden.id, 
                   user.name, 
                   orden.planilla, 
                   orden.lote, 
                   orden.cantidad_formularios, 
                   orden.devoluciones, 
                   orden.total_formularios, 
                   orden.estado_aprobacion, 
                   orden.no_llegaron
              FROM ordenproduccion orden 
              LEFT JOIN user ON user.id = orden.id_user 
             $where
               AND estado = '0'
             ORDER BY orden.planilla DESC, orden.lote DESC";
    if($conn->consultar($SQL, $data)){
        if($conn->getNumeroRegistros() > 0){
            $cont = 0;
            while($obj = $conn->sacarRegistro('str')){
                $obj['inicio'] = '';
                if($obj['estado_aprobacion'] == 'Sin aprobar'){
                    $obj['inicio'] = '<input type="checkbox" name="check_'.$obj['id'].'" id="check_'.$obj['id'].'" value="'.$obj['id'].'"><a href="" onClick="window.open(\'editOrden.php?orden='.$obj['id'].'\', \'\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbar=no,resizable=no,width=420,height=200,top=85,left=140\'); return false;" id="a_edit_orden_'.$obj['id'].'"><img src="../../resources/images/icons/edit.png" alt="Editar"/></a><a href="#" onclick="$(this).eliminarOrderProduccion(event, '.$obj['id'].');" id="a_del_orden_'.$obj['id'].'"><img src="../../resources/images/icons/cross.png" alt="Eliminar"/></a>';
                }
                $obj['form_digitado'] = Ordenproduccion::getCountForms2($obj['planilla'], $obj['lote']);
                $obj['form_devolucion'] = Ordenproduccion::getCount2($obj['lote'], "0"); 
                $obj['form_noLlegaron'] = Ordenproduccion::getNoLlegaronForms($obj['lote']);
                $obj['acciones'] = '';
                $obj['se_puede_aprobar'] = false;
                $procesados = intval($obj['form_digitado']) + intval($obj['form_devolucion']) + intval($obj['form_noLlegaron']);
                if ($obj['cantidad_formularios'] == $procesados && (intval($obj['form_digitado']) == $obj['total_formularios']) && (intval($obj['form_devolucion']) == $obj['devoluciones']) && (intval($obj['form_noLlegaron']) == $obj['no_llegaron'])){
                    if($obj['estado_aprobacion'] == 'Sin aprobar'){
                        //$obj['acciones'] = '<a href="#" onclick="window.open(\'validacionOrden.php?orden='.$obj['id'].'&cantidad_datos='.($obj['devoluciones'] + $obj['total_formularios']).'\', \'\', \'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=600, height=300, top=85, left=140\');" class="button">Aprobar</a>';
                        $obj['acciones'] = '<a href="#" onclick="$(this).aprobarOrderProduccion(event, '.$obj['id'].', \''.($obj['devoluciones'] + $obj['total_formularios']).'\', 1);" class="button" id="button_aprobar_'.$obj['id'].'">Aprobar</a><div id="div_img_loading_'.$obj['id'].'" style="width: 16px; height: 16px; display: none;"><img src="../../images/icons/loading.gif"><div>';
                        $obj['se_puede_aprobar'] = true;
                    }else
                        $obj['acciones'] = '<img src="../../resources/images/icons/tick_circle.png" alt="icon" class="aprobado">';
                }else{
                    $obj['acciones'] = 'No esta lista para aprobaci&oacute;n.';
                    if($obj['estado_aprobacion'] != 'Sin aprobar')
                        $obj['inicio'] = 'Error';
                    else
                        $obj['inicio'] = '<input type="checkbox" name="check_'.$obj['id'].'" id="check_'.$obj['id'].'" value="'.$obj['id'].'" disabled="disabled"><a href="" onClick="window.open(\'editOrden.php?orden='.$obj['id'].'\', \'\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbar=no,resizable=no,width=420,height=200,top=85,left=140\'); return false;" id="a_edit_orden_'.$obj['id'].'"><img src="../../resources/images/icons/edit.png" alt="Editar"/></a><a href="#" onclick="$(this).eliminarOrderProduccion(event, '.$obj['id'].');" id="a_del_orden_'.$obj['id'].'"><img src="../../resources/images/icons/cross.png" alt="Eliminar"/></a>';
                }

                $objs['data'][] = $obj;
                $cont++;
            }
            $objs['draw'] = 1;
            $objs['recordsTotal'] = $cont;
            $objs['recordsFiltered'] = $cont;
        }
    }
    echo json_encode($objs);
}
if($action == "search_orden1"){
    $orden = new Ordenproduccion();
    $result_search = $orden->search($criterio1, $texto);
    $count_results = mysqli_num_rows($result_search);

    if ($count_results > 0) {
        ?>
        <table>
            <thead>
                <tr>
                    <th>Consecutivo</th>
                    <th>Asignado a</th>
                    <th>Planilla</th>
                    <th>Lote</th>                        
                    <th>Cantidad Formularios</th>     
                    <th>Devoluciones</th>
                    <th>Fecha</th>
                    <th>Total Formularios</th>
                    <th>Asesor</th>
                    <th>Fecha de Creaci�n</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="6">

                        <div class="pagination">
                            <a href="#" title="First Page">&laquo; Primero</a><a href="#" title="Previous Page">&laquo; Anterior</a>
                            <a href="#" class="number current" title="1">1</a>
                            <a href="#" title="Next Page">Siguiente &raquo;</a><a href="#" title="Last Page">�ltimo &raquo;</a>
                        </div> <!-- End .pagination -->
                        <div class="clear"></div>
                    </td>
                </tr>
            </tfoot>

            <tbody id="list_users">
                <?php
                while ($orden_enabled = mysqli_fetch_array($result_search)) {
                    ?>
                    <tr>
                        <td><?php echo $orden_enabled['id']; ?></td>
                        <td><?php echo utf8_encode($orden_enabled['usuario']); ?></td>
                        <td><?php echo $orden_enabled['planilla']; ?></td>
                        <td><?php echo $orden_enabled['lote']; ?></td>
                        <td><?php echo $orden_enabled['cantidad_formularios']; ?></td>
                        <td><?php echo $orden_enabled['devoluciones']; ?></td>
                        <td><?php echo $orden_enabled['fecha']; ?></td>
                        <td><?php echo $orden_enabled['total_formularios']; ?></td>
                        <td><?php echo utf8_encode($orden_enabled['asesor']); ?></td>
                        <td><?php echo $orden_enabled['fecha_creacion']; ?></td>                    
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }
}
if($action == "ordenadd_masiva"){
	$file = $_FILES['file'];
	if(file_exists($file['tmp_name']) && (mime_content_type($file['tmp_name']) !== 'text/plain')){
		echo json_encode(array("error"=> "Esta intentando adjuntar un archivo con un formato diferente al requerido"));
		exit();
	}

	$handle = fopen($file['tmp_name'], "r");
	if($handle){
		$conn = new Conexion();
		$i = 0;
		$crea = 0;
		while(!feof($handle)){
			$buffer = fgets($handle, 1024);
			if($buffer != ''){

				$buffer = trim($buffer, " \n\r\t");
				$buffer = preg_replace('/\*/', ' ', $buffer);

				$datos_leer = explode(";", $buffer);
				if($i > 0){
					$siPuede = true;
					foreach ($datos_leer as $key => $value) {
						if($value == '')
							$siPuede = false;
					}
					if($siPuede){
						$SQI = "INSERT INTO ordenproduccion
								(
									id_user, planilla, lote, asesor, cantidad_formularios, 
									devoluciones, no_llegaron, fecha, total_formularios
								)
								VALUES
								(
									:id_user, :planilla, :lote, :asesor, :cantidad_formularios, 
									:devoluciones, :no_llegaron, :fecha, :total_formularios
								)";
						$dat = array(
							':id_user'=> $_SESSION['id'], 
							':planilla'=> $_POST['planilla'], 
							':lote'=> trim(preg_replace("/\s+/", " ", $datos_leer[0])), 
							':asesor'=> $_SESSION['id'], 
							':cantidad_formularios'=> trim(preg_replace("/\s+/", " ", $datos_leer[4])), 
							':devoluciones'=> trim(preg_replace("/\s+/", " ", $datos_leer[1])), 
							':no_llegaron'=> trim(preg_replace("/\s+/", " ", $datos_leer[2])), 
							':fecha'=> date('Y-m-d', strtotime($_POST['fecha_recepcion'])), 
							':total_formularios'=> trim(preg_replace("/\s+/", " ", $datos_leer[3]))
						);
						if($conn->ejecutar($SQI, $dat))
							$crea++;
					}
				}else{
					$column = checkColumnsAsignaciones($datos_leer, '1');
					if(!is_null($column)){
						echo json_encode(array("error"=> "La estructura del archivo no es consistente\n$column"));
						exit();
					}
				}
				unset($datos_leer);
				$i++;
			}
		}
		$resp = "Se insertaron ".$crea." ordenes de produccion.";
		echo json_encode(array("exito"=> "Cargue completado con exito", "resp"=> $resp));
	}else{
		echo json_encode(array("error"=> "No se pudo abrir el archivo"));
		exit();
	}
}
if(isset($_GET['action']) && $_GET['action'] == "buscarTodasLasOrdenes"){
	//echo json_encode(array($_POST, $_FILES['file']));
	//exit();
    $where = "WHERE DATE(orden.date_created) >= '2015-01-01'";
    if(isset($_SESSION['id']) && !empty($_SESSION['id']) && !is_null($_SESSION['id']) && $_SESSION['id'] == '1')
        $where = "WHERE DATE(orden.date_created) >= '2020-01-01'";
	$objs = array();
	$conn = new Conexion();
	$SQL = "SELECT orden.id, 
				   user.name, 
				   orden.planilla, 
				   orden.lote, 
				   orden.cantidad_formularios, 
				   orden.devoluciones, 
				   orden.total_formularios, 
				   orden.estado_aprobacion, 
				   orden.no_llegaron/*,
                   d.total AS total_devoluciones*/
			  FROM ordenproduccion orden 
			  LEFT JOIN user ON user.id = orden.id_user 
              /*LEFT JOIN v_devoluciones_form AS d ON(d.lote = orden.lote)*/
			 $where
               AND orden.estado = '0'
               /*AND orden.planilla = 4895
               AND orden.lote IN (55521, 55537, 59388, 59494, 63606, 63609, 63645, 63903, 63941, 63948, 63953, 63968, 63994, 64107, 64126, 64146, 64233, 64292, 64779, 64801, 64802, 64866, 64979, 65046, 65048, 65072, 65115, 65117, 65132, 65167, 65174, 65250, 65253, 65291, 65309, 65312, 65327, 65389, 65392, 65542, 65603, 65621, 65623, 65634, 65649, 65664, 65665, 65718, 65723, 65729, 65752, 65756, 65823, 65824, 65832, 65848, 65852, 65870, 65886, 65890, 65975, 66007, 66064, 66141, 66156, 66160, 66201, 66228, 66317, 66320, 66332, 66352, 66353, 66367, 66372, 66375, 66410, 66477, 66502, 66533, 66555, 66568, 66593, 66638, 66755, 66857, 66949, 66950, 66964, 66996, 67027, 67206, 67210, 67325, 67414, 67503, 67565)
               AND orden.lote IN (65649)*/
			 ORDER BY orden.planilla DESC, orden.lote DESC";
	if($conn->consultar($SQL)){
		if($conn->getNumeroRegistros() > 0){
			$cont = 0;
			while($obj = $conn->sacarRegistro('str')){
    			$obj['inicio'] = '';
    			if($obj['estado_aprobacion'] == 'Sin aprobar'){
    				$obj['inicio'] = '<input type="checkbox" name="check_'.$obj['id'].'" id="check_'.$obj['id'].'" value="'.$obj['id'].'"><a href="" onClick="window.open(\'editOrden.php?orden='.$obj['id'].'\', \'\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbar=no,resizable=no,width=420,height=200,top=85,left=140\'); return false;" id="a_edit_orden_'.$obj['id'].'"><img src="../../resources/images/icons/edit.png" alt="Editar"/></a><a href="#" onclick="$(this).eliminarOrderProduccion(event, '.$obj['id'].');" id="a_del_orden_'.$obj['id'].'"><img src="../../resources/images/icons/cross.png" alt="Eliminar"/></a>';
    			}
    			$obj['form_digitado'] = Ordenproduccion::getCountForms2($obj['planilla'], $obj['lote']);
    			$obj['form_devolucion'] = Ordenproduccion::getCount2($obj['lote'], "0"); 
    			$obj['form_noLlegaron'] = Ordenproduccion::getNoLlegaronForms($obj['lote']);
    			$obj['acciones'] = '';
                $obj['se_puede_aprobar'] = false;
    			$procesados = intval($obj['form_digitado']) + intval($obj['form_devolucion']) + intval($obj['form_noLlegaron']);
    			if ($obj['cantidad_formularios'] == $procesados && (intval($obj['form_digitado']) == $obj['total_formularios']) && (intval($obj['form_devolucion']) == $obj['devoluciones']) && (intval($obj['form_noLlegaron']) == $obj['no_llegaron'])){
    				if($obj['estado_aprobacion'] == 'Sin aprobar'){
    					//$obj['acciones'] = '<a href="#" onclick="window.open(\'validacionOrden.php?orden='.$obj['id'].'&cantidad_datos='.($obj['devoluciones'] + $obj['total_formularios']).'\', \'\', \'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=600, height=300, top=85, left=140\');" class="button">Aprobar</a>';
                        $obj['acciones'] = '<a href="#" onclick="$(this).aprobarOrderProduccion(event, '.$obj['id'].', \''.($obj['devoluciones'] + $obj['total_formularios']).'\', 1);" class="button" id="button_aprobar_'.$obj['id'].'">Aprobar</a><div id="div_img_loading_'.$obj['id'].'" style="width: 16px; height: 16px; display: none;"><img src="../../images/icons/loading.gif"><div>';
                        $obj['se_puede_aprobar'] = true;
    				}else
    					$obj['acciones'] = '<img src="../../resources/images/icons/tick_circle.png" alt="icon" class="aprobado">';
    			}else{
    				$obj['acciones'] = 'No esta lista para aprobaci&oacute;n.';
                    if($obj['estado_aprobacion'] != 'Sin aprobar')
                        $obj['inicio'] = 'Error';
                    else
                        $obj['inicio'] = '<input type="checkbox" name="check_'.$obj['id'].'" id="check_'.$obj['id'].'" value="'.$obj['id'].'" disabled="disabled"><a href="" onClick="window.open(\'editOrden.php?orden='.$obj['id'].'\', \'\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbar=no,resizable=no,width=420,height=200,top=85,left=140\'); return false;" id="a_edit_orden_'.$obj['id'].'"><img src="../../resources/images/icons/edit.png" alt="Editar"/></a><a href="#" onclick="$(this).eliminarOrderProduccion(event, '.$obj['id'].');" id="a_del_orden_'.$obj['id'].'"><img src="../../resources/images/icons/cross.png" alt="Eliminar"/></a>';
                }

    			$objs['data'][] = $obj;
    			$cont++;
			}
			$objs['draw'] = 1;
			$objs['recordsTotal'] = $cont;
			$objs['recordsFiltered'] = $cont;
		}
	}
	echo json_encode($objs);
}
if($action == "delete_case"){
	$conn = new Conexion();
	$SQL = "INSERT INTO `workflow_borrados` 
			(
				`id`, `id_client`, `id_user`, `causal`, `id_official`, `observation`, `date_created`, 
				`status`, `persontype`, `documento`, `nombre`, `id_radicado`, `id_sucursal`, 
				`id_area`, `lote`, `estado`, `fecha_creacion`
			) SELECT *, NOW() 
				FROM workflow 
			   WHERE id = :id";
	if($conn->ejecutar($SQL, array(":id"=> $_POST['case']))){
		if($conn->ejecutar("DELETE FROM workflow WHERE id = :id", array(":id"=> $_POST['case']))){
			$conn->desconectar();
			echo json_encode(array("exito"=> "La eliminacion se realizo con exito"));
		}else{
			$conn->desconectar();
			echo json_encode(array("error"=> "No se pudo realizar la eliminacion del registro duplicado, pero si la copia, contacte con el administrador."));
		}
	}else{
		$conn->desconectar();
		echo json_encode(array("error"=> "No se pudo realizar la copia del registro, contacte con el administrador."));
	}
}
function checkColumnsAsignaciones($datos_leer, $proceso_id){
	$out = null;
	$structure = array();
	switch ($proceso_id) {
		case '1':
			$structure = array(
				'fields' => array(
					'LOTE'=> '',
					'DEVUELTO'=> '',
					'NO ENVIADO'=> '',
					'PUBLICADOS'=> '',
					'RADICADOS'=> ''
				)
			);
			break;
		default:
			$structure = array(
				'fields' => array(
					'LOTE'=> '',
					'DEVUELTO'=> '',
					'NO ENVIADO'=> '',
					'PUBLICADOS'=> '',
					'RADICADOS'=> ''
				)
			);
			break;
	}
	if(!is_array($datos_leer))
		$datos_leer = array();
		
	foreach ($structure['fields'] AS $field => $value){
		$field = trim($field);
		if(strlen($field) > 0){
			if(!in_array($field , $datos_leer)){
				$out .= "$field, ";
			}
		}
	}
	if($out != null){
		$out .= "Se encontraron las siguientes columnas:\n\n";
		$out = "Faltaron las siguientes columnas:\n\n$out";
	}
	return $out;
}
if($action == "crearMeta"){
	//echo json_encode($_POST);
	if(!isset($_SESSION['id']) || empty($_SESSION['id']) || is_null($_SESSION['id'])){
		echo json_encode(array('error'=> 'Su sesion a caducado, o no la ha iniciado, por favor abra una nueva pestaña, inicie sesion e intente nuevamente crear la meta.'));
		exit();
	}
	$_POST['periodo'] = date('Y-m-d', strtotime($_POST['fecha']));
	$_POST['creador_id'] = $_SESSION['id'];
	$met = new Meta();
	$met->setAtributos($_POST);
	try{
		if($rMet = $met->registrar())
			echo json_encode($rMet);
		else
			echo json_encode(array('error'=> 'Ocurrio un error al momento de guardar la meta, contacte con el administrador.'));
	}catch(PDOException $Exception){
		echo json_encode(array('error'=> $Exception->getMessage()."::".$Exception->getCode()));
	}
}
if($action == "reporteProductivivdadDiaria"){
	if($resRep = Meta::reporteProductivivdadDiaria($_POST['fecha'])){
		echo json_encode($resRep);
	}else{
		echo json_encode(array('error'=> 'Ocurrio un error al realizar la consulta, contacte con el administrador...'));
	}
}
if($action == "reporteProductividadRango"){
	if($resRep = Meta::reporteProductividadRango($_POST['fechaini'], $_POST['fechafin'], $_POST['gestor_id'], $_POST['tarea_id'])){
		echo json_encode($resRep);
	}else{
		echo json_encode(array('error'=> 'Ocurrio un error al realizar la consulta, contacte con el administrador...'));
	}
}
?>