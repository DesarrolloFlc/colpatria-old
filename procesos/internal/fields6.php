<?php
require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
require_once PATH_CCLASS . DS . 'general.class.php';
$daneCiudades = General::getCiudadesDanes();
$sucursales = General::getSucursalesLista();
$clasesVinculacion = General::getclaseVinculacion();
$tipoDocumentos = General::getTipoDocumentoID();
$tipoempresas = General::getTipoEmpresaID();
$actEconomicas = General::getActividadesEconomicas();
$ciius = General::getCiiuId();
$profesiones = General::getProfesionesID();
$ingresos = General::getIngresosMensualesID();
$egresos = General::getEgresosMensualesID();
$transacciones = General::getTipoTransaccionesID();
$paises = General::getPaisesID();
$areas = General::getAreasID();
$funcionarios = General::getOfficials();
$tipo_persona = General::getTipoPersonaId();
?>
<input type="hidden" name="formulario" id="formulario" value="15">
<table>
	<tr>
		<td>
		<table>
			<tr>
				<td style="width: 80px">Fecha de radicado:</td><!--fecharadicado-->
				<td>
					<select id="f_rad_a" name="f_rad_a" onchange="$(this).verificarFecha(event, 'rad', '1');" style="font-size: 12px">
						<option value="">Año</option>
<?php
		$an = 1900;
		$anl = date('Y');
		for($i = $an; $i <= $anl;$i++)
			echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_rad_m" name="f_rad_m" onchange="$(this).verificarFecha(event, 'rad', '1');" style="font-size: 12px">
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
					<select id="f_rad_d" name="f_rad_d" style="font-size: 12px">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 80px">Fecha de diligenciamiento:</td><!--fechasolicitud-->
				<td>
					<select id="f_dil_a" name="f_dil_a" onchange="$(this).verificarFecha(event, 'dil', '1');" style="font-size: 12px">
						<option value="">Año</option>
<?php
		$an = 1900;
		$anl = date('Y');
		for($i = $an; $i <= $anl;$i++)
			echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_dil_m" name="f_dil_m" onchange="$(this).verificarFecha(event, 'dil', '1');" style="font-size: 12px">
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
					<select id="f_dil_d" name="f_dil_d" onblur="$(this).verificarFechaDoble(event, 'dil', '1');" style="font-size: 12px">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Ciudad:</td>
				<td>
					<select id="ciudad" name="ciudad" style="font-size: 12px">
						<option value="">Seleccione...</option>
<?php
/*agregar campo llamado ciudad*/
					foreach ($daneCiudades as $ciudad) {
						echo '<option value="'.$ciudad['id'].'">'.$ciudad['ciudad'].'</option>';
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Sucursal:</td>
				<td>
					<select id="sucursal" name="sucursal" style="font-size: 12px">
						<option value="">Seleccione...</option>
<?php
					foreach ($sucursales as $sucursal) {
						echo '<option value="'.$sucursal['id'].'">'.$sucursal['sucursal'].'</option>';
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Area:</td>
				<td>
					<select id="area" name="area" style="font-size: 12px">
						<option value="">Seleccione...</option>
<?php
					foreach ($areas as $area) {
						echo '<option value="'.$area['id'].'">'.$area['description'].'</option>';
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Funcionario:</td>
				<td>
					<select id="id_official" name="id_official" style="font-size: 12px">
						<option value="">Seleccione...</option>
<?php
					foreach ($funcionarios as $funcionario) {
						echo '<option value="'.strtoupper($funcionario['name']).'">'.strtoupper($funcionario['name']).'</option>';
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Tipo de solicitud:</td>
				<td>
					<select id="tipo_solicitud" name="tipo_solicitud"><!--agregar campo llamado tipo_solicitud-->
						<option value="">Seleccion...</option>
						<option value="VINCULACION">Vinculacion</option>
						<option value="ACTUALIZACION">Actualizacion</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Clase vinculacion:</td>
				<td>
					<select id="clasecliente" name="clasecliente" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($clasesVinculacion as $clase) {
						echo '<option value="'.$clase['id'].'">'.$clase['description'].'</option>';
					}
?>
					</select>
					Cual?
					<input type="text" id="cual_clasecliente" name="cual_clasecliente" style="width: 130px;" disabled onkeypress="return validar_letra(event)"><!--agregar campo llamado cual_clasecliente-->
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
					<input type="text" id="primerapellido" name="primerapellido" style="width: 130px; margin-right: 30px" onkeypress="return validar_letra(event)">
					Segundo apellido:&nbsp;
					<input type="text" id="segundoapellido" name="segundoapellido" style="width: 130px" onkeypress="return validar_letra(event)">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Nombres:</td>
				<td><input type="text" id="nombres" name="nombres" style="width: 200px; margin-right: 40px" onkeypress="return validar_letra(event)"></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Genero:</td>
				<td>
					<select id="sexo" name="sexo" class="obligatorio" onblur="ocultarCampoGenero();">
						<option value="">Seleccion...</option>
						<option value="Femenino">Femenino</option>
						<option value="Masculino">Masculino</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo documento:</td>
				<td>
					<select id="tipodocumento" name="tipodocumento" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($tipoDocumentos as $tipo) {
						echo '<option value="'.$tipo['id'].'">'.$tipo['description'].'</option>';
					}
?>
					</select>
					Numero identificacion:&nbsp;<input type="text" id="documento" name="documento" onBlur="ocultarCampoDoc();" style="width: 130px">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Fecha expedicion:</td><!--fechaexpedicion-->
				<td>
					<select id="f_exp_a" name="f_exp_a" onchange="$(this).verificarFecha(event, 'exp', '0');" style="font-size: 12px">
						<option value="">Año</option>
<?php
		$an = 1900;
		$anl = date('Y');
		for($i = $an; $i <= $anl;$i++)
			echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_exp_m" name="f_exp_m" onchange="$(this).verificarFecha(event, 'exp', '0');" style="font-size: 12px">
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
					<select id="f_exp_d" name="f_exp_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Lugar expedicion:</td>
				<td>
					<select id="lugarexpedicion" name="lugarexpedicion" style="font-size: 12px">
						<option value="">Seleccione...</option>
<?php
				foreach ($daneCiudades as $ciudad) {
					echo '<option value="'.$ciudad['id'].'">'.$ciudad['ciudad'].'</option>';
				}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Fecha nacimiento:</td><!--fechanacimiento-->
				<td>
					<select id="f_nac_a" name="f_nac_a" onchange="$(this).verificarFecha(event, 'nac', '1');" style="font-size: 12px">
						<option value="">Año</option>
<?php
		$an = 1900;
		$anl = date('Y');
		for($i = $an; $i <= $anl;$i++)
			echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_nac_m" name="f_nac_m" onchange="$(this).verificarFecha(event, 'nac', '1');" style="font-size: 12px">
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
					<select id="f_nac_d" name="f_nac_d" style="font-size: 12px" onblur="$(this).verificarFechaDoble(event, 'nac', '1');">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Lugar nacimiento:</td>
				<td>
					<select id="lugarnacimiento" name="lugarnacimiento" style="font-size: 12px">
						<option value="">Seleccione...</option>
<?php
				foreach ($daneCiudades as $ciudad) {
					echo '<option value="'.$ciudad['id'].'">'.$ciudad['ciudad'].'</option>';
				}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Nacionalidad:</td>
				<td>
					<select id="paisnacimiento" name="paisnacimiento" style="font-size: 12px" onblur="$(this).verificarPais(event, 'paisnacimiento');">
						<option value="">Seleccione...</option>
<?php
					foreach ($paises as $pais) {
						echo '<option value="'.$pais['id'].'">'.$pais['description'].'</option>';
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Nacionalidad 2:</td>
				<td>
					<select id="nacionalidad_otra" name="nacionalidad_otra" style="font-size: 12px" onblur="$(this).verificarPais(event, 'nacionalidad_otra');">
						<option value="">Seleccione...</option>
<?php
					foreach ($paises as $pais) {
						echo '<option value="'.$pais['id'].'">'.$pais['description'].'</option>';
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">E-mail:</td>
				<td><input type="text" id="correoelectronico" name="correoelectronico" style="width: 240px" onkeypress="return validar_letra(event)"></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Celular:</td>
				<td>
					<input type="text" id="celular" name="celular" style="width: 130px" maxlength="10" onblur="$(this).checkTamanoTele(10);">
					Telefono:
					<input type="text" id="telefonoresidencia" name="telefonoresidencia" style="width: 130px; margin-right: 40px" maxlength="7" onblur="$(this).checkTamanoTele(7);">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Direccion residencia:</td>
				<td><input type="text" id="direccionresidencia" name="direccionresidencia" style="width: 240px" onkeypress="return validar_letra(event)"></td>
			</tr>
			<tr>
				<td>Re-escribir Tipo persona:</td>
				<td>
					<select id="tipopersona2" name="tipopersona2" onblur="$(this).revisarTipoPersona(event);">
						<option value="">-- Seleccione una opción --</option>
<?php
foreach ($tipo_persona as $tipopersona){
?>
						<option value="<?=$tipopersona['id']?>"><?=$tipopersona['description']?></option>
<?php
}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Ciudad y departamento:</td>
				<td>
					<select id="ciudadresidencia" name="ciudadresidencia" style="font-size: 12px">
						<option value="">Seleccione...</option>
<?php
				foreach ($daneCiudades as $ciudad) {
					echo '<option value="'.$ciudad['id'].'">'.$ciudad['ciudad'].'</option>';
				}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Empresa donde trabaja:</td>
				<td><input type="text" id="nombreempresa" name="nombreempresa" style="width: 240px" onkeypress="return validar_letra(event)"></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Direccion oficina:</td>
				<td>
					<input type="text" id="direccionempresa" name="direccionempresa" style="width: 180px; margin-right: 10px" onkeypress="return validar_letra(event)">
					Telefono oficina:
					<input type="text" id="telefonolaboral" name="telefonolaboral" style="width: 100px" onblur="$(this).checkTamanoTele(7);" maxlength="7">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Ciudad empresa</td>
				<td>
					<select id="ciudadempresa" name="ciudadempresa" style="font-size: 12px">
						<option value="">Seleccione...</option>
<?php
				foreach ($daneCiudades as $ciudad) {
					echo '<option value="'.$ciudad['id'].'">'.$ciudad['ciudad'].'</option>';
				}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 80px">Re-escribir fecha de diligenciamiento:</td><!--fechasolicitud-->
				<td>
					<select id="f_dil2_a" name="f_dil2_a" onchange="$(this).verificarFecha(event, 'dil2', '1');" style="font-size: 12px">
						<option value="">Año</option>
<?php
		$an = 1900;
		$anl = date('Y');
		for($i = $an; $i <= $anl;$i++)
			echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_dil2_m" name="f_dil2_m" onchange="$(this).verificarFecha(event, 'dil2', '1');" style="font-size: 12px">
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
					<select id="f_dil2_d" name="f_dil2_d" onblur="$(this).verificarFechaDoble(event, 'dil', '2');" style="font-size: 12px">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Celular oficina:</td>
				<td>
					<input type="text" id="celularoficinappal" name="celularoficinappal" style="width: 160px" onblur="$(this).checkTamanoTele(10);" maxlength="10"><!--agregar campo llamado celularoficinappal-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Re-escribir numero identificacion</td>
				<td>
					<input type="text" name="documento2" id="documento2" onpaste="alert('No se puede copiar.');return false" onBlur="validarCampoDoc();" onpaste="return false;" class="obligatorio">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo empresa</td>
				<td>
					<select id="tipoempresaemp" name="tipoempresaemp" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($tipoempresas as $tipoempresa) {
						echo '<option value="'.$tipoempresa['id'].'">'.$tipoempresa['description'].'</option>';
					}
?>
					</select>
					Cual?
					<input type="text" id="tipoempresaemp_cual" name="tipoempresaemp_cual" style="width: 100px" disabled onkeypress="return validar_letra(event)"><!--agregar campo llamado tipoempresaemp_cual-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
				<td>
					<select id="recursos_publicos" name="recursos_publicos" style="font-size: 12px; margin-right: 15px"><!--agregar campo llamado recursos_publicos-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Grado de poder publico?
					<select id="poder_publico" name="poder_publico" style="font-size: 12px; margin-left: 10px"><!--agregar campo llamado poder_publico-->
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
					<select id="reconocimiento_publico" name="reconocimiento_publico" style="font-size: 12px; margin-right: 15px"><!--agregar campo llamado reconocimiento_publico-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Indique
					<input type="text" id="reconocimiento_cual" name="reconocimiento_cual" style="width: 180px; margin-left: 10px" disabled onkeypress="return validar_letra(event)"><!--agregar campo llamado reconocimiento_cual-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Re-escribir Nacionalidad:</td>
				<td>
					<select id="paisnacimiento2" name="paisnacimiento2" style="font-size: 12px" onblur="$(this).verificarRePais(event, 'paisnacimiento', 'Nacionalidad');">
						<option value="">Seleccione...</option>
<?php
					foreach ($paises as $pais) {
						echo '<option value="'.$pais['id'].'">'.$pais['description'].'</option>';
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Servidor publico?</td>
				<td>
					<select id="servidor_publico" name="servidor_publico" style="font-size: 12px; margin-right: 15px"><!--agregar campo llamado servidor_publico-->
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
					<select id="f_nac2_a" name="f_nac2_a" onchange="$(this).verificarFecha(event, 'nac2', '1');" style="font-size: 12px">
						<option value="">Año</option>
<?php
		$an = 1900;
		$anl = date('Y');
		for($i = $an; $i <= $anl;$i++)
			echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_nac2_m" name="f_nac2_m" onchange="$(this).verificarFecha(event, 'nac2', '1');" style="font-size: 12px">
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
					<select id="f_nac2_d" name="f_nac2_d" style="font-size: 12px" onblur="$(this).verificarFechaDoble(event, 'nac', '2');">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Persona expuesta politicamente?</td>
				<td>
					<select id="expuesta_politica" name="expuesta_politica" style="font-size: 12px; margin-right: 15px"><!--agregar campo llamado expuesta_politica-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Cargo:
					<input type="text" id="cargo_politica" name="cargo_politica" style="width: 180px; margin-left: 10px" disabled onkeypress="return validar_letra(event)"><!--agregar campo llamado cargo_politica-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">&nbsp;</td>
				<td>
					Inicio
					<select id="f_ini_a" name="f_ini_a" onchange="$(this).verificarFecha(event, 'ini', '0');" style="font-size: 12px"><!--agregar campo llamado cargo_politica_ini-->
						<option value="">Año</option>
<?php
		$an = 1900;
		$anl = date('Y');
		for($i = $an; $i <= $anl;$i++)
			echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_ini_m" name="f_ini_m" onchange="$(this).verificarFecha(event, 'ini', '0');" style="font-size: 12px">
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
					<select id="f_ini_d" name="f_ini_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px">
						<option value="">Dia</option>
					</select>
					Fin
					<select id="f_fin_a" name="f_fin_a" onchange="$(this).verificarFecha(event, 'fin', '0');" style="font-size: 12px"><!--agregar campo llamado cargo_politica_fin-->
						<option value="">Año</option>
<?php
		$an = 1900;
		$anl = date('Y', strtotime('+3 year'));
		for($i = $an; $i <= $anl;$i++)
			echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_fin_m" name="f_fin_m" onchange="$(this).verificarFecha(event, 'fin', '0');" style="font-size: 12px">
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
					<select id="f_fin_d" name="f_fin_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px">
						<option value="">Dia</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
				<td>
					<select id="expuesta_publica" name="expuesta_publica" style="font-size: 12px; margin-right: 5px"><!--agregar campo llamado expuesta_publica-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Nombre: 
					<input type="text" id="publica_nombre" name="publica_nombre" style="width: 100px" disabled onkeypress="return validar_letra(event)"><!--agregar campo llamado publica_nombre-->
					Cargo: 
					<input type="text" id="publica_cargo" name="publica_cargo" style="width: 100px" disabled onkeypress="return validar_letra(event)"><!--agregar campo llamado publica_cargo-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Representante internacional?</td>
				<td>
					<select id="repre_internacional" name="repre_internacional" style="font-size: 12px; margin-right: 5px"><!--agregar campo llamado repre_internacional-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Indique: 
					<input type="text" id="internacional_indique" name="internacional_indique" style="width: 180px" disabled onkeypress="return validar_letra(event)"><!--agregar campo llamado internacional_indique-->
				</td>
			</tr>
			<!--Re-escribir campo telefono y celular-->
			<tr>
				<td style="width: 100px;display: table-cell;">Re-escribir Telefono:</td>
				<td>
					<input type="text" id="telefonoresidencia2" name="telefonoresidencia2" style="width: 130px; margin-right: 10px" onblur="validarCampoTelf();" maxlength="7">
					Re-escribir Celular:
					<input type="text" id="celular2" name="celular2" style="width: 130px" onblur="validarCampoCel();" maxlength="10">
				</td>
			</tr>
			<tr>
				<td>Re-escribir Genero</td>
				<td>
					<select id="sexo2" name="sexo2" onblur="validarCampoGenero();">
						<option value="">Seleccion...</option>
						<option value="Femenino">Femenino</option>
						<option value="Masculino">Masculino</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tributarias en otro pais?</td>
				<td>
					<select id="tributarias_otro_pais" name="tributarias_otro_pais" style="font-size: 12px; margin-right: 5px"><!--agregar campo llamado tributarias_otro_pais-->
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Cuales?: 
					<input type="text" id="tributarias_paises" name="tributarias_paises" style="width: 180px" disabled onkeypress="return validar_letra(event)"><!--agregar campo llamado tributarias_paises-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Re-escribir Nacionalidad 2:</td>
				<td>
					<select id="nacionalidad_otra2" name="nacionalidad_otra2" style="font-size: 12px" onblur="$(this).verificarRePais(event, 'nacionalidad_otra', 'Nacionalidad 2');">
						<option value="">Seleccione...</option>
<?php
					foreach ($paises as $pais) {
						echo '<option value="'.$pais['id'].'">'.$pais['description'].'</option>';
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
if($_POST['type_person'] == "1"){
?>
			<tr>
				<td colspan="2">PERSONA NATURAL</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Actividad economica:</td>
				<td>
					<select id="tipoactividad" name="tipoactividad" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($actEconomicas as $actEconomica) {
						echo '<option value="'.$actEconomica['id'].'">'.$actEconomica['description'].'</option>';
					}
?>
					</select>
					CIIU(codigo):
					<select id="ciiu" name="ciiu" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($ciius as $ciiu) {
						echo '<option value="'.$ciiu['codigo'].'">'.$ciiu['descripcion'].'</option>';
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Ocupacion / Profesion</td>
				<td>
					<select id="profesion" name="profesion" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($profesiones as $profesion) {
						echo '<option value="'.$profesion['id'].'">'.$profesion['description'].'</option>';
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Cargo:</td>
				<td><input type="text" id="cargo" name="cargo" style="width: 260px" onkeypress="return validar_letra(event)"></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Actividad secundaria:</td>
				<td>
					<input type="text" id="detalleactividadeconomicappal" name="detalleactividadeconomicappal" style="width: 130px; margin-right: 15px" onkeypress="return validar_letra(event)">
					CIIU:
					<select id="ciiu_otro" name="ciiu_otro" style="font-size: 12px; margin-right: 5px"><!--agregar campo llamado ciiu_otro-->
						<option value="">Seleccione...</option>
<?php
					foreach ($ciius as $ciiu) {
						echo '<option value="'.$ciiu['codigo'].'">'.$ciiu['descripcion'].'</option>';
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Direccion:</td>
				<td>
					<input type="text" id="direccionoficinappal" name="direccionoficinappal" style="width: 180px; margin-right: 15px" onkeypress="return validar_letra(event)">
					Telefono:
					<input type="text" id="telefonoficinappal" name="telefonoficinappal" style="width: 100px" onblur="$(this).checkTamanoTele(7);" maxlength="7"><!--agregar campo llamado telefonoficinappal-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo de comercio:</td>
				<td><input type="text" id="detalletipoactividad" name="detalletipoactividad" style="width: 220px" onkeypress="return validar_letra(event)"></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Ingresos mensuales:</td>
				<td>
					<select id="ingresosmensuales" name="ingresosmensuales" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($ingresos as $ingreso) {
						echo '<option value="'.$ingreso['id'].'">'.$ingreso['description'].'</option>';
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Activos:</td>
				<td>
					<input type="text" id="totalactivos" name="totalactivos" style="width: 100px; margin-right: 20px">
					Pasivos:
					<input type="text" id="totalpasivos" name="totalpasivos" style="width: 100px">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Egresos mensuales:</td>
				<td>
					<select id="egresosmensuales" name="egresosmensuales" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($egresos as $egreso) {
						echo '<option value="'.$egreso['id'].'">'.$egreso['description'].'</option>';
					}
?>
					</select>
					Patrimonio:
					<input type="text" id="patrimonio" name="patrimonio" style="width: 100px"><!--agregar campo llamado patrimonio-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Otros ingresos:</td>
				<td>
					<select id="otrosingresos" name="otrosingresos" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($ingresos as $ingreso) {
						echo '<option value="'.$ingreso['id'].'">'.$ingreso['description'].'</option>';
					}
?>
						<option value="13">SD</option>
					</select>
					Concepto otros ingresos:
					<input type="text" id="conceptosotrosingresos" name="conceptosotrosingresos" style="width: 150px" onkeypress="return validar_letra(event)">
				</td>
			</tr>
<?php
}elseif($_POST['type_person'] == "2"){
?>
			<tr>
				<td colspan="2">PERSONA JUR&Iacute;DICA</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Nombre o Razon social:</td>
				<td><input type="text" id="razonsocial" name="razonsocial" style="width: 280px" onkeypress="return validar_letra(event)"></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">NIT:</td>
				<td>
					<input type="text" id="nit" name="nit" style="width: 130px; margin-right: 10px" onBlur="ocultarCampoNit();">
					DIV:
					<input type="text" id="digitochequeo" name="digitochequeo" style="width: 80px; margin-left: 10px">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo de empresa</td>
				<td>
					<select id="tipoempresajur" name="tipoempresajur" style="font-size: 12px; margin-right: 5px"><!--agregar campo llamado tipoempresajur-->
						<option value="">Seleccione...</option>
<?php
					foreach ($tipoempresas as $tipoempresa) {
						echo '<option value="'.$tipoempresa['id'].'">'.$tipoempresa['description'].'</option>';
					}
?>
					</select>
					Otra: 
					<input type="text" id="tipoempresajur_otra" name="tipoempresajur_otra" style="width: 130px; margin-left: 10px" disabled onkeypress="return validar_letra(event)"><!--agregar campo llamado tipoempresajur_otra-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Actividad economica:</td>
				<td>
					<input type="text" id="detalleactividadeconomicappal" name="detalleactividadeconomicappal" style="width: 180px; margin-right: 10px" onkeypress="return validar_letra(event)">
					CIIU(codigo):
					<select id="ciiu" name="ciiu" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($ciius as $ciiu) {
						echo '<option value="'.$ciiu['codigo'].'">'.$ciiu['descripcion'].'</option>';
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Direccion oficina principal:</td>
				<td><input type="text" id="direccionoficinappal" name="direccionoficinappal" style="width: 240px" onkeypress="return validar_letra(event)"></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Ciudad / Departamento:</td>
				<td>
					<select id="ciudadoficina" name="ciudadoficina" style="font-size: 12px">
						<option value="">Seleccione...</option>
<?php
					foreach ($daneCiudades as $ciudad) {
						echo '<option value="'.$ciudad['id'].'">'.$ciudad['ciudad'].'</option>';
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Telefono:</td>
				<td>
					<input type="text" id="telefonoficina" name="telefonoficina" style="width: 100px; margin-right: 10px" onblur="$(this).checkTamanoTele(7);" maxlength="7">
					E-mail:
					<input type="text" id="correoelectronico_otro" name="correoelectronico_otro" style="width: 230px" onkeypress="return validar_letra(event)">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Celular:</td>
				<td>
					<input type="text" id="celularoficina" name="celularoficina" style="width: 100px; margin-right: 10px" onblur="$(this).checkTamanoTele(10);" maxlength="10">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Direccion sucursal:</td>
				<td><input type="text" id="direccionsucursal" name="direccionsucursal" style="width: 240px" onkeypress="return validar_letra(event)"></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Ingresos mensuales:</td>
				<td>
					<select id="ingresosmensualesemp" name="ingresosmensualesemp" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($ingresos as $ingreso) {
						echo '<option value="'.$ingreso['id'].'">'.$ingreso['description'].'</option>';
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Activos:</td>
				<td>
					<input type="text" id="activosemp" name="activosemp" style="width: 100px; margin-right: 20px">
					Pasivos:
					<input type="text" id="pasivosemp" name="pasivosemp" style="width: 100px">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Egresos mensuales:</td>
				<td>
					<select id="egresosmensualesemp" name="egresosmensualesemp" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($egresos as $egreso) {
						echo '<option value="'.$egreso['id'].'">'.$egreso['description'].'</option>';
					}
?>
					</select>
					Patrimonio:
					<input type="text" id="patrimonio" name="patrimonio" style="width: 100px">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Otros ingresos:</td>
				<td>
					<select id="otrosingresosemp" name="otrosingresosemp" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($ingresos as $ingreso) {
						echo '<option value="'.$ingreso['id'].'">'.$ingreso['description'].'</option>';
					}
?>
						<option value="13">SD</option>
					</select>
					Concepto otros ingresos:
					<input type="text" id="concepto_otrosingresosemp" name="concepto_otrosingresosemp" style="width: 150px" onkeypress="return validar_letra(event)">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Re-escribir NIT:</td>
				<td>
					<input type="text" id="nit2" name="nit2" style="width: 130px; margin-right: 10px" onblur="validarCampoNit();">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Re-escribir Telefono:</td>
				<td>
					<input type="text" id="telefonoficina2" name="telefonoficina2" style="width: 100px; margin-right: 10px" onblur="validarCampoTelfOfi();" maxlength="7">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Re-escribir Celular:</td>
				<td>
					<input type="text" id="celularoficina2" name="celularoficina2" style="width: 100px; margin-right: 10px" onblur="validarCampoCelOfi();" maxlength="10">
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2"><strong>Idenficacion de los accionistas o asociados</strong></td>
			</tr>
			<tr>
				<td colspan="2"><strong>Accionista #1</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo id:</td>
				<td>
					<select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($tipoDocumentos as $tipo) {
						echo '<option value="'.$tipo['id'].'">'.$tipo['description'].'</option>';
					}
?>
					</select>
					Numero id:
					<input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Razon social / nombre</td>
				<td>
					<input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" onkeypress="return validar_letra(event)">
					% Participacion:
					<input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
				<td>
					<select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Reconocimiento publico?
					<select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
				<td>
					<select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Tributarias en otro pais?
					<input type="text" name="declaracion_tributaria[]" id="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" onkeypress="return validar_letra(event)">
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2"><strong>Accionista #2</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo id:</td>
				<td>
					<select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($tipoDocumentos as $tipo) {
						echo '<option value="'.$tipo['id'].'">'.$tipo['description'].'</option>';
					}
?>
					</select>
					Numero id:
					<input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Razon social / nombre</td>
				<td>
					<input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" onkeypress="return validar_letra(event)">
					% Participacion:
					<input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
				<td>
					<select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Reconocimiento publico?
					<select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
				<td>
					<select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Tributarias en otro pais?
					<input type="text" name="declaracion_tributaria[]" id="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" onkeypress="return validar_letra(event)">
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2"><strong>Accionista #3</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo id:</td>
				<td>
					<select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($tipoDocumentos as $tipo) {
						echo '<option value="'.$tipo['id'].'">'.$tipo['description'].'</option>';
					}
?>
					</select>
					Numero id:
					<input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Razon social / nombre</td>
				<td>
					<input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" onkeypress="return validar_letra(event)">
					% Participacion:
					<input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
				<td>
					<select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Reconocimiento publico?
					<select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
				<td>
					<select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Tributarias en otro pais?
					<input type="text" name="declaracion_tributaria[]" id="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" onkeypress="return validar_letra(event)">
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2"><strong>Accionista #4</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo id:</td>
				<td>
					<select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($tipoDocumentos as $tipo) {
						echo '<option value="'.$tipo['id'].'">'.$tipo['description'].'</option>';
					}
?>
					</select>
					Numero id:
					<input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Razon social / nombre</td>
				<td>
					<input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" onkeypress="return validar_letra(event)">
					% Participacion:
					<input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
				<td>
					<select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Reconocimiento publico?
					<select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
				<td>
					<select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Tributarias en otro pais?
					<input type="text" name="declaracion_tributaria[]" id="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" onkeypress="return validar_letra(event)">
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2"><strong>Accionista #5</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo id:</td>
				<td>
					<select id="tipo_id[]" name="tipo_id[]" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccione...</option>
<?php
					foreach ($tipoDocumentos as $tipo) {
						echo '<option value="'.$tipo['id'].'">'.$tipo['description'].'</option>';
					}
?>
					</select>
					Numero id:
					<input type="text" id="identificacion[]" name="identificacion[]" style="width: 130px">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Razon social / nombre</td>
				<td>
					<input type="text" id="nombre_accionista[]" name="nombre_accionista[]" style="width: 220px; margin-right: 10px" onkeypress="return validar_letra(event)">
					% Participacion:
					<input type="text" id="porcentaje[]" name="porcentaje[]" style="width: 40px">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Maneja recursos publicos?</td>
				<td>
					<select id="publico_recursos[]" name="publico_recursos[]" style="font-size: 12px; margin-right: 15px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Reconocimiento publico?
					<select id="publico_reconocimiento[]" name="publico_reconocimiento[]" style="font-size: 12px; margin-left: 10px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Persona expuesta publicamente?</td>
				<td>
					<select id="publico_expuesta[]" name="publico_expuesta[]" style="font-size: 12px; margin-right: 15px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Tributarias en otro pais?
					<input type="text" name="declaracion_tributaria[]" id="declaracion_tributaria[]" style="font-size: 12px; margin-left: 10px" onkeypress="return validar_letra(event)">
				</td>
			</tr>
<?php
}
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
					<input type="text" id="origen_fondos" name="origen_fondos" style="width: 160px; margin-right: 10px" onkeypress="return validar_letra(event)"><!--agregar campo llamado origen_fondos-->
					Pais de procedencia:
					<input type="text" id="procedencia_fondos" name="procedencia_fondos" style="width: 100px" onkeypress="return validar_letra(event)"><!--agregar campo llamado procedencia_fondos-->
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
					<select id="monedaextranjera" name="monedaextranjera" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Cual?
					<select id="tipotransacciones" name="tipotransacciones" style="font-size: 12px; margin-right: 5px" disabled>
						<option value="">Seleccione...</option>
<?php
					foreach ($transacciones as $transaccion) {
						echo '<option value="'.$transaccion['id'].'">'.$transaccion['description'].'</option>';
					}
?>
					</select>
					<input type="text" id="tipotransacciones_cual" name="tipotransacciones_cual" style="width: 135px" disabled onkeypress="return validar_letra(event)"><!--agregar campo llamado tipotransacciones_cual-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Otras operaciones:</td>
				<td><input type="text" id="otras_operaciones" name="otras_operaciones" style="width: 260px" onkeypress="return validar_letra(event)"></td><!--agregar campo llamado otras_operaciones-->
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Productos en el exterior?</td>
				<td>
					<select id="productos_exterior" name="productos_exterior" style="font-size: 12px; margin-right: 5px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Cuentas moneda extranjera?
					<select id="cuentas_monedaextranjera" name="cuentas_monedaextranjera" style="font-size: 12px; margin-right: 5px">
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
					<input type="text" id="producto_tipo[]" name="producto_tipo[]" style="width: 130px; margin-right: 15px" disabled onkeypress="return validar_letra(event)">
					Identificacion:
					<input type="text" id="producto_identificacion[]" name="producto_identificacion[]" style="width: 140px; margin-left: 10px" disabled>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Entidad:</td>
				<td>
					<input type="text" id="producto_entidad[]" name="producto_entidad[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)">
					Monto:
					<input type="text" id="producto_monto[]" name="producto_monto[]" style="width: 80px; margin-right: 5px" disabled>
					Ciudad:
					<input type="text" id="producto_ciudad[]" name="producto_ciudad[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Pais:</td>
				<td>
					<input type="text" id="producto_pais[]" name="producto_pais[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)">
					Moneda:
					<input type="text" id="producto_moneda[]" name="producto_moneda[]" style="width: 80px; margin-right: 5px" disabled onkeypress="return validar_letra(event)">
				</td>
			</tr>
			<tr>
				<td colspan="2"><strong style="font-size: 14px">#2</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo de producto:</td>
				<td>
					<input type="text" id="producto_tipo[]" name="producto_tipo[]" style="width: 130px; margin-right: 15px" disabled onkeypress="return validar_letra(event)">
					Identificacion:
					<input type="text" id="producto_identificacion[]" name="producto_identificacion[]" style="width: 140px; margin-left: 10px" disabled>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Entidad:</td>
				<td>
					<input type="text" id="producto_entidad[]" name="producto_entidad[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)">
					Monto:
					<input type="text" id="producto_monto[]" name="producto_monto[]" style="width: 80px; margin-right: 5px" disabled>
					Ciudad:
					<input type="text" id="producto_ciudad[]" name="producto_ciudad[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Pais:</td>
				<td>
					<input type="text" id="producto_pais[]" name="producto_pais[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)">
					Moneda:
					<input type="text" id="producto_moneda[]" name="producto_moneda[]" style="width: 80px; margin-right: 5px" disabled onkeypress="return validar_letra(event)">
				</td>
			</tr>
			<tr>
				<td colspan="2"><strong style="font-size: 14px">#3</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Tipo de producto:</td>
				<td>
					<input type="text" id="producto_tipo[]" name="producto_tipo[]" style="width: 130px; margin-right: 15px" disabled onkeypress="return validar_letra(event)">
					Identificacion:
					<input type="text" id="producto_identificacion[]" name="producto_identificacion[]" style="width: 140px; margin-left: 10px" disabled>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Entidad:</td>
				<td>
					<input type="text" id="producto_entidad[]" name="producto_entidad[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)">
					Monto:
					<input type="text" id="producto_monto[]" name="producto_monto[]" style="width: 80px; margin-right: 5px" disabled>
					Ciudad:
					<input type="text" id="producto_ciudad[]" name="producto_ciudad[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Pais:</td>
				<td>
					<input type="text" id="producto_pais[]" name="producto_pais[]" style="width: 110px; margin-right: 5px" disabled onkeypress="return validar_letra(event)">
					Moneda:
					<input type="text" id="producto_moneda[]" name="producto_moneda[]" style="width: 80px; margin-right: 5px" disabled onkeypress="return validar_letra(event)">
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
					<select id="reclamaciones" name="reclamaciones" style="font-size: 12px; margin-right: 5px"><!--agregar campo llamado reclamaciones-->
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
					<input type="text" id="rec_ano[]" name="rec_ano[]" style="width: 50px; margin-right: 5px" disabled>
					Ramo:
					<input type="text" id="rec_ramo[]" name="rec_ramo[]" style="width: 220px; margin-right: 5px" disabled onkeypress="return validar_letra(event)">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Compañia:</td>
				<td>
					<input type="text" id="rec_compania[]" name="rec_compania[]" style="width: 150px; margin-right: 8px" disabled onkeypress="return validar_letra(event)">
					Valor:
					<input type="text" id="rec_valor[]" name="rec_valor[]" style="width: 120px; margin-right: 5px" disabled>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Resultado:</td>
				<td>
					<input type="text" id="rec_resultado[]" name="rec_resultado[]" style="width: 150px" disabled onkeypress="return validar_letra(event)">
				</td>
			</tr>
			<tr>
				<td colspan="2"><strong style="font-size: 14px">#2</strong></td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Año:</td>
				<td>
					<input type="text" id="rec_ano[]" name="rec_ano[]" style="width: 50px; margin-right: 5px" disabled>
					Ramo:
					<input type="text" id="rec_ramo[]" name="rec_ramo[]" style="width: 220px; margin-right: 5px" disabled onkeypress="return validar_letra(event)">
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Compañia:</td>
				<td>
					<input type="text" id="rec_compania[]" name="rec_compania[]" style="width: 150px; margin-right: 8px" disabled onkeypress="return validar_letra(event)">
					Valor:
					<input type="text" id="rec_valor[]" name="rec_valor[]" style="width: 120px; margin-right: 5px" disabled>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Resultado:</td>
				<td>
					<input type="text" id="rec_resultado[]" name="rec_resultado[]" style="width: 150px" disabled onkeypress="return validar_letra(event)">
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
					<select id="auto_correo" name="auto_correo" style="font-size: 12px; margin-right: 10px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
						<option value="2">SD</option>
					</select>
					Autoriza el envio de SMS?
					<select id="auto_sms" name="auto_sms" style="font-size: 12px;">
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
					<select id="firma" name="firma" style="font-size: 12px; margin-right: 20px">
						<option value="">Seleccion...</option>
						<option value="-1">SI</option>
						<option value="0">NO</option>
					</select>
					Huella:
					<select id="huella" name="huella" style="font-size: 12px; margin-left: 5px">
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
					<input type="text" id="lugarentrevista" name="lugarentrevista" style="width: 180px; margin-right: 10px" onkeypress="return validar_letra(event)">
					Resultado:
					<select id="resultadoentrevista" name="resultadoentrevista" style="font-size: 12px">
						<option value="">Seleccion...</option>
						<option value="APROBADO">Aprobado</option>
						<option value="RECHAZADO">Rechazado</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 80px">Fecha de entrevista:</td><!--fechaentrevista-->
				<td>
					<select id="f_ent_a" name="f_ent_a" onchange="$(this).verificarFecha(event, 'ent', '0');" style="font-size: 12px">
						<option value="">Año</option>
<?php
		$an = 1900;
		$anl = date('Y');
		for($i = $an; $i <= $anl;$i++)
			echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_ent_m" name="f_ent_m" onchange="$(this).verificarFecha(event, 'ent', '0');" style="font-size: 12px">
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
					<select id="f_ent_d" name="f_ent_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px">
						<option value="">Dia</option>
					</select>
					Hora:
					<select id="h_ent_h" name="h_ent_h" style="font-size: 12px">
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
					<select id="h_ent_m" name="h_ent_m" style="font-size: 12px">
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
					<select id="h_ent_z" name="h_ent_z" style="font-size: 12px">
						<option value="">Horario</option>
						<option value="AM">A.M.</option>
						<option value="PM">P.M.</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Observaciones:</td>
				<td>
					<textarea cols="40" rows="4" id="observacionesentrevista" name="observacionesentrevista" onkeypress="return validar_letra(event)"></textarea>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Nombre Intermediario / Asesor / Entrevistador:</td>
				<td>
					<input type="text" id="nombreintermediario" name="nombreintermediario" style="width: 190px; margin-right: 10px" onkeypress="return validar_letra(event)">
					Clave:
					<input type="text" id="clave_inter" name="clave_inter" style="width: 100px"><!--agregar campo llamado clave_inter-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Firma entrevistador:</td>
				<td>
					<select id="firma_entrevista" name="firma_entrevista" style="font-size: 12px"><!--agregar campo llamado firma_entrevista-->
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
					<select id="verificacion_ciudad" name="verificacion_ciudad" style="font-size: 12px"><!--agregar campo llamado verificacion_ciudad-->
						<option value="">Seleccione...</option>
<?php
					foreach ($daneCiudades as $ciudad) {
						echo '<option value="'.$ciudad['id'].'">'.$ciudad['ciudad'].'</option>';
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 80px">Fecha de verificacion:</td><!--agregar campo llamado verificacion_fecha-->
				<td>
					<select id="f_ver_a" name="f_ver_a" onchange="$(this).verificarFecha(event, 'ver', '0');" style="font-size: 12px">
						<option value="">Año</option>
<?php
		$an = 1900;
		$anl = date('Y');
		for($i = $an; $i <= $anl;$i++)
			echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select id="f_ver_m" name="f_ver_m" onchange="$(this).verificarFecha(event, 'ver', '0');" style="font-size: 12px">
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
					<select id="f_ver_d" name="f_ver_d" title="Fecha de expedici&oacute;n: dia" style="font-size: 12px">
						<option value="">Dia</option>
					</select>
					Hora:
					<select id="h_ver_h" name="h_ver_h" style="font-size: 12px"><!--agregar campo llamado verificacion_hora-->
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
					<select id="h_ver_m" name="h_ver_m" style="font-size: 12px">
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
					<select id="h_ver_z" name="h_ver_z" style="font-size: 12px">
						<option value="">Horario</option>
						<option value="AM">A.M.</option>
						<option value="PM">P.M.</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Nombre y cargo de verificador:</td>
				<td>
					<input type="text" id="verificacion_nombre" name="verificacion_nombre" style="width: 230px; margin-right: 5px" onkeypress="return validar_letra(event)"><!--agregar campo llamado verificacion_nombre-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Observaciones:</td>
				<td>
					<textarea cols="40" rows="4" id="verificacion_observacion" name="verificacion_observacion" onkeypress="return validar_letra(event)"></textarea><!--agregar campo llamado verificacion_observacion-->
				</td>
			</tr>
			<tr>
				<td style="width: 100px;display: table-cell;">Firma:</td>
				<td>
					<select id="verificacion_firma" name="verificacion_firma" style="font-size: 12px"><!--agregar campo llamado verificacion_firma-->
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
	$('select[name="clasecliente"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '10'){
			$('input[name="cual_clasecliente"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="cual_clasecliente"]').val('');
			$('input[name="cual_clasecliente"]').attr('disabled', 'disabled');
		}
	});
	$('select[name="tipoempresaemp"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '5'){
			$('input[name="tipoempresaemp_cual"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="tipoempresaemp_cual"]').val('');
			$('input[name="tipoempresaemp_cual"]').attr('disabled', 'disabled');
		}
	});
	$('select[name="reconocimiento_publico"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name="reconocimiento_cual"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="reconocimiento_cual"]').val('');
			$('input[name="reconocimiento_cual"]').attr('disabled', 'disabled');
		}
	});
	$('select[name="expuesta_politica"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name="cargo_politica"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="cargo_politica"]').val('');
			$('input[name="cargo_politica"]').attr('disabled', 'disabled');
		}
	});
	$('select[name="expuesta_publica"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name="publica_nombre"]').removeAttr('disabled');
			$('input[name="publica_cargo"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="publica_nombre"]').val('');
			$('input[name="publica_nombre"]').attr('disabled', 'disabled');
			$('input[name="publica_cargo"]').val('');
			$('input[name="publica_cargo"]').attr('disabled', 'disabled');
		}
	});
	$('select[name="repre_internacional"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name="internacional_indique"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="internacional_indique"]').val('');
			$('input[name="internacional_indique"]').attr('disabled', 'disabled');
		}
	});
	$('select[name="tributarias_otro_pais"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('input[name="tributarias_paises"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="tributarias_paises"]').val('');
			$('input[name="tributarias_paises"]').attr('disabled', 'disabled');
		}
	});
	$('select[name="tipoempresajur"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '5'){
			$('input[name="tipoempresajur_otra"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="tipoempresajur_otra"]').val('');
			$('input[name="tipoempresajur_otra"]').attr('disabled', 'disabled');
		}
	});
	$('select[name="monedaextranjera"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '-1'){
			$('select[name="tipotransacciones"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('select[name="tipotransacciones"]').val('');
			$('select[name="tipotransacciones"]').attr('disabled', 'disabled');
			$('input[name="tipotransacciones_cual"]').val('');
			$('input[name="tipotransacciones_cual"]').attr('disabled', 'disabled');
		}
	});
	$('select[name="tipotransacciones"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '7'){
			$('input[name="tipotransacciones_cual"]').removeAttr('disabled');
		}else if($(this).val() != ''){
			$('input[name="tipotransacciones_cual"]').val('');
			$('input[name="tipotransacciones_cual"]').attr('disabled', 'disabled');
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
			$('input[name^="producto_tipo"]').attr('disabled', 'disabled');
			$('input[name^="producto_identificacion"]').val('');
			$('input[name^="producto_identificacion"]').attr('disabled', 'disabled');
			$('input[name^="producto_entidad"]').val('');
			$('input[name^="producto_entidad"]').attr('disabled', 'disabled');
			$('input[name^="producto_monto"]').val('');
			$('input[name^="producto_monto"]').attr('disabled', 'disabled');
			$('input[name^="producto_ciudad"]').val('');
			$('input[name^="producto_ciudad"]').attr('disabled', 'disabled');
			$('input[name^="producto_pais"]').val('');
			$('input[name^="producto_pais"]').attr('disabled', 'disabled');
			$('input[name^="producto_moneda"]').val('');
			$('input[name^="producto_moneda"]').attr('disabled', 'disabled');
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
			$('input[name^="rec_ano"]').attr('disabled', 'disabled');
			$('input[name^="rec_ramo"]').val('');
			$('input[name^="rec_ramo"]').attr('disabled', 'disabled');
			$('input[name^="rec_compania"]').val('');
			$('input[name^="rec_compania"]').attr('disabled', 'disabled');
			$('input[name^="rec_valor"]').val('');
			$('input[name^="rec_valor"]').attr('disabled', 'disabled');
			$('input[name^="rec_resultado"]').val('');
			$('input[name^="rec_resultado"]').attr('disabled', 'disabled');
		}
	});
	$('select[name^="otrosingresos"]').change(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if($(this).val() == '13'){
			$('input[name^="concepto"]').val('SD');
		}else{
			$('input[name^="concepto"]').val('');
		}
	})
});

$.fn.verificarFecha = function(e, call, tipo){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	var f_a = $('select#f_'+call+'_a').val();
	var f_m = $('select#f_'+call+'_m').val();
	if((f_a != '' && f_a != 'ND') && (f_m != '' && f_m != 'ND')){
		var d = new Date(f_a, f_m, 0).getDate();
		var d_str = '';
		str_d = '<option value="">Dia</option>';
		for(var i=1;i<=d;i++){
			d_str = '0'+i;
			if(i > 9)
				d_str = i;
			str_d += '<option value="'+i+'">'+d_str+'</option>';
		}
		$('select#f_'+call+'_d').html(str_d);
	}else if(f_a == 'ND' || f_m == 'ND'){
		//$('select#f_'+call+'_a option[value="ND"]').prop('selected', true);
		$('select#f_'+call+'_m option[value="ND"]').prop('selected', true);
		$('select#f_'+call+'_d').html('<option value="">Dia</option><option value="ND">ND</option>');
		$('select#f_'+call+'_d option[value="ND"]').prop('selected', true);
	}
}
$.fn.verificarFechaDoble = function(e, call, tipo){
	(e.preventDefault) ? e.preventDefault() : e.returnValue = false;
	if(tipo == '1'){
		var f_a = $('select#f_'+call+'_a').val();
		var f_m = $('select#f_'+call+'_m').val();
		var f_d = $(this).val();
		if(f_a != '' && f_m != '' && f_d != ''){
			if(call == 'nac'){
				var fNac = f_a + '-' + f_m + '-' + f_d;
				var fExp = $('select#f_exp_a').val() + '-' + $('select#f_exp_m').val() + '-' + $('select#f_exp_d').val();
				var dif = diff_years(new Date(fExp), new Date(fNac));
				if(dif < 18){
					alert('La diferencia entre fecha de nacimiento y fecha de expedicion debe ser mayor a 18 años');
					$('select#f_'+call+'_a').val('').change();
					$('select#f_'+call+'_m').val('').change();
					$(this).val('').change();
					$('select#f_'+call+'_a').focus();
					return false;
				}
			}
			$('select#f_'+call+'_a').hide();
			$('select#f_'+call+'_m').hide();
			$(this).hide();
		}
	}else if(tipo == '2'){
		var f_1 = $('select#f_'+call+'_a').val()+'-'+$('select#f_'+call+'_m').val()+'-'+$('select#f_'+call+'_d').val();
		var f_2 = $('select#f_'+call+'2_a').val()+'-'+$('select#f_'+call+'2_m').val()+'-'+$('select#f_'+call+'2_d').val();
		if(f_1 != f_2){
			alert("Las fechas no coinciden, por favor validelas.");
			$('select#f_'+call+'_a').show();
			$('select#f_'+call+'_a').val('');
			$('select#f_'+call+'_a').change();
			$('select#f_'+call+'_m').show();
			$('select#f_'+call+'_m').val('');
			$('select#f_'+call+'_m').change();
			$('select#f_'+call+'_d').show();
			$('select#f_'+call+'_d').val('');
			$('select#f_'+call+'_d').change();

			$('select#f_'+call+'2_a').val('');
			$('select#f_'+call+'2_a').change();
			$('select#f_'+call+'2_m').val('');
			$('select#f_'+call+'2_m').change();
			$('select#f_'+call+'2_d').val('');
			$('select#f_'+call+'2_d').change();

			$('select#f_'+call+'_a').focus();
		}
	}
}
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