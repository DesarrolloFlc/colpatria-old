<?php
session_start();
if( isset($_SESSION['group']) && $_SESSION['group'] == "1" || $_SESSION['group'] == "2"  || $_SESSION['group'] == "9"  || $_SESSION['group'] == "3" || $_SESSION['group'] == "4" || $_SESSION['group'] == "5" || $_SESSION['group'] == "6" || $_SESSION['group'] == "7" || $_SESSION['group'] == "8" ) {
    require_once '../../template/general/header.php';
?>
<noscript> <!-- Show a notification if the user has disabled javascript -->
<div class="notification error png_bg">
    <div>Javascript esta deshabilitado o no es soportado por tu navegador. Por favor <a href="http://browsehappy.com/" title="Upgrade to a better browser">actualiza</a> tu navagador o <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">habilita</a> Javascript para navegar por la interface apropiadamente.</div>
</div>
</noscript>

<!-- Page Head -->
<div style="float: right; position: absolute; top: 10px; right: 30px;"><img src="/Colpatria/resources/images/logoFinlecoBPO.jpg" width="140px" height="115px"/></div>
<p id="page-intro">Este es el consultor de imágenes de Finleco BPO para Colpatria Supermercado</p>

<div class="clear"></div> <!-- End .clear -->           
<div class="clear"></div> <!-- End .clear -->
<br><br><br><br>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Búsqueda de clientes</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Formularios</a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->

            <div class="notification attention png_bg">
                <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    La efectividad de la búsqueda depende de la calidad de los datos ingresados.
                </div>
            </div>
            <form action="searchClient.php" method="POST" id="form_clientsearch_sup" name="form_clientsearch_sup">
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>Criterio de búsqueda:</label>              
                        <select name="criterio1" id="criterio1" class="small-input">
                            <option value="">-- Seleccione una opción --</option>
                            <option value="1">Documento/NIT de cliente</option>
                            <option value="2">Nombre/Raz&oacute;n social de cliente</option>
                        </select> 
                    </p>                
                    <p>
                        <label>Realizar la búsqueda:</label>              
                        <select name="criterio2" id="criterio2" class="small-input">
                            <option value="">-- Seleccione una opción --</option>
                            <option value="1">Exactamente</option>
                            <option value="2">Conteniendo</option>
                        </select> 
                    </p>
                    <p>
                        <label>Texto a buscar:</label>
                        <input class="text-input medium-input" type="text" id="texto" name="texto" /> <span class="input-notification attention png_bg">Campo obligatorio</span>
                        <br /><small>Escriba la información que desea buscar(p.e: 8023656)</small>
                    </p>
                    <p>
                        <input class="button" type="submit" id="search_client" value="Realizar búsqueda " />
                    </p>
                </fieldset>
                <div class="clear"></div><!-- End .clear -->
            </form>
        </div> <!-- End #tab2 -->    
    </div> <!-- End .content-box-content -->
</div> <!-- End .content-box -->



<div class="content-box" style="display:none;" id="box_search_result">
    <div class="content-box-header">
        <h3>Resultados de la búsqueda</h3>
        <div class="clear"></div>
    </div> 
    <div class="content-box-content">
        <div class="notification error   png_bg" id="result_search" style="display: none">
            <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
            <div id="msg_result_search">					
            </div>
        </div> 
        <div class="tab-content default-tab" id="tab_resultsearch">            
        </div>
    </div>
</div>



<div class="content-box column-left closed-box">
    <div class="content-box-header">
        <h3>¿Dudas o inquietudes?</h3>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab">
            <h4>Permite que las conozcamos ...</h4>
            <p>Si tienes alguna duda o inconveniente con el sistema no dudes 
                en comunicarte al número de teléfono: 6-063200 ext 911/109, o escribenos a candres@finleco.com</p>            
        </div> <!-- End #tab3 -->        
    </div> <!-- End .content-box-content -->
</div> <!-- End .content-box -->

<div class="content-box column-right closed-box">
    <div class="content-box-header"> <!-- Add the class "closed" to the Content box header to have it closed by default -->
        <h3>¿Qué es Doc Finder?</h3>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab">
            <h4>Doc. Finder</h4>
            <p>Es la herramienta que te permitira realizar la búsqueda de imágenes de clientes 
                de forma sencilla y efectiva.</p>
        </div> <!-- End #tab3 -->        
    </div> <!-- End .content-box-content -->
</div> <!-- End .content-box -->
<div class="clear"></div>

<?php
} else {
echo "<h2>No tiene permisos para acceder a esta �rea</h2>";
}
?>