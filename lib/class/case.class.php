<?php

include $_SERVER['DOCUMENT_ROOT'].'/Aplicativos.Serverfin04' . '/Colpatria/config/globalParameters.php';

class Cases {
    function insertCase($id_user, $id_official, $causal, $observation, $sucursal, $area, $nombre, $persontype, $documento, $lote) {
        $sql = "INSERT INTO workflow(id_user,causal,id_official, observation,persontype,documento,nombre,id_sucursal,id_area,lote) 
                VALUES( '$id_user','$causal','$id_official','$observation',$persontype, '$documento','$nombre','$sucursal','$area','$lote')";
        if (mysqli_query($GLOBALS['link'], $sql))
            return true;
        else
            return false;
    }
    
    function getCases($id_user) {
        $sql = "SELECT us.name  AS username, workflow.causal AS causal, workflow.observation AS observation,
                offi.name  AS officialname, workflow.date_created AS date_created
                FROM user us 
                INNER JOIN workflow ON us.id = workflow.id_user 
                INNER JOIN official offi ON offi.id = workflow.id_official 
                WHERE workflow.id_user = '$id_user' AND workflow.status = '1'";
        return mysqli_query($GLOBALS['link'], $sql);
    }


    function getCasesSearch($criterio,$texto) {

	if( !empty($texto) && $criterio == "2") {
		$complemento = "  workflow.lote = '$texto' ";
	} else {
		$complemento = "  workflow.documento = '$texto' ";
	} 
        $sql = "SELECT us.name  AS username, workflow.causal AS causal, workflow.observation AS observation,
                offi.name  AS officialname, workflow.date_created AS date_created, workflow.documento AS documento, workflow.lote AS lote, workflow.id AS id 
                FROM user us 
                INNER JOIN workflow ON us.id = workflow.id_user 
                INNER JOIN official offi ON offi.id = workflow.id_official 
                WHERE $complemento AND workflow.status = '1' ";
        //echo $sql;
       return mysqli_query($GLOBALS['link'], $sql);
    }

     function getCount( $lote,$flag) {
		$sql = "SELECT COUNT(*) AS total FROM workflow WHERE lote = '$lote' AND status = '1'";
		$result = mysqli_fetch_array(mysqli_query($GLOBALS['link'], $sql));
		$total = "";
		if(  $result['total'] > 0 ) 	{	
			if( $flag == "1")
				$total = $total." - ";	
			$total = $total.$result['total']." en devoluci&oacute;n.";		
		}
  		else {
			if( $flag == "1")
				$total = $total." - ";	
			$total = $total." 0 en devoluci&oacute;n.";
		}
	        return $total;
	}

     static function getCount2( $lote,$flag) {
        $sql = "SELECT COUNT('x') AS total 
                  FROM workflow 
                 WHERE lote = '$lote' 
                   AND status = '1'";
        $result = mysqli_fetch_array(mysqli_query($GLOBALS['link'], $sql));
        $total = "";
        if(  $result['total'] > 0 )     {   
            if( $flag == "1")
                $total = $total." - ";  
            $total = $total.$result['total']." en devoluci&oacute;n.";      
        }
        else {
            if( $flag == "1")
                $total = $total." - ";  
            $total = $total." 0 en devoluci&oacute;n.";
        }
            return $total;
    }

	function getLotes() {
		$sql = "SELECT DISTINCT(lote) AS lote FROM workflow WHERE status = '1' GROUP BY lote";
		return mysqli_query($GLOBALS['link'], $sql);
	}

	function getCase($id_case) {			
		$sql = "SELECT documento,lote,nombre FROM workflow WHERE id = '$id_case' AND status = '1' ";
		return mysqli_query($GLOBALS['link'], $sql);
	}
}
?>