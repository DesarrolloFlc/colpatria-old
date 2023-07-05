<?php
ini_set("log_errors", 1);
$handle = mysqli_connect('localhost', 'colpatria_sgd', 'colpatria_sgd', 'colpatria_sgd');
if($handle){
	echo "CONECTADO...<br>";
	/*if(mysql_select_db(,$handle)){
		//mysqli_query($handle, "SET CHARACTER SET latin1");
		echo "CONECTADO A LA BASE DE DATOS colpatria_sgd<br>";
	}else{
		echo "Error tratando de seleccionar la base de datos [colpatria_sgd]<br>";
		exit();
	}*/
}else{
	echo "no se pudo conectar al host<br>";
	exit();
}
$dir = 'files';
// Abrir un directorio conocido, y proceder a leer sus contenidos
if (is_dir($dir)) {
	//echo "aca1";
	if ($gd = opendir($dir)) {
		//echo "aca2";
		while ($archivo = readdir($gd)) {
			//echo "aca3";
			$parttipe = explode('.', $archivo);
			if (strtolower($parttipe[1]) == 'tif' || strtolower($parttipe[1]) == 'tiff') {
			//echo "aca4";
				$tipofile = explode('_', $archivo);
				if (count($tipofile) == 1 || count($tipofile) == 2) {//PLANILLA422_.tif
					if(count($tipofile) == 1)
						$plnum = explode('.', $archivo);
					elseif(count($tipofile) == 2)
						$plnum = explode('_', $archivo);
					
					$planilla = substr($plnum[0], 8);
					$SQL = "INSERT INTO planilla 
							(planilla, directory, filename, description) 
							VALUES ('$planilla','planillas', '$archivo', 'PLANILLA')";
					echo $SQL."<br>";
					if(mysqli_query($handle, $SQL)) echo "INSERTADO<br>";
					else echo "NO INSERTADO<br>";
					echo "nombre de archivo: $archivo : tipo de archivo: PLANILLA <br>";
					$nuevo_archivo = '../../../../../planillas_colpatria/'.$archivo;
					if (copy('files/'.$archivo, $nuevo_archivo)) {
					    echo "archvi copiado $archivo...<br>";
					    if(unlink('files/'.$archivo)){
					    	echo "el archivo fue eliminado...<br><br>";
					    }else
					    	echo "no se pudo eliminar el archivo<br><br>";
					}else
						echo "Error al copiar $archivo...<br><br>";
				}elseif(count($tipofile) == 3){//PLANILLA416_LOTE_6467.tif
					$plnum = explode('_', $archivo);
					$planilla = substr($plnum[0], 8);
					$lastpart = explode('.', $plnum[2]);
					$lote = $lastpart[0];
					$SQL1 = "INSERT INTO planilla 
							(planilla, lote, directory, filename, description) 
							VALUES ('$planilla', '$lote', 'planillas', '$archivo', 'PLANILLA_LOTE')";
					echo $SQL1."<br>";
					mysqli_query($handle, $SQL1);
					echo "nombre de archivo: $archivo : tipo de archivo: LOTE <br>";
					$nuevo_archivo = '../../../../../planillas_colpatria/'.$archivo;
					if (copy('files/'.$archivo, $nuevo_archivo)) {
					    echo "archvi copiado $archivo...<br>";
					    if(unlink('files/'.$archivo)){
					    	echo "el archivo fue eliminado...<br><br>";
					    }else
					    	echo "no se pudo eliminar el archivo<br><br>";
					}else
						echo "Error al copiar $archivo...<br>";
				}				
			}			
		}
		closedir($gd);
	}
}else{
	echo "no es dir";
}
?>