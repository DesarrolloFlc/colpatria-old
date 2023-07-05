<table id="table_parte1">
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="left"><strong>DATOS B&Aacute;SICA DEL TOMADOR</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Primer apellido:</td>
		<td>
			<input type="text" id="primerapellido" name="primerapellido" style="width: 130px; margin-right: 30px" onkeypress="return validar_letra(event)" title="Primer apellido" value="<?=$dataform['primerapellido']?>" data-oldvalue="<?=$dataform['primerapellido']?>">
			Segundo apellido:&nbsp;
			<input type="text" id="segundoapellido" name="segundoapellido" style="width: 130px" onkeypress="return validar_letra(event)" title="Segundo apellido" value="<?=$dataform['segundoapellido']?>" data-oldvalue="<?=$dataform['segundoapellido']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Nombres:</td>
		<td><input type="text" id="nombres" name="nombres" style="width: 200px; margin-right: 40px" onkeypress="return validar_letra(event)" title="Nombres" value="<?=$dataform['nombres']?>" data-oldvalue="<?=$dataform['nombres']?>"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Tipo documento:</td>
		<td>
			<select id="tipodocumento" name="tipodocumento" style="font-size: 12px; margin-right: 5px" title="Tipo documento" data-oldvalue="<?=$dataform['tipodocumento']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($tipoDocumentos) && !empty($tipoDocumentos) && is_array($tipoDocumentos)){
	foreach($tipoDocumentos as $tipo){
	    $slect = '';
	    if($dataform['tipodocumento'] == $tipo['id'])
	        $slect = ' selected';
?>
				<option value="<?=$tipo['id']?>"<?=$slect?>><?=$tipo['description']?></option>
<?php
	}
}
?>
			</select>
			Numero identificacion:&nbsp;<input type="text" id="documento" name="documento" style="width: 130px; display: initial;" title="Numero identificacion" readonly value="<?=$dataform['documento']?>" data-oldvalue="<?=$dataform['documento']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Fecha expedicion:</td>
		<td>
			<input type="hidden" id="fechaexpedicion" name="fechaexpedicion" value="<?=$dataform['fechaexpedicion']?>">
			<select id="f_exp_a" name="f_exp_a" onchange="$(this).verificarFecha(event, 'exp', '0');" style="font-size: 12px" title="Año de fecha expedicion">
				<option value="">Año</option>
<?php
$f_r = explode('-', $dataform['fechaexpedicion']);
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++){
    $select = '';
    if($i == $f_r[0])
        $select = ' selected';
?>
				<option value="<?=$i?>"<?=$select?>><?=$i?></option>
<?php
}
?>
			</select>
			<select id="f_exp_m" name="f_exp_m" onchange="$(this).verificarFecha(event, 'exp', '0');" style="font-size: 12px" title="Mes de fecha expedicion">
				<option value="">Mes</option>
<?php
$an = 1;
for($i = $an; $i <= 12; $i++){
    $select = '';
	$val_m = '0'.$i;
	if($i > 9)
		$val_m = $i;
    if($val_m == $f_r[1])
        $select = ' selected';
?>
				<option value="<?=$val_m?>"<?=$select?>><?=$val_m?></option>
<?php
}
?>
			</select>
			<select id="f_exp_d" name="f_exp_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px" title="Dia de fecha expedicion">
				<option value="">Dia</option>
