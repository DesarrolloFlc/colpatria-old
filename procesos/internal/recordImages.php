<?php
session_start();
require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header.php';
require_once PATH_CCLASS . DS . 'file.class.php';
$file = new File();
$images = $file->getImages();
$num_images = $file->countImagesTmp();
?>
<input type="hidden" name="num_images" id="num_images" value="<?=$num_images['total']?>"/>
<!-- Page Head -->
<h2>Imágenes para indexar al sistema</h2>
<p id="page-intro">Imágenes que han sido escaneadas y guardadas en el servidor.</p>

<div class="clear"></div> <!-- End .clear -->

<div class="notification information png_bg">
    <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
    <div>En el momento hay <?=$num_images['total']?> im&aacute;genes en cola para indexar.</div>
</div>

<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Im&aacute;genes disponibles para indexar</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Lista</a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>

    </div> <!-- End .content-box-header -->
    <div class="content-box-content">    
        <div class="tab-content default-tab" id="tab1">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nombre imagen</th>
                        <th>Cantidad im&aacute;genes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_images =0;
                    $counter = 1;
                    foreach ($images as $image) {
                        if ($image != "." && $image != "..") {
                            $num_images_subfolder =  $file->getImagesFolder($image);
                            echo "<tr><td>$counter</td><td>" . $image . "</td><td>$num_images_subfolder</td></tr>";                            
                            $counter++;
                            $total_images+=$counter;
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><h3>CANTIDAD DE IM&Aacute;GENES TOTAL PARA INDEXACI&Oacute;N:</h3></td>
                        <td colspan="3"><h3><?=$total_images?></h3></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input class="button" id="enviar" type="submit" value="Indexar im&aacute;genes >>" />
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="notification success png_bg" id="result_indexacion" style="display:none">
    <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
    <div id="msg_indexacion">	
    </div>
</div>
<div class="clear"></div>
<?php
require_once PATH_SITE . DS . 'template/general/footer.php';
