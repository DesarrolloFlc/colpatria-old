<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header.php';
require_once PATH_CCLASS . DS . 'form.class.php';
require_once PATH_CCLASS . DS . 'general.class.php';
require_once PATH_CCLASS . DS . 'image.class.php';

extract($_GET);

if (empty($id_client) || empty($persontype)) {
    echo "<h1>No ha seleccionado ningún cliente</h1>";
    exit;
}

$general = new General();
$estados_civiles = $general->getEstadosCiviles();
$estudios = $general->getEstudios();
$profesiones = $general->getProfesiones();
$ciudades = $general->getCiudades();
$ingresos_mensuales = $general->getIngresosMensuales();
$lugar_expedicion = $general->getCiudades();
$ciudades = $general->getCiudades();
$contact = $general->getContacts();
$ciudades_ofippal = $general->getCiudades();
$actividades = $general->getActividades();
$egresos_mensuales= $general->getEgresosMensuales();
$ingresos_mensuales_emp = $general->getIngresosMensualesEmp();
$egresos_mensuales_emp = $general->getEgresosMensualesEmp();

$form = new Form();
$data_form = mysqli_fetch_array($form->getLastId($id_client));
$data_client = mysqli_fetch_array($form->getFormInfo($data_form['id']));
?>

<!-- Page Head -->
<h2>Confirmación del cliente</h2>
<p id="page-intro">Actualización de datos del cliente</p>

<div class="clear"></div> <!-- End .clear -->
<div style="float: right"><a href="../viewClient.php?id_client=<?php echo $id_client ?>" class="button">Regresar al cliente >></a></div>
<div class="clear"></div> <!-- End .clear -->
<br />

 <?php
          	$image = new Image();
        $images = $image->getImagesForm($data_form['id']);
        echo "<div id='thumbs'>";
        echo "<table>";
	 echo "<tr>";
        while ($thumb = mysqli_fetch_array($images)) {
          
            ?>
        <td>
            <object width=150 height=160
                    classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
                <param name="src" value="../../../<?php echo $thumb['directory']; ?>/<?php echo $thumb['filename']; ?>">
            </object>
        </td>
        <?php

    }
        echo "</tr>";
	 echo "</table>";
    ?>
<br /><br />
<form  action="saveContact.php" id="confirmClient" name="confirmClient"  method="POST" enctype="multipart/form-data">
    <?php
    if ($persontype == "1") //Si la persona es natural
        require_once 'fieldsNaturalPerson.php';
    else if($persontype == "2") 
        require_once 'fieldsJuridicPerson.php';
    ?>
	<input type="hidden" name="persontype"  id="persontype" value="<?php echo $persontype?>" />
    <input class="button" type="submit" value="Guardar actualización>>" />
</form>
<?php
require_once PATH_SITE . DS . 'template/general/footer.php';
