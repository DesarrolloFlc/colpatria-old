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
                    <label>Razón social:</label>
                    <input class="text-input small-input" type="text" id="razonsocial" name="razonsocial"  value="<?php echo $data_client['razonsocial']; ?>" data-oldValue="<?php echo $data_client['razonsocial']; ?>" /> 
                </p>
                <p>
                    <label>NIT:</label>
                    <input type="text" name="nit" id="nit" class="text-input small-input" value="<?php echo $data_client['document']; ?>" data-oldValue="<?php echo $data_client['document']; ?>"/>
                    Cod. Verf.
                    <input type="text" name="digitochequeo" id="digitochequeo" size="4" class="text-input small-input" value="<?php echo $data_client['digitochequeo']; ?>" data-oldValue="<?php echo $data_client['digitochequeo']; ?>"/>
                </p>

                <p>
                    <label>Ciudad oficina ppal.</label>        
                    <select name="ciudadoficina" id="ciudadoficina" data-oldValue="<?php echo $data_client['ciudadoficina']; ?>">
                        <option value="">-Opciones-</option>
                        <?php
                        while ($result = mysqli_fetch_array($ciudades_ofippal)) {
                            $complemento = "";
                            if ($result['id'] == $data_client['ciudadoficina'])
                                $complemento = "selected='selected'";
                            echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                        }
                        ?>      
                    </select>
                </p> 

                <p>
                    <label>Dirección oficina ppal.</label>
                    <input class="text-input small-input" type="text" id="direccionoficinappal" name="direccionoficinappal" value="<?php echo $data_client['direccionoficinappal']; ?>" data-oldValue="<?php echo $data_client['direccionoficinappal']; ?>" /> 
                </p>

                <p>
                    <label>Teléfono oficina.</label>
                    <input class="text-input small-input" type="text" id="telefonoficina" name="telefonoficina" value="<?php echo $data_client['telefonoficina']; ?>" data-oldValue="<?php echo $data_client['telefonoficina']; ?>" /> 
                </p>

                <p>
                    <label>Actividad económica ppal.</label>        
                    <select name="actividadeconomicappal" id="actividadeconomicappal" data-oldValue="<?php echo $data_client['actividadeconomicappal']; ?>">
                        <option value="">-Opciones-</option>
                        <?php
                        while ($result = mysqli_fetch_array($actividades)) {
                            $complemento = "";
                            if ($result['id'] == $data_client['actividadeconomicappal'])
                                $complemento = "selected='selected'";
                            echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                        }
                        ?>      
                    </select>
                </p> 

                <p>
                    <label>Activos empresa.</label>
                    <input class="text-input small-input" type="text" id="activosemp" name="activosemp" value="<?php echo $data_client['activosemp']; ?>" data-oldValue="<?php echo $data_client['activosemp']; ?>" /> 
                </p>

                <p>
                    <label>Pasivos empresa.</label>
                    <input class="text-input small-input" type="text" id="pasivosemp" name="pasivosemp" value="<?php echo $data_client['pasivosemp']; ?>" data-oldValue="<?php echo $data_client['pasivosemp']; ?>" /> 
                </p>


                <p>
                    <label>Ingresos mensuales empresa.</label>        
                    <select name="ingresosmensualesemp" id="ingresosmensualesemp" data-oldValue="<?php echo $data_client['ingresosmensualesemp']; ?>" >
                        <option value="">-Opciones-</option>
                        <?php
                        while ($result = mysqli_fetch_array($ingresos_mensuales_emp)) {
                            $complemento = "";
                            if ($result['id'] == $data_client['ingresosmensualesemp'])
                                $complemento = "selected='selected'";
                            echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                        }
                        ?>      
                    </select>
                </p> 


                <p>
                    <label>Egresos mensuales empresa.</label>        
                    <select name="egresosmensualesemp" id="egresosmensualesemp" data-oldValue="<?php echo $data_client['egresosmensualesemp']; ?>" >
                        <option value="">-Opciones-</option>
                        <?php
                        while ($result = mysqli_fetch_array($egresos_mensuales_emp)) {
                            $complemento = "";
                            if ($result['id'] == $data_client['egresosmensualesemp'])
                                $complemento = "selected='selected'";
                            echo "<option value='{$result['id']}' $complemento>{$result['description']}</option>";
                        }
                        ?>      
                    </select>
                </p> 


                <p>
                    <label>E-mail.</label>
                    <input class="text-input small-input" type="text" id="correoelectronico" name="correoelectronico"  value="<?php echo $data_client['correoelectronico']; ?>" data-oldValue="<?php echo $data_client['correoelectronico']; ?>" /> 
                </p>
                <p>
                    <label>Resultado de la gestión:</label>
                    <select name="contact" id="contact">
                        <option value="">--Seleccione una opción--</option>
                        <?php
                        while ($cont = mysqli_fetch_array($contact)) {
                            ?>
                            <option value="<?php echo $cont['id']; ?>"><?php echo $cont['description']; ?></option>
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
                    <input type="hidden" name="id_form" id="id_form" value="<?php echo $data_form['id'] ?>" />
                    <input type="hidden" name="id_client" id="id_client" value="<?php echo $id_client ?>"/>
                    <input type="hidden" name="persontype" id="persontype" value="2" />
                </p>
            </fieldset>
            <div class="clear"></div><!-- End .clear -->
        </div> <!-- End #tab2 -->    
    </div> <!-- End .content-box-content -->
</div> <!-- End .content-box -->