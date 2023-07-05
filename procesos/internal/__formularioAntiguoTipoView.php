<input type="hidden" name="formulario" id="formulario" value="15">
<table>
	<tr>
		<td>
		<table>
			<tr>
				<td style="width: 80px">Fecha de radicado:</td><!--fecharadicado-->
				<td>
					<select id="f_rad_a" name="f_rad_a" onchange="$(this).verificarFecha(event, 'rad', '1');" style="font-size: 12px" title="Año de fecha de radicado">
						<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_rad_m" name="f_rad_m" onchange="$(this).verificarFecha(event, 'rad', '1');" style="font-size: 12px" title="Mes de fecha de radicado">
						<option value="">Mes</option>
<?php
$an = 1;
for($i=$an;$i<=12;$i++){
	$val_m = '0'.$i;
	if($i > 9)
		$val_m = $i;
	echo '<option value="'.$i.'">'.$val_m.'</option>';
}
?>
					</select>
					<select id="f_rad_d" name="f_rad_d" style="font-size: 12px" title="Dia de fecha de radicado">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 80px">Fecha de diligenciamiento:</td><!--fechasolicitud-->
				<td>
					<select id="f_dil_a" name="f_dil_a" onchange="$(this).verificarFecha(event, 'dil', '1');" style="font-size: 12px" title="Año de fecha de diligenciamiento">
						<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_dil_m" name="f_dil_m" onchange="$(this).verificarFecha(event, 'dil', '1');" style="font-size: 12px" title="Mes de fecha de diligenciamiento">
						<option value="">Mes</option>
<?php
$an = 1;
for($i=$an;$i<=12;$i++){
	$val_m = '0'.$i;
	if($i > 9)
		$val_m = $i;
	echo '<option value="'.$i.'">'.$val_m.'</option>';
}
?>
					</select>
					<select id="f_dil_d" name="f_dil_d" onblur="$(this).verificarFechaDoble(event, 'dil', '1');" style="font-size: 12px" title="Dia de fecha de diligenciamiento">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Ciudad:</td>
				<td>
					<select id="ciudad" name="ciudad" style="font-size: 12px" title="Ciudad">
						<option value="">Seleccione...</option>
<?php
/*agregar campo llamado ciudad*/
if(isset($daneCiudades) && !empty($daneCiudades) && is_array($daneCiudades)){
	foreach($daneCiudades as $ciudad){
?>
						<option value="<?=$ciudad['id']?>"><?=$ciudad['ciudad']?></option>
<?php
	}
}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Sucursal:</td>
				<td>
					<select id="sucursal" name="sucursal" style="font-size: 12px" title="Sucursal">
						<option value="">Seleccione...</option>
<?php
if(isset($sucursales) && !empty($sucursales) && is_array($sucursales)){
	foreach($sucursales as $sucursal){
?>
						<option value="<?=$sucursal['id']?>"><?=$sucursal['sucursal']?></option>
<?php
	}
}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Area:</td>
				<td>
					<select id="area" name="area" style="font-size: 12px" title="Area">
						<option value="">Seleccione...</option>
<?php
if(isset($areas) && !empty($areas) && is_array($areas)){
	foreach($areas as $area){
?>
						<option value="<?=$area['id']?>"><?=$area['description']?></option>
<?php
	}
}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Funcionario:</td>
				<td>
					<select id="id_official" name="id_official" style="font-size: 12px" title="Funcionario">
						<option value="">Seleccione...</option>
<?php
if(isset($funcionarios) && !empty($funcionarios) && is_array($funcionarios)){
	foreach($funcionarios as $funcionario){
?>
						<option value="<?=strtoupper($funcionario['name'])?>"><?=strtoupper($funcionario['name'])?></option>
<?php
	}
}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Tipo de solicitud:</td>
				<td>
					<select id="tipo_solicitud" name="tipo_solicitud" title="Tipo de solicitud"><!--agregar campo llamado tipo_solicitud-->
						<option value="">Seleccion...</option>
						<option value="VINCULACION">Vinculacion</option>
						<option value="ACTUALIZACION">Actualizacion</option>
						<option value="SD">SD</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Clase vinculacion:</td>
				<td>
					<select id="clasecliente" name="clasecliente" style="font-size: 12px; margin-right: 5px" title="Clase vinculacion">
						<option value="">Seleccione...</option>
<?php
if(isset($clasesVinculacion) && !empty($clasesVinculacion) && is_array($clasesVinculacion)){
	foreach($clasesVinculacion as $clase){
?>
						<option value="<?=$clase['id']?>"><?=$clase['description']?></option>
<?php
	}
}
?>
					</select>
					Cual?
					<input type="text" id="cual_clasecliente" name="cual_clasecliente" style="width: 130px;" onkeypress="return validar_letra(event)" disabled title="Cual clase vinculacion"><!--agregar campo llamado cual_clasecliente-->
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<table id="table_parte1">
			<tr>
				<td colspan="2" align="center"><strong>1. INFORMACI&Oacute;N B&Aacute;SICA</strong></td>
			</tr>
			<tr>
				<td colspan="2">Persona natural y jur&iacute;dica (Para persona jur&iacute;dica seran los datos del representante legal)</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Primer apellido:</td>
				<td>
					<input type="text" id="primerapellido" name="primerapellido" style="width: 130px; margin-right: 30px" onkeypress="return validar_letra(event)" title="Primer apellido">
					Segundo apellido:&nbsp;
					<input type="text" id="segundoapellido" name="segundoapellido" style="width: 130px" onkeypress="return validar_letra(event)" title="Segundo apellido">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Nombres:</td>
				<td><input type="text" id="nombres" name="nombres" style="width: 200px; margin-right: 40px" onkeypress="return validar_letra(event)" title="Nombres"></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Genero:</td>
				<td>
					<select id="sexo" name="sexo" class="obligatorio" style="display: initial;" onblur="$(this).ocultarEsteCampo(event);" title="Genero">
						<option value="">Seleccion...</option>
						<option value="Femenino">Femenino</option>
						<option value="Masculino">Masculino</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo documento:</td>
				<td>
					<select id="tipodocumento" name="tipodocumento" style="font-size: 12px; margin-right: 5px" title="Tipo documento">
						<option value="">Seleccione...</option>
<?php
if(isset($tipoDocumentos) && !empty($tipoDocumentos) && is_array($tipoDocumentos)){
	foreach($tipoDocumentos as $tipo){
?>
						<option value="<?=$tipo['id']?>"><?=$tipo['description']?></option>
<?php
	}
}
?>
					</select>
					Numero identificacion:&nbsp;<input type="text" id="documento" name="documento" onblur="$(this).ocultarEsteCampo(event);" style="width: 130px; display: initial;" title="Numero identificacion">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Fecha expedicion:</td><!--fechaexpedicion-->
				<td>
					<select id="f_exp_a" name="f_exp_a" onchange="$(this).verificarFecha(event, 'exp', '0');" style="font-size: 12px" title="Año de fecha expedicion">
						<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_exp_m" name="f_exp_m" onchange="$(this).verificarFecha(event, 'exp', '0');" style="font-size: 12px" title="Mes de fecha expedicion">
						<option value="">Mes</option>
