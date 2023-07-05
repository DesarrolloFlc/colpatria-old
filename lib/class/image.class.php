<?php

require_once PATH_SITE . DS . 'config/globalParameters.php';

class Image
{

    function getImageDB($id_user) {
        $sql = "SELECT user.username AS username,
                       image_tmp.filename AS filename, 
                       image_tmp.id AS id
                  FROM image_tmp 
                 INNER JOIN user ON(user.id = image_tmp.id_user)
                 WHERE image_tmp.status = '1' 
                   AND image_tmp.directory = '$id_user' 
                   AND filename LIKE 'LOTE%' 
                 ORDER BY filename ASC 
                 LIMIT 1";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getImageDBMG($id_client) {
        $sql = "SELECT *
                FROM migra_images
                WHERE id_client = $id_client AND status = '1' AND filename LIKE '%MULTI.tiff' ORDER BY filename ASC LIMIT 1";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getPlanilla($id_user) {
        $sql = "SELECT filename 
                  FROM image_tmp 
                 WHERE filename LIKE 'PLANILLA%' 
                   AND filename NOT LIKE '%_LOTE_%' 
                   AND directory = '$id_user' 
                   AND status = '1' 
                 LIMIT 1";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getPlanillaActiva($id_user) {
        $sql = "SELECT COUNT(*) as total FROM image_tmp WHERE filename LIKE 'PLANILLA%' AND directory = '$id_user' AND status = '1'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function disablePlanilla($id_user) {
        if (!empty($id_user)) {
            $sql = "UPDATE image_tmp SET status = '2' WHERE  directory = '$id_user' AND filename LIKE 'PLANILLA%' ";
            if (mysqli_query($GLOBALS['link'], $sql))
                return 0;
            else
                return -1;
        }
    }

