<?php
session_start();

if ($_SESSION['group'] == "1" || $_SESSION['group'] == "5" || $_SESSION['group'] == "6") {


    require_once '../../template/general/header.php';
    require_once '../../lib/class/case.class.php';

    $scase = new Cases();
    $mycases = $scase->getCases($_SESSION['id']);
    ?>

    <!-- Page Head -->
    <h2>Lista de casos</h2>
    <p id="page-intro">Casos abiertos por gestores Finleco BPO</p>

    <div class="clear"></div> <!-- End .clear -->

    <ul class="shortcut-buttons-set"> <!-- Replace the icons URL's with your own -->

        <li><a class="shortcut-button" href="writeCase.php"><span>
                    <img src="../../resources/images/icons/pencil.png" alt="icon" /><br />
                    Escribir caso
                </span></a></li>
    </ul>

    <div class="clear"></div> <!-- End .clear -->

    <div class="content-box"  id="box_search_result">

        <div class="content-box-header">

            <h3>B&uacute;squeda de casos en el workflow</h3>

            <ul class="content-box-tabs">
                <li><a href="#tab2" class="default-tab">Buscador</a></li> <!-- href must be unique and match the id of target div -->            
            </ul>

            <div class="clear"></div>

        </div> <!-- End .content-box-header -->

        <div class="content-box-content">                 
            <div class="tab-content default-tab" id="tab2">
                <form action="cases.php" method="POST" id="form_casesearch" name="form_casesearch">
                    <p>
                        <label>Criterio de búsqueda:</label>              
                        <select name="criterio1" id="criterio1" class="small-input">
                            <option value="">-- Seleccione una opción --</option>
                            <option value="1">C&eacute;dula</option>
                            <option value="2">Lote</option>
                        </select> 
                    </p>
                    <p>
                        <label>Texto a buscar:</label>
                        <input class="text-input medium-input" type="text" id="texto" name="texto" /> <span class="input-notification attention png_bg">Campo obligatorio</span>
                        <br /><small>Escriba la información que desea buscar(p.e: 101)</small>
                    </p>
                    <p>
                        <input class="button" type="submit" id="search_case" name= "search_case" value="Realizar búsqueda " />
                    </p>
                </form>
            </div>
        </div>
    </div>


    <?php if (isset($_POST['search_case']) && $_POST['search_case'] != '') : ?>
        <?php
        $resultcase = $scase->getCasesSearch($_POST['criterio1'], $_POST['texto']);
        ?>
        <div class="content-box" id="box_search_result">
            <div class="content-box-header">
                <h3>Resultados de la búsqueda</h3>
                <div class="clear"></div>
            </div> 
            <div class="content-box-content">
                <table>
                    <thead>
                        <tr>
                            <th>Editar</th>
                            <th>Lote</th>
                            <th>Documento</th>
                            <th>Usuario</th>
                            <th>Causal</th>
                            <th>Responsable</th>
                            <th>Fecha creaci&oacute;n</th>  
                            <?php if ($_SESSION['group'] == "6"): ?>
                                <th>Retroalimentar</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($rcase = mysqli_fetch_array($resultcase)): ?>	
                            <tr>
                                <td>
                                    <a href="" onClick="window.open('editCase.php?case=<?php echo $rcase['id'] ?>', '', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbar=no,resizable=no,width=420,height=200,top=85,left=140');
                                        return false;">
                                        <img src="../../resources/images/icons/edit.png" alt="Editar">
                                    </a>
                                    &nbsp;
                                    <a href="?action=delete_case&case=<?=$rcase['id']?>" id="delete_workflow">
                                        <img src="../../resources/images/icons/cross_circle.png" alt="Eliminar">
                                    </a>
                                </td>
                                <td><?php echo $rcase['lote'] ?></td>
                                <td><?php echo $rcase['documento'] ?></td>
                                <td><?php echo utf8_encode($rcase['username']) ?></td>
                                <td><?php echo $rcase['causal'] ?></td>
                                <td><?php echo $rcase['officialname'] ?></td>
                                <td><?php echo $rcase['date_created'] ?></td>
            <?php if ($_SESSION['group'] == "6"): ?>
                                    <td>
                                        <a href="" onClick="window.open('retroalimentar.php?case=<?php echo $rcase['id'] ?>', '', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbar=no,resizable=no,width=420,height=260,top=85,left=140');
                                                return false;">Retroalimentar</a>
                                        &nbsp;||&nbsp; <a href="" onClick="window.open('history.php?id_case=<?php echo $rcase['id'] ?>', '', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbar=no,resizable=no,width=320,height=170,top=85,left=140');
                                                return false;"> Historial</a>
                                    </td>					
            <?php endif; ?>
                            </tr>
        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php endif; ?>

    <div class="content-box"  id="box_search_result">

        <div class="content-box-header">

            <h3>Últimos casos recibidos</h3>

            <ul class="content-box-tabs">
                <li><a href="#tab2" class="default-tab">Recibidos</a></li> <!-- href must be unique and match the id of target div -->
                <li><a href="#tab1" id="tab_adduser">Enviados</a></li>
            </ul>

            <div class="clear"></div>

        </div> <!-- End .content-box-header -->

        <div class="content-box-content">        
            <div class="tab-content" id="tab1">
                <table>
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Creador</th>
                            <th>Responsable</th>
                            <th>Fecha envío</th>                            
                        </tr>
                    </thead>
                    <tbody>
    <?php
    while ($mycase = mysqli_fetch_array($mycases)) {
        ?>
                            <tr>
                                <td>Devolución</td>
                                <td><?php echo utf8_encode($mycase['username']); ?></td>
                                <td><?php echo utf8_encode($mycase['officialname']); ?></td>
                                <td><?php echo $mycase['date_created']; ?></td>
                            </tr>
        <?php
    }
    ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-content default-tab" id="tab2">
                <div class="notification information png_bg">
                    <a href="#" class="close"><img src="/Colpatria/resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                    <div>
                        En estos momentos no tiene casos abiertos.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clear"></div>
<script type="text/javascript">
$(document).ready(function() {
	$('a#delete_workflow').click(function(event){
		(event.preventDefault) ? event.preventDefault() : event.returnValue = false;
		if(confirm("Esta seguro que desea eliminar el registro?")){
			var este = this;
			var partes = $(this).attr('href').split('?');
			var datos = partes[(partes.length - 1)];
			$.ajax({
				data: datos,
				type: 'post',
				url: '../../lib/general/procesos.php',
				dataType: 'json',
				success: function(dato, textStatus, jqXHR) {
					//console.log(dato);
					if(dato.exito){
						alert(dato.exito);
						$(este).parent().parent().remove();
					}else
						alert(dato.error);
				},
				error: function(xhr, ajaxOptions, thrownError) {
					console.log(xhr);
					console.log(ajaxOptions);
					console.log(thrownError);
					alert('Ocurrio el siguiente error:\n' + thrownError + '\n' + xhr.responseText);
					/*$("#fileUploadError").removeClass("hide").text("An error occured!");
					$("#files").children().last().remove();
					$("#uploadFile").closest("form").trigger("reset");*/
				}
			});
		}
	});
});
</script>
<?php
    require_once '../../template/general/footer.php';
} else {
    echo "<h1>No tiene autorizaci�n para este m�dulo</h1>";
}
?>