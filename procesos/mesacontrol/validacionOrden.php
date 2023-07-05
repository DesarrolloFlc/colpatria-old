<html>
    <style>
        body {
            text-align:center;
            font-family: Arial;   
        }

        thead tr th{
            font-size: 14px;
            padding: 10px;
            background-color: #a40e0e;
            color: white;
        }

        tbody tr td{
            padding: 5px;
        }

        p {
            font-size: 12px;
        }


        .button {
            font-family: Verdana, Arial, sans-serif;
            display: inline-block;
            /*background: #459300 url('../images/bg-button-green.gif') top left repeat-x !important;*/
            background: #a40e0e;
            border: 1px solid #459300 !important;
            padding: 4px 7px 4px 7px !important;
            color: #fff !important;
            font-size: 11px !important;
            cursor: pointer;
        }

        .button:hover {
            text-decoration: underline;
        }

        .button:active {
            padding: 5px 7px 3px 7px !important;
        }

        a.remove-link {
            color: #bb0000;
        }

        a.remove-link:hover {
            color: #000;
        }

        .error {
            color: red;
            text-align:left;
        }
    </style>
    <body>
<?php
        if(!isset($_FILES['filename_cargue'])){
?>
            <p>Por favor realice el cargue del archivo en formato csv unicamente con las cedulas que quiere validar para esta orden de producci&oacute;n.</p>
            <form method="POST" action="validacionOrden.php" enctype="multipart/form-data">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2" align="center">CARGUE DE CEDULAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cedulas(.csv)</td>
                            <td><input type="file" name="filename_cargue" /></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" value="Validar orden >>"  class="button"/></td>
                        </tr>
                    </tfoot>
                </table>
                <input type="hidden" name="orden" id="orden" value="<?php echo $_GET['orden'] ?>" />
                <input type="hidden" name="cantidad_datos" id="cantidad_datos" value="<?php echo $_GET['cantidad_datos'] ?>" />
            </form>
<?php
        }else{
            require_once dirname(dirname(dirname(__FILE__))) . "/includes.php";
            require_once PATH_SITE . DS . 'config/globalParameters.php';
            require_once PATH_CCLASS . DS . 'ordenproduccion.class.php';

            $orden = $_POST['orden'];
            $ordenes = new Ordenproduccion();
            $orden = mysqli_fetch_array($ordenes->getOrden($orden));

            $temp = file($_FILES['filename_cargue']['tmp_name']);
            $n = count($temp);


            if($n != $_POST['cantidad_datos']){
                echo "<h2>El n&uacute;mero de datos no coincide.</h2>";
                exit;
            }
            echo "<h2>Resumen de la validaci�n.</h2>";
            echo "<hr />";

            $rules_clients = 0;
            $rules_dev = 0;
            $rules_no = 0;

            for($k = 0; $k < $n; $k++){
                $info = explode(";", $temp[$k]);
                $complemento_tipo = "";
                if(!empty($info[0])){
                    if(trim($info[1]) == "d"){
                        /** VALIDAR SI EL CLIENTE SE ENCUENTRA CON DEVOLUCION **/
                        $dev_clientes = mysqli_fetch_row(mysqli_query($GLOBALS['link'], "SELECT COUNT(*) FROM workflow WHERE documento = '".trim($info[0])."' AND lote = '{$orden['lote']}'"));
                        if($dev_clientes[0] == 0){
                            echo "<p class='error'>El cliente ".trim($info[0])." no tiene devoluciones para este lote.</p>";
                            $rules_dev++;
                        }
                    }elseif(trim($info[1]) == "n"){
                        /** VALIDAR SI EL CLIENTE SE ENCUENTRA CON DEVOLUCION **/
                        $dev_clientes = mysqli_fetch_row(mysqli_query($GLOBALS['link'], "SELECT COUNT(*) FROM radicados_items WHERE documento = '".trim($info[0])."' AND id_radicados = '{$orden['lote']}' AND estado = 1"));
                        if($dev_clientes[0] == 0){
                            echo "<p class='error'>El cliente ".trim($info[0])." no tiene marcaciones de no llego para este lote.</p>";
                            $rules_no++;
                        }
                    }else{
                        /** VALIDAR SI EXISTE EL CLIENTE * */
                        //print_r($info);
                        $complemento_tipo = " AND flag NOT LIKE 'MIGRACION%' AND estado = '0'";
                        if(isset($info[2]) && trim($info[2]) != "" && ($info[2] == 1 || $info[2] == 2)){
                            //echo "string";
                            $complemento_tipo = " AND persontype = '".trim($info[2])."' AND status_form = 'Activo' AND flag NOT LIKE 'MIGRACION%' AND estado = '0'";
                        }elseif(isset($info[2]) && trim($info[2]) != "" && $info[2] == 3){
                            $complemento_tipo = " AND estado = '0'";
                            //echo "string1111";
                        }
                        //echo "SELECT id FROM client WHERE document = '".trim($info[0])."'$complemento_tipo";
                        $id_cliente = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT id FROM client WHERE document = '".trim($info[0])."'$complemento_tipo"));
                        //echo "SELECT id FROM client WHERE document = '".trim($info[0])."' ".$complemento_tipo." AND flag NOT LIKE 'MIGRACION%'";	
                        if($id_cliente['id'] > 0){
                            /** VALIDAR SI EL CLIENTE TIENE FORMULARIOS EN EL LOTE DE LA ORDEN * */
                            $num_forms = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT COUNT(*) AS total FROM form WHERE id_client = '{$id_cliente['id']}' AND log_lote = '{$orden['lote']}'  AND status = '1'"));
                            if($num_forms['total'] == 0){
                                $id_reg = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT COUNT(*) AS total FROM data_renovacion_autos WHERE lote = '{$orden['lote']}' AND documento = '".trim($info[0])."'"));
                                if($id_reg['total'] == 0){
                                    //echo "SELECT COUNT(*)  AS total FROM form WHERE id_client = '{$id_cliente['id']}' AND log_lote = '{$orden['lote']}'  AND status = '1'";
                                    echo "<p class='error'>El cliente " . trim($info[0]) . " no tiene formularios para este lote.</p> SELECT id FROM client WHERE document = '".trim($info[0])."'$complemento_tipo";
                                    $rules_clients++;
                                }
                            }
                        }else{
                            $id_reg = mysqli_fetch_array(mysqli_query($GLOBALS['link'], "SELECT COUNT(*) AS total FROM data_renovacion_autos WHERE lote = '{$orden['lote']}' AND documento = '".trim($info[0])."'"));
                            if($id_reg['total'] == 0){
                                echo "<p class='error'>El cliente " . trim($info[0]) . " no existe.</p>";
                                $rules_clients++;
                            }
                        }
                    }
                }
            }
            if($rules_clients == 0 AND $rules_dev == 0 AND $rules_no == 0){
?>
                <form action="../../lib/general/procesos.php" name="aprobar_orden" id="aprobar_orden" method="POST">
                    <input type="submit" value="Aprobar Orden >>" class="button" />
                    <input type="hidden" name="action" id="action" value="aprobar_orden" />
                    <input type="hidden" name="id_orden" id="id_orden" value="<?php echo $_POST['orden'] ?>" />
                </form>
<?php
            }
            echo "<hr />";
            echo "<p><b>Clientes no creados: $rules_clients</b></p>";
            echo "<p><b>Clientes existente con devoluci&oacute;n/formulario no creado: $rules_dev</b></p>";
            echo "<p><b>Clientes marcados como no llegaron, no creado: $rules_no</b></p>";
        }
?>
    </body>
</html>