<?php
$an = 1;
for($i=$an;$i<=12;$i++){
	$val_m = '0'.$i;
	if($i > 9)
		$val_m = $i;
	echo '<option value="'.$i.'">'.$val_m.'</option>';
}
?>
					</select>
					<select id="f_exp_d" name="f_exp_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px" title="Dia de fecha expedicion">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Lugar expedicion:</td>
				<td>
					<select id="lugarexpedicion" name="lugarexpedicion" style="font-size: 12px" title="Lugar expedicion">
						<option value="">Seleccione...</option>
<?php
if(isset($daneCiudades) && !empty($daneCiudades) && is_array($daneCiudades)){
	foreach($daneCiudades as $ciudad){
?>
						<option value="<?=$ciudad['id']?>"><?=$ciudad['ciudad']?></option>
<?php
	}
}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Fecha nacimiento:</td><!--fechanacimiento-->
				<td>
					<select id="f_nac_a" name="f_nac_a" onchange="$(this).verificarFecha(event, 'nac', '1');" style="font-size: 12px" title="Año de fecha nacimiento">
						<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_nac_m" name="f_nac_m" onchange="$(this).verificarFecha(event, 'nac', '1');" style="font-size: 12px" title="Mes de fecha nacimiento">
						<option value="">Mes</option>
<?php
$an = 1;
for($i=$an;$i<=12;$i++){
	$val_m = '0'.$i;
	if($i > 9)
		$val_m = $i;
	echo '<option value="'.$i.'">'.$val_m.'</option>';
}
?>
					</select>
					<select id="f_nac_d" name="f_nac_d" style="font-size: 12px" onblur="$(this).verificarFechaDoble(event, 'nac', '1');" title="Dia de fecha nacimiento">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Lugar nacimiento:</td>
				<td>
					<select id="lugarnacimiento" name="lugarnacimiento" style="font-size: 12px" title="Lugar nacimiento">
						<option value="">Seleccione...</option>
