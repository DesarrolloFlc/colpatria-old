<?php
require_once PATH_SITE . DS . 'config/globalParameters.php';
require_once PATH_CLASS . DS . '_conexion.php';
class Form 
{
    function getLastId($id_client) {
        $sql = "SELECT * FROM form WHERE id_client = '$id_client' AND status = '1' AND id_user NOT IN (3691) ORDER BY date_created DESC LIMIT 1 ";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function update($id_form, $fecharadicado, $fechasolicitud, $sucursal, $area, $id_official, $formulario, $clasecliente, $primerapellido, $segundoapellido, $nombres, $tipodocumento, $documento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $lugarnacimiento, $sexo, $nacionalidad, $numerohijos, $estadocivil, $direccionresidencia, $ciudadresidencia, $telefonoresidencia, $nombreempresa, $ciudadempresa, $direccionempresa, $nomenclatura, $telefonolaboral, $celular, $correoelectronico, $cargo, $actividadeconomicaempresa, $profesion, $ocupacion, $detalleocupacion, $ciiu, $ingresosmensuales, $otrosingresos, $egresosmensuales, $conceptosotrosingresos, $tipoactividad, $nivelestudios, $tipovivienda, $estrato, $totalactivos, $totalpasivos, $razonsocial, $nit, $digitochequeo, $ciiu_, $ciudadoficina, $direccionoficinappal, $nomenclatura_emp, $telefonoficina, $faxoficina, $ciudadsucursal, $direccionsucursal, $nomenclatura_emp2, $telefonosucursal, $faxsucursal, $actividadeconomicappal, $detalleactividadeconomicappal, $tipoempresaemp, $activosemp, $pasivosemp, $ingresosmensualesemp, $egresosmensualesemp, $socio1, $socio2, $socio3, $monedaextranjera, $tipotransacciones, $firma, $huella, $lugarentrevista, $fechaentrevista, $horaentrevista, $tipohoraentrevista, $resultadoentrevista, $observacionesentrevista, $nombreintermediario, $id_user) {
        if (!empty($id_form) && !empty($id_user)) {
            $sql = "INSERT INTO data_backup (SELECT *,'" . $id_user . "',NOW() FROM data WHERE id_form = '$id_form')";
            if (mysqli_query($GLOBALS['link'], $sql)) {
                $sql0 = "UPDATE data SET 
				        fecharadicado='$fecharadicado',fechasolicitud='$fechasolicitud',sucursal='$sucursal',area='$area',
                        id_official='$id_official',formulario='$formulario',clasecliente='$clasecliente',primerapellido='$primerapellido',
                        segundoapellido='$segundoapellido',nombres='$nombres',tipodocumento='$tipodocumento',documento='$documento',
                        fechaexpedicion='$fechaexpedicion',lugarexpedicion='$lugarexpedicion',fechanacimiento='$fechanacimiento',
                        lugarnacimiento='$lugarnacimiento',sexo='$sexo',nacionalidad='$nacionalidad',numerohijos='$numerohijos',
                        estadocivil='$estadocivil',	direccionresidencia='$direccionresidencia',ciudadresidencia='$ciudadresidencia',
                        telefonoresidencia='$telefonoresidencia',nombreempresa='$nombreempresa',ciudadempresa='$ciudadempresa',
                        direccionempresa='$direccionempresa',nomenclatura='$nomenclatura',telefonolaboral='$telefonolaboral',
                        celular='$celular',correoelectronico='$correoelectronico',cargo='$cargo',
                        actividadeconomicaempresa='$actividadeconomicaempresa',profesion='$profesion',ocupacion='$ocupacion',detalleocupacion='$detalleocupacion',ciiu='$ciiu',
                        ingresosmensuales='$ingresosmensuales',otrosingresos='$otrosingresos',egresosmensuales='$egresosmensuales',
                        conceptosotrosingresos='$conceptosotrosingresos',tipoactividad='$tipoactividad',nivelestudios='$nivelestudios',
                        tipovivienda='$tipovivienda',estrato='$estrato',totalactivos='$totalactivos',totalpasivos='$totalpasivos',
                        razonsocial='$razonsocial',nit='$nit',digitochequeo='$digitochequeo',ciiu='$ciiu_',ciudadoficina='$ciudadoficina',
                        direccionoficinappal='$direccionoficinappal',nomenclatura_emp='$nomenclatura_emp',telefonoficina='$telefonoficina',
                        faxoficina='$faxoficina',ciudadsucursal='$ciudadsucursal',direccionsucursal='$direccionsucursal',
                        nomenclatura_emp2='$nomenclatura_emp2',telefonosucursal='$telefonosucursal',faxsucursal='$faxsucursal',
                        actividadeconomicappal='$actividadeconomicappal',detalleactividadeconomicappal='$detalleactividadeconomicappal',
                        tipoempresaemp='$tipoempresaemp',activosemp='$activosemp',pasivosemp='$pasivosemp',
                        ingresosmensualesemp='$ingresosmensualesemp',egresosmensualesemp='$egresosmensualesemp',socio1='$socio1',
                        socio2='$socio2',socio3='$socio3',monedaextranjera='$monedaextranjera',tipotransacciones='$tipotransacciones',
                        firma='$firma',huella='$huella',lugarentrevista='$lugarentrevista',fechaentrevista='$fechaentrevista',
                        horaentrevista='$horaentrevista',tipohoraentrevista='$tipohoraentrevista',resultadoentrevista='$resultadoentrevista',
                        observacionesentrevista='$observacionesentrevista',nombreintermediario='$nombreintermediario'
				WHERE id_form = '$id_form'";
                if (mysqli_query($GLOBALS['link'], $sql0)) {
                    return 0;
                } else {
                    echo "<br>Ocurrio un fallo haciendo la actualizaci�n del registro, cont�cte al administrador del sistema. <br>" ;
                    return 1;
                }
            } else {
                echo "<br>Ocurrio un fallo haciendo el backup del registro, por favor, contacte al administrador del sistema. <br>" . $sql . "<br>";
            }
        }
    }
    public static function updateNewNatural($id_data, $id_form, $fecharadicado, $fechasolicitud, $ciudad, $sucursal, $area, $id_official, $tipo_solicitud, $clasecliente, $cual_clasecliente, $primerapellido, $segundoapellido, $nombres, $tipodocumento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $lugarnacimiento, $paisnacimiento, $nacionalidad_otra, $direccionresidencia, $ciudadresidencia, $correoelectronico, $telefonoresidencia, $celular, $nombreempresa, $direccionempresa, $telefonolaboral, $ciudadempresa, $celularoficinappal, $tipoempresaemp, $tipoempresaemp_cual, $recursos_publicos, $poder_publico, $reconocimiento_publico, $reconocimiento_cual, $servidor_publico, $expuesta_politica, $cargo_politica, $cargo_politica_ini, $cargo_politica_fin, $expuesta_publica, $publica_nombre, $publica_cargo, $repre_internacional, $internacional_indique, $tributarias_otro_pais, $tributarias_paises, $tipoactividad, $ciiu, $profesion, $cargo, $actividadeconomicaempresa, $ciiu_otro, $direccionoficinappal, $telefonoficinappal, $detalletipoactividad, $ingresosmensuales, $totalactivos, $totalpasivos, $egresosmensuales, $patrimonio, $otrosingresos, $conceptosotrosingresos, $origen_fondos, $procedencia_fondos, $monedaextranjera, $tipotransacciones, $tipotransacciones_cual, $otras_operaciones, $productos_exterior, $cuentas_monedaextranjera, $reclamaciones, $firma, $huella, $lugarentrevista, $resultadoentrevista, $fechaentrevista, $horaentrevista, $observacionesentrevista, $nombreintermediario, $clave_inter, $firma_entrevista, $verificacion_ciudad, $verificacion_fecha, $verificacion_hora, $verificacion_nombre, $verificacion_nombre_, $verificacion_observacion, $verificacion_firma, $verificacion_observacion_, $verificacion_firma_, $id_user){
    	if(!empty($id_form) && !empty($id_user)){
    		$sql = "INSERT INTO data_backup (SELECT *,'$id_user', NOW() FROM data WHERE id = '$id_data')";
    		//echo $sql; //exit();
    		if(mysqli_query($GLOBALS['link'], $sql)){
    			$squ = "UPDATE data SET fecharadicado = '$fecharadicado', fechasolicitud = '$fechasolicitud', ciudad = '$ciudad', sucursal = '$sucursal', area = '$area', 
	                         id_official = '$id_official', tipo_solicitud = '$tipo_solicitud', clasecliente = '$clasecliente', cual_clasecliente = '$cual_clasecliente', 
	                         primerapellido = '$primerapellido', segundoapellido = '$segundoapellido', nombres = '$nombres', tipodocumento = '$tipodocumento', 
	                         fechaexpedicion = '$fechaexpedicion', lugarexpedicion = '$lugarexpedicion', fechanacimiento = '$fechanacimiento', lugarnacimiento = '$lugarnacimiento', 
	                         paisnacimiento = '$paisnacimiento', nacionalidad_otra = '$nacionalidad_otra', direccionresidencia = '$direccionresidencia', 
	                         ciudadresidencia = '$ciudadresidencia', correoelectronico = '$correoelectronico', telefonoresidencia = '$telefonoresidencia', celular = '$celular', 
	                         nombreempresa = '$nombreempresa', direccionempresa = '$direccionempresa', telefonolaboral = '$telefonolaboral', ciudadempresa = '$ciudadempresa', 
	                         celularoficinappal = '$celularoficinappal', tipoempresaemp = '$tipoempresaemp', tipoempresaemp_cual = '$tipoempresaemp_cual', 
	                         recursos_publicos = '$recursos_publicos', poder_publico = '$poder_publico', reconocimiento_publico = '$reconocimiento_publico', 
	                         reconocimiento_cual = '$reconocimiento_cual', servidor_publico = '$servidor_publico', expuesta_politica = '$expuesta_politica', 
	                         cargo_politica = '$cargo_politica', cargo_politica_ini = '$cargo_politica_ini', cargo_politica_fin = '$cargo_politica_fin', 
	                         expuesta_publica = '$expuesta_publica', publica_nombre = '$publica_nombre', publica_cargo = '$publica_cargo', repre_internacional = '$repre_internacional', 
	                         internacional_indique = '$internacional_indique', tributarias_otro_pais = '$tributarias_otro_pais', tributarias_paises = '$tributarias_paises', 
	                         tipoactividad = '$tipoactividad', ciiu = '$ciiu', profesion = '$profesion', cargo = '$cargo', actividadeconomicaempresa = '$actividadeconomicaempresa', 
	                         ciiu_otro = '$ciiu_otro', direccionoficinappal = '$direccionoficinappal', telefonoficinappal = '$telefonoficinappal', 
	                         detalletipoactividad = '$detalletipoactividad', ingresosmensuales = '$ingresosmensuales', totalactivos = '$totalactivos', totalpasivos = '$totalpasivos', 
	                         egresosmensuales = '$egresosmensuales', patrimonio = '$patrimonio', otrosingresos = '$otrosingresos', conceptosotrosingresos = '$conceptosotrosingresos', 
	                         origen_fondos = '$origen_fondos', procedencia_fondos = '$procedencia_fondos', monedaextranjera = '$monedaextranjera', tipotransacciones = '$tipotransacciones', 
	                         tipotransacciones_cual = '$tipotransacciones_cual', otras_operaciones = '$otras_operaciones', productos_exterior = '$productos_exterior', 
	                         cuentas_monedaextranjera = '$cuentas_monedaextranjera', reclamaciones = '$reclamaciones', firma = '$firma', huella = '$huella', 
	                         lugarentrevista = '$lugarentrevista', resultadoentrevista = '$resultadoentrevista', fechaentrevista = '$fechaentrevista', horaentrevista = '$horaentrevista', 
	                         observacionesentrevista = '$observacionesentrevista', nombreintermediario = '$nombreintermediario', clave_inter = '$clave_inter', 
	                         firma_entrevista = '$firma_entrevista', verificacion_ciudad = '$verificacion_ciudad', verificacion_fecha = '$verificacion_fecha', 
	                         verificacion_hora = '$verificacion_hora', verificacion_nombre = '$verificacion_nombre', verificacion_nombre = '$verificacion_nombre_', 
	                         verificacion_observacion = '$verificacion_observacion', verificacion_firma = '$verificacion_firma', verificacion_observacion = '$verificacion_observacion_', 
	                         verificacion_firma = '$verificacion_firma_'
	                   WHERE id = '$id_data'";
	                   //echo $squ;
	           	if(mysqli_query($GLOBALS['link'], $squ))
	           		return 0;
	           	else{
	           		echo "<br>Ocurrio un fallo haciendo la actualizaci�n del registro, cont�cte al administrador del sistema. <br>";
	           		return 1;
	           	}
	        }else
	        	echo "<br>Ocurrio un fallo haciendo el backup del registro, por favor, contacte al administrador del sistema. <br>" . $sql . "<br>";
	        }
	    }
    public static function updateNewJuridico($id_data, $id_form, $fecharadicado, $fechasolicitud, $ciudad, $sucursal, $area, $id_official, $tipo_solicitud, $clasecliente, $cual_clasecliente, $primerapellido, $segundoapellido, $nombres, $tipodocumento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $lugarnacimiento, $paisnacimiento, $nacionalidad_otra, $direccionresidencia, $ciudadresidencia, $correoelectronico, $telefonoresidencia, $celular, $nombreempresa, $direccionempresa, $telefonolaboral, $ciudadempresa, $celularoficinappal, $tipoempresaemp, $tipoempresaemp_cual, $recursos_publicos, $poder_publico, $reconocimiento_publico, $reconocimiento_cual, $servidor_publico, $expuesta_politica, $cargo_politica, $cargo_politica_ini, $cargo_politica_fin, $expuesta_publica, $publica_nombre, $publica_cargo, $repre_internacional, $internacional_indique, $tributarias_otro_pais, $tributarias_paises, $razonsocial, $digitochequeo, $tipoempresajur, $tipoempresajur_otra, $detalleactividadeconomicappal, $ciiu, $direccionoficinappal, $ciudadoficina, $telefonoficina, $correoelectronico_otro, $celularoficina, $direccionsucursal, $ingresosmensualesemp, $activosemp, $pasivosemp, $egresosmensualesemp, $patrimonio, $otrosingresosemp, $concepto_otrosingresosemp, $origen_fondos, $procedencia_fondos, $monedaextranjera, $tipotransacciones, $tipotransacciones_cual, $otras_operaciones, $productos_exterior, $cuentas_monedaextranjera, $reclamaciones, $firma, $huella, $lugarentrevista, $resultadoentrevista, $fechaentrevista, $horaentrevista, $observacionesentrevista, $nombreintermediario, $clave_inter, $firma_entrevista, $verificacion_ciudad, $verificacion_fecha, $verificacion_hora, $verificacion_nombre, $verificacion_nombre_, $verificacion_observacion, $verificacion_firma, $verificacion_observacion_, $verificacion_firma_, $id_user){
      if(!empty($id_form) && !empty($id_user)){
        $sql = "INSERT INTO data_backup (SELECT *,'$id_user', NOW() FROM data WHERE id = '$id_data')";
        //echo $sql; exit();
        if(mysqli_query($GLOBALS['link'], $sql)){
          $squ = "UPDATE data SET fecharadicado = '$fecharadicado', fechasolicitud = '$fechasolicitud', ciudad = '$ciudad', sucursal = '$sucursal', area = '$area', 
                         id_official = '$id_official', tipo_solicitud = '$tipo_solicitud', clasecliente = '$clasecliente', cual_clasecliente = '$cual_clasecliente', 
                         primerapellido = '$primerapellido', segundoapellido = '$segundoapellido', nombres = '$nombres', tipodocumento = '$tipodocumento', 
                         fechaexpedicion = '$fechaexpedicion', lugarexpedicion = '$lugarexpedicion', fechanacimiento = '$fechanacimiento', lugarnacimiento = '$lugarnacimiento', 
                         paisnacimiento = '$paisnacimiento', nacionalidad_otra = '$nacionalidad_otra', direccionresidencia = '$direccionresidencia', 
                         ciudadresidencia = '$ciudadresidencia', correoelectronico = '$correoelectronico', telefonoresidencia = '$telefonoresidencia', celular = '$celular', 
                         nombreempresa = '$nombreempresa', direccionempresa = '$direccionempresa', telefonolaboral = '$telefonolaboral', ciudadempresa = '$ciudadempresa', 
                         celularoficinappal = '$celularoficinappal', tipoempresaemp = '$tipoempresaemp', tipoempresaemp_cual = '$tipoempresaemp_cual', 
                         recursos_publicos = '$recursos_publicos', poder_publico = '$poder_publico', reconocimiento_publico = '$reconocimiento_publico', 
                         reconocimiento_cual = '$reconocimiento_cual', servidor_publico = '$servidor_publico', expuesta_politica = '$expuesta_politica', 
                         cargo_politica = '$cargo_politica', cargo_politica_ini = '$cargo_politica_ini', cargo_politica_fin = '$cargo_politica_fin', 
                         expuesta_publica = '$expuesta_publica', publica_nombre = '$publica_nombre', publica_cargo = '$publica_cargo', repre_internacional = '$repre_internacional', 
                         internacional_indique = '$internacional_indique', tributarias_otro_pais = '$tributarias_otro_pais', tributarias_paises = '$tributarias_paises', 
                         razonsocial = '$razonsocial', digitochequeo = '$digitochequeo', tipoempresajur = '$tipoempresajur', tipoempresajur_otra = '$tipoempresajur_otra', 
                         detalleactividadeconomicappal = '$detalleactividadeconomicappal', ciiu = '$ciiu', direccionoficinappal = '$direccionoficinappal', 
                         ciudadoficina = '$ciudadoficina', telefonoficina = '$telefonoficina', correoelectronico_otro = '$correoelectronico_otro', celularoficina = '$celularoficina', 
                         direccionsucursal = '$direccionsucursal', ingresosmensualesemp = '$ingresosmensualesemp', activosemp = '$activosemp', pasivosemp = '$pasivosemp', 
                         egresosmensualesemp = '$egresosmensualesemp', patrimonio = '$patrimonio', otrosingresosemp = '$otrosingresosemp', 
                         concepto_otrosingresosemp = '$concepto_otrosingresosemp', origen_fondos = '$origen_fondos', procedencia_fondos = '$procedencia_fondos', 
                         monedaextranjera = '$monedaextranjera', tipotransacciones = '$tipotransacciones', tipotransacciones_cual = '$tipotransacciones_cual', 
                         otras_operaciones = '$otras_operaciones', productos_exterior = '$productos_exterior', cuentas_monedaextranjera = '$cuentas_monedaextranjera', 
                         reclamaciones = '$reclamaciones', firma = '$firma', huella = '$huella', lugarentrevista = '$lugarentrevista', resultadoentrevista = '$resultadoentrevista', 
                         fechaentrevista = '$fechaentrevista', horaentrevista = '$horaentrevista', observacionesentrevista = '$observacionesentrevista', 
                         nombreintermediario = '$nombreintermediario', clave_inter = '$clave_inter', firma_entrevista = '$firma_entrevista', 
                         verificacion_ciudad = '$verificacion_ciudad', verificacion_fecha = '$verificacion_fecha', verificacion_hora = '$verificacion_hora', 
                         verificacion_nombre = '$verificacion_nombre', verificacion_nombre = '$verificacion_nombre_', verificacion_observacion = '$verificacion_observacion', 
                         verificacion_firma = '$verificacion_firma', verificacion_observacion = '$verificacion_observacion_', verificacion_firma = '$verificacion_firma_'
                   WHERE id = '$id_data'";
          if(mysqli_query($GLOBALS['link'], $squ))
            return 0;
          else{
            echo "<br>Ocurrio un fallo haciendo la actualizaci�n del registro, cont�cte al administrador del sistema. <br>";
            return 1;
          }
        }else
          echo "<br>Ocurrio un fallo haciendo el backup del registro, por favor, contacte al administrador del sistema. <br>" . $sql . "<br>";
      }
    }

    /*
      function updateNatural($id_form,$fecharadicado,$fechasolicitud,$sucursal,$area,$id_official,$formulario,$clasecliente,$primerapellido,$segundoapellido,$nombres,$tipodocumento,$documento,$fechaexpedicion,$lugarexpedicion,$fechanacimiento,$lugarnacimiento,$sexo,$nacionalidad,$numerohijos,$estadocivil,$direccionresidencia,$ciudadresidencia,$telefonoresidencia,$nombreempresa,$ciudadempresa,$direccionempresa,$nomenclatura,$telefonolaboral,$celular,$correoelectronico,$cargo,$actividadeconomicaempresa,$profesion,$ocupacion,$ciiu,$ingresosmensuales,$otrosingresos,$egresosmensuales,$conceptosotrosingresos,$tipoactividad,$nivelestudios,$tipovivienda,$estrato,$totalactivos,$totalpasivos,$ciiu,$monedaextranjera,$tipotransacciones,$firma,$huella,$lugarentrevista,$fechaentrevista,$horaentrevista,$tipohoraentrevista,$resultadoentrevista,$observacionesentrevista,$nombreintermediario, $id_user) {
      if( !empty( $id_form) && !empty($id_user)) {
      $sql = "INSERT INTO data_backup (SELECT *,'".$id_user."',NOW() FROM data WHERE id_form = '$id_form')";
      if( mysqli_query($GLOBALS['link'], $sql) ) {
      $sql0= "UPDATE data SET
      fecharadicado='$fecharadicado',fechasolicitud='$fechasolicitud',sucursal='$sucursal',area='$area',
      id_official='$id_official',formulario='$formulario',clasecliente='$clasecliente',primerapellido='$primerapellido',
      segundoapellido='$segundoapellido',nombres='$nombres',tipodocumento='$tipodocumento',documento='$documento',
      fechaexpedicion='$fechaexpedicion',lugarexpedicion='$lugarexpedicion',fechanacimiento='$fechanacimiento',
      lugarnacimiento='$lugarnacimiento',sexo='$sexo',nacionalidad='$nacionalidad',numerohijos='$numerohijos',
      estadocivil='$estadocivil', direccionresidencia='$direccionresidencia',ciudadresidencia='$ciudadresidencia',
      telefonoresidencia='$telefonoresidencia',nombreempresa='$nombreempresa',ciudadempresa='$ciudadempresa',
      direccionempresa='$direccionempresa',nomenclatura='$nomenclatura',telefonolaboral='$telefonolaboral',
      celular='$celular',correoelectronico='$correoelectronico',cargo='$cargo',
      actividadeconomicaempresa='$actividadeconomicaempresa',profesion='$profesion',ocupacion='$ocupacion',
      ciiu='$ciiu',ingresosmensuales='$ingresosmensuales',otrosingresos='$otrosingresos',
      egresosmensuales='$egresosmensuales',conceptosotrosingresos='$conceptosotrosingresos',tipoactividad='$tipoactividad',
      nivelestudios='$nivelestudios',tipovivienda='$tipovivienda',estrato='$estrato',totalactivos='$totalactivos',
      totalpasivos='$totalpasivos',ciiu='$ciiu',monedaextranjera='$monedaextranjera',
      tipotransacciones='$tipotransacciones',firma='$firma',huella='$huella',lugarentrevista='$lugarentrevista',
      fechaentrevista='$fechaentrevista',horaentrevista='$horaentrevista',tipohoraentrevista='$tipohoraentrevista',
      resultadoentrevista='$resultadoentrevista',observacionesentrevista='$observacionesentrevista',
      nombreintermediario='$nombreintermediario'
      WHERE id_form = '$id_form'";
      if( mysqli_query($GLOBALS['link'], $sql0)){
      return 0;
      } else {
      echo "<br>Ocurrio un fallo haciendo la actualizaci�n del registro, cont�cte al administrador del sistema.";
      return 1;
      }
      } else {
      echo "<br>Ocurrio un fallo haciendo el backup del registro, por favor, cont�cte al administrador del sistema.";
      }
      }
      }

     */

    function add($id_client, $type, $lote, $planilla, $id_user, $num_images, $marca) {
        $log_planilla = explode('.', substr($planilla, 8, strlen($planilla)))[0]; //8 PORQUE ES LA LONGITUD DE PLANILLA
        $log_lote = substr($lote, 5, strlen($lote));
        $sql = "INSERT INTO form
                (
                  id_client, type, lote,planilla, id_user, log_planilla, log_lote, num_images,marca
                )
                VALUES
                (
                  $id_client, '$type', '$lote', '$planilla', '$id_user', '$log_planilla', '$log_lote', '$num_images', '$marca'
                )";
        //echo $sql;
        if (mysqli_query($GLOBALS['link'], $sql))
            return 0;
        else
            return -1;
    }
    function insertPrimaryData($id_form, $fechasolicitud, $sucursal, $clasecliente, $primerapellido, $segundoapellido, $nombres, $tipodocumento, $documento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $lugarnacimiento, $sexo, $numerohijos, $estadocivil, $direccionresidencia, $ciudadresidencia, $telefonoresidencia, $nombreempresa, $ciudadempresa, $direccionempresa, $nomenclatura, $telefonolaboral, $celular, $correoelectronico, $cargo, $actividadeconomicaempresa, $profesion, $ocupacion, $detalleocupacion, $ciiu, $ingresosmensuales, $otrosingresos, $egresosmensuales, $conceptosotrosingresos, $tipoactividad, $detalletipoactividad, $nivelestudios, $tipovivienda, $estrato, $totalactivos, $totalpasivos, $razonsocial, $nit, $ciudadoficina, $direccionoficinappal, $nomenclatura_emp, $telefonoficina, $faxoficina, $celularoficina, $ciudadsucursal, $direccionsucursal, $nomenclatura_emp2, $telefonosucursal, $faxsucursal, $actividadeconomicappal, $tipoempresaemp, $activosemp, $pasivosemp, $ingresosmensualesemp, $egresosmensualesemp, $monedaextranjera, $tipotransacciones, $nacionalidad, $area, $lote, $formulario, $digitochequeo, $id_official, $socio1, $socio2, $socio3, $fecharadicado, $detalleactividadeconomicappal, $firma, $huella, $lugarentrevista, $fechaentrevista, $horaentrevista, $tipohoraentrevista, $resultadoentrevista, $observacionesentrevista, $nombreintermediario, $cliente_id){
      $sql = "INSERT INTO data
              (
                id_form, fechasolicitud, sucursal, clasecliente, primerapellido, segundoapellido, nombres, tipodocumento, documento,
                fechaexpedicion, lugarexpedicion, fechanacimiento, lugarnacimiento, sexo, numerohijos, estadocivil, direccionresidencia,
                ciudadresidencia, telefonoresidencia, nombreempresa, ciudadempresa, direccionempresa, nomenclatura, telefonolaboral,
                celular, correoelectronico, cargo, actividadeconomicaempresa, profesion, ocupacion, detalleocupacion, ciiu, 
                ingresosmensuales, otrosingresos, egresosmensuales, conceptosotrosingresos, tipoactividad, detalletipoactividad,
                nivelestudios, tipovivienda, estrato, totalactivos, totalpasivos, razonsocial, nit, ciudadoficina, direccionoficinappal,
                nomenclatura_emp, telefonoficina, faxoficina, celularoficina, ciudadsucursal, direccionsucursal, nomenclatura_emp2,
                telefonosucursal, faxsucursal, actividadeconomicappal, tipoempresaemp, activosemp, pasivosemp, ingresosmensualesemp,
                egresosmensualesemp, monedaextranjera, tipotransacciones, nacionalidad, area, lote, formulario, digitochequeo,
                id_official, socio1, socio2, socio3, fecharadicado, detalleactividadeconomicappal, firma, huella, lugarentrevista,
                fechaentrevista, horaentrevista, tipohoraentrevista, resultadoentrevista, observacionesentrevista, nombreintermediario
              ) 
              VALUES
              (
                '$id_form', '$fechasolicitud', '$sucursal', '$clasecliente', '$primerapellido', '$segundoapellido', '$nombres',
                '$tipodocumento', '$documento', '$fechaexpedicion', '$lugarexpedicion', '$fechanacimiento', '$lugarnacimiento',
                '$sexo', '$numerohijos', '$estadocivil', '$direccionresidencia', '$ciudadresidencia', '$telefonoresidencia',
                '$nombreempresa', '$ciudadempresa', '$direccionempresa', '$nomenclatura', '$telefonolaboral', '$celular',
                '$correoelectronico', '$cargo', '$actividadeconomicaempresa', '$profesion', '$ocupacion', '$detalleocupacion',
                '$ciiu', '$ingresosmensuales', '$otrosingresos', '$egresosmensuales', '$conceptosotrosingresos', '$tipoactividad',
                '$detalletipoactividad', '$nivelestudios', '$tipovivienda', '$estrato', '$totalactivos', '$totalpasivos', '$razonsocial',
                '$nit', '$ciudadoficina', '$direccionoficinappal', '$nomenclatura_emp', '$telefonoficina', '$faxoficina', '$celularoficina',
                '$ciudadsucursal', '$direccionsucursal', '$nomenclatura_emp2', '$telefonosucursal', '$faxsucursal', '$actividadeconomicappal',
                '$tipoempresaemp', '$activosemp', '$pasivosemp', '$ingresosmensualesemp', '$egresosmensualesemp', '$monedaextranjera',
                '$tipotransacciones', '$nacionalidad', '$area', '$lote', '$formulario', '$digitochequeo', '$id_official', '$socio1',
                '$socio2', '$socio3', '$fecharadicado', '$detalleactividadeconomicappal', '$firma', '$huella', '$lugarentrevista', 
                '$fechaentrevista', '$horaentrevista', '$tipohoraentrevista', '$resultadoentrevista', '$observacionesentrevista',
                '$nombreintermediario'
              )";
      if(mysqli_query($GLOBALS['link'], $sql)){
		$ct = array(
			'cliente_id'=> $cliente_id,
			'telefono'=> '',
			'cod_ciudad'=> "NULL",
			'ciudad'=> "NULL",
			'tipo_demografico_id'=> 1,
			'origen_id'=> 4
		);
		if(isset($telefonoresidencia) && !empty(trim($telefonoresidencia))){
			$ct['telefono'] = $telefonoresidencia;
			$ct['cod_ciudad'] = (isset($ciudadresidencia) && !empty(trim($ciudadresidencia))) ? trim($ciudadresidencia) : "NULL";
			$telId = self::verificarTelefono($ct);
		}
		if(isset($telefonolaboral) && !empty(trim($telefonolaboral))){
			$ct['telefono'] = $telefonolaboral;
			$ct['cod_ciudad'] = (isset($ciudadempresa) && !empty(trim($ciudadempresa))) ? trim($ciudadempresa) : "NULL";
			$telId = self::verificarTelefono($ct);
		}
		if(isset($celular) && !empty(trim($celular))){
			$ct['telefono'] = $celular;
			$ct['cod_ciudad'] = "NULL";
			$ct['tipo_demografico_id'] = "5";
			$telId = self::verificarTelefono($ct);
		}
		if(isset($telefonoficina) && !empty(trim($telefonoficina))){
			$ct['telefono'] = $telefonoficina;
			$ct['cod_ciudad'] = (isset($ciudadoficina) && !empty(trim($ciudadoficina))) ? trim($ciudadoficina) : "NULL";
			$telId = self::verificarTelefono($ct);
		}
		if(isset($faxoficina) && !empty(trim($faxoficina))){
			$ct['telefono'] = $faxoficina;
			$ct['cod_ciudad'] = (isset($ciudadoficina) && !empty(trim($ciudadoficina))) ? trim($ciudadoficina) : "NULL";
			$telId = self::verificarTelefono($ct);
		}
		if(isset($celularoficina) && !empty(trim($celularoficina))){
			$ct['telefono'] = $celularoficina;
			$ct['cod_ciudad'] = "NULL";
			$ct['tipo_demografico_id'] = "5";
			$telId = self::verificarTelefono($ct);
		}
		if(isset($telefonosucursal) && !empty(trim($telefonosucursal))){
			$ct['telefono'] = $telefonosucursal;
			$ct['cod_ciudad'] = (isset($ciudadsucursal) && !empty(trim($ciudadsucursal))) ? trim($ciudadsucursal) : "NULL";
			$telId = self::verificarTelefono($ct);
		}
		if(isset($faxsucursal) && !empty(trim($faxsucursal))){
			$ct['telefono'] = $faxsucursal;
			$ct['cod_ciudad'] = (isset($ciudadsucursal) && !empty(trim($ciudadsucursal))) ? trim($ciudadsucursal) : "NULL";
			$telId = self::verificarTelefono($ct);
		}
		$cd = array(
			'cliente_id'=> $cliente_id,
			'direccion'=> '',
			'cod_ciudad'=> "NULL",
			'ciudad'=> "NULL",
			'tipo_demografico_id'=> 2,
			'origen_id'=> 4
		);
        if(isset($direccionresidencia) && !empty($direccionresidencia) && strlen($direccionresidencia) > 1 && strtoupper(trim($direccionresidencia)) != 'SD' && strtoupper(trim($direccionresidencia)) != 'NA' && strtoupper(trim($direccionresidencia)) != 'N/A'){
        	$cd['direccion'] = $direccionresidencia;
			$cd['cod_ciudad'] = (isset($ciudadresidencia) && !empty(trim($ciudadresidencia))) ? trim($ciudadresidencia) : "NULL";
			$ciuId = self::verificarDireccion($cd);
        }
        if(isset($direccionempresa) && !empty($direccionempresa) && strlen($direccionempresa) > 1 && strtoupper(trim($direccionempresa)) != 'SD' && strtoupper(trim($direccionempresa)) != 'NA' && strtoupper(trim($direccionempresa)) != 'N/A'){
        	$cd['direccion'] = $direccionempresa;
			$cd['cod_ciudad'] = (isset($ciudadempresa) && !empty(trim($ciudadempresa))) ? trim($ciudadempresa) : "NULL";
			$ciuId = self::verificarDireccion($cd);
        }
        if(isset($direccionoficinappal) && !empty($direccionoficinappal) && strlen($direccionoficinappal) > 1 && strtoupper(trim($direccionoficinappal)) != 'SD' && strtoupper(trim($direccionoficinappal)) != 'NA' && strtoupper(trim($direccionoficinappal)) != 'N/A'){
        	$cd['direccion'] = $direccionoficinappal;
			$cd['cod_ciudad'] = (isset($ciudadoficina) && !empty(trim($ciudadoficina))) ? trim($ciudadoficina) : "NULL";
			$ciuId = self::verificarDireccion($cd);
        }
        if(isset($direccionsucursal) && !empty($direccionsucursal) && strlen($direccionsucursal) > 1 && strtoupper(trim($direccionsucursal)) != 'SD' && strtoupper(trim($direccionsucursal)) != 'NA' && strtoupper(trim($direccionsucursal)) != 'N/A'){
        	$cd['direccion'] = $direccionsucursal;
			$cd['cod_ciudad'] = (isset($ciudadsucursal) && !empty(trim($ciudadsucursal))) ? trim($ciudadsucursal) : "NULL";
			$ciuId = self::verificarDireccion($cd);
        }
		if(isset($correoelectronico) && !empty(trim($correoelectronico)) && trim($correoelectronico) != 'NULL' && strtoupper(trim($correoelectronico)) != 'SD' && strtoupper(trim($correoelectronico)) != 'NA' && strtoupper(trim($correoelectronico)) != 'N/A'){
			$cd['direccion'] = $correoelectronico;
			$cd['ciudad'] = "NULL";
			$cd['tipo_demografico_id'] = "5";
			$ciuId = self::verificarDireccion($cd);
		}
        return 0;
      }else
        return -1;
    }
    function insertPrimaryDataNew($id_form, $fecharadicado, $fechasolicitud, $sucursal, $area, $lote, $formulario, $id_official, $clasecliente, $primerapellido, $segundoapellido,$nombres, $sexo, $tipodocumento, $documento, $fechaexpedicion, $lugarexpedicion, $fechanacimiento, $paisnacimiento, $lugarnacimiento, $nacionalidad_otra,$direccionresidencia, $ciudadresidencia, $telefonoresidencia, $nombreempresa, $ciudadempresa, $direccionempresa, $telefonolaboral, $celular,$correoelectronico, $cargo, $actividadeconomicaempresa, $profesion, $ciiu, $ingresosmensuales, $otrosingresos, $egresosmensuales, $conceptosotrosingresos,$tipoactividad, $detalletipoactividad, $totalactivos, $totalpasivos, $razonsocial, $nit, $digitochequeo, $ciudadoficina, $direccionoficinappal,$telefonoficina, $celularoficina, $direccionsucursal, $detalleactividadeconomicappal, $tipoempresaemp, $activosemp, $pasivosemp, $ingresosmensualesemp,$egresosmensualesemp, $otrosingresosemp, $concepto_otrosingresosemp, $monedaextranjera, $tipotransacciones, $productos_exterior, $cuentas_monedaextranjera,$firma, $huella, $lugarentrevista, $fechaentrevista, $horaentrevista, $tipohoraentrevista, $resultadoentrevista, $observacionesentrevista,$nombreintermediario, $ciudad, $tipo_solicitud, $cual_clasecliente, $celularoficinappal, $tipoempresaemp_cual, $recursos_publicos, $poder_publico,$reconocimiento_publico, $reconocimiento_cual, $servidor_publico, $expuesta_politica, $cargo_politica, $cargo_politica_ini, $cargo_politica_fin,$expuesta_publica, $publica_nombre, $publica_cargo, $repre_internacional, $internacional_indique, $tributarias_otro_pais, $tributarias_paises, $ciiu_otro,$telefonoficinappal, $patrimonio, $tipoempresajur, $tipoempresajur_otra, $correoelectronico_otro, $origen_fondos, $procedencia_fondos, $tipotransacciones_cual,$otras_operaciones, $reclamaciones, $clave_inter, $firma_entrevista, $verificacion_ciudad, $verificacion_fecha, $verificacion_hora, $verificacion_nombre,$verificacion_observacion, $verificacion_firma, $auto_correo, $auto_sms, $cliente_id){
        if($digitochequeo == '')
            $digitochequeo = '0';
        if($ingresosmensualesemp == '')
            $ingresosmensualesemp = '0';
        if($egresosmensualesemp == '')
            $egresosmensualesemp = '0';
        if($otrosingresosemp == '')
            $otrosingresosemp = '0';
        if($tipotransacciones == '')
            $tipotransacciones = '0';
      $sql = "INSERT INTO data 
              (
                id_form, fecharadicado, fechasolicitud, sucursal, area, lote, formulario, id_official, clasecliente, primerapellido, segundoapellido, nombres, sexo, tipodocumento, documento, 
                fechaexpedicion, lugarexpedicion, fechanacimiento, paisnacimiento, lugarnacimiento, nacionalidad_otra, direccionresidencia, ciudadresidencia, telefonoresidencia, 
                nombreempresa, ciudadempresa, direccionempresa, telefonolaboral, celular, correoelectronico, cargo, actividadeconomicaempresa, profesion, ciiu, ingresosmensuales, 
                otrosingresos, egresosmensuales, conceptosotrosingresos, tipoactividad, detalletipoactividad, totalactivos, totalpasivos, razonsocial, nit, digitochequeo, ciudadoficina, 
                direccionoficinappal, telefonoficina, celularoficina, direccionsucursal, detalleactividadeconomicappal, tipoempresaemp, activosemp, pasivosemp, ingresosmensualesemp, 
                egresosmensualesemp, otrosingresosemp, concepto_otrosingresosemp, monedaextranjera, tipotransacciones, productos_exterior, cuentas_monedaextranjera, firma, huella, 
                lugarentrevista, fechaentrevista, horaentrevista, tipohoraentrevista, resultadoentrevista, observacionesentrevista, nombreintermediario, ciudad, tipo_solicitud, 
                cual_clasecliente, celularoficinappal, tipoempresaemp_cual, recursos_publicos, poder_publico, reconocimiento_publico, reconocimiento_cual, servidor_publico, 
                expuesta_politica, cargo_politica, cargo_politica_ini, cargo_politica_fin, expuesta_publica, publica_nombre, publica_cargo, repre_internacional, internacional_indique, 
                tributarias_otro_pais, tributarias_paises, ciiu_otro, telefonoficinappal, patrimonio, tipoempresajur, tipoempresajur_otra, correoelectronico_otro, origen_fondos, 
                procedencia_fondos, tipotransacciones_cual, otras_operaciones, reclamaciones, clave_inter, firma_entrevista, verificacion_ciudad, verificacion_fecha, verificacion_hora, 
                verificacion_nombre, verificacion_observacion, verificacion_firma, auto_correo, auto_sms
              ) 
              VALUES 
              (
                '$id_form', '$fecharadicado', '$fechasolicitud', '$sucursal', '$area', '$lote', '$formulario', '$id_official', '$clasecliente', '$primerapellido', '$segundoapellido', 
                '$nombres', '$sexo', '$tipodocumento', '$documento', '$fechaexpedicion', '$lugarexpedicion', '$fechanacimiento', '$paisnacimiento', '$lugarnacimiento', '$nacionalidad_otra', 
                '$direccionresidencia', '$ciudadresidencia', '$telefonoresidencia', '$nombreempresa', '$ciudadempresa', '$direccionempresa', '$telefonolaboral', '$celular', 
                '$correoelectronico', '$cargo', '$actividadeconomicaempresa', '$profesion', '$ciiu', '$ingresosmensuales', '$otrosingresos', '$egresosmensuales', '$conceptosotrosingresos', 
                '$tipoactividad', '$detalletipoactividad', '$totalactivos', '$totalpasivos', '$razonsocial', '$nit', '$digitochequeo', '$ciudadoficina', '$direccionoficinappal', 
                '$telefonoficina', '$celularoficina', '$direccionsucursal', '$detalleactividadeconomicappal', '$tipoempresaemp', '$activosemp', '$pasivosemp', '$ingresosmensualesemp', 
                '$egresosmensualesemp', '$otrosingresosemp', '$concepto_otrosingresosemp', '$monedaextranjera', '$tipotransacciones', '$productos_exterior', '$cuentas_monedaextranjera', 
                '$firma', '$huella', '$lugarentrevista', '$fechaentrevista', '$horaentrevista', '$tipohoraentrevista', '$resultadoentrevista', '$observacionesentrevista', 
                '$nombreintermediario', '$ciudad', '$tipo_solicitud', '$cual_clasecliente', '$celularoficinappal', '$tipoempresaemp_cual', '$recursos_publicos', '$poder_publico', 
                '$reconocimiento_publico', '$reconocimiento_cual', '$servidor_publico', '$expuesta_politica', '$cargo_politica', '$cargo_politica_ini', '$cargo_politica_fin', 
                '$expuesta_publica', '$publica_nombre', '$publica_cargo', '$repre_internacional', '$internacional_indique', '$tributarias_otro_pais', '$tributarias_paises', '$ciiu_otro', 
                '$telefonoficinappal', '$patrimonio', '$tipoempresajur', '$tipoempresajur_otra', '$correoelectronico_otro', '$origen_fondos', '$procedencia_fondos', '$tipotransacciones_cual', 
                '$otras_operaciones', '$reclamaciones', '$clave_inter', '$firma_entrevista', '$verificacion_ciudad', '$verificacion_fecha', '$verificacion_hora', '$verificacion_nombre', 
                '$verificacion_observacion', '$verificacion_firma', '$auto_correo', '$auto_sms'
              )";
              echo $sql;
              /*if($_SESSION['id']== '5221'){
                echo $sql;
                exit();
              }*/

      if(mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']))){
		$ct = array(
			'cliente_id'=> $cliente_id,
			'telefono'=> '',
			'cod_ciudad'=> "NULL",
			'ciudad'=> "NULL",
			'tipo_demografico_id'=> 1,
			'origen_id'=> 4
		);
		if(isset($telefonoresidencia) && !empty(trim($telefonoresidencia))){
			$ct['telefono'] = $telefonoresidencia;
			$ct['cod_ciudad'] = (isset($ciudadresidencia) && !empty(trim($ciudadresidencia))) ? trim($ciudadresidencia) : "NULL";
			$telId = self::verificarTelefono($ct);
		}
		if(isset($telefonolaboral) && !empty(trim($telefonolaboral))){
			$ct['telefono'] = $telefonolaboral;
			$ct['cod_ciudad'] = (isset($ciudadempresa) && !empty(trim($ciudadempresa))) ? trim($ciudadempresa) : "NULL";
			$telId = self::verificarTelefono($ct);
		}
		if(isset($celular) && !empty(trim($celular))){
			$ct['telefono'] = $celular;
			$ct['cod_ciudad'] = "NULL";
			$ct['tipo_demografico_id'] = "5";
			$telId = self::verificarTelefono($ct);
		}
		if(isset($telefonoficina) && !empty(trim($telefonoficina))){
			$ct['telefono'] = $telefonoficina;
			$ct['cod_ciudad'] = (isset($ciudadoficina) && !empty(trim($ciudadoficina))) ? trim($ciudadoficina) : "NULL";
			$telId = self::verificarTelefono($ct);
		}
		if(isset($celularoficina) && !empty(trim($celularoficina))){
			$ct['telefono'] = $celularoficina;
			$ct['cod_ciudad'] = "NULL";
			$ct['tipo_demografico_id'] = "5";
			$telId = self::verificarTelefono($ct);
		}
		if(isset($celularoficinappal) && !empty(trim($celularoficinappal))){
			$ct['telefono'] = $celularoficinappal;
			$ct['cod_ciudad'] = "NULL";
			$ct['tipo_demografico_id'] = "5";
			$telId = self::verificarTelefono($ct);
		}
		if(isset($telefonoficinappal) && !empty(trim($telefonoficinappal))){
			$ct['telefono'] = $telefonoficinappal;
			$ct['cod_ciudad'] = (isset($ciudadoficina) && !empty(trim($ciudadoficina))) ? trim($ciudadoficina) : "NULL";
			$telId = self::verificarTelefono($ct);
		}
		$cd = array(
			'cliente_id'=> $cliente_id,
			'direccion'=> '',
			'cod_ciudad'=> "NULL",
			'ciudad'=> "NULL",
			'tipo_demografico_id'=> 2,
			'origen_id'=> 4
		);
        if(isset($direccionresidencia) && !empty($direccionresidencia) && strlen($direccionresidencia) > 1 && strtoupper(trim($direccionresidencia)) != 'SD' && strtoupper(trim($direccionresidencia)) != 'NA' && strtoupper(trim($direccionresidencia)) != 'N/A'){
        	$cd['direccion'] = $direccionresidencia;
			$cd['cod_ciudad'] = (isset($ciudadresidencia) && !empty(trim($ciudadresidencia))) ? trim($ciudadresidencia) : "NULL";
			$ciuId = self::verificarDireccion($cd);
        }
        if(isset($direccionempresa) && !empty($direccionempresa) && strlen($direccionempresa) > 1 && strtoupper(trim($direccionempresa)) != 'SD' && strtoupper(trim($direccionempresa)) != 'NA' && strtoupper(trim($direccionempresa)) != 'N/A'){
        	$cd['direccion'] = $direccionempresa;
			$cd['cod_ciudad'] = (isset($ciudadempresa) && !empty(trim($ciudadempresa))) ? trim($ciudadempresa) : "NULL";
			$ciuId = self::verificarDireccion($cd);
        }
        if(isset($direccionoficinappal) && !empty($direccionoficinappal) && strlen($direccionoficinappal) > 1 && strtoupper(trim($direccionoficinappal)) != 'SD' && strtoupper(trim($direccionoficinappal)) != 'NA' && strtoupper(trim($direccionoficinappal)) != 'N/A'){
        	$cd['direccion'] = $direccionoficinappal;
			$cd['cod_ciudad'] = (isset($ciudadoficina) && !empty(trim($ciudadoficina))) ? trim($ciudadoficina) : "NULL";
			$ciuId = self::verificarDireccion($cd);
        }
        if(isset($direccionsucursal) && !empty($direccionsucursal) && strlen($direccionsucursal) > 1 && strtoupper(trim($direccionsucursal)) != 'SD' && strtoupper(trim($direccionsucursal)) != 'NA' && strtoupper(trim($direccionsucursal)) != 'N/A'){
        	$cd['direccion'] = $direccionsucursal;
			$cd['cod_ciudad'] = "NULL";
			$ciuId = self::verificarDireccion($cd);
        }
		if(isset($correoelectronico) && !empty(trim($correoelectronico)) && trim($correoelectronico) != 'NULL' && strtoupper(trim($correoelectronico)) != 'SD' && strtoupper(trim($correoelectronico)) != 'NA' && strtoupper(trim($correoelectronico)) != 'N/A'){
			$cd['direccion'] = $correoelectronico;
			$cd['ciudad'] = "NULL";
			$cd['tipo_demografico_id'] = "5";
			$ciuId = self::verificarDireccion($cd);
		}
		if(isset($correoelectronico_otro) && !empty(trim($correoelectronico_otro)) && trim($correoelectronico_otro) != 'NULL' && strtoupper(trim($correoelectronico_otro)) != 'SD' && strtoupper(trim($correoelectronico_otro)) != 'NA' && strtoupper(trim($correoelectronico_otro)) != 'N/A'){
			$cd['direccion'] = $correoelectronico_otro;
			$cd['ciudad'] = "NULL";
			$cd['tipo_demografico_id'] = "5";
			$ciuId = self::verificarDireccion($cd);
		}
        return 0;
      }else
        return -1;
    }
    function insertSecondData($id_form, $firma, $huella, $lugarentrevista, $fechaentrevista, $horaentrevista, $tipohoraentrevista, $resultadoentrevista, $observacionesentrevista, $nombreintermediario) {
        $sql = "UPDATE data 
                SET firma='$firma', huella='$huella', lugarentrevista='$lugarentrevista', fechaentrevista='$fechaentrevista',
                horaentrevista='$horaentrevista', tipohoraentrevista='$tipohoraentrevista', resultadoentrevista='$resultadoentrevista',
                observacionesentrevista='$observacionesentrevista', nombreintermediario='$nombreintermediario'
                WHERE id_form = '$id_form'";
        if(mysqli_query($GLOBALS['link'], $sql))
          return 0;
        else
          return -1;
    }

    function getForms($id_client) {
        $sql = "SELECT f.*, d.formulario
                  FROM form AS f
                  LEFT JOIN data AS d ON(d.id_form = f.id)
                 WHERE f.id_client = '$id_client' 
                   AND f.status = '1'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getFormsSupCap($id_client) {
        $sql = "SELECT * FROM sup_data_capi WHERE id_client = '$id_client'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getFormsSupSeg($id_client) {
        $sql = "SELECT * FROM sup_data WHERE id_client = '$id_client'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getFormInfo($id_form) {
        $sql = "SELECT t1.*, 
                       t3.persontype,
                       t3.document,
                       t3.firstname
                  FROM data AS t1 
                 INNER JOIN form AS t2 ON(t2.id = t1.id_form)
                 INNER JOIN client AS t3 ON(t3.id = t2.id_client)
                 WHERE t1.id_form = '$id_form'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getPlanillas() {
        $sql = "SELECT DISTINCT(planilla) AS planilla FROM form ORDER BY planilla ASC";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getPlanillasLog() {
        $sql = "SELECT DISTINCT(log_planilla) AS planilla FROM form ORDER BY log_planilla ASC";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getLotesPlanilla($planilla) {
        $sql = "SELECT DISTINCT(log_lote) AS lote FROM form WHERE log_planilla = '$planilla' AND status = '1' ORDER BY lote ASC ";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getClientsLote($planilla, $lote) {
        $sql = "SELECT cli.id AS id, cli.document AS document, IF(cli.persontype = '1','NATURAL','JURIDICO') AS persontype
			 FROM form INNER JOIN client cli ON cli.id = form.id_client WHERE log_planilla = '$planilla' AND log_lote='$lote' AND form.status = '1' ";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getNamePlanilla($planilla) {
        $sql = "SELECT filename FROM image_tmp WHERE filename LIKE 'PLANILLA" . $planilla . "_%' AND filename NOT LIKE '%_LOTE%'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getDevolucion($documento) {
        $sql = "SELECT * FROM workflow WHERE documento = '$documento'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getDevolucionLote($lote) {
        $sql = "SELECT * FROM workflow WHERE lote = '$lote'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getFullInfoForm($id_form) {
        $sql = "SELECT cli.document, IF(cli.persontype = '1', 'NATURAL','JURIDICO') AS tipopersona, formu.id, formu.type, formu.log_lote,
                formu.log_planilla, formu.date_created AS fechacreacion, user.name, data.fecharadicado, data.fechasolicitud, 
                sucursal.sucursal, param_area.description AS descripcionarea, data.lote, data.id_official AS responsable, 
                param_clasecliente.description AS clasecliente, IF( cli.persontype = '1', CONCAT(data.primerapellido,' ',data.segundoapellido,' ',data.nombres), data.razonsocial ) AS nombrerazon,
                IF( cli.persontype = '1',param_tipodocumento.description,'NIT') AS tipodocumento,
                IF( cli.persontype = '1',data.documento,data.nit) AS documento,
                IF( cli.persontype = '1','NA',data.digitochequeo) AS digitochequeo,
                IF( cli.persontype = '1',data.fechaexpedicion,'NA') AS fechaexpedicion,
                IF( cli.persontype = '1',lugar_exp.description,'NA') AS lugarexpedicion,
                IF( cli.persontype = '1',data.fechanacimiento,'NA') AS fechanacimiento,
                IF( cli.persontype = '1',lugar_nac.description,'NA') AS lugarnacimiento,
                IF( cli.persontype = '1',data.sexo,'NA') AS sexo,
                IF( cli.persontype = '1',param_pais.description, 'NA') AS pais,
                IF( cli.persontype = '1',data.numerohijos,'NA') AS numerohijos,
                IF( cli.persontype = '1',param_estadocivil.description,'NA') AS estadocivil,
                IF( cli.persontype = '2',data.documento,'NA') AS documentorepresentante,
                IF( cli.persontype = '2',CONCAT(data.primerapellido,' ',data.segundoapellido,' ',data.nombres) ,'NA') AS nombrerepresentante,
                IF( cli.persontype = '2',data.fechaexpedicion,'NA') AS fechaexpedicionrepresentante,
                IF( cli.persontype = '2',lugar_exp.description,'NA') AS lugarexpedicionrepresentante,
                data.direccionresidencia AS direccionresidencia, lugar_resi.description AS lugarresidencia, 
                data.telefonoresidencia AS telefonoresidencia, data.nombreempresa AS nombreempresa, lugar_emp.description AS lugarempresa, 
                data.direccionempresa AS direccionempresa, data.nomenclatura, IF( cli.persontype = '1',data.telefonolaboral,'NA') AS telefonolaboral,
                IF(data.correoelectronico='','SD',data.correoelectronico) AS correoelectronico, IF( cli.persontype = '1',data.cargo,'NA') AS cargo,
                param_actividadecono.description AS actividadecono, IF( cli.persontype = '1',param_profesion.description,'NA') AS profesion,
                IF( cli.persontype = '1',param_ocupacion.description,'NA') AS ocupacion,
                IF(param_ciiu.codigo='','SD',param_ciiu.codigo) AS ciiu, 
                IF( cli.persontype = '1',param_ingresosmensuales.description,'NA') AS ingresosmensuales, 
                IF( cli.persontype = '1',param_otrosingresos.description,'NA') AS otrosingresos,
                IF( cli.persontype = '1',param_egresosmensuales.description,'NA') AS egresosmensuales,
                IF(cli.persontype = '1',data.conceptosotrosingresos,'NA') AS conceptos, param_tipoactividad.description AS actividad,
                IF( cli.persontype = '1',param_estudio.description,'NA') AS estudios, 
                IF( cli.persontype = '1',param_tipovivienda.description,'NA') AS tipovivienda, 
                IF( cli.persontype = '1',data.estrato,'NA') AS estrato, data.totalactivos AS totalactivos, data.totalpasivos AS totalpasivos,
                IF( cli.persontype = '1', 'NA', lugar_oficina.description) AS lugaroficina,
                IF( cli.persontype = '1', 'NA', data.direccionoficinappal) AS direccionofi,
                IF( cli.persontype = '1', 'NA', data.nomenclatura_emp) AS nomenclaturaemp,
                IF( cli.persontype = '1', 'NA', data.telefonoficina) AS telefonooficina,
                IF( cli.persontype = '2',data.faxoficina,'NA') AS faxoficina,
                IF( cli.persontype = '1', 'NA', lugar_sucursal.description) AS lugarsucursal,
                IF( cli.persontype = '1', 'NA', data.direccionsucursal) AS direccionsucursal,
                IF( cli.persontype = '1', 'NA', data.nomenclatura_emp2) AS nomenclaturaemp2,
                IF( cli.persontype = '1', 'NA', data.telefonosucursal) AS telefonosucursal,
                IF( cli.persontype = '1', 'NA', data.faxsucursal) AS faxsucursal, 
                IF( cli.persontype = '1', 'NA', param_actividad.description) AS actividad2,
                IF( cli.persontype = '1', 'NA', data.detalleactividadeconomicappal) AS detalleactividad,
                IF( cli.persontype = '1','NA',param_tipoempresa.description) AS tipoemp,
                IF( cli.persontype = '1', 'NA', data.activosemp) AS activosemp, IF( cli.persontype = '1', 'NA', data.pasivosemp) AS pasivosemp,
                IF( cli.persontype = '1', 'NA', param_ingresosmensuales_emp.description)  AS ingresosmensuemp,
                IF( cli.persontype = '1', 'NA', param_egresosmensuales_emp.description) AS egresosmensuemp,
                data.monedaextranjera AS monedaextranjera, 
                IF(data.tipotransacciones = '0','SD',param_tipotransacciones.description) AS tipotransacciones, data.firma, data.huella,
                data.lugarentrevista, data.resultadoentrevista, 
                IF(data.observacionesentrevista = '','SD',data.observacionesentrevista ) AS observacionesentrevista,
                data.nombreintermediario, IF( data.socio1 = '', 'SD', data.socio1) AS socio1, 
                IF( data.socio2 = '', 'SD', data.socio2) AS socio2, IF( data.socio3 = '', 'SD', data.socio3) AS socio3
                FROM client cli 
                INNER JOIN form formu ON(formu.id_client = cli.id)
                INNER JOIN data ON(formu.id = data.id_form)
                LEFT JOIN  param_sucursales sucursal ON(sucursal.id = data.sucursal)
                LEFT JOIN param_area ON(param_area.id = data.area )
                LEFT JOIN param_formulario ON(param_formulario.id = data.formulario)
                LEFT JOIN  param_clasecliente ON( param_clasecliente.id = data.clasecliente)
                LEFT JOIN param_tipodocumento ON(param_tipodocumento.id = data.tipodocumento)
                LEFT JOIN param_ciudad lugar_exp ON(lugar_exp.id = data.lugarexpedicion)
                LEFT JOIN param_ciudad lugar_nac ON(lugar_nac.id = data.lugarnacimiento)
                LEFT JOIN param_pais ON(param_pais.id = data.nacionalidad)
                LEFT JOIN param_estadocivil ON(param_estadocivil.id = data.estadocivil)
                LEFT JOIN param_ciudad lugar_resi ON(lugar_resi.id = data.ciudadresidencia)
                LEFT JOIN param_ciudad lugar_emp ON(lugar_emp.id = data.ciudadempresa)
                LEFT JOIN param_actividadecono ON(param_actividadecono.id = data.actividadeconomicaempresa)
                LEFT JOIN param_profesion ON(param_profesion.id = data.profesion)
                LEFT JOIN param_ocupacion ON(param_ocupacion.id = data.ocupacion)
                LEFT JOIN param_ciiu ON(param_ciiu.codigo = data.ciiu)
                LEFT JOIN param_ingresosmensuales ON(param_ingresosmensuales.id = data.ingresosmensuales)
                LEFT JOIN param_otrosingresos ON(param_otrosingresos.id = data.otrosingresos)
                LEFT JOIN param_egresosmensuales ON(param_egresosmensuales.id = data.egresosmensuales)
                LEFT JOIN param_tipoactividad ON(param_tipoactividad.id = data.tipoactividad)
                LEFT JOIN param_estudio ON(param_estudio.id = data.nivelestudios)
                LEFT JOIN param_tipovivienda ON(param_tipovivienda.id = data.tipovivienda)
                LEFT JOIN param_ciudad lugar_oficina ON(lugar_oficina.id = data.ciudadoficina)
                LEFT JOIN param_ciudad lugar_sucursal ON(lugar_sucursal.id = data.ciudadsucursal)
                LEFT JOIN param_actividad ON(param_actividad.id = data.actividadeconomicappal)
                LEFT JOIN param_tipoempresa ON(param_tipoempresa.id = data.tipoempresaemp)
                LEFT JOIN param_ingresosmensuales_emp ON(param_ingresosmensuales_emp.id = data.ingresosmensualesemp)
                LEFT JOIN param_egresosmensuales_emp ON(param_egresosmensuales_emp.id = data.egresosmensualesemp)
                LEFT JOIN param_tipotransacciones ON(param_tipotransacciones.id = data.tipotransacciones)
                INNER JOIN user ON(user.id = formu.id_user)
                WHERE formu.id = '$id_form'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getCountForms($planilla, $lote) {
        $sql = "SELECT SUM(total) AS total
                  FROM (
                (SELECT COUNT('x') AS total, 'form' AS tipo
                   FROM form 
                  WHERE log_lote = '$lote' 
                    AND status = '1')
                 UNION
                (SELECT COUNT('x') AS total, 'renovacion' AS tipo
                   FROM data_renovacion_autos
                  WHERE lote = '$lote')
                ) AS t";
        $result = mysqli_fetch_array(mysqli_query($GLOBALS['link'], $sql));
        return $result['total'];
    }
    static function getCountForms2($planilla, $lote) {
        $sql = "SELECT SUM(t.total) AS total
                  FROM (
                (SELECT COUNT('x') AS total, 'form' AS tipo
                   FROM form 
                  WHERE log_lote = '$lote' 
                    AND status = '1')
                 UNION
                (SELECT COUNT('x') AS total, 'renovacion' AS tipo
                   FROM data_renovacion_autos
                  WHERE lote = '$lote')
                ) AS t";
        $result = mysqli_fetch_array(mysqli_query($GLOBALS['link'], $sql));
        return $result['total'];
    }
    static function getNoLlegaronForms($lote){
      $SQL = "SELECT COUNT('x') AS total
                FROM radicados AS t1
               INNER JOIN radicados_items AS t2 ON(t2.id_radicados = t1.id)
               WHERE t1.estado = 2
                 AND t2.estado = 1
                 AND t1.id = '$lote'";
      $result = mysqli_fetch_array(mysqli_query($GLOBALS['link'], $SQL));
      return $result['total'];
    }

    function getCountFormsEspecial($id_client) {
        $sql = "SELECT count(data_renovacion_autos.iddata_renovacion_autos) as cant FROM data_renovacion_autos INNER JOIN client ON data_renovacion_autos.documento = client.document WHERE documento = '$id_client'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function getDataFormsEspecial($id_client) {
        $sql = "SELECT iddata_renovacion_autos,razon_social,tipo_doc,documento,ocupacion,ciudad,direccion,telefono,email, fecha_diligenciamiento, numero_poliza FROM data_renovacion_autos INNER JOIN client ON data_renovacion_autos.documento = client.document WHERE client.id = '$id_client'";
        return mysqli_query($GLOBALS['link'], $sql);
    }

    function updateDocument($id_form, $id_client, $document, $tipo) {
        $sql = "UPDATE form SET id_client = '$id_client' WHERE id ='$id_form' ";
        if (mysqli_query($GLOBALS['link'], $sql)) {
            if ($tipo == "1") {
                $sql2 = "UPDATE data SET documento ='$document' WHERE id_form = '$id_form'";
                return mysqli_query($GLOBALS['link'], $sql2);
            } else if ($tipo == "2") {
                $sql2 = "UPDATE data SET nit ='$document' WHERE id_form = '$id_form'";
                return mysqli_query($GLOBALS['link'], $sql2);
            } else {
                return -1;
            }
        } else {
            return -1;
        }
    }

    function updatePlanillas() {
        ini_set('display_errors', 1);
        $respuesta = 'respuesta: ';
        $temp = file('archivo.csv');
        $n = count($temp);
        for ($i = 1; $i < $n; $i++) {
            $datos_leer = explode(";", $temp[$i]);
            $SQL1 = "SELECT id 
                    FROM  client 
                    WHERE document =  '" . $datos_leer[1] . "'";
            $resq = mysqli_query($GLOBALS['link'], $SQL1);
            if (mysqli_num_rows($resq) == 1) {
                $result = mysqli_fetch_assoc($resq);
                $sql = "UPDATE form 
                        SET planilla = 'PLANILLA" . $datos_leer[3] . "', log_planilla = " . $datos_leer[3] . " 
                        WHERE id_client = " . $result['id'] . " 
                        AND log_lote = " . $datos_leer[0];
                //echo $sql;
                if (mysqli_query($GLOBALS['link'], $sql))
                    $respuesta .= 'Actualizado Cliente Con Documento #: ' . $datos_leer[1] . '<br>';
            }
        }
        return $respuesta;
    }
    function insertformautos($razonsocial, $tipodoc, $numdoc, $ocupacion, $detalle, $ciudad, $direccion, $telefono, $email, $fecha, $npoliza, $nombres, $papellido, $sapellido, $indicativo_doc, $lote, $planilla, $id_usuario, $id_form) {
        $log_planilla = substr($planilla, 8, strlen($planilla)); //8 PORQUE ES LA LONGITUD DE PLANILLA
        $log_lote = substr($lote, 5, strlen($lote));
        $sql = "INSERT INTO data_renovacion_autos
                (
                  iddata_renovacion_autos, razon_social, tipo_doc, documento, ocupacion, ocupacion_detalle,  
                  ciudad, direccion, telefono, email, fecha_diligenciamiento, numero_poliza, 
                  nombres, p_apellido, s_apellido, indicativo_doc, lote, planilla, id_usuario, id_fomulario
                ) 
                VALUES 
                (
                  '', '$razonsocial', $tipodoc, $numdoc, $ocupacion, '$detalle', 
                  $ciudad, '$direccion', $telefono, '$email', '$fecha', '$npoliza', 
                  '$nombres', '$papellido', '$sapellido' , '$indicativo_doc', '$log_lote', '$log_planilla', '$id_usuario', '$id_form'
                )";
        //echo $sql;
        if (mysqli_query($GLOBALS['link'], $sql)) {
            return 0;
        } else {
            return -1;
        }
    }

    function updateformautos($formatoesp) {
        //return 'desde la case->|' . $formatoesp["razonsocial"] . " | " . $formatoesp["grupodoc"] . " | " . $formatoesp["numero"] . " | " . $formatoesp["ocupacti"] . " | " . $formatoesp["ciudad"] . " | " . $formatoesp["direccion"] . " | " . $formatoesp["telefono"] . " | " . $formatoesp["email"] . " | " . $formatoesp["idformato"] . "";
        $fecha = $formatoesp["age"]."-".$formatoesp["mes_"]."-".$formatoesp["dia"];
        $sql = "UPDATE data_renovacion_autos 
                SET razon_social = '".$formatoesp["razonsocial"]."', tipo_doc = '".$formatoesp["grupodoc"]."', 
                documento = '".$formatoesp["numero"]."', ocupacion = '".$formatoesp["ocupacti"]."', ciudad = '".$formatoesp["ciudad"]."', 
                direccion = '".$formatoesp["direccion"]."', telefono = '".$formatoesp["telefono"]."', email = '".$formatoesp["email"]."', 
                fecha_diligenciamiento = '".$fecha."', numero_poliza = '".$formatoesp["npoliza"]."' 
                WHERE iddata_renovacion_autos = '".$formatoesp["idformato"]."'";
        if (mysqli_query($GLOBALS['link'], $sql))
          return TRUE;
        else
          return FALSE;
    }

    function insertThreeData($p_apellido, $s_apellido, $nombres, $tipo_documento, $documento, $direccion, $ciudad, $telefono, $ocupacion, $detalle, $cod_verificacion, $razon_social, $idform) {
        if ($tipo_documento == 7) {
            $sql = "UPDATE data 
                    SET direccionresidencia = '$direccion', ciudadresidencia = '$ciudad', 
                    telefonoresidencia = '$telefono', actividadeconomicappal = '$ocupacion', 
                    detalleactividadeconomicappal = '$detalle', razonsocial = '$razon_social', 
                    nit = '$documento', digitochequeo = '$cod_verificacion', estado_autos = '3' 
                    WHERE id_form = '$idform'";
        } else {
            $sql = "UPDATE data 
                    SET primerapellido = '$p_apellido', segundoapellido = '$s_apellido', nombres = '$nombres', 
                    tipodocumento = '$tipo_documento', documento = '$documento', direccionresidencia = '$direccion', 
                    ciudadresidencia = '$ciudad', telefonoresidencia = '$telefono', ocupacion = '$ocupacion', 
                    detalleocupacion = '$detalle', estado_autos = '3' 
                    WHERE id_form = '$idform'";
        }
        //return $sql;
        if (mysqli_query($GLOBALS['link'], $sql)) {
            return true;
        } else {
            return false;
        }
    }
    function fomrAutos($id_client){
      $SQL = "SELECT i.*, dra.iddata_renovacion_autos, dra.id_usuario
                FROM form f
               INNER JOIN client c ON(c.id = f.id_client)
               INNER JOIN data_renovacion_autos dra ON(dra.documento = c.document)
               INNER JOIN image i ON(i.id_forma = f.id)
               WHERE c.id = '$id_client'
                 AND i.id_imagetype = '5'
               GROUP BY i.id";
      return mysqli_query($GLOBALS['link'], $SQL);
    }
    public static function getLastDataInsert($id_form){
      $sql = "SELECT t1.id, t2.date_created
                FROM data AS t1
               INNER JOIN form AS t2 ON(t2.id = t1.id_form) 
               WHERE t1.id_form = $id_form 
               ORDER BY 2
               LIMIT 1";
      $resp = mysqli_query($GLOBALS['link'], $sql);
      $dato = mysqli_fetch_array($resp);
      return $dato;
    }
    public static function insertCuentas($idData, $producto_tipo, $producto_identificacion, $producto_entidad, $producto_monto, $producto_ciudad, $producto_pais, $producto_moneda){
      $sql = "INSERT INTO data_productos 
              (
                data_id, producto_tipo, producto_identificacion, producto_entidad, producto_monto, producto_ciudad, producto_pais, producto_moneda
              ) 
              VALUES 
              (
                '$idData', '$producto_tipo', '$producto_identificacion', '$producto_entidad', '$producto_monto', '$producto_ciudad', '$producto_pais', '$producto_moneda'
              )";
      if(mysqli_query($GLOBALS['link'], $sql)){
        return true;
      }else{
        return false;
      }
    }
    public static function insertReclamaciones($idData, $rec_ano, $rec_ramo, $rec_compania, $rec_valor, $rec_resultado){
      $sql = "INSERT INTO data_reclamaciones 
              (
                data_id, rec_ano, rec_ramo, rec_compania, rec_valor, rec_resultado
              ) 
              VALUES 
              (
                '$idData', '$rec_ano', '$rec_ramo', '$rec_compania', '$rec_valor', '$rec_resultado'
              )";
      if(mysqli_query($GLOBALS['link'], $sql)){
        return true;
      }else{
        return false;
      }
    }
    public static function insertAccionistas($data_id, $tipo_id, $identificacion, $nombre_accionista, $porcentaje, $publico_recursos, $publico_reconocimiento, $publico_expuesta, $declaracion_tributaria){
      $sql = "INSERT INTO data_socios 
              (
                data_id, tipo_id, identificacion, nombre_accionista, porcentaje, publico_recursos, publico_reconocimiento, publico_expuesta, declaracion_tributaria
              ) 
              VALUES 
              (
                '$data_id', '$tipo_id', '$identificacion', '$nombre_accionista', '$porcentaje', '$publico_recursos', '$publico_reconocimiento', '$publico_expuesta', '$declaracion_tributaria'
              )";
      if(mysqli_query($GLOBALS['link'], $sql)){
        return true;
      }else{
        return false;
      }

    }
	public static function verificarTelefono($dato){
		$conn = new Conexion();
		$SQL = "SELECT id 
				  FROM telefono 
				 WHERE cliente_id = :cliente_id
				   AND telefono = :telefono";
		if($conn->consultar($SQL, array(':cliente_id'=> $dato['cliente_id'], ':telefono'=> trim($dato['telefono'])))){
			$cantReg = $conn->getNumeroRegistros();
			if($cantReg >= 1){
				$da = $conn->sacarRegistro('str');
				$conn->desconectar();
				return $da['id'];
			}else{
				$SQU = "INSERT INTO telefono 
						(
							cliente_id, telefono, cod_ciudad, ciudad, tipo_demografico_id, origen_id
						) 
						VALUES 
						(
							:cliente_id, :telefono, :cod_ciudad, :ciudad, :tipo_demografico_id, :origen_id
						)";
				$data = array(
					':cliente_id'=> $dato['cliente_id'],
					':telefono'=> trim($dato['telefono']),
					':cod_ciudad'=> trim($dato['cod_ciudad']),
					':ciudad'=> trim($dato['ciudad']),
					':tipo_demografico_id'=> $dato['tipo_demografico_id'],
					':origen_id'=> $dato['origen_id']
				);
				try{
					if($conn->ejecutar($SQU, $data)){
						$ultimaId = $conn->ultimaId();
						$conn->desconectar();
						return $ultimaId;
					}else{
						$conn->desconectar();
						return false;
					}
				}catch(PDOException $Exception){
					$SQU = "INSERT INTO telefono_excepcion(excepcion, error, codigo, datos) VALUES (:excepcion, :error, :codigo, :datos)";
					$conn->ejecutar($SQU, array(':excepcion'=> 'PDOException', ':error'=> $Exception->getMessage(), ':codigo'=> $Exception->getCode(), ':datos'=> json_encode($data)));
					//throw new PDOException($Exception->getMessage(), (int)$Exception->getCode());
				}catch(Exception $e){
					$SQU = "INSERT INTO telefono_excepcion(excepcion, error, codigo, datos) VALUES (:excepcion, :error, :codigo, :datos)";
					$conn->ejecutar($SQU, array(':excepcion'=> 'Exception', ':error'=> $e->getMessage(), ':codigo'=> $e->getCode(), ':datos'=> json_encode($data)));
					//throw new Exception($e->getMessage(), (int)$e->getCode());
				}
			}
		}
	}
	public static function verificarDireccion($dato){
		$conn = new Conexion();
		$SQL = "SELECT id 
				  FROM direccion 
				 WHERE cliente_id = :cliente_id
				   AND direccion = :direccion";
		if($conn->consultar($SQL, array(':cliente_id'=> $dato['cliente_id'], ':direccion'=> trim($dato['direccion'])))){
			$cantReg = $conn->getNumeroRegistros();
			if($cantReg >= 1){
				$da = $conn->sacarRegistro('str');
				$conn->desconectar();
				return $da['id'];
			}else{
				$SQU = "INSERT INTO direccion 
						(
							cliente_id, direccion, cod_ciudad, ciudad, tipo_demografico_id, origen_id
						) 
						VALUES 
						(
							:cliente_id, :direccion, :cod_ciudad, :ciudad, :tipo_demografico_id, :origen_id
						)";
				$data = array(
					':cliente_id'=> $dato['cliente_id'],
					':direccion'=> trim($dato['direccion']),
					':cod_ciudad'=> trim($dato['cod_ciudad']),
					':ciudad'=> trim($dato['ciudad']),
					':tipo_demografico_id'=> $dato['tipo_demografico_id'],
					':origen_id'=> $dato['origen_id']
				);
				try{
					if($conn->ejecutar($SQU, $data)){
						$ultimaId = $conn->ultimaId();
						$conn->desconectar();
						return $ultimaId;
					}else{
						$conn->desconectar();
						return false;
					}
				}catch(PDOException $Exception){
					$SQU = "INSERT INTO direccion_exception(excepcion, error, codigo, datos) VALUES (:excepcion, :error, :codigo, :datos)";
					$conn->ejecutar($SQU, array(':excepcion'=> 'PDOException', ':error'=> $Exception->getMessage(), ':codigo'=> $Exception->getCode(), ':datos'=> json_encode($data)));
					//throw new PDOException($Exception->getMessage(), (int)$Exception->getCode());
				}catch(Exception $e){
					$SQU = "INSERT INTO direccion_exception(excepcion, error, codigo, datos) VALUES (:excepcion, :error, :codigo, :datos)";
					$conn->ejecutar($SQU, array(':excepcion'=> 'Exception', ':error'=> $e->getMessage(), ':codigo'=> $e->getCode(), ':datos'=> json_encode($data)));
					//throw new Exception($e->getMessage(), (int)$e->getCode());
				}
			}
		}
	}
}