<?php
    for ($d = 1; $d <= 31; $d++) { 
        $time = mktime(12, 0, 0, $f_r[1], $d, $f_r[0]);
        if (date('m', $time) == $f_r[1]){
            $select = '';
            $day = date('d', $time);
            if($day == $f_r[2])
                $select = ' selected';
?>
                        <option value="<?=$day?>"<?=$select?>><?=$day?></option>
<?php
        }
    }
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Lugar expedicion:</td>
		<td>
			<select id="lugarexpedicion" name="lugarexpedicion" style="font-size: 12px" title="Lugar expedicion" data-oldvalue="<?=$dataform['lugarexpedicion']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($daneCiudades) && !empty($daneCiudades) && is_array($daneCiudades)){
	foreach($daneCiudades as $ciudad){
	    $slect = '';
	    if($dataform['lugarexpedicion'] == $ciudad['id'])
	        $slect = ' selected';
?>
				<option value="<?=$ciudad['id']?>"<?=$slect?>><?=$ciudad['ciudad']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Fecha nacimiento:</td>
		<td>
			<input type="hidden" id="fechanacimiento" name="fechanacimiento" value="<?=$dataform['fechanacimiento']?>">
			<select id="f_nac_a" name="f_nac_a" onchange="$(this).verificarFecha(event, 'nac', '1');" style="font-size: 12px" title="Año de fecha nacimiento">
				<option value="">Año</option>
<?php
$f_r = explode('-', $dataform['fechanacimiento']);
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl; $i++){
    $select = '';
    if($i == $f_r[0])
        $select = ' selected';
?>
				<option value="<?=$i?>"<?=$select?>><?=$i?></option>
<?php
}
?>
			</select>
			<select id="f_nac_m" name="f_nac_m" onchange="$(this).verificarFecha(event, 'nac', '1');" style="font-size: 12px" title="Mes de fecha nacimiento">
				<option value="">Mes</option>
<?php
$an = 1;
for($i = $an; $i <= 12; $i++){
    $select = '';
	$val_m = '0'.$i;
	if($i > 9)
		$val_m = $i;
    if($val_m == $f_r[1])
        $select = ' selected';
?>
				<option value="<?=$val_m?>"<?=$select?>><?=$val_m?></option>
<?php
}
?>
			</select>
			<select id="f_nac_d" name="f_nac_d" style="font-size: 12px" title="Dia de fecha nacimiento">
				<option value="">Dia</option>