    function getPlanillaLote($id_user, $lote) {
        $sql = "SELECT filename 
                  FROM image_tmp 
                 WHERE filename LIKE '%_" . $lote . "%' 
                   AND directory = '$id_user' 
                   AND status = '1' 
                 LIMIT 1";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getPlanillaLoteMG($id_client) {
        $sql = "SELECT filename FROM migra_images WHERE id_client = $id_client AND status = 1 LIMIT 1";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getPlanillas($id_user) {
        
    }

    function getNextImages($id_user, $id_image_actual) {
        $cantidad = 3;
        $sql = "SELECT filename
                  FROM image_tmp
                 WHERE image_tmp.status = '1' 
                   AND image_tmp.directory = '$id_user' 
                   AND filename LIKE 'LOTE%' 
                   AND id NOT LIKE '$id_image_actual' 
                 ORDER BY filename ASC 
                 LIMIT $cantidad";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getNextImagesMG($id_client, $filename) {
        $cantidad = 3;
        $sql = "SELECT filename
                FROM migra_images
                WHERE status = '1' AND id_client = $id_client AND filename NOT LIKE '$filename' ORDER BY filename ASC LIMIT $cantidad";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getImages($status, $id_user) {
        if (!empty($status)) {
            $complemento = "WHERE status = '$status' AND directory= '{$_SESSION['id']}' AND filename LIKE 'LOTE%' ";
        }
        $sql = "SELECT COUNT(*) AS total FROM image_tmp $complemento";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getImagesMG($status, $id_client) {
        $complemento = '';
        if (!empty($status)) {
            $complemento = "WHERE id_client = $id_client AND status = '$status'";
        }
        $sql = "SELECT COUNT(*) AS total FROM migra_images $complemento";
        //echo $sql;
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getLastForm() {
        $sql = "SELECT id_form FROM indexacion_log WHERE status = '1' LIMIT 1";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function changeStatusImgTemp($id, $status) {
        $sql = "UPDATE image_tmp SET status = '$status' WHERE id= '$id'";
        if (mysqli_query($GLOBALS['link'], $sql))
            return 0;
        else
            return -1;
    }

    function changeStatusImgTempMG($id, $status) {
        $sql = "UPDATE migra_images SET status = '$status' WHERE id_client= '$id'";
        if (mysqli_query($GLOBALS['link'], $sql))
            return 0;
        else
            return -1;
    }

    function getName($id) {
        $sql = "SELECT filename FROM image_tmp WHERE id = '$id'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getNameMG($id) {
        $sql = "SELECT filename FROM migra_images WHERE id = $id";
        return mysqli_query($GLOBALS['link'], $sql);
    }
    function save($file, $id_form, $imagetype, $id_user) {
        global $PATH_IMAGES_TMP, $PATH_IMAGES, $DIR_DEFAULT;
        $file_origen = "/var/www/html/Aplicativos.Serverfin04/Colpatria/tmp_images/".$id_user."/".$file;

        $onlyname = explode(".", $file);
        $unique_name = md5(uniqid(rand(), true));
        $finalname = $unique_name."_".$imagetype.".".$onlyname[count($onlyname) - 1];

        $file_destino = "/var/www/html/Aplicativos.Serverfin04/images_colpatria/".$finalname;
//        return copy($file_origen, $file_destino);

    /*if($_SESSION['id'] == 1){
        echo $file_origen.":::::::".$file_destino;
        $this->add($id_form, $imagetype, $finalname, $DIR_DEFAULT, $file);

    }*/
        if (@copy($file_origen, $file_destino)) {
            if ($this->add($id_form, $imagetype, $finalname, $DIR_DEFAULT, $file) == 0) {
                return 0;
            }
        } else {
            return 1;
        }
    }

    function saveMG($file, $id_form, $imagetype, $id_user, $document) {
        global $PATH_IMAGES_TMP, $PATH_IMAGES, $DIR_DEFAULT;
        $file_origen = "/var/www/html/migracion/" . $document[0] . "/" . $document . "/" . $file;


        $onlyname = explode(".", $file);
        $unique_name = md5(uniqid(rand(), true));
        $finalname = $unique_name . "_" . $imagetype . "." . $onlyname[count($onlyname) - 1];

        $file_destino = "/var/www/html/images_colpatria/" . $finalname;

        if (copy($file_origen, $file_destino)) {
            if ($this->add($id_form, $imagetype, $finalname, $DIR_DEFAULT, $file) == 0)
                return 0;
        }
        else {
            return 1;
        }
    }

    function add($id_form, $imagetype, $filename, $dst, $file) {
        $sql = "INSERT INTO image(id_forma,id_imagetype,directory,filename,original_file)
                VALUES('$id_form','$imagetype','$dst','$filename','$file')";
    if($_SESSION['id'] == 1){
        echo $sql;
        exit();
    }
        if (mysqli_query($GLOBALS['link'], $sql))
            return 0;
        else
            return 1;
    }

    function getCountImage($id_forma) {
        $sql = "SELECT COUNT(*) AS total FROM image WHERE id_forma = '$id_forma' AND status = '1'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getImagesForm($id_forma) {
        $sql = "SELECT * FROM image WHERE id_forma = '$id_forma' AND status = '1'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getFirstImageForm($id_forma) {
        $sql = "SELECT * FROM image WHERE id_forma = '$id_forma' AND id_imagetype NOT IN (2, 3, 4, 5)  AND status = '1' ORDER BY date_created ASC LIMIT 1";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getImageForm($id_image) {
        $sql = "SELECT * FROM image WHERE id = '$id_image'  AND status = '1'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getClienteMigracion() {
        $sql = "SELECT * FROM clientes_migracion WHERE estado = 0 LIMIT 1"; //; AND documento = '7222338'";
        //echo $sql;
        $resp = mysqli_query($GLOBALS['link'], $sql);
        $data = mysqli_fetch_array($resp);
        if ($data === null) return false;
        $id = $data['id'];
        $sql1 = "UPDATE clientes_migracion SET estado = 1 WHERE id = $id AND estado = 0";
        if (mysqli_query($GLOBALS['link'], $sql1))
            return $data;
        else
            return false;
    }
    static function guardarPlanillaLote($planillaLote, $logLote, $userId){
        $plPart = explode('_', $planillaLote);
        $planilla = 0;
        if(count($plPart) >= 3)
            $planilla = substr($plPart[0], 8);
        $lote = substr($logLote, 5);

        $sql = "SELECT COUNT('x') AS cantidad
                  FROM planilla 
                 WHERE planilla = '$planilla' 
                   AND lote = '$lote'
                   AND description = 'PLANILLA_LOTE'";
        $resp = mysqli_query($GLOBALS['link'], $sql);
        $numRows = mysqli_num_rows($resp);
        if($numRows == 1){
            $data = mysqli_fetch_array($resp);
            if(intval($data['cantidad']) == 0){
                $squ = "INSERT INTO planilla 
                        (
                            planilla, lote, directory, filename, description
                        ) 
                        VALUES
                        (
                            '$planilla', '$lote', 'planillas', '$planillaLote', 'PLANILLA_LOTE'
                        )";
                if(mysqli_query($GLOBALS['link'], $squ)){
                    $pathUser = '/var/www/html/Aplicativos.Serverfin04/Colpatria/tmp_images';
                    $pathPlanillas = '/var/www/html/Aplicativos.Serverfin04/planillas_colpatria';
                    if(!file_exists($pathPlanillas.'/'.$planillaLote))
                        copy($pathUser.'/'.$userId.'/'.$planillaLote, $pathPlanillas.'/'.$planillaLote);
                }
            }
        }
    }

}
