<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Actualización de datos</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab3" class="default-tab">Cliente</a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab3"> <!-- This is the target div. id must match the href of this div's tab -->
            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                <p>
                    <label>Cédula:</label>
                    <input class="text-input small-input" type="text"value="<?=$data_client['document']?>" data-oldValue="<?=$data_client['document']?>" onpaste="return false;" onkeypress="return false;"/> 
                    <input type="hidden"  id="documento" name="documento" value="<?=$data_client['document']?>">
                </p>
                <p>
                    <label>Primer apellido:</label>
                    <input class="text-input small-input" type="text" id="primerapellido" name="primerapellido"  value="<?=$data_client['primerapellido']?>" data-oldValue="<?=$data_client['primerapellido']?>" onkeypress="onlyChars();"/> 
                </p>
                <p>
                    <label>Segundo apellido:</label>
                    <input class="text-input small-input" type="text" id="segundoapellido" name="segundoapellido"  value="<?=$data_client['segundoapellido']?>" data-oldValue="<?=$data_client['segundoapellido']?>" onkeypress="onlyChars();"/> 
                </p>
                <p>
                    <label>Nombres:</label>
                    <input class="text-input small-input" type="text" id="nombres" name="nombres"  value="<?=$data_client['nombres']?>" data-oldValue="<?=$data_client['nombres']?>" onkeypress="onlyChars();"/> 
                </p>
                <p>
                    <?php
                    $fecha_exp = explode("-", $data_client['fechaexpedicion']);
                    ?>
                    <label>Fecha de expedición:</label>
                    <select name="fechaexpedicion_a" id="fechaexpedicion_a" data-oldValue="<?=$fecha_exp[0]?>">
                        <option value="">---</option>
                        <?php
                        for ($i = 1950; $i <= date('Y'); $i++) {
                            $complemento = '';
                            if (isset($fecha_exp[0]) && $i == $fecha_exp[0])
                                $complemento = "selected='selected'";
                            echo "<option value='$i' $complemento>$i</option>";
                        }
                        ?>   
                    </select>
                    <select name="fechaexpedicion_m" id="fechaexpedicion_m" data-oldValue="<?=$fecha_exp[1] ?? ''?>">
                        <option value="">---</option>
                        <?php
                        for ($i = 01; $i <= 12; $i++) {
                            $complemento = '';
                            if (strlen($i) == 1) {
                                $num = "0" . $i;
                            } else {
                                $num = $i;
                            }
                            if (isset($fecha_exp[1]) && $num == $fecha_exp[1]) {
                                $complemento = " selected='selected'";
                            }
                            echo "<option value='$num' $complemento>$num</option>";
                        }
                        ?>             
                    </select>
                    <select name="fechaexpedicion_d" id="fechaexpedicion_d" data-oldValue="<?=$fecha_exp[2] ?? ''?>">
                        <option value="">---</option>
                        <?php
                        for ($i = 01; $i <= 31; $i++) {
                            $complemento = "";
                            if (strlen($i) == 1)
                                $num = "0" . $i;
                            else
                                $num = $i;
                            if (isset($fecha_exp[2]) && $num == $fecha_exp[2])
                                $complemento = "selected='selected'";
                            echo "<option value='$num' $complemento>$num</option>";
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label>Lugar de expedición:</label>
                    <select name="lugarexpedicion" id="lugarexpedicion" data-oldValue="<?=$data_client['lugarexpedicion']?>">
                        <option value="">-Opciones-</option>
                        <?php
                        if($data_client['formulario'] != '15'){
                            while ($result = mysqli_fetch_array($lugar_expedicion)) {
                                $complemento = "";
                                if ($result['id'] == $data_client['lugarexpedicion']) {
                                    $complemento = " selected='selected'";
                                }
                                echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                            }
                        }else{
                            foreach ($lugar_expedicion2 as $ciudaddane) {
                                $complemento = "";
                                if ($ciudaddane['id'] == $data_client['lugarexpedicion']) {
                                    $complemento = " selected='selected'";
                                }
                                echo "<option value='{$ciudaddane['id']}' $complemento>{$ciudaddane['ciudad']}</option>";
                            }
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label>Cantidad de hijos:</label>        
                    <select name="numerohijos" id="numerohijos" data-oldValue="<?=$data_client['numerohijos']?>">
                        <option value="">-Opciones-</option>
                        <?php
                        for ($i = 0; $i < 16; $i++) {
                            $complemento = "";
                            if ($i == $data_client['numerohijos'])
                                $complemento = " selected='selected'";
                            ?>                            
                            <option value="<?=$i?>" <?=$complemento?>><?=$i?></option>
                            <?php
                        }
                        ?>     
                    </select>
                </p>        
                <p>
                    <label>Estado civil:</label>        
                    <select name="estadocivil" id="estadocivil" data-oldValue="<?=$data_client['estadocivil']?>">
                        <option value="">-Opciones-</option>
                        <?php
                        while ($result = mysqli_fetch_array($estados_civiles)) {
                            $complemento = "";
                            if ($result['id'] == $data_client['estadocivil'])
                                $complemento = " selected='selected'";
                            echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                        }
                        ?>      
                    </select>
                </p>      
                <p>
                    <label>Nivel de estudios:</label>        
                    <select name="nivelestudios" id="nivelestudios" data-oldValue="<?=$data_client['nivelestudios']?>">
                        <option value="">-Opciones-</option>
                        <?php
                        while ($result = mysqli_fetch_array($estudios)) {
                            $complemento = '';
                            if ($result['id'] == $data_client['nivelestudios'])
                                $complemento = " selected='selected'";
                            echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                        }
                        ?>    
                    </select>
                </p>   
                <p>
                    <label>Profesión:</label>        
                    <select name="profesion" id="profesion" data-oldValue="<?=$data_client['profesion']?>">
                        <option value="">-Opciones-</option>
                        <?php
                        while ($result = mysqli_fetch_array($profesiones)) {
                            $complemento = "";
                            if ($result['id'] == $data_client['profesion'])
                                $complemento = " selected='selected'";
                            echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                        }
                        ?>
                    </select>
                </p>                       
                <p>
                    <label>Dirección de residencia:</label>
                    <input class="text-input small-input" type="direccionresidencia" id="texto" name="direccionresidencia"  value="<?=$data_client['direccionresidencia']?>" data-oldValue="<?=$data_client['direccionresidencia']?>" /> 
                </p>

                <p>
                    <label>Ciudad de residencia:</label>        
                    <select name="ciudadresidencia" id="ciudadresidencia"  data-oldValue="<?=$data_client['ciudadresidencia']?>">
                        <option value="">-Opciones-</option>
                        <?php
                        if($data_client['formulario'] != '15'){
                            while ($result = mysqli_fetch_array($ciudades)) {

                                $complemento = "";
                                if ($result['id'] == $data_client['ciudadresidencia'])
                                    $complemento = " selected='selected'";
                                echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                            }
                        }else{
                            foreach ($lugar_expedicion2 as $ciudaddane) {
                                $complemento = "";
                                if ($ciudaddane['id'] == $data_client['ciudadresidencia']) {
                                    $complemento = " selected='selected'";
                                }
                                echo "<option value='{$ciudaddane['id']}' $complemento>{$ciudaddane['ciudad']}</option>";
                            }
                        }
                        ?>
                    </select>
                </p>   


                <p>
                    <label>Teléfono fijo:</label>
                    <input class="text-input small-input" type="text" id="telefonoresidencia" name="telefonoresidencia" value="<?=$data_client['telefonoresidencia']?>" data-oldValue="<?=$data_client['telefonoresidencia']?>" maxlength="7" onkeypress="return validar_num(event)"/> 
                </p>                
                <p>
                    <label>Teléfono celular:</label>
                    <input class="text-input small-input" type="text" id="celular" name="celular" value="<?=$data_client['celular']?>" data-oldValue="<?=$data_client['celular']?>" maxlength="10" onkeypress="return validar_num(event)"/> 
                </p>

                <p>
                    <label>Correo electrónico:</label>
                    <input class="text-input small-input" type="text" id="correoelectronico" name="correoelectronico" value="<?=$data_client['correoelectronico']?>" data-oldValue="<?=$data_client['correoelectronico']?>"/> 
                </p>

                <p>
                    <label>Ingresos mensuales: </label>        
                    <select name="ingresosmensuales" id="ingresosmensuales" data-oldValue="<?=$data_client['ingresosmensuales']?>">
                        <option value="">-Opciones-</option>
                        <?php
                        while ($result = mysqli_fetch_array($ingresos_mensuales)) {

                            $complemento = "";
                            if ($result['id'] == $data_client['ingresosmensuales'])
                                $complemento = " selected='selected'";
                            echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                        }
                        ?>
                    </select>
                </p>   
                <p>
                    <label>Egresos mensuales:</label>        
                    <select name="egresosmensuales" id="egresosmensuales" data-oldValue="<?=$result['id']?>">
                        <option value="">-Opciones-</option>
                        <?php
                        while ($result = mysqli_fetch_array($egresos_mensuales)) {
                            $complemento = "";
                            if ($result['id'] == $data_client['egresosmensuales'])
                                $complemento = " selected='selected'";
                            echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                        }
                        ?>
                    </select>
                </p>   
                <p>
                    <label>Resultado de la gestión:</label>
                    <select name="contact" id="contact">
                        <option value="">--Seleccione una opción--</option>
                        <?php
                        while ($cont = mysqli_fetch_array($contact)) {
                            ?>
                            <option value="<?=$cont['id']?>"><?=$cont['description']?></option>
                            <?php
                        }
                        ?>        
                    </select>
                </p>
                <p>
                    <label>Observaciones</label>
                    <textarea id="observacion" name="observacion"></textarea>
                </p>
                <p>
                    <label>Grabaci&oacute;n:</label>
                    <input type="file" name="grabacion" id="grabacion" />
                </p>
                <p>
                    <input type="hidden" name="id_form" id="id_form" value="<?=$data_form['id'] ?>" />
                    <input type="hidden" name="id_client" id="id_client" value="<?=$id_client ?>"/>
                    <input type="hidden" name="persontype" id="persontype" value="1"/>
                </p>

            </fieldset>

            <div class="clear"></div><!-- End .clear -->

        </div> <!-- End #tab2 -->    
    </div> <!-- End .content-box-content -->
</div> <!-- End .content-box -->