<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header.php';
require_once PATH_CCLASS . DS . 'form.class.php';
require_once PATH_CCLASS . DS . 'general.class.php';
require_once PATH_CCLASS . DS . 'image.class.php';
require_once PATH_CCLASS . DS . 'contactcapi.class.php';
require_once PATH_CCLASS . DS . 'contact.class.php';

extract($_GET);
if (empty($id_client) || empty($persontype)) {
    if (empty($id_client)) {
        echo "<h1>No ha seleccionado ningún cliente</h1>";
        exit();
    }
    if (empty($persontype)) {
        $data_agente = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT persontype FROM client WHERE id = '$id_client'"));
        $persontype = $data_agente['persontype'];
    }
    //exit;
}
$data_agente = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT persontype FROM client WHERE id = '$id_client'"));
$persontype = $data_agente['persontype'];

$general = new General();
$estados_civiles = $general->getEstadosCiviles();
$estudios = $general->getEstudios();
$profesiones = $general->getProfesiones();
$ciudades = $general->getCiudades();
$ingresos_mensuales = $general->getIngresosMensuales();
$lugar_expedicion = $general->getCiudades();
$lugar_expedicion2 = General::getCiudadesDanes();
$ciudades = $general->getCiudades();
$contact = $general->getContacts();
$ciudades_ofippal = $general->getCiudades();
$actividades = $general->getActividades();
$egresos_mensuales = $general->getEgresosMensuales();
$ingresos_mensuales_emp = $general->getIngresosMensualesEmp();
$egresos_mensuales_emp = $general->getEgresosMensualesEmp();

$form = new Form();
$data_form = mysqli_fetch_array($form->getLastId($id_client));
$data_client = mysqli_fetch_array($form->getFormInfo($data_form['id']));


//Data capi
$datacapi = new Contactcapi();
$lastDateConfirm = $datacapi->getLastConfirm($id_client);
$count_display = 0;

//Data general
$dataconfirm = new Contact();
$lastDateConfirm2 = $dataconfirm->getLastConfirm($id_client);
//Data credito SKRV
$lastDatacredito = $dataconfirm->getLastConfirmDatacredito($id_client);

if ($lastDateConfirm != "" || $lastDateConfirm2 != "" || $lastDatacredito != "") {
    if ((date("Y-m-d", strtotime($lastDateConfirm)) >= (date("Y-m-d", strtotime("-10 month"))))) {
?>
        <script type="text/javascript" language="javascript">
            alert("ATENCION!!!! El cliente no se puede confirmar. ");
        </script>
<?php
        $count_display++;
    }
    if ((date("Y-m-d", strtotime($lastDateConfirm2)) >= (date("Y-m-d", strtotime("-10 month"))))) {
?>
        <script type="text/javascript" language="javascript">
            alert("ATENCION!!!! El cliente no se puede confirmar." );
        </script>
<?php
        $count_display++;
    }
    if ((date("Y-m-d", strtotime($lastDatacredito)) >= (date("Y-m-d", strtotime("-10 month"))))) {
?>
        <script type="text/javascript" language="javascript">
            alert("ATENCION!!!! El cliente no se puede confirmar. [Data Credito]" );
        </script>
<?php
        $count_display++;
    }
}
?>

<!-- Page Head -->
<h2>Confirmación del cliente</h2>
<p id="page-intro">Actualización de datos del cliente</p>

<div class="clear"></div> <!-- End .clear -->
<div style="float: right"><a href="../viewClient.php?id_client=<?php echo $id_client ?>" class="button">Regresar al cliente >></a></div>
<div class="clear"></div> <!-- End .clear -->
<br>

<?php
$image = new Image();
$images = $image->getImagesForm($data_form['id']);
echo "<div id='thumbs'>";
echo "<table>";
echo "<tr>";
while ($thumb = mysqli_fetch_array($images)) {
?>
    <td>
        <!--<object width=150 height=160 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
            <param name="src" value="../../../<?php echo $thumb['directory']; ?>/<?php echo $thumb['filename']; ?>">
        </object>-->
        <!--<object width=150 height=150 data="../../../<?php echo $thumb['directory']; ?>/<?php echo $thumb['filename']; ?>" type="image/tiff">
            <param name="negative" value="yes">
        </object>-->
        <object width=150 height=160 classid="CLSID:106E49CF-797A-11D2-81A2-00E02C015623">
            <param name="src" value="../../../<?php echo $thumb['directory']; ?>/<?php echo $thumb['filename']; ?>">                
            <embed width=150 height=160 src="../../../<?php echo $thumb['directory']; ?>/<?php echo $thumb['filename']; ?>" type="image/tiff">
        </object>



    </td>
<?php
}
echo "</tr>";
echo "</table></div>";
?>
<br><br>
<form  action="saveContact.php" id="confirmClient" name="confirmClient"  method="POST" enctype="multipart/form-data">
<?php
    if ($persontype == "1") { //Si la persona es natural
        require_once 'fieldsNaturalPerson.php';
    } else if ($persontype == "2") {
        require_once 'fieldsJuridicPerson.php';
    }
?>
    <input type="hidden" name="persontype"  id="persontype" value="<?=$persontype ?>">
<?php
    if ($count_display > 0) {

    } else {
?>
        <input class="button" type="submit" name="btnguardaractu" id="btnguardaractu" value="Guardar actualización>>">
        <input type="hidden" name="confirmdata" id="confirmdata" value="">
        <input type="hidden" name="alertingresos" id="alertingresos" value="">
        <input type="hidden" name="datos_actualizar" id="datos_actualizar" value="">
<?php
        if($persontype == "1"){
?>
            <input type="hidden" name="tipo_actividad" id="tipo_actividad" value="<?=$data_client["tipoactividad"]?>">
<?php
        }else{
?>
            <input type="hidden" name="tipo_actividad" id="tipo_actividad" value="<?=$data_client["actividadeconomicappal"]?>">
<?php
        }
    }
    ?>
</form>
<script>
$(document).ready(function() {
    $('form#confirmClient [data-oldValue]').each(function(index, value) {
        console.log($(this).val(), $(value).attr('data-oldValue'));
    });
    $('form#confirmClient').submit(function(event) {
        (event.preventDefault) ? event.preventDefault() : event.returnValue = false;
        datos = '';
        $(this).find("[data-oldvalue]").each(function(index, el) {
            if($(el).val() != $(el).attr('data-oldvalue')){
                if(datos === '')
                    datos = $(el).attr('name');
                else
                    datos += '|' + $(el).attr('name');
            }
        });
        if(datos !== '')
            $(this).find('input[name="datos_actualizar"]').val(datos);

        
        var forma = document.confirmClient;
        forma.submit();        
    });
});
</script>
<?php
require_once PATH_SITE . DS . 'template/general/footer.php';
