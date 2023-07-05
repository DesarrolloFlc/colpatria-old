<table>
	<tr style="background-color: #cabbf7; color: #00e;">
		<td colspan="2" align="center"><strong>DATOS B&Aacute;SICA DEL TOMADOR</strong></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Primer apellido:</td>
		<td>
			<input type="text" id="primerapellido" name="primerapellido" style="width: 130px; margin-right: 30px" onkeypress="return validar_letra(event)" title="Primer apellido" value="<?=$dataform['primerapellido']?>"data-oldvalue="<?=$dataform['primerapellido']?>">
			Segundo apellido:&nbsp;
			<input type="text" id="segundoapellido" name="segundoapellido" style="width: 130px" onkeypress="return validar_letra(event)" title="Segundo apellido" value="<?=$dataform['segundoapellido']?>"data-oldvalue="<?=$dataform['segundoapellido']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Nombres:</td>
		<td><input type="text" id="nombres" name="nombres" style="width: 200px; margin-right: 40px" onkeypress="return validar_letra(event)" title="Nombres" value="<?=$dataform['nombres']?>"data-oldvalue="<?=$dataform['nombres']?>"></td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Tipo documento:</td>
		<td>
			<select id="tipodocumento" name="tipodocumento" style="font-size: 12px; margin-right: 5px" title="Tipo documento">
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
			Numero identificacion:&nbsp;<input type="text" id="documento" name="documento" readonly style="width: 130px; display: initial;" title="Numero identificacion" value="<?=$dataform['documento']?>"data-oldvalue="<?=$dataform['documento']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Fecha expedicion:</td>
		<td>
			<input type="hidden" id="fechaexpedicion" name="fechaexpedicion" value="<?=$dataform['fechaexpedicion']?>">
			<select id="f_exp_a" name="f_exp_a" onchange="$(this).verificarFecha(event, 'exp', '1');" style="font-size: 12px" title="Año de fecha expedicion">
				<option value="">Año</option>
<?php
$f_r = explode('-', $dataform['fechaexpedicion']);
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
			<select id="f_exp_m" name="f_exp_m" onchange="$(this).verificarFecha(event, 'exp', '1');" style="font-size: 12px" title="Mes de fecha expedicion">
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
		<td style="width: 100px;display: table-cell;">Obligaciones fiscales en otro pais?</td>
		<td>
			<select id="tributarias_otro_pais" name="tributarias_otro_pais" style="font-size: 12px; margin-right: 15px" title="Obligaciones fiscales en otro pais" data-oldvalue="<?=$dataform['tributarias_otro_pais']?>">
				<option value="">Seleccion...</option>
				<option value="-1"<?=(($dataform['tributarias_otro_pais'] == "-1") ? "selected" : "")?>>SI</option>
				<option value="0"<?=(($dataform['tributarias_otro_pais'] == "0") ? "selected" : "")?>>NO</option>
				<option value="2"<?=(($dataform['tributarias_otro_pais'] == "2") ? "selected" : "")?>>SD</option>
			</select>
			Cuales?
			<input type="text" id="tributarias_paises" name="tributarias_paises" style="width: 180px; margin-left: 10px" onkeypress="return validar_letra(event)" title="Cuales" value="<?=$dataform['tributarias_paises']?>" data-oldvalue="<?=$dataform['tributarias_paises']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">Producto o seguro:</td>
		<td><input type="text" id="producto_seguro" name="producto_seguro" style="width: 200px; margin-right: 40px" onkeypress="return validar_letra(event)" title="Producto o seguro a adquirir" value="<?=$dataform['producto_seguro']?>" data-oldvalue="<?=$dataform['producto_seguro']?>"></td>
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
		<td style="width: 100px;display: table-cell;">Telefono:</td>
		<td>
			<input type="text" id="telefonoresidencia" name="telefonoresidencia" style="width: 130px; margin-right: 40px" maxlength="7" onchange="$(this).checkTamanoTele(event, 7);" onkeypress="return validar_num(event)" title="Telefono" value="<?=$dataform['telefonoresidencia']?>" data-oldvalue="<?=$dataform['telefonoresidencia']?>">
			Celular:
			<input type="text" id="celular" name="celular" style="width: 130px" maxlength="10" onchange="$(this).checkTamanoTele(event, 10);" onkeypress="return validar_num(event)" title="Celular" value="<?=$dataform['celular']?>" data-oldvalue="<?=$dataform['celular']?>">
		</td>
	</tr>
	<tr>
		<td style="width: 100px;display: table-cell;">E-mail:</td>
		<td><input type="text" id="correoelectronico" name="correoelectronico" style="width: 240px" onkeypress="return validar_letra(event)" title="E-mail" value="<?=$dataform['correoelectronico']?>" data-oldvalue="<?=$dataform['correoelectronico']?>"></td>
	</tr>
</table>