<?php
session_start();

if (!isset($_SESSION['group']) || !in_array($_SESSION['group'], [1, 6])) {
    echo "<h1>No tiene autorizaci�n para este m�dulo</h1>";
    exit;
}
require_once dirname(dirname(dirname(__FILE__))) . '/template/general/header.php';
require_once PATH_CCLASS . DS . 'user.class.php';

$user = new User();
$user_groups = $user->getGroups();
$users = $user->getUsers();
?>
<!-- Page Head -->
<h2>Listado de usuarios</h2>
<!--<a href="../includes/_Data_Credito_1.php" class="">borrar esto al terminar</a>-->
<p id="page-intro">Usuarios que hacen parte de Doc. Finder</p>

<div class="clear"></div> <!-- End .clear -->

<div class="notification information png_bg">
    <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
    <div>
        La creación, edición o desactivación de un usuario unicamente la puedes ejecutar con perfil de administrador.
    </div>
</div>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box closed-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Búsqueda de usuarios</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab3" class="default-tab">Usuarios</a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab3"> <!-- This is the target div. id must match the href of this div's tab -->
            <form action="searchUser.php" method="POST" id="search_user" name="search_user">
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>Criterio de búsqueda:</label>              
                        <select name="criterio" id="criterio" class="small-input">
                            <option value="">-- Seleccione una opción --</option>
                            <option value="1">Usuario</option>
                            <option value="2">Nombre</option>
                            <option value="3">Documento de identificación</option>
                        </select> 
                    </p>        
                    <p>
                        <label>Texto a buscar:</label>
                        <input class="text-input medium-input" type="text" id="texto" name="texto" /> <span class="input-notification attention png_bg">Campo obligatorio</span>                        
                    </p>
                    <p>
                        <input class="button" type="submit" value="Realizar búsqueda >>" />
                    </p>
                </fieldset>
                <div class="clear"></div><!-- End .clear -->
            </form>
        </div> <!-- End #tab2 -->    
    </div> <!-- End .content-box-content -->
</div> <!-- End .content-box -->


<div class="clear"></div>

<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">

        <h3>Usuarios actuales</h3>

        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Lista</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" id="tab_adduser">Crear</a></li>
        </ul>

        <div class="clear"></div>

    </div> <!-- End .content-box-header -->

    <div class="content-box-content">        
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
            <div class="notification error   png_bg" id="result_search" style="display: none">
                <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div id="msg_result_search">					
                </div>
            </div>            
            <table>
                <thead>
                    <tr>
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Fecha de creación</th>                        
                        <th>Acciones</th>     
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="6">

                            <div class="pagination">
                                <a href="#" title="First Page">&laquo; Primero</a><a href="#" title="Previous Page">&laquo; Anterior</a>
                                <a href="#" class="number current" title="1">1</a>
                                <a href="#" title="Next Page">Siguiente &raquo;</a><a href="#" title="Last Page">Último &raquo;</a>
                            </div> <!-- End .pagination -->
                            <div class="clear"></div>
                        </td>
                    </tr>
                </tfoot>

                <tbody id="list_users">
                    <?php
                    while ($user_enabled = mysqli_fetch_array($users)) {
                        ?>
                        <tr>
                            <td><?php echo $user_enabled['identificacion']; ?></td>
                            <td><?php echo utf8_encode($user_enabled['name']); ?></td>
                            <td><?php echo $user_enabled['username']; ?></td>
                            <td><?php echo $user_enabled['date_created']; ?></td>
                            <td>
                                <!-- Icons -->
                                <a href="editUser.php?id_user=<?php echo $user_enabled['id'] ?>" title="Edit"><img src="../../resources/images/icons/pencil.png" alt="Edit" /></a>
                                <a href="../../lib/general/procesos.php?id_user=<?php echo $user_enabled['id'] ?>&actionadmin=desactivaruser" title="Desactivar" class="desactivaruser"><img src="../../resources/images/icons/cross.png" alt="Delete" /></a> 

                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div><!-- FIN TAB1 -->
        <div class="tab-content" id="tab2"> <!-- This is the target div. id must match the href of this div's tab -->
            <div class="notification attention png_bg"> 
                <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    No olvide diligenciar todos los campos.
                </div>
            </div>
            <div class="notification success  png_bg" id="result_notif" style="display:none;"> 
                <a href="#" class="close"><img src="../../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div id="msg_adduser">

                </div>
            </div>
            <form method="POST" id="form_useradd" name="form_useradd" onsubmit="$(this).crearUsuario(event);">
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>Perfil del usuario:</label>              
                        <select name="id_group" class="small-input">
                            <option value="">-- Seleccione una opción --</option>
                            <?php
                            while ($grupo = mysqli_fetch_array($user_groups)) {
                                echo "<option value='{$grupo['id']}'>{$grupo['name']}</option>";
                            }
                            ?>
                        </select> 
                    </p>
                    <p>
                        <label>Usuario:</label>
                        <input class="text-input small-input" type="text" name="username"  />
                    </p>
                    <p>
                        <label>Contrase&ntilde;a:</label>
                        <input class="text-input small-input" type="password" name="password" />
                    </p>
                    <p>
                        <label>Nombre:</label>
                        <input class="text-input medium-input" type="text" name="name" />
                    </p>
                    <p>
                        <label>N&uacute;mero de identificaci&oacute;n:</label>
                        <input class="text-input small-input" type="text" name="identificacion" />
                    </p>
                    <p>
                        <label>Sucursal:</label>
                        <input class="text-input small-input" type="text" name="sucursal" />
                    </p>
                    <p>
                        <label>Correo electr&oacute;nico:</label>
                        <input class="text-input small-input" type="text" name="correoelectronico" />
                    </p>
                    <p>
                        <label>Cargo:</label>
                        <input class="text-input small-input" type="text" name="cargo" />
                    </p>
                    <p>
                        <label>Seleccione si es un oficial Colpatria</label>
                        <input type="checkbox" id="oficial" name="oficial" onChange="$.fn.comprobarOficial(event, $(this));" value="oficial" />
                    </p>
                    <div id="divpadreoficial" style="display:none;"><!-- style="display:none;"-->
                        <p>
                            <label>Nombre de Jefe:</label>
                            <input class="text-input small-input" type="text" name="nombrejefe" />
                        </p>
                        <p>
                            <label>Correo de Jefe:</label>
                            <input class="text-input small-input" type="text" name="correojefe" />
                        </p>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <input class="button" type="submit" id="crear-usuario" value="Crear usuario >>" />
                        <div style="width: 16px; height: 16px; padding-left: 5px;">
                            <img id="imgloading-crear-usuario" src="<?=SITE_ROOT?>/images/icons/loading.gif" style="display: none;" />
                        </div>
                    </div>
                </fieldset>
                <div class="clear"></div><!-- End .clear -->
                <input type="hidden" name="domain" value="user">
                <input type="hidden" name="action" value="agregarUsuario">
                <input type="hidden" name="meth" value="js">
            </form>
        </div> <!-- End #tab2 -->    
    </div>
</div>

<div class="clear"></div>
<?php
require_once PATH_SITE . DS . 'template/general/footer.php';
