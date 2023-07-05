<?php

require_once PATH_SITE . DS . 'config/globalParameters.php';

class File
{

    function getImagesFolder($namefile) {
        $folders = array();
        $counter = 0;
        if (is_dir("../../tmp_images/". $namefile)) {
            if ($dh = opendir("../../tmp_images/".$namefile)) {
                while (($file = readdir($dh)) !== false) {
                    if (file_exists("../../tmp_images/". $namefile . "/" . $file) && $file != "." && $file != ".." && $file != "Thumbs.db") {
                        $counter++;
                    }
                }
            }
        }
        return $counter;
    }

    function getImagesToInsert($folders, $id_user) {
        $total = count($folders);
        $counter = 0;
        for ($i = 0; $i < $total; $i++) {
            if (is_dir("../../tmp_images/".$folders[$i]) && $folders[$i] != "." && $folders[$i] != ".." && $folders[$i] != "Thumbs.db") {
                $ar_images = scandir("../../tmp_images/". $folders[$i]);
                $total_insert = $this->insertImages($ar_images, $id_user, $folders[$i]);
                $counter+=$total_insert;
            }
        }
        return $counter;
    }

    function getImages() {
        if (file_exists("../../tmp_images")) {
            return scandir("../../tmp_images");
        } else {
            error_log("ERROR");
        }
    }

    function countImagesTmp() {
        $sql = "SELECT COUNT(*) AS total FROM image_tmp WHERE status = '1'";
        return mysqli_fetch_array(mysqli_query($GLOBALS['link'], $sql));
    }

    function insertImages($ar_images, $id_user, $directory) {
        $total = count($ar_images);
        $cantidad_insertada = 0;
        for ($i = 0; $i < $total; $i++) {
            //Buscar si imagen esta insertada
            $sql0 = "SELECT COUNT(*) AS total 
                       FROM image_tmp 
                      WHERE filename = '".$ar_images[$i]."' 
                        AND directory = '".$directory."'";
            $existe_imagen = mysqli_fetch_array(mysqli_query($GLOBALS['link'], $sql0));

            if( !($existe_imagen['total'] > 0) ) {
                if ($ar_images[$i] != "." && $ar_images[$i] != ".." && $ar_images[$i] != "Thumbs.db") {
                    $sql = "INSERT INTO image_tmp
                            (
                                filename, id_user, date_uploaded, directory
                            )
                            VALUES
                            (
                                '{$ar_images[$i]}', $id_user, '" . $this->getDate() . "', '$directory'
                            )";
                    if (mysqli_query($GLOBALS['link'], $sql))
                        $cantidad_insertada++;
                }
            }
        }
        return $cantidad_insertada;
    }

    function getDate() {
        return date("Y-m-d h:m:s");
    }

}