<?php
for ($d = 1; $d <= 31; $d++) { 
    $time = mktime(12, 0, 0, $f_r[1], $d, $f_r[0]);
    if (date('m', $time) == $f_r[1]){
        $select = '';
        $day = date('d', $time);
        if($day == $f_r[2])
            $select = ' selected';
?>
				<option value="<?=$day?>"<?=$select?>><?=$day?></option>
<?php
        }
    }
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Nacionalidad:</td>
		<td>
			<select id="paisnacimiento" name="paisnacimiento" style="font-size: 12px" title="Nacionalidad" data-oldvalue="<?=$dataform['paisnacimiento']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($paises) && !empty($paises) && is_array($paises)){
	foreach($paises as $pais){
	    $slect = '';
	    if($dataform['paisnacimiento'] == $pais['id'])
	        $slect = ' selected';
?>
				<option value="<?=$pais['id']?>"<?=$slect?>><?=$pais['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Nacionalidad 2:</td>
		<td>
			<select id="nacionalidad_otra" name="nacionalidad_otra" style="font-size: 12px" title="Nacionalidad 2" data-oldvalue="<?=$dataform['nacionalidad_otra']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($paises) && !empty($paises) && is_array($paises)){
	foreach($paises as $pais){
	    $slect = '';
	    if($dataform['nacionalidad_otra'] == $pais['id'])
	        $slect = ' selected';
?>
				<option value="<?=$pais['id']?>"<?=$slect?>><?=$pais['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">E-mail:</td>
		<td><input type="text" id="correoelectronico" name="correoelectronico" style="width: 240px" onkeypress="return validar_letra(event)" title="E-mail" value="<?=$dataform['correoelectronico']?>" data-oldvalue="<?=$dataform['correoelectronico']?>"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Lugar nacimiento:</td>
		<td>
			<select id="lugarnacimiento" name="lugarnacimiento" style="font-size: 12px" title="Lugar nacimiento" data-oldvalue="<?=$dataform['lugarnacimiento']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($daneCiudades) && !empty($daneCiudades) && is_array($daneCiudades)){
	foreach($daneCiudades as $ciudad){
	    $slect = '';
	    if($dataform['lugarnacimiento'] == $ciudad['id'])
	        $slect = ' selected';
?>
				<option value="<?=$ciudad['id']?>"<?=$slect?>><?=$ciudad['ciudad']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Telefono:</td>
		<td>
			<input type="text" id="telefonoresidencia" name="telefonoresidencia" style="width: 130px; margin-right: 40px" maxlength="7" onchange="$(this).checkTamanoTele(event, 7);" onkeypress="return validar_num(event)" title="Telefono" value="<?=$dataform['telefonoresidencia']?>" data-oldvalue="<?=$dataform['telefonoresidencia']?>">
			Celular:
			<input type="text" id="celular" name="celular" style="width: 130px" maxlength="10" onchange="$(this).checkTamanoTele(event, 10);" onkeypress="return validar_num(event)" title="Celular" value="<?=$dataform['celular']?>" data-oldvalue="<?=$dataform['celular']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Direccion residencia:</td>
		<td><input type="text" id="direccionresidencia" name="direccionresidencia" style="width: 240px" onkeypress="return validar_letra(event)" title="Direccion residencia" value="<?=$dataform['direccionresidencia']?>" data-oldvalue="<?=$dataform['direccionresidencia']?>"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Ciudad y departamento:</td>
		<td>
			<select id="ciudadresidencia" name="ciudadresidencia" style="font-size: 12px" title="Ciudad y departamento" data-oldvalue="<?=$dataform['ciudadresidencia']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($daneCiudades) && !empty($daneCiudades) && is_array($daneCiudades)){
	foreach($daneCiudades as $ciudad){
	    $slect = '';
	    if($dataform['ciudadresidencia'] == $ciudad['id'])
	        $slect = ' selected';
?>
				<option value="<?=$ciudad['id']?>"<?=$slect?>><?=$ciudad['ciudad']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Actividad economica:</td>
		<td>
			<select id="tipoactividad" name="tipoactividad" style="font-size: 12px; margin-right: 5px" title="Actividad economica" data-oldvalue="<?=$dataform['tipoactividad']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($actEconomicas) && !empty($actEconomicas) && is_array($actEconomicas)){
	foreach($actEconomicas as $actEconomica){
	    $slect = '';
	    if($dataform['tipoactividad'] == $actEconomica['id'])
	        $slect = ' selected';
?>
				<option value="<?=$actEconomica['id']?>"<?=$slect?>><?=$actEconomica['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">CIIU(codigo):</td>
		<td>
			
			<select id="ciiu" name="ciiu" style="font-size: 12px; margin-right: 5px" title="CIIU(codigo)" data-oldvalue="<?=$dataform['ciiu']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($ciius) && !empty($ciius) && is_array($ciius)){
	foreach($ciius as $ciiu){
	    $slect = '';
	    if($dataform['ciiu'] == $ciiu['codigo'])
	        $slect = ' selected';
?>
				<option value="<?=$ciiu['codigo']?>"<?=$slect?>><?=$ciiu['descripcion']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Tipo empresa</td>
		<td>
			<select id="tipoempresaemp" name="tipoempresaemp" style="font-size: 12px; margin-right: 5px" title="Tipo empresa" data-oldvalue="<?=$dataform['tipoempresaemp']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($tipoempresas) && !empty($tipoempresas) && is_array($tipoempresas)){
	foreach($tipoempresas as $tipoempresa){
	    $slect = '';
	    if($dataform['tipoempresaemp'] == $tipoempresa['id'])
	        $slect = ' selected';
?>
				<option value="<?=$tipoempresa['id']?>"<?=$slect?>><?=$tipoempresa['description']?></option>
<?php
	}
}
?>
			</select>
			Cual?
			<input type="text" id="tipoempresaemp_cual" name="tipoempresaemp_cual" style="width: 100px" disabled onkeypress="return validar_letra(event)" title="Cual tipo empresa" value="<?=$dataform['tipoempresaemp_cual']?>" data-oldvalue="<?=$dataform['tipoempresaemp_cual']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Ocupacion / Profesion</td>
		<td>
			<select id="profesion" name="profesion" style="font-size: 12px; margin-right: 5px" title="Ocupacion / Profesion" data-oldvalue="<?=$dataform['profesion']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($profesiones) && !empty($profesiones) && is_array($profesiones)){
	foreach($profesiones as $profesion){
    $slect = '';
    if($dataform['profesion'] == $profesion['id'])
        $slect = ' selected';
?>
				<option value="<?=$profesion['id']?>"<?=$slect?>><?=$profesion['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Cargo:</td>
		<td><input type="text" id="cargo" name="cargo" style="width: 260px" onkeypress="return validar_letra(event)" title="Cargo" value="<?=$dataform['cargo']?>" data-oldvalue="<?=$dataform['cargo']?>"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Empresa donde labora:</td>
		<td><input type="text" id="nombreempresa" name="nombreempresa" style="width: 240px" onkeypress="return validar_letra(event)" title="Empresa donde labora" value="<?=$dataform['nombreempresa']?>" data-oldvalue="<?=$dataform['nombreempresa']?>"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Direccion oficina:</td>
		<td>
			<input type="text" id="direccionempresa" name="direccionempresa" style="width: 180px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Direccion oficina" value="<?=$dataform['direccionempresa']?>" data-oldvalue="<?=$dataform['direccionempresa']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Ciudad empresa</td>
		<td>
			<select id="ciudadempresa" name="ciudadempresa" style="font-size: 12px" title="Ciudad empresa" data-oldvalue="<?=$dataform['ciudadempresa']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($daneCiudades) && !empty($daneCiudades) && is_array($daneCiudades)){
	foreach($daneCiudades as $ciudad){
	    $slect = '';
	    if($dataform['ciudadempresa'] == $ciudad['id'])
	        $slect = ' selected';
?>
				<option value="<?=$ciudad['id']?>"<?=$slect?>><?=$ciudad['ciudad']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Telefono oficina:</td>
		<td>
			<input type="text" id="telefonolaboral" name="telefonolaboral" style="width: 100px" onchange="$(this).checkTamanoTele(event, 7);" maxlength="7" onkeypress="return validar_num(event)" title="Telefono oficina" value="<?=$dataform['telefonolaboral']?>" data-oldvalue="<?=$dataform['telefonolaboral']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Producto que comercializa:</td>
		<td><input type="text" id="detalletipoactividad" name="detalletipoactividad" style="width: 220px" onkeypress="return validar_letra(event)" title="Producto que comercializa" value="<?=$dataform['detalletipoactividad']?>" data-oldvalue="<?=$dataform['detalletipoactividad']?>"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Activos:</td>
		<td>
			<input type="text" id="totalactivos" name="totalactivos" style="width: 100px; margin-right: 20px" title="Activos" onkeypress="return validar_num(event)" value="<?=$dataform['totalactivos']?>" data-oldvalue="<?=$dataform['totalactivos']?>">
			Ingresos mensuales:
			<select id="ingresosmensuales" name="ingresosmensuales" style="font-size: 12px; margin-right: 5px" title="Ingresos mensuales" data-oldvalue="<?=$dataform['ingresosmensuales']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($ingresos) && !empty($ingresos) && is_array($ingresos)){
	foreach($ingresos as $ingreso){
	    $slect = '';
	    if($dataform['ingresosmensuales'] == $ingreso['id'])
	        $slect = ' selected';
?>
				<option value="<?=$ingreso['id']?>"<?=$slect?>><?=$ingreso['description']?></option>
<?php
	}
}
if($dataform['ingresosmensuales'] == '13')
	echo '<option value="13" selected>SD</option>';
?>
			</select>
			
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Pasivos:</td>
		<td><input type="text" id="totalpasivos" name="totalpasivos" style="width: 100px" title="Pasivos" onkeypress="return validar_num(event)" value="<?=$dataform['totalpasivos']?>" data-oldvalue="<?=$dataform['totalpasivos']?>">
			Otros ingresos:
			<select id="otrosingresos" name="otrosingresos" style="font-size: 12px; margin-right: 5px" title="Otros ingresos" data-oldvalue="<?=$dataform['otrosingresos']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($ingresos) && !empty($ingresos) && is_array($ingresos)){
	foreach($ingresos as $ingreso){
	    $slect = '';
	    if($dataform['otrosingresos'] == $ingreso['id'])
	        $slect = ' selected';
?>
				<option value="<?=$ingreso['id']?>"<?=$slect?>><?=$ingreso['description']?></option>
<?php
	}
	$slect = '';
    if($dataform['otrosingresos'] == '13')
        $slect = ' selected';
}
?>
				<option value="13"<?=$slect?>>SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Patrimonio:</td>
		<td>
			<input type="text" id="patrimonio" name="patrimonio" style="width: 100px" title="Patrimonio" onkeypress="return validar_num(event)" value="<?=$dataform['patrimonio']?>" data-oldvalue="<?=$dataform['patrimonio']?>">
			Egresos mensuales:
			<select id="egresosmensuales" name="egresosmensuales" style="font-size: 12px; margin-right: 5px" title="Egresos mensuales" data-oldvalue="<?=$dataform['egresosmensuales']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($egresos) && !empty($egresos) && is_array($egresos)){
	foreach($egresos as $egreso){
	    $slect = '';
	    if($dataform['egresosmensuales'] == $egreso['id'])
	        $slect = ' selected';
?>
				<option value="<?=$egreso['id']?>"<?=$slect?>><?=$egreso['description']?></option>
<?php
	}
}
if($dataform['egresosmensuales'] == '13')
	echo '<option value="13" selected>SD</option>';
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Concepto otros ingresos:</td>
		<td>
			<input type="text" id="conceptosotrosingresos" name="conceptosotrosingresos" style="width: 300px" onkeypress="return validar_letra(event)" title="Concepto otros ingresos" value="<?=$dataform['conceptosotrosingresos']?>" data-oldvalue="<?=$dataform['conceptosotrosingresos']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Persona expuesta politicamente?</td>
		<td>
			<select id="expuesta_politica" name="expuesta_politica" style="font-size: 12px; margin-right: 15px" title="Persona expuesta politicamente" data-oldvalue="<?=$dataform['expuesta_politica']?>">
				<option value="">Seleccion...</option>
				<option value="-1"<?=(($dataform['expuesta_politica'] == "-1") ? "selected" : "")?>>SI</option>
				<option value="0"<?=(($dataform['expuesta_politica'] == "0") ? "selected" : "")?>>NO</option>
				<option value="2"<?=(($dataform['expuesta_politica'] == "2") ? "selected" : "")?>>SD</option>
			</select>
			Familiar de expuesto politico?
			<select id="expuesta_publica" name="expuesta_publica" style="font-size: 12px; margin-right: 5px" title="Familiar de expuesto politico" data-oldvalue="<?=$dataform['expuesta_publica']?>">
				<option value="">Seleccion...</option>
				<option value="-1"<?=(($dataform['expuesta_publica'] == "-1") ? "selected" : "")?>>SI</option>
				<option value="0"<?=(($dataform['expuesta_publica'] == "0") ? "selected" : "")?>>NO</option>
				<option value="2"<?=(($dataform['expuesta_publica'] == "2") ? "selected" : "")?>>SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
		<td>
			<select id="recursos_publicos" name="recursos_publicos" style="font-size: 12px; margin-right: 15px" title="Maneja recursos publicos" data-oldvalue="<?=$dataform['recursos_publicos']?>">
				<option value="">Seleccion...</option>
				<option value="-1"<?=(($dataform['recursos_publicos'] == "-1") ? "selected" : "")?>>SI</option>
				<option value="0"<?=(($dataform['recursos_publicos'] == "0") ? "selected" : "")?>>NO</option>
				<option value="2"<?=(($dataform['recursos_publicos'] == "2") ? "selected" : "")?>>SD</option>
			</select>
			Obligaciones tributarias en otro pais?
			<select id="tributarias_otro_pais" name="tributarias_otro_pais" style="font-size: 12px; margin-right: 15px" title="Obligaciones fiscales en otro pais" data-oldvalue="<?=$dataform['tributarias_otro_pais']?>">
				<option value="">Seleccion...</option>
				<option value="-1"<?=(($dataform['tributarias_otro_pais'] == "-1") ? "selected" : "")?>>SI</option>
				<option value="0"<?=(($dataform['tributarias_otro_pais'] == "0") ? "selected" : "")?>>NO</option>
				<option value="2"<?=(($dataform['tributarias_otro_pais'] == "2") ? "selected" : "")?>>SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Operaciones en moneda extranjera?</td>
		<td>
			<select id="monedaextranjera" name="monedaextranjera" style="font-size: 12px; margin-right: 5px" title="Operaciones en moneda extranjera" data-oldvalue="<?=$dataform['monedaextranjera']?>">
				<option value="">Seleccion...</option>
				<option value="-1"<?=(($dataform['monedaextranjera'] == "-1") ? "selected" : "")?>>SI</option>
				<option value="0"<?=(($dataform['monedaextranjera'] == "0") ? "selected" : "")?>>NO</option>
				<option value="2"<?=(($dataform['monedaextranjera'] == "2") ? "selected" : "")?>>SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Cual?</td>
		<td>
			<select id="tipotransacciones" name="tipotransacciones" style="font-size: 12px; margin-right: 5px" disabled title="Cual operacion en moneda extranjera" data-oldvalue="<?=$dataform['tipotransacciones']?>">
				<option value="">Seleccione...</option>
<?php
if(isset($transacciones) && !empty($transacciones) && is_array($transacciones)){
	foreach($transacciones as $transaccion){
	    $slect = '';
	    if($dataform['tipotransacciones'] == $transaccion['id'])
	        $slect = ' selected';
?>
				<option value="<?=$transaccion['id']?>"<?=$slect?>><?=$transaccion['description']?></option>
<?php
	}
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;"></td>
		<td>
			<input type="text" id="tipotransacciones_cual" name="tipotransacciones_cual" style="width: 135px" disabled onkeypress="return validar_letra(event)" title="Cual otra" value="<?=$dataform['tipotransacciones_cual']?>" data-oldvalue="<?=$dataform['tipotransacciones_cual']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Responsable RUT?</td>
		<td>
			<select id="responsable_rut" name="responsable_rut" style="font-size: 12px; margin-right: 5px" title="Responsable RUT" data-oldvalue="<?=$dataform['responsable_rut']?>">
				<option value="">Seleccion...</option>
				<option value="-1"<?=(($dataform['responsable_rut'] == "-1") ? "selected" : "")?>>SI</option>
				<option value="0"<?=(($dataform['responsable_rut'] == "0") ? "selected" : "")?>>NO</option>
				<option value="2"<?=(($dataform['responsable_rut'] == "2") ? "selected" : "")?>>SD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Codigo de responsabilidad</td>
		<td>
			<input type="text" id="codigo_rut" name="codigo_rut" style="width: 135px" disabled onkeypress="return validar_letra(event)" title="Codigo de responsabilidad" value="<?=$dataform['codigo_rut']?>" data-oldvalue="<?=$dataform['codigo_rut']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">E-mail registrado en DIAN:</td>
		<td>
			<input type="text" id="correoelectronico_otro" name="correoelectronico_otro" style="width: 230px" onkeypress="return validar_letra(event)" title="E-mail" disabled value="<?=$dataform['correoelectronico_otro']?>" data-oldvalue="<?=$dataform['correoelectronico_otro']?>">
		</td>
	</tr>
</table>