<?php

require_once PATH_SITE . DS . 'config/globalParameters.php';

class Image {

    function getImageDB( $id_user ) {
        $sql = "SELECT user.username AS username,image_tmp.filename  AS filename, image_tmp.id AS id
                FROM image_tmp INNER JOIN user ON user.id = image_tmp.id_user
                WHERE image_tmp.status = '1' AND image_tmp.directory = '$id_user' ORDER BY filename ASC LIMIT 1";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getImages($status, $id_user) {
        if (!empty($status)) {
            $complemento = "WHERE status = '$status' AND directory= '{$_SESSION['id']}'";
        }
        $sql = "SELECT COUNT(*) AS total FROM image_tmp $complemento";
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

    function getName($id) {
        $sql = "SELECT filename FROM image_tmp WHERE id = '$id'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function save($file, $id_form, $imagetype, $id_user) {
        global $PATH_IMAGES_TMP, $PATH_IMAGES, $DIR_DEFAULT;
        $file_origen = "/var/www/Colpatria/tmp_images/" .$id_user."/".$file;
        
        $onlyname = explode(".", $file);
        $unique_name = md5(uniqid(rand(), true)); 
        $finalname = $unique_name."_".$imagetype.".".$onlyname[count($onlyname)-1];
        
        $file_destino =  "/var/www/images_colpatria/". $finalname;
	
        if (copy($file_origen, $file_destino)) {
            if ($this->add($id_form, $imagetype,$finalname,$DIR_DEFAULT) == 0)
                return 0;
        }
        else {
                return 1;
        }
    }

    function add($id_form, $imagetype,$filename,$dst) {
        $sql = "INSERT INTO image(id_forma,id_imagetype,directory,filename)
                VALUES('$id_form','$imagetype','$dst','$filename')";
        if (mysqli_query($GLOBALS['link'], $sql))
            return 0;
        else
            return 1;
    }
    
    function getCountImage($id_forma) {
        $sql = "SELECT COUNT(*) AS total FROM image WHERE id_forma = '$id_forma'";
        return mysqli_query($GLOBALS['link'], $sql);
    }
    
    function getImagesForm($id_forma) {
        $sql = "SELECT * FROM image WHERE id_forma = '$id_forma'";
        return mysqli_query($GLOBALS['link'], $sql);        
    }
    
    function getFirstImageForm( $id_forma )  {
        $sql = "SELECT * FROM image WHERE id_forma = '$id_forma' ORDER BY date_created ASC LIMIT 1";        
        return mysqli_query($GLOBALS['link'], $sql);        
    }
    
    function getImageForm($id_image) {
        $sql = "SELECT * FROM image WHERE id = '$id_image' ";  
        return mysqli_query($GLOBALS['link'], $sql);    
    }
    
}