<?php
if(isset($daneCiudades) && !empty($daneCiudades) && is_array($daneCiudades)){
	foreach($daneCiudades as $ciudad){
?>
						<option value="<?=$ciudad['id']?>"><?=$ciudad['ciudad']?></option>
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
					<select id="paisnacimiento" name="paisnacimiento" style="font-size: 12px" title="Nacionalidad" onblur="$(this).verificarPais(event, 'paisnacimiento');">
						<option value="">Seleccione...</option>
<?php
if(isset($paises) && !empty($paises) && is_array($paises)){
	foreach($paises as $pais){
?>
					<option value="<?=$pais['id']?>"><?=$pais['description']?></option>
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
					<select id="nacionalidad_otra" name="nacionalidad_otra" style="font-size: 12px" title="Nacionalidad 2" onblur="$(this).verificarPais(event, 'nacionalidad_otra');">
						<option value="">Seleccione...</option>
<?php
if(isset($paises) && !empty($paises) && is_array($paises)){
	foreach($paises as $pais){
?>
						<option value="<?=$pais['id']?>"><?=$pais['description']?></option>
<?php
	}
}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">E-mail:</td>
				<td><input type="text" id="correoelectronico" name="correoelectronico" style="width: 240px" onkeypress="return validar_letra(event)" title="E-mail"></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Celular:</td>
				<td>
					<input type="text" id="celular" name="celular" style="width: 130px" maxlength="10" onblur="$(this).checkTamanoTele(10);" title="Celular">
					Telefono:
					<input type="text" id="telefonoresidencia" name="telefonoresidencia" style="width: 130px; margin-right: 40px" maxlength="7" onblur="$(this).checkTamanoTele(7);" title="Telefono">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Direccion residencia:</td>
				<td><input type="text" id="direccionresidencia" name="direccionresidencia" style="width: 240px" onkeypress="return validar_letra(event)" title="Direccion residencia"></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Ciudad y departamento:</td>
				<td>
					<select id="ciudadresidencia" name="ciudadresidencia" style="font-size: 12px" title="Ciudad y departamento">
						<option value="">Seleccione...</option>
<?php
if(isset($daneCiudades) && !empty($daneCiudades) && is_array($daneCiudades)){
	foreach($daneCiudades as $ciudad){
?>
						<option value="<?=$ciudad['id']?>"><?=$ciudad['ciudad']?></option>
<?php
	}
}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Empresa donde trabaja:</td>
				<td><input type="text" id="nombreempresa" name="nombreempresa" style="width: 240px" onkeypress="return validar_letra(event)" title="Empresa donde trabaja"></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Direccion oficina:</td>
				<td>
					<input type="text" id="direccionempresa" name="direccionempresa" style="width: 180px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Direccion oficina">
					Telefono oficina:
					<input type="text" id="telefonolaboral" name="telefonolaboral" style="width: 100px" onblur="$(this).checkTamanoTele(7);" maxlength="7" title="Telefono oficina">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Ciudad empresa</td>
				<td>
					<select id="ciudadempresa" name="ciudadempresa" style="font-size: 12px" title="Ciudad empresa">
						<option value="">Seleccione...</option>
<?php
if(isset($daneCiudades) && !empty($daneCiudades) && is_array($daneCiudades)){
	foreach($daneCiudades as $ciudad){
?>
						<option value="<?=$ciudad['id']?>"><?=$ciudad['ciudad']?></option>
<?php
	}
}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 80px">Re-escribir fecha de diligenciamiento:</td><!--fechasolicitud-->
				<td>
					<select id="f_dil2_a" name="f_dil2_a" onchange="$(this).verificarFecha(event, 'dil2', '1');" style="font-size: 12px" title="text">
						<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_dil2_m" name="f_dil2_m" onchange="$(this).verificarFecha(event, 'dil2', '1');" style="font-size: 12px" title="text">
						<option value="">Mes</option>
<?php
$an = 1;
for($i=$an;$i<=12;$i++){
	$val_m = '0'.$i;
	if($i > 9)
		$val_m = $i;
	echo '<option value="'.$i.'">'.$val_m.'</option>';
}
?>
					</select>
					<select id="f_dil2_d" name="f_dil2_d" onblur="$(this).verificarFechaDoble(event, 'dil', '2');" style="font-size: 12px" title="text">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Celular oficina:</td>
				<td>
					<input type="text" id="celularoficinappal" name="celularoficinappal" style="width: 160px" onblur="$(this).checkTamanoTele(10);" maxlength="10" title="Celular oficina"><!--agregar campo llamado celularoficinappal-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Re-escribir numero identificacion</td>
				<td>
					<input type="text" name="documento2" id="documento2" onpaste="alert('No se puede copiar.');return false" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'documento', 'El numero de documento no coinciden por favor validelos.');" onpaste="return false;" class="obligatorio" title="text">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo empresa</td>
				<td>
					<select id="tipoempresaemp" name="tipoempresaemp" style="font-size: 12px; margin-right: 5px" title="Tipo empresa">
						<option value="">Seleccione...</option>
<?php
if(isset($tipoempresas) && !empty($tipoempresas) && is_array($tipoempresas)){
	foreach($tipoempresas as $tipoempresa){
?>
						<option value="<?=$tipoempresa['id']?>"><?=$tipoempresa['description']?></option>
<?php
	}
}
?>
					</select>
					Cual?
					<input type="text" id="tipoempresaemp_cual" name="tipoempresaemp_cual" style="width: 100px" disabled onkeypress="return validar_letra(event)" title="Cual tipo empresa"><!--agregar campo llamado tipoempresaemp_cual-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
				<td>
					<select id="recursos_publicos" name="recursos_publicos" style="font-size: 12px; margin-right: 15px" title="Maneja recursos publicos"><!--agregar campo llamado recursos_publicos-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Grado de poder publico?
					<select id="poder_publico" name="poder_publico" style="font-size: 12px; margin-left: 10px" title="Grado de poder publico"><!--agregar campo llamado poder_publico-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Reconocimiento publico?</td>
				<td>
					<select id="reconocimiento_publico" name="reconocimiento_publico" style="font-size: 12px; margin-right: 15px" title="Reconocimiento publico"><!--agregar campo llamado reconocimiento_publico-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Indique
					<input type="text" id="reconocimiento_cual" name="reconocimiento_cual" style="width: 180px; margin-left: 10px" disabled onkeypress="return validar_letra(event)" title="Indique reconocimiento publico"><!--agregar campo llamado reconocimiento_cual-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Re-escribir Nacionalidad:</td>
				<td>
					<select id="paisnacimiento2" name="paisnacimiento2" style="font-size: 12px" title="Re-escribir Nacionalidad" onblur="$(this).verificarRePais(event, 'paisnacimiento', 'Nacionalidad');">
						<option value="">Seleccione...</option>
<?php
if(isset($paises) && !empty($paises) && is_array($paises)){
	foreach($paises as $pais){
?>
					<option value="<?=$pais['id']?>"><?=$pais['description']?></option>
<?php
	}
}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Servidor publico?</td>
				<td>
					<select id="servidor_publico" name="servidor_publico" style="font-size: 12px; margin-right: 15px" title="Servidor publico"><!--agregar campo llamado servidor_publico-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Re-escribir fecha nacimiento:</td><!--fechanacimiento-->
				<td>
					<select id="f_nac2_a" name="f_nac2_a" onchange="$(this).verificarFecha(event, 'nac2', '1');" style="font-size: 12px" title="text">
						<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_nac2_m" name="f_nac2_m" onchange="$(this).verificarFecha(event, 'nac2', '1');" style="font-size: 12px" title="text">
						<option value="">Mes</option>
<?php
$an = 1;
for($i=$an;$i<=12;$i++){
	$val_m = '0'.$i;
	if($i > 9)
		$val_m = $i;
	echo '<option value="'.$i.'">'.$val_m.'</option>';
}
?>
					</select>
					<select id="f_nac2_d" name="f_nac2_d" style="font-size: 12px" onblur="$(this).verificarFechaDoble(event, 'nac', '2');" title="text">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Persona expuesta politicamente?</td>
				<td>
					<select id="expuesta_politica" name="expuesta_politica" style="font-size: 12px; margin-right: 15px" title="Persona expuesta politicamente"><!--agregar campo llamado expuesta_politica-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Cargo:
					<input type="text" id="cargo_politica" name="cargo_politica" style="width: 180px; margin-left: 10px" disabled onkeypress="return validar_letra(event)" title="Cargo"><!--agregar campo llamado cargo_politica-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">&nbsp;</td>
				<td>
					Inicio
					<select id="f_ini_a" name="f_ini_a" onchange="$(this).verificarFecha(event, 'ini', '0');" style="font-size: 12px" title="Año de inicio"><!--agregar campo llamado cargo_politica_ini-->
						<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_ini_m" name="f_ini_m" onchange="$(this).verificarFecha(event, 'ini', '0');" style="font-size: 12px" title="Mes de inicio">
						<option value="">Mes</option>
<?php
$an = 1;
for($i=$an;$i<=12;$i++){
	$val_m = '0'.$i;
	if($i > 9)
		$val_m = $i;
	echo '<option value="'.$i.'">'.$val_m.'</option>';
}
?>
					</select>
					<select id="f_ini_d" name="f_ini_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px" title="Dia de inicio">
						<option value="">Dia</option>
					</select>
					Fin
					<select id="f_fin_a" name="f_fin_a" onchange="$(this).verificarFecha(event, 'fin', '0');" style="font-size: 12px" title="Año de fin"><!--agregar campo llamado cargo_politica_fin-->
						<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y', strtotime('+3 year'));
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_fin_m" name="f_fin_m" onchange="$(this).verificarFecha(event, 'fin', '0');" style="font-size: 12px" title="Mes de fin">
						<option value="">Mes</option>
<?php
$an = 1;
for($i=$an;$i<=12;$i++){
	$val_m = '0'.$i;
	if($i > 9)
		$val_m = $i;
	echo '<option value="'.$i.'">'.$val_m.'</option>';
}
?>
					</select>
					<select id="f_fin_d" name="f_fin_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px" title="Dia de fin">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
				<td>
					<select id="expuesta_publica" name="expuesta_publica" style="font-size: 12px; margin-right: 5px" title="Persona expuesta publicamente"><!--agregar campo llamado expuesta_publica-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Nombre: 
					<input type="text" id="publica_nombre" name="publica_nombre" style="width: 100px" disabled onkeypress="return validar_letra(event)" title="Nombre"><!--agregar campo llamado publica_nombre-->
					Cargo: 
					<input type="text" id="publica_cargo" name="publica_cargo" style="width: 100px" disabled onkeypress="return validar_letra(event)" title="Cargo"><!--agregar campo llamado publica_cargo-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Representante internacional?</td>
				<td>
					<select id="repre_internacional" name="repre_internacional" style="font-size: 12px; margin-right: 5px" title="Representante internacional"><!--agregar campo llamado repre_internacional-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Indique: 
					<input type="text" id="internacional_indique" name="internacional_indique" style="width: 180px" disabled onkeypress="return validar_letra(event)" title="Indique"><!--agregar campo llamado internacional_indique-->
				</td>
			</tr>
			<!--Re-escribir campo telefono y celular-->
			<tr>
				<td style="width: 100px;display: table-cell;">Re-escribir Telefono:</td>
				<td>
					<input type="text" id="telefonoresidencia2" name="telefonoresidencia2" style="width: 130px; margin-right: 10px" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'telefonoresidencia', 'Los telefonos no coinciden por favor validelos.');" maxlength="7" title="text">
					Re-escribir Celular:
					<input type="text" id="celular2" name="celular2" style="width: 130px" onblur="$(this).validarCampoReescrito(event, 'input', 'form_fingering', 'celular', 'Los numeros de celular no coinciden, por favor validelos.');" maxlength="10" title="text">
				</td>
			</tr>
			<tr>
				<td>Re-escribir Genero</td>
				<td>
					<select id="sexo2" name="sexo2" onblur="$(this).validarCampoReescrito(event, 'select', 'form_fingering', 'sexo', 'La opcion seleccionada para el campo de genero no coinciden por favor validelos.');" title="text">
						<option value="">Seleccion...</option>
						<option value="Femenino">Femenino</option>
						<option value="Masculino">Masculino</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tributarias en otro pais?</td>
				<td>
					<select id="tributarias_otro_pais" name="tributarias_otro_pais" style="font-size: 12px; margin-right: 5px" title="Tributarias en otro pais"><!--agregar campo llamado tributarias_otro_pais-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Cuales?: 
					<input type="text" id="tributarias_paises" name="tributarias_paises" style="width: 180px" disabled onkeypress="return validar_letra(event)" title="Cuales tributarias en otro pais"><!--agregar campo llamado tributarias_paises-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Re-escribir Nacionalidad 2:</td>
				<td>
					<select id="nacionalidad_otra2" name="nacionalidad_otra2" style="font-size: 12px" title="Nacionalidad 2" onblur="$(this).verificarRePais(event, 'nacionalidad_otra', 'Nacionalidad 2');">
						<option value="">Seleccione...</option>
<?php
if(isset($paises) && !empty($paises) && is_array($paises)){
	foreach($paises as $pais){
?>
						<option value="<?=$pais['id']?>"><?=$pais['description']?></option>
<?php
	}
}
?>
					</select>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<table>
			<tr>
				<td colspan="2" align="center"><strong>2. ACTIVIDAD ECON&Oacute;MICA</strong></td>
			</tr>
<?php
require_once PATH_INTERNAL.DS.$request['action'].'_'.$request['tipo_persona'].'_'.'View.php';
?>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<table>
			<tr>
				<td colspan="2" align="center"><strong>3. DECLARACI&Oacute;N DE ORIGEN DE LOS BIENES Y/O FONDOS</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Fuente de origen de fondos</td>
				<td>
					<input type="text" id="origen_fondos" name="origen_fondos" style="width: 160px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Fuente de origen de fondos"><!--agregar campo llamado origen_fondos-->
					Pais de procedencia:
					<input type="text" id="procedencia_fondos" name="procedencia_fondos" style="width: 100px" onkeypress="return validar_letra(event)" title="Pais de procedencia"><!--agregar campo llamado procedencia_fondos-->
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<table>
			<tr>
				<td colspan="2" align="center"><strong>4. ACTIVIDADES EN OPERACIONES INTERNACIONALES</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Operaciones en moneda extranjera?</td>
				<td>
					<select id="monedaextranjera" name="monedaextranjera" style="font-size: 12px; margin-right: 5px" title="Operaciones en moneda extranjera">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Cual?
					<select id="tipotransacciones" name="tipotransacciones" style="font-size: 12px; margin-right: 5px" disabled title="Cual operacion en moneda extranjera">
						<option value="">Seleccione...</option>
<?php
if(isset($transacciones) && !empty($transacciones) && is_array($transacciones)){
	foreach($transacciones as $transaccion){
?>
						<option value="<?=$transaccion['id']?>"><?=$transaccion['description']?></option>
<?php
	}
}
?>
					</select>
					<input type="text" id="tipotransacciones_cual" name="tipotransacciones_cual" style="width: 135px" disabled onkeypress="return validar_letra(event)" title="Cual otra"><!--agregar campo llamado tipotransacciones_cual-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Otras operaciones:</td>
				<td><input type="text" id="otras_operaciones" name="otras_operaciones" style="width: 260px" onkeypress="return validar_letra(event)" title="Otras operaciones"></td><!--agregar campo llamado otras_operaciones-->
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Productos en el exterior?</td>
				<td>
					<select id="productos_exterior" name="productos_exterior" style="font-size: 12px; margin-right: 5px" title="Productos en el exterior">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Cuentas moneda extranjera?
					<select id="cuentas_monedaextranjera" name="cuentas_monedaextranjera" style="font-size: 12px; margin-right: 5px" title="Cuentas moneda extranjera">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><strong>Cuentas en moneda extranjera</strong></td>
			</tr>
			<tr>
				<td colspan="2"><strong style="font-size: 14px">#1</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo de producto:</td>
				<td>
					<input type="text" id="producto_tipo[]" name="producto_tipo[]" style="width: 130px; margin-right: 15px" disabled onkeypress="return validar_letra(event)" title="Tipo de producto">
					Identificacion:
					<input type="text" id="producto_identificacion[]" name="producto_identificacion[]" style="width: 140px; margin-left: 10px" disabled title="Identificacion">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Entidad:</td>
				<td>
					<input type="text" id="producto_entidad[]" name="producto_entidad[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)" title="Entidad">
					Monto:
					<input type="text" id="producto_monto[]" name="producto_monto[]" style="width: 80px; margin-right: 5px" disabled title="Monto">
					Ciudad:
					<input type="text" id="producto_ciudad[]" name="producto_ciudad[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)" title="Ciudad">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Pais:</td>
				<td>
					<input type="text" id="producto_pais[]" name="producto_pais[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)" title="Pais">
					Moneda:
					<input type="text" id="producto_moneda[]" name="producto_moneda[]" style="width: 80px; margin-right: 5px" disabled onkeypress="return validar_letra(event)" title="Moneda">
				</td>
			</tr>
			<tr>
				<td colspan="2"><strong style="font-size: 14px">#2</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo de producto:</td>
				<td>
					<input type="text" id="producto_tipo[]" name="producto_tipo[]" style="width: 130px; margin-right: 15px" disabled onkeypress="return validar_letra(event)" title="Tipo de producto">
					Identificacion:
					<input type="text" id="producto_identificacion[]" name="producto_identificacion[]" style="width: 140px; margin-left: 10px" disabled title="Identificacion">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Entidad:</td>
				<td>
					<input type="text" id="producto_entidad[]" name="producto_entidad[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)" title="Entidad">
					Monto:
					<input type="text" id="producto_monto[]" name="producto_monto[]" style="width: 80px; margin-right: 5px" disabled title="Monto">
					Ciudad:
					<input type="text" id="producto_ciudad[]" name="producto_ciudad[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)" title="Ciudad">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Pais:</td>
				<td>
					<input type="text" id="producto_pais[]" name="producto_pais[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)" title="Pais">
					Moneda:
					<input type="text" id="producto_moneda[]" name="producto_moneda[]" style="width: 80px; margin-right: 5px" disabled onkeypress="return validar_letra(event)" title="Moneda">
				</td>
			</tr>
			<tr>
				<td colspan="2"><strong style="font-size: 14px">#3</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo de producto:</td>
				<td>
					<input type="text" id="producto_tipo[]" name="producto_tipo[]" style="width: 130px; margin-right: 15px" disabled onkeypress="return validar_letra(event)" title="Tipo de producto">
					Identificacion:
					<input type="text" id="producto_identificacion[]" name="producto_identificacion[]" style="width: 140px; margin-left: 10px" disabled title="Identificacion">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Entidad:</td>
				<td>
					<input type="text" id="producto_entidad[]" name="producto_entidad[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)" title="Entidad">
					Monto:
					<input type="text" id="producto_monto[]" name="producto_monto[]" style="width: 80px; margin-right: 5px" disabled title="Monto">
					Ciudad:
					<input type="text" id="producto_ciudad[]" name="producto_ciudad[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)" title="Ciudad">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Pais:</td>
				<td>
					<input type="text" id="producto_pais[]" name="producto_pais[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)" title="Pais">
					Moneda:
					<input type="text" id="producto_moneda[]" name="producto_moneda[]" style="width: 80px; margin-right: 5px" disabled onkeypress="return validar_letra(event)" title="Moneda">
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<table>
			<tr>
				<td colspan="2" align="center"><strong>5. INFORMACION SOBRE RECLAMACIONES EN SEGUROS</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Reclamaciones o indemnizaciones?</td>
				<td style="width: 400px;display: table-cell;">
					<select id="reclamaciones" name="reclamaciones" style="font-size: 12px; margin-right: 5px" title="Reclamaciones o indemnizaciones"><!--agregar campo llamado reclamaciones-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2"><strong style="font-size: 14px">#1</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Año:</td>
				<td>
					<input type="text" id="rec_ano[]" name="rec_ano[]" style="width: 50px; margin-right: 5px" disabled title="Año">
					Ramo:
					<input type="text" id="rec_ramo[]" name="rec_ramo[]" style="width: 220px; margin-right: 5px" disabled onkeypress="return validar_letra(event)" title="Ramo">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Compañia:</td>
				<td>
					<input type="text" id="rec_compania[]" name="rec_compania[]" style="width: 150px; margin-right: 8px" disabled onkeypress="return validar_letra(event)" title="Compañia">
					Valor:
					<input type="text" id="rec_valor[]" name="rec_valor[]" style="width: 120px; margin-right: 5px" disabled title="Valor">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Resultado:</td>
				<td>
					<input type="text" id="rec_resultado[]" name="rec_resultado[]" style="width: 150px" disabled onkeypress="return validar_letra(event)" title="Resultado">
				</td>
			</tr>
			<tr>
				<td colspan="2"><strong style="font-size: 14px">#2</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Año:</td>
				<td>
					<input type="text" id="rec_ano[]" name="rec_ano[]" style="width: 50px; margin-right: 5px" disabled title="Año">
					Ramo:
					<input type="text" id="rec_ramo[]" name="rec_ramo[]" style="width: 220px; margin-right: 5px" disabled onkeypress="return validar_letra(event)" title="Ramo">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Compañia:</td>
				<td>
					<input type="text" id="rec_compania[]" name="rec_compania[]" style="width: 150px; margin-right: 8px" disabled onkeypress="return validar_letra(event)" title="Compañia">
					Valor:
					<input type="text" id="rec_valor[]" name="rec_valor[]" style="width: 120px; margin-right: 5px" disabled title="Valor">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Resultado:</td>
				<td>
					<input type="text" id="rec_resultado[]" name="rec_resultado[]" style="width: 150px" disabled onkeypress="return validar_letra(event)" title="Resultado">
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<table>
			<tr>
				<td style="width: 100px;display: table-cell;">Autoriza el envio por correo?</td>
				<td style="width: 350px">
					<select id="auto_correo" name="auto_correo" style="font-size: 12px; margin-right: 10px" title="Autoriza el envio por correo">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Autoriza el envio de SMS?
					<select id="auto_sms" name="auto_sms" style="font-size: 12px;" title="Autoriza el envio de SMS">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<table>
			<tr>
				<td colspan="2" align="center"><strong>8. FRIMA Y HUELLA</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Firma:</td>
				<td style="width: 300px">
					<select id="firma" name="firma" style="font-size: 12px; margin-right: 20px" title="Firma">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
					</select>
					Huella:
					<select id="huella" name="huella" style="font-size: 12px; margin-left: 5px" title="Huella">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
					</select>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<table>
			<tr>
				<td colspan="2" align="center"><strong>9. INFORMACI&Oacute;N ENTREVISTA</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Lugar entrevista:</td>
				<td>
					<input type="text" id="lugarentrevista" name="lugarentrevista" style="width: 180px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Lugar entrevista">
					Resultado:
					<select id="resultadoentrevista" name="resultadoentrevista" style="font-size: 12px" title="Resultado">
						<option value="">Seleccion...</option>
						<option value="APROBADO">Aprobado</option>
						<option value="RECHAZADO">Rechazado</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 80px">Fecha de entrevista:</td><!--fechaentrevista-->
				<td>
					<select id="f_ent_a" name="f_ent_a" onchange="$(this).verificarFecha(event, 'ent', '0');" style="font-size: 12px" title="Año de fecha de entrevista">
						<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_ent_m" name="f_ent_m" onchange="$(this).verificarFecha(event, 'ent', '0');" style="font-size: 12px" title="Mes de fecha de entrevista">
						<option value="">Mes</option>
<?php
$an = 1;
for($i=$an;$i<=12;$i++){
	$val_m = '0'.$i;
	if($i > 9)
		$val_m = $i;
	echo '<option value="'.$i.'">'.$val_m.'</option>';
}
?>
					</select>
					<select id="f_ent_d" name="f_ent_d" style="font-size: 12px" title="Dia de fecha de entrevista">
						<option value="">Dia</option>
					</select>
					Hora:
					<select id="h_ent_h" name="h_ent_h" style="font-size: 12px" title="Hora">
						<option value="">Hora</option><!--horaentrevista-->
<?php
for ($i=1; $i <= 12; $i++) { 
	$hor = $i;
	if (strlen($i) == 1) {
		$hor = '0'.$i;
	}
	echo '<option value="'.$hor.'">'.$hor.'</option>';
}
?>
					</select>
					<select id="h_ent_m" name="h_ent_m" style="font-size: 12px" title="Minuto">
						<option value="">Minuto</option>
<?php
for ($i=0; $i <= 59; $i++) { 
	$hor = $i;
	if (strlen($i) == 1) {
		$hor = '0'.$i;
	}
	echo '<option value="'.$hor.'">'.$hor.'</option>';
}
?>
					</select>
					<select id="h_ent_z" name="h_ent_z" style="font-size: 12px" title="Horario">
						<option value="">Horario</option>
						<option value="AM">A.M.</option>
						<option value="PM">P.M.</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Observaciones:</td>
				<td>
					<textarea cols="40" rows="4" id="observacionesentrevista" name="observacionesentrevista" onkeypress="return validar_letra(event)" title="Observaciones"></textarea>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Nombre Intermediario / Asesor / Entrevistador:</td>
				<td>
					<input type="text" id="nombreintermediario" name="nombreintermediario" style="width: 190px; margin-right: 10px" onkeypress="return validar_letra(event)" title="Nombre Intermediario / Asesor / Entrevistador">
					Clave:
					<input type="text" id="clave_inter" name="clave_inter" style="width: 100px" title="Clave"><!--agregar campo llamado clave_inter-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Firma entrevistador:</td>
				<td>
					<select id="firma_entrevista" name="firma_entrevista" style="font-size: 12px" title="Firma entrevistador"><!--agregar campo llamado firma_entrevista-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;"></td>
				<td></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;"></td>
				<td></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;"></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<table>
			<tr>
				<td colspan="2" align="center"><strong>10. CONFIRMACI&Oacute;N DE LA INFORMACI&Oacute;N</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Ciudad:</td>
				<td>
					<select id="verificacion_ciudad" name="verificacion_ciudad" style="font-size: 12px" title="Ciudad"><!--agregar campo llamado verificacion_ciudad-->
						<option value="">Seleccione...</option>
<?php
if(isset($daneCiudades) && !empty($daneCiudades) && is_array($daneCiudades)){
	foreach($daneCiudades as $ciudad){
?>
						<option value="<?=$ciudad['id']?>"><?=$ciudad['ciudad']?></option>
<?php
	}
}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 80px">Fecha de verificacion:</td><!--agregar campo llamado verificacion_fecha-->
				<td>
					<select id="f_ver_a" name="f_ver_a" onchange="$(this).verificarFecha(event, 'ver', '0');" style="font-size: 12px" title="Año de fecha de verificacion">
						<option value="">Año</option>
<?php
$an = 1900;
$anl = date('Y');
for($i = $an; $i <= $anl;$i++)
	echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_ver_m" name="f_ver_m" onchange="$(this).verificarFecha(event, 'ver', '0');" style="font-size: 12px" title="Mes de fecha de verificacion">
						<option value="">Mes</option>
<?php
$an = 1;
for($i=$an;$i<=12;$i++){
	$val_m = '0'.$i;
	if($i > 9)
		$val_m = $i;
	echo '<option value="'.$i.'">'.$val_m.'</option>';
}
?>
					</select>
					<select id="f_ver_d" name="f_ver_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px" title="Dia de fecha de verificacion">
						<option value="">Dia</option>
					</select>
					Hora:
					<select id="h_ver_h" name="h_ver_h" style="font-size: 12px" title="Hora"><!--agregar campo llamado verificacion_hora-->
						<option value="">Hora</option>
<?php
for ($i=1; $i <= 12; $i++) { 
	$hor = $i;
	if (strlen($i) == 1) {
		$hor = '0'.$i;
	}
	echo '<option value="'.$hor.'">'.$hor.'</option>';
}
?>
					</select>
					<select id="h_ver_m" name="h_ver_m" style="font-size: 12px" title="Minuto">
						<option value="">Minuto</option>
<?php
for ($i=0; $i <= 59; $i++) { 
	$hor = $i;
	if (strlen($i) == 1) {
		$hor = '0'.$i;
	}
	echo '<option value="'.$hor.'">'.$hor.'</option>';
}
?>
					</select>
					<select id="h_ver_z" name="h_ver_z" style="font-size: 12px" title="Horario">
						<option value="">Horario</option>
						<option value="AM">A.M.</option>
						<option value="PM">P.M.</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Nombre y cargo de verificador:</td>
				<td>
					<input type="text" id="verificacion_nombre" name="verificacion_nombre" style="width: 230px; margin-right: 5px" onkeypress="return validar_letra(event)" title="Nombre y cargo de verificador"><!--agregar campo llamado verificacion_nombre-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Observaciones:</td>
				<td>
					<textarea cols="40" rows="4" id="verificacion_observacion" name="verificacion_observacion" onkeypress="return validar_letra(event)" title="Observaciones"></textarea><!--agregar campo llamado verificacion_observacion-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Firma:</td>
				<td>
					<select id="verificacion_firma" name="verificacion_firma" style="font-size: 12px" title="Firma"><!--agregar campo llamado verificacion_firma-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;"></td>
				<td></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;"></td>
				<td></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;"></td>
				<td></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;"></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
	    <td align="center"><input type="submit" value="Crear formulario"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<script type="text/javascript">
$(document).ready(function(){
	//console.log("aca");
	$('select[name="clasecliente"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '10'){
			$('input[name="cual_clasecliente"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="cual_clasecliente"]').val('');
			$('input[name="cual_clasecliente"]').attr('disabled', true);
		}
	});
	$('select[name="tipoempresaemp"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '5'){
			$('input[name="tipoempresaemp_cual"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="tipoempresaemp_cual"]').val('');
			$('input[name="tipoempresaemp_cual"]').attr('disabled', true);
		}
	});
	$('select[name="reconocimiento_publico"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name="reconocimiento_cual"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="reconocimiento_cual"]').val('');
			$('input[name="reconocimiento_cual"]').attr('disabled', true);
		}
	});
	$('select[name="expuesta_politica"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name="cargo_politica"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="cargo_politica"]').val('');
			$('input[name="cargo_politica"]').attr('disabled', true);
		}
	});
	$('select[name="expuesta_publica"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name="publica_nombre"]').removeAttr('disabled');
			$('input[name="publica_cargo"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="publica_nombre"]').val('');
			$('input[name="publica_nombre"]').attr('disabled', true);
			$('input[name="publica_cargo"]').val('');
			$('input[name="publica_cargo"]').attr('disabled', true);
		}
	});
	$('select[name="repre_internacional"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name="internacional_indique"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="internacional_indique"]').val('');
			$('input[name="internacional_indique"]').attr('disabled', true);
		}
	});
	$('select[name="tributarias_otro_pais"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name="tributarias_paises"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="tributarias_paises"]').val('');
			$('input[name="tributarias_paises"]').attr('disabled', true);
		}
	});
	$('select[name="tipoempresajur"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '5'){
			$('input[name="tipoempresajur_otra"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="tipoempresajur_otra"]').val('');
			$('input[name="tipoempresajur_otra"]').attr('disabled', true);
		}
	});
	$('select[name="monedaextranjera"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('select[name="tipotransacciones"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('select[name="tipotransacciones"]').val('');
			$('select[name="tipotransacciones"]').attr('disabled', true);
			$('input[name="tipotransacciones_cual"]').val('');
			$('input[name="tipotransacciones_cual"]').attr('disabled', true);
		}
	});
	$('select[name="tipotransacciones"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '7'){
			$('input[name="tipotransacciones_cual"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="tipotransacciones_cual"]').val('');
			$('input[name="tipotransacciones_cual"]').attr('disabled', true);
		}
	});
	$('select[name="cuentas_monedaextranjera"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name^="producto_tipo"]').removeAttr('disabled');
			$('input[name^="producto_identificacion"]').removeAttr('disabled');
			$('input[name^="producto_entidad"]').removeAttr('disabled');
			$('input[name^="producto_monto"]').removeAttr('disabled');
			$('input[name^="producto_ciudad"]').removeAttr('disabled');
			$('input[name^="producto_pais"]').removeAttr('disabled');
			$('input[name^="producto_moneda"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name^="producto_tipo"]').val('');
			$('input[name^="producto_tipo"]').attr('disabled', true);
			$('input[name^="producto_identificacion"]').val('');
			$('input[name^="producto_identificacion"]').attr('disabled', true);
			$('input[name^="producto_entidad"]').val('');
			$('input[name^="producto_entidad"]').attr('disabled', true);
			$('input[name^="producto_monto"]').val('');
			$('input[name^="producto_monto"]').attr('disabled', true);
			$('input[name^="producto_ciudad"]').val('');
			$('input[name^="producto_ciudad"]').attr('disabled', true);
			$('input[name^="producto_pais"]').val('');
			$('input[name^="producto_pais"]').attr('disabled', true);
			$('input[name^="producto_moneda"]').val('');
			$('input[name^="producto_moneda"]').attr('disabled', true);
		}
	});
	$('select[name="reclamaciones"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){//"input[name^=load_file]"
			$('input[name^="rec_ano"]').removeAttr('disabled');
			$('input[name^="rec_ramo"]').removeAttr('disabled');
			$('input[name^="rec_compania"]').removeAttr('disabled');
			$('input[name^="rec_valor"]').removeAttr('disabled');
			$('input[name^="rec_resultado"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name^="rec_ano"]').val('');
			$('input[name^="rec_ano"]').attr('disabled', true);
			$('input[name^="rec_ramo"]').val('');
			$('input[name^="rec_ramo"]').attr('disabled', true);
			$('input[name^="rec_compania"]').val('');
			$('input[name^="rec_compania"]').attr('disabled', true);
			$('input[name^="rec_valor"]').val('');
			$('input[name^="rec_valor"]').attr('disabled', true);
			$('input[name^="rec_resultado"]').val('');
			$('input[name^="rec_resultado"]').attr('disabled', true);
		}
	});
	$('select[name^="otrosingresos"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '13'){
			$('input[name^="concepto"]').val('SD');
		}else{
			$('input[name^="concepto"]').val('');
		}
	});
	$('form#form_fingering').submit(function(event) {
		/* Act on the event */
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		//alert('Se envio bien');
		if($(this).find('select[name="f_rad_a"]').val() == ''){
			alert('Por favor seleccione el año de radicacion');
			$(this).find('select[name="f_rad_a"]').focus();
			return false;
		}
		if($(this).find('select[name="f_rad_m"]').val() == ''){
			alert('Por favor seleccione el mes de radicacion');
			$(this).find('select[name="f_rad_m"]').focus();
			return false;
		}
		if($(this).find('select[name="f_rad_d"]').val() == ''){
			alert('Por favor seleccione el dia de radicacion');
			$(this).find('select[name="f_rad_d"]').focus();
			return false;
		}
		if($(this).find('select[name="f_dil_a"]').val() == ''){
			alert('Por favor seleccione el año de diligenciamiento');
			$(this).find('select[name="f_dil_a"]').focus();
			return false;
		}
		if($(this).find('select[name="f_dil_m"]').val() == ''){
			alert('Por favor seleccione el mes de diligenciamiento');
			$(this).find('select[name="f_dil_m"]').focus();
			return false;
		}
		if($(this).find('select[name="f_dil_d"]').val() == ''){
			alert('Por favor seleccione el dia de diligenciamiento');
			$(this).find('select[name="f_dil_d"]').focus();
			return false;
		}
		if($(this).find('select[name="sucursal"]').val() == ''){
			alert('Por favor seleccione una sucursal');
			$(this).find('select[name="sucursal"]').focus();
			return false;
		}
		if($(this).find('select[name="clasecliente"]').val() == ''){
			alert('Por favor seleccione una clase de vinculacion');
			$(this).find('select[name="clasecliente"]').focus();
			return false;
		}else if($(this).find('select[name="clasecliente"]').val() == '10' && $(this).find('input[name="cual_clasecliente"]').val() == ''){
			alert('Debe digitar cual clase de vinculacion.');
			$(this).find('input[name="cual_clasecliente"]').focus();
			return false;
		}
		if ($(this).find('select[name="tipopersona"]').val() == "1") {
			if ($(this).find('input[name="nombres"]').val() == '') {
				alert('Por favor digite el nombre del cliente');
				$(this).find('input[name="nombres"]').focus();
				return false;
			} else if ($(this).find('input[name="nombres"]').val() == 'SD' || $(this).find('input[name="nombres"]').val() == 'NA') {
				alert('Por favor digite nombre de cliente valido, no puede ser SD ni NA.');
				$(this).find('input[name="nombres"]').focus();
				return false;
			}
			if ($(this).find('select[name="tipodocumento"]').val() == '') {
				alert('Por favor seleccione el tipo de documento del cliente');
				$(this).find('select[name="tipodocumento"]').focus();
				return false;
			}
			if ($(this).find('input[name="documento"]').val() == '') {
				alert("Por favor digite el numero de documento.");
				$(this).find('input[name="documento"]').css('background-color', 'red');
				$(this).find('input[name="documento"]').focus();
				return false;
			}else if ($(this).find('input[name="documento"]').val() != $(this).find('input[name="documento2"]').val()) {
				alert("El No. de documento no coincide.");
				$(this).find('input[name="documento"]').css('background-color', 'red');
				return false;
			}
			//FECHAEXPEDICION
			if ($(this).find('select[name="f_exp_a"]').val() == '') {
				alert('Por favor seleccione el año de expedicion');
				$(this).find('select[name="f_exp_a"]').focus();
				return false;
			}
			if ($(this).find('select[name="f_exp_m"]').val() == '') {
				alert('Por favor seleccione el mes de expedicion');
				$(this).find('select[name="f_exp_m"]').focus();
				return false;
			}
			if ($(this).find('select[name="f_exp_d"]').val() == '') {
				alert('Por favor seleccione el dia de expedicion');
				$(this).find('select[name="f_exp_d"]').focus();
				return false;
			}
			if ($(this).find('select[name="lugarexpedicion"]').val() == '') {
				alert('Por favor seleccione lugar de expedicion');
				$(this).find('#lugarexpedicion').focus();
				return false;
			}
			//FECHANACIMIENTO
			if ($(this).find('select[name="f_nac_a"]').val() == '') {
				alert('Por favor seleccione el año de nacimiento');
				$(this).find('select[name="f_nac_a"]').focus();
				return false;
			}
			if ($(this).find('select[name="f_nac_m"]').val() == '') {
				alert('Por favor seleccione el mes de nacimiento');
				$(this).find('select[name="f_nac_m"]').focus();
				return false;
			}
			if ($(this).find('select[name="f_nac_d"]').val() == '') {
				alert('Por favor seleccione el dia de nacimiento');
				$(this).find('select[name="f_nac_d"]').focus();
				return false;
			}
			//Confirmar que la fecha de expedicion sea mayor a la de nacimiento
			var dif_anos = parseInt($(this).find('select[name="f_exp_a"]').val()) - parseInt($(this).find('select[name="f_nac_a"]').val());
			if (dif_anos < 10) {
				alert('Por favor seleccione el año de expedicion valido, este no puede ser menor a la fecha de nacimiento y tampoco la diferencia entre estos puede ser menor a 10 años de edad');
				$(this).find('select[name="f_exp_a"]').focus();
				return false;
			}
			if ($(this).find('select[name="paisnacimiento"]').val() == '') {
				alert('Por favor seleccione nacionalidad.');
				$(this).find('select[name="paisnacimiento"]').focus();
				return false;
			}
			if ($(this).find('input[name="correoelectronico"]').val() != "" && $(this).find('input[name="correoelectronico"]').val() != "SD") {
				var status = false;
				var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
				if (document.getElementById("correoelectronico").value.search(emailRegEx) == -1) {
					alert("Por favor ingrese un mail valido.");
					$(this).find('input[name="correoelectronico"]').css('background-color', 'red');
					return false;
				}
			}
			if ($(this).find('select[name="ciudadresidencia"]').val() == '') {
				alert('Por favor seleccione una ciudad de residencia.');
				$(this).find('select[name="ciudadresidencia"]').focus();
				return false;
			}
			if ($(this).find('input[name="nombreempresa"]').val() == '') {
				if ($(this).find('#tipoactividad').val() == '1' || $(this).find('#tipoactividad').val() != '2') {
					alert('Por favor digite el nombre de la empresa donde trabaja.');
					$(this).find('input[name="nombreempresa"]').focus();
					return false;
				}
			}
			/*if ($(this).find('input[name="actividadeconomicaempresa"]').val() == '') {
				alert('Por favor digite actividad economica.');
				$(this).find('input[name="actividadeconomicaempresa"]').focus();
				return false;
			}*/
			if ($(this).find('select[name="tipoactividad"]').val() == '') {
				alert('Por favor seleccione el tipo de actividad.');
				$(this).find('select[name="tipoactividad"]').focus();
				return false;
			}
			if ($(this).find('select[name="profesion"]').val() == "" || $(this).find('select[name="profesion"]').val() == "0") {
				alert("El campo de profesion no puede estar vacío.");
				$(this).find('select[name="profesion"]').focus();
				return false;
			}
			if ($(this).find('input[name="cargo"]').val() == "") {
				alert("El campo de cargo no puede estar vacío.");
				$(this).find('input[name="cargo"]').focus();
				return false;
			}
			if ($(this).find('select[name="ingresosmensuales"]').val() == "") {
				if ($("#ocupacion").val() != "404" && $("#ocupacion").val() != "405") {
					alert('Por favor seleccione ingresos mensuales.');
					$(this).find('select[name="ingresosmensuales"]').focus();
					return false;
				}
			}
			if ($(this).find('input[name="totalactivos"]').val() == "") {
				if ($("#ocupacion").val() != "404" && $("#ocupacion").val() != "405") {
					alert('Por favor digite el total activos.');
					$(this).find('input[name="totalactivos"]').focus();
					return false;
				}
			}
			if ($(this).find('input[name="totalpasivos"]').val() == "") {
				if ($("#ocupacion").val() != "404" && $("#ocupacion").val() != "405") {
					alert('Por favor digite el total pasivos.');
					$(this).find('input[name="totalpasivos"]').focus();
					return false;
				}
			}
			if ($(this).find('select[name="egresosmensuales"]').val() == "") {
				if ($("#ocupacion").val() != "404" && $("#ocupacion").val() != "405") {
					alert('Por favor seleccione egresos mensuales.');
					$(this).find('select[name="egresosmensuales"]').focus();
					return false;
				}
			}
			if ($(this).find('select[name="otrosingresos"]').val() == "") {
				alert('Por favor seleccione otros ingresos.');
				$(this).find('select[name="otrosingresos"]').focus();
				return false;
			}
			if ($(this).find('input[name="conceptosotrosingresos"]').val() == "") {
				alert('El campo de concepto de otros ingresos no puede ir vacio, por favor digitelo.');
				$(this).find('input[name="conceptosotrosingresos"]').focus();
				return false;
			}
			if ($(this).find('input[name="telefonoresidencia"]').val() == '' && $(this).find('input[name="celular"]').val() == '' && $(this).find('input[name="telefonolaboral"]').val() == '' && $(this).find('input[name="celularoficinappal"]').val() == '' && $(this).find('input[name="telefonoficinappal"]').val() == '') {
				alert('Esta intentando guardar un formulario sin ningun numero de telefono, esto deberia ser una devolucion y no se puede guardar la informacion de esta manera.');
				$(this).find('input[name="telefonoresidencia"]').focus();
				return false;
			}
		}else if ($(this).find('select[name="tipopersona"]').val() == "2") {
			if ($(this).find('input[name="nit"]').val() != $(this).find('input[name="nit2"]').val()) {
				alert("El No. de NIT no coincide.");
				$(this).find('input[name="nit"]').css('background-color', 'red');
				return false;
			}
			if ($(this).find('select[name="tipoempresajur"]').val() == '') {
				alert('Por favor seleccione el tipo de empresa.');
				$(this).find('select[name="tipoempresajur"]').focus();
				return false;
			}
			if ($(this).find('input[name="detalleactividadeconomicappal"]').val == '') {
				alert('Por favor debe digitar el detalle de la actividad economica principal.');
				$(this).find('input[name="detalleactividadeconomicappal"]').focus();
				return false;
			}
			if ($(this).find('input[name="direccionoficinappal"]').val() == '') {
				alert("Por favor digite la direccion de la oficina principal.");
				$(this).find('input[name="direccionoficinappal"]').focus();
				return false;
			}
			if ($(this).find('select[name="ciudadoficina"]').val() == '') {
				alert("Por favor seleccione ciudadoficina.");
				$(this).find('select[name="ciudadoficina"]').focus();
				return false;
			}
			if($(this).find('select[name="ingresosmensualesemp"]').val() == ''){
				alert('Por favor seleccione ingresos mensuales de la empresa.');
				$(this).find('select[name="ingresosmensualesemp"]').focus();
				return false;
			}
			if($(this).find('input[name="activosemp"]').val() == '' || $(this).find('input[name="activosemp"]').val() == 'SD' || $(this).find('input[name="activosemp"]').val() == 'NA'){
				alert('Por favor digite un valor valido para el campo activos empresa.');
				$(this).find('input[name="activosemp"]').focus();
				return false;
			}
			if($(this).find('input[name="pasivosemp"]').val() == '' || $(this).find('input[name="pasivosemp"]').val() == 'SD' || $(this).find('input[name="pasivosemp"]').val() == 'NA'){
				alert('Por favor digite un valor valido para el campo pasivos empresa.');
				$(this).find('input[name="pasivosemp"]').focus();
				return false;
			}
			if($(this).find('select[name="egresosmensualesemp"]').val() == ''){
				alert('Por favor seleccione egresos mensuales de la empresa.');
				$(this).find('select[name="egresosmensualesemp"]').focus();
				return false;
			}
			if ($(this).find('input[name="telefonoresidencia"]').val() == '' && $(this).find('input[name="celular"]').val() == '' && $(this).find('input[name="telefonolaboral"]').val() == '' && $(this).find('input[name="celularoficinappal"]').val() == '' && $(this).find('input[name="telefonoficina"]').val() == '' && $(this).find('input[name="celularoficina"]').val() == '') {
				alert('Esta intentando guardar un formulario sin ningun numero de telefono, esto deberia ser una devolucion y no se puede guardar la informacion de esta manera.');
				$(this).find('input[name="telefonoresidencia"]').focus();
				return false;
			}
		}
		$(this).find('input, select, textarea').each(function(index, el) {
			if($(el).val() == '' && !$(el).attr('disabled') && $(el).attr('type') != 'hidden' && $(el).attr('type') != 'submit'){
				alert('El campo '+ $(el).attr('title') +' no puede estar vacio. name: ' + $(el).attr('name'));
				$(el).focus();
				return false;
			}
		});
		//return false;
		var data = $(this).serialize();
		$.ajax({
			beforeSend: function(){
				//$('table#table_list_result tbody tr td button#drea_button_add_'+posicion).button('loading');
			},
			data: data,
			type: 'POST',
			url: '../includes/Controller.php',
			dataType: 'json',
			success: function(dato){
				console.log(dato);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert("Error(guardarGestionDeposito): "+xhr.status+" Error: "+xhr.responseText);
			}
		});
	});
});
$.fn.verificarPais = function(e, campo){
	if($(this).val() != '')
		$(this).hide();
}
$.fn.verificarRePais = function(e, campo, titulo){
	if($(this).val() != '' && ($(this).val() != $('#' + campo).val())){
		alert('Los campos ' + titulo + ' no coinciden, por favor validelos.');
		$('#' + campo).show();
		$('#' + campo).val('').change();
		$(this).val('').change();
	}
};
</script>