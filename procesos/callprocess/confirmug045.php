<?php
session_start();
require_once '../../template/general/header.php';
require_once '../../lib/class/form.class.php';
require_once '../../lib/class/general.class.php';
require_once '../../lib/class/image.class.php';
//require_once '../../lib/class/contactcapi.class.php';
//require_once '../../lib/class/contact.class.php';
extract($_GET);

$general = new General();
$tipo_documento = $general->getTipoDocumento();
$ciudades = $general->getCiudades();
$ocupaciones = $general->getOcupaciones();
if (empty($id_client) || empty($persontype)) {
    if (empty($id_client)) {
        echo "<h1>No ha seleccionado ningún cliente</h1>";
        exit();
    }
    if (empty($persontype)) {
        $data_agente = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT persontype FROM client WHERE id = '$id_client'"));
        $persontype = $data_agente['persontype'];
    }
}

$form = new Form();
$data_form = mysqli_fetch_array($form->getDataFormsEspecial($id_client));
?>
<!-- Page Head -->
<h2>Confirmación del cliente</h2>
<p id="page-intro">Actualización de datos UG045.</p>

<div class="clear"></div> <!-- End .clear -->
<div style="float: right"><a href="../viewClient.php?id_client=<?php echo $id_client ?>" class="button">Regresar al cliente >></a></div>
<div class="clear"></div> <!-- End .clear -->
<br />



<br>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Actualización de datos</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab3" class="default-tab">Formato UG045</a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab3"> <!-- This is the target div. id must match the href of this div's tab -->
            <div class="notification success  png_bg" id="result_notif" style="display:none;"> 
                <a href="#" class="close">
                    <img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
                </a>
                <div id="msg_adduser"></div>
            </div>
            <form  action="" id="frmactualizaug" name="frmactualizaug"  method="POST" enctype="multipart/form-data">
                <fieldset>
                    <p>
                        <label >Nombre/Razón Social</label>
                        <input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 30%;" onpaste="return false;" id="razonsocial" name="razonsocial" value="<?php echo $data_form["razon_social"]; ?>">
                    </p>
                    <p>

                        <?php
                        while ($result = mysqli_fetch_array($tipo_documento)) {
                            if ($result['id'] == $data_form["tipo_doc"]) {
                                ?>
                                <?php echo $result['description']; ?><input type="radio" name="grupodoc" id="grupodoc" value="<?php echo $result['id']; ?>" checked> 
                                <?php
                            } else {
                                ?>
                                <?php echo $result['description']; ?><input type="radio" name="grupodoc" id="grupodoc" value="<?php echo $result['id']; ?>"> 
                                <?php
                            }
                        }
                        ?>

                    </p>
                    <p>
                        <label>Número</label>
                        <input type="text" class="obligatorio" style="margin-left: 1px; margin-right: 1px; width: 30%;" onkeypress="return validar_num(event)" onkeypress="return validar_num(event)" onpaste="return false;" id="numero" name="numero" value="<?php echo $data_form["documento"]; ?>">
                    </p>
                    <p>
                        <label>Ocupación/ Actividad Económica</label>


                        <select id="ocupacti" name="ocupacti" class="obligatorio"  style="width: 30%;">
                            <option value="">-Opciones-</option>
                            <?php
                            while ($result = mysqli_fetch_array($ocupaciones)) {
                                if ($result['id'] == $data_form["ocupacion"]) {
                                    echo "<option value='{$result['id']}' selected>{$result['description']}</option>";
                                } else {
                                    echo "<option value='{$result['id']}'>{$result['description']}</option>";
                                }
                            }
                            ?>
                        </select>

                    </p>
                    <p>
                        <label>Ciudad</label>

                        <select id="ciudad" name="ciudad" style="width: 30%;">
                            <option value="">--Seleccione ciudad--</option>
                            <?php
                            while ($result = mysqli_fetch_array($ciudades)) {
                                if ($result['id'] == $data_form["ciudad"]) {
                                    echo "<option value='{$result['id']}' selected>{$result['description']}</option>";
                                } else {
                                    echo "<option value='{$result['id']}'>{$result['description']}</option>";
                                }
                            }
                            ?>
                        </select>

                    </p>
                    <p>
                        <label>Dirección</label>
                        <input type="text" class="obligatorio"  style="margin-left: 1px; margin-right: 1px; width: 30%;" onpaste="return false;" id="direccion" name="direccion" value="<?php echo $data_form["direccion"]; ?>">
                    </p>
                    <p>
                        <label>Teléfono</label>
                        <input type="text" class="obligatorio" onkeypress="return validar_num(event)" onpaste="return false;" id="telefono" name="telefono" size="10" maxlength="10" value="<?php echo $data_form["telefono"]; ?>">
                    </p>
                    <p>
                        <label>E-mail</label>
                        <input type="text" class="obligatorio" onpaste="return false;" id="email" name="email" value="<?php echo $data_form["email"]; ?>">
                    </p>
                    <p>
                        <label>Numero de poliza</label>
                        <input type="text" class="obligatorio" onkeypress="return validar_num(event)" onpaste="return false;" id="npoliza" name="npoliza"  value="<?php echo $data_form["numero_poliza"]; ?>" >
                    </p>
                    <p>
                        <label>Fecha de diligenciamiento</label>
                        <select id="age" name="age">
                            <?php
                            list($age, $mes, $dia) = explode("-", $data_form["fecha_diligenciamiento"]);
                            $anio = date("Y");
                            for ($index = 0; $index < 20; $index++) {
                                if ($anio == $age) {
                                    ?>
                                    <option value="<?php echo $anio; ?>" selected><?php echo $anio; ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="<?php echo $anio; ?>"><?php echo $anio; ?></option>
                                    <?php
                                }

                                $anio--;
                            }
                            ?>
                        </select>
                        <select  id="mes_" name="mes_" >
                            <option value="">--</option>
                            <option value="01" <?php if ($mes == '01') { ?> selected<?php } ?> >Enero</option>
                            <option value="02" <?php if ($mes == '02') { ?> selected<?php } ?> >Febrero</option>
                            <option value="03" <?php if ($mes == '03') { ?> selected<?php } ?> >Marzo</option>
                            <option value="04" <?php if ($mes == '04') { ?> selected<?php } ?> >Abril</option>
                            <option value="05" <?php if ($mes == '05') { ?> selected<?php } ?> >Mayo</option>
                            <option value="06" <?php if ($mes == '06') { ?> selected<?php } ?> >Junio</option>
                            <option value="07" <?php if ($mes == '07') { ?> selected<?php } ?> >Julio</option>
                            <option value="08" <?php if ($mes == '08') { ?> selected<?php } ?> >Agosto</option>
                            <option value="09" <?php if ($mes == '09') { ?> selected<?php } ?> >Septiembre</option>
                            <option value="10" <?php if ($mes == '10') { ?> selected<?php } ?> >Octubre</option>
                            <option value="11" <?php if ($mes == '11') { ?> selected<?php } ?> >Noviembre</option>
                            <option value="12" <?php if ($mes == '12') { ?> selected<?php } ?> >Diciembre</option>
                        </select>
                        <select  id="dia" name="dia" >
                            <option value="<?php echo $dia; ?>"><?php echo $dia; ?></option>
                        </select>
                    </p>
                    <p>
                        <input type="submit" value="Guardar" />
                    </p>
                    <input type="hidden" value="updateFormatoUg" name="action" id="action">
                    <input type="hidden" value="<?php echo $data_form["iddata_renovacion_autos"]; ?>" name="idformato" id="idformato">
                </fieldset>
            </form>
        </div> <!-- End #tab2 -->    
    </div> <!-- End .content-box-content -->
</div> <!-- End .content-box -->
