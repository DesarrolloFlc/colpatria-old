<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'client.class.php';
$action = $_POST['action'];
if($action == 'generarBaseMarcador'){
    $_POST['FILE'] = $_FILES;
}
call_user_func($action, $_POST);

function generarBaseMarcador($request){
    ini_set('memory_limit', '-1');
    set_time_limit(0);
    if(isset($request['FILE'])){
        if(isset($request['FILE']['file_marcador']['size']) && $request['FILE']['file_marcador']['size'] >= '2063686'){
            echo "<script>parent.alert('El archivo adjunto no debe ser mayo a 2MB');</script>";
            exit();
        }
        if(isset($request['FILE']['file_marcador']['type']) && !tipoCSV($request['FILE']['file_marcador']['type'])){
            echo "<script>parent.alert('Esta intentando adjuntar un archivo con un formato diferente al requerido');</script>";
            exit();
        }
        $name = 'MP';
        $camp = '';
        $proceso = $request['proceso_id'];
        if ($proceso == '1') {
            $name .= 'SEG';
            $camp = 'CLS';
        }elseif($proceso == '2'){
            $name .= 'CAP';
            $camp = 'COL';
        }else{
            echo "<script>parent.alert('No selecciono el proceso o selecciono una opcion indebida.');</script>";
            exit();
        }
        if ($request['tipo_marcacion'] == '1')
            $name .= 'LOC'.date('dmYs');
        else if($request['tipo_marcacion'] == '2')
            $name .= 'NAC'.date('dmYs');
        else if($request['tipo_marcacion'] == '3')
            $name .= 'CEL'.date('dmYs');

        //fputcsv($fh, array($dial.$indicativo.$telefono, $camp.$consulta['id']), ',');
        //fputcsv($fh, array('6638598', 'SOL1', $proceso, 1), ',');
        $handle = fopen($request['FILE']['file_marcador']['tmp_name'], "r");
        if($handle){
            $i = 0;
            $objetos = array();
            while(!feof($handle)){
                if($i > 0){
                    $buffer = fgets($handle, 4096);
                    $datos_leer = explode(";",$buffer);

                    $documento = trim($datos_leer[0]);
                    $telefono = trim($datos_leer[1]);
                    $dial = '';
                    $indicativo = '';
                    if($request['tipo_marcacion'] == '2'){
                        $dial = '05';
                        $indicativo = trim($datos_leer[2]);
                    }elseif($request['tipo_marcacion'] == '3'){
                        $dial = trim($datos_leer[2]);
                        $indicativo = '';
                    }
                    $datos = Client::getClientes($documento);
                    if(isset($datos) && is_array($datos)){
                        foreach($datos as $dato)
                            $objetos[] = array($dial.$indicativo.$telefono, $camp.$dato['id']);
                            //fputcsv($fh, array($dial.$indicativo.$telefono, $camp.$dato['id']), ',');
                    }
                    unset($datos);
                }else{
                    $buffer = fgets($handle, 4096);
                    $datos_leer = explode(";",$buffer);
                    $resp = false;
                    if($request['tipo_marcacion'] == '1'){
                        if(strtolower(trim($datos_leer[0])) !== 'documento' || strtolower(trim($datos_leer[1])) !== 'telefono')
                            $resp = true;
                    }elseif($request['tipo_marcacion'] == '2'){
                        if(strtolower(trim($datos_leer[0])) !== 'documento' || strtolower(trim($datos_leer[1])) !== 'telefono' || strtolower(trim($datos_leer[2])) !== 'indicativo')
                            $resp = true;
                    }elseif($request['tipo_marcacion'] == '3'){
                        if(strtolower(trim($datos_leer[0])) !== 'documento' || strtolower(trim($datos_leer[1])) !== 'telefono' || strtolower(trim($datos_leer[2])) !== 'linea')
                            $resp = true;
                    }
                    if($resp === true){
                        echo "<script>parent.alert('La estructura del archivo no es consistente');</script>";
                        exit();
                    }
                }
                unset($datos_leer);
                $i++;
            }
            fclose($handle);
            if(!empty($objetos)){
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Content-Description: File Transfer");
                header("Content-Encoding: UTF-8");
                header("Content-Type: text/csv; charset=UTF-8");
                header("Content-Disposition: attachment; filename=".$name.".csv");
                header("Expires: 0");
                header("Pragma: public");
                echo "\xEF\xBB\xBF"; // UTF-8 BOM

                $fh = fopen('php://output', 'w');
                foreach ($objetos as $objeto) {
                    fputcsv($fh, $objeto, ',');
                }
                // Close the file
                fclose($fh);
                unset($objetos);
                // Make sure nothing else is sent, our file is done
                //echo "<script>parent.$('form#generarBaseMarcador').reset();</script>";
                exit();
            }
        }else{
            echo "<script>parent.alert('No se pudo abrir el archivo');</script>";
            exit();
        }
    }else{
        echo "<script>parent.alert('No adjunto ningun archivo para la creacion de la base para marcador predictivo');</script>";
        exit();
    }
}
function tipoCSV($tipo){
    switch ($tipo) {
        case 'text/comma-separated-values':
            return true;
            break;
        case 'text/csv':
            return true;
            break;
        case 'application/csv':
            return true;
            break;
        case 'application/excel':
            return true;
            break;
        case 'application/vnd.ms-excel':
            return true;
            break;
        case 'application/vnd.msexcel':
            return true;
            break;
        case 'text/anytext':
            return true;
            break;
        
        default:
            return false;
            break;
    }
    return false;
}
?>