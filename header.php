<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Colpatria/config/globalParameters.php';
?>
<!DOCTYPE html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Doc. Finder | Finleco BPO - Colpatria</title>

    <!--                       CSS                       -->

    <!-- Reset Stylesheet -->
    <link rel="stylesheet" href="/Colpatria/resources/css/reset.css" type="text/css" media="screen" />

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="/Colpatria/resources/css/style.css" type="text/css" media="screen" />

    <!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
    <link rel="stylesheet" href="/Colpatria/resources/css/invalid.css" type="text/css" media="screen" />	

    <!-- Colour Schemes

		Default colour scheme is green. Uncomment prefered stylesheet to use it.
    
		<link rel="stylesheet" href="resources/css/blue.css" type="text/css" media="screen" />
		-->		
    <link rel="stylesheet" href="/Colpatria/resources/css/red.css" type="text/css" media="screen" />    



    <!-- Internet Explorer Fixes Stylesheet -->

    <!--[if lte IE 7]>
			<link rel="stylesheet" href="resources/css/ie.css" type="text/css" media="screen" />
		<![endif]-->

    <!--                       Javascripts                       -->

    <!-- jQuery -->
    <script type="text/javascript" src="/Colpatria/resources/scripts/jquery-1.3.2.min.js"></script>

    <!-- jQuery Configuration -->
    <script type="text/javascript" src="/Colpatria/resources/scripts/simpla.jquery.configuration.js"></script>

    <!-- Facebox jQuery Plugin -->
    <script type="text/javascript" src="/Colpatria/resources/scripts/facebox.js"></script>

    <!-- jQuery WYSIWYG Plugin -->
    <script type="text/javascript" src="/Colpatria/resources/scripts/jquery.wysiwyg.js"></script>

    <!-- Internet Explorer .png-fix -->

    <!--[if IE 6]>
                    <script type="text/javascript" src="resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
                    <script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->

    <!--Libreria adicional de herramientas con jQuery -->
    <script type="text/javascript" src="/Colpatria/lib/js/tools.js"></script>
</head>

<body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->

        <div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->

                <h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>

                <!-- Logo (221px wide) -->
                <a href="#"><img id="logo" src="/Colpatria/resources/images/logo.png" alt="Finleco BPO Group Ltda."  width="220px" height="70px" /></a>

                <!-- Sidebar Profile links -->
                <div id="profile-links">
				Hola, <a href="#" title="Edit your profile"><?php echo utf8_encode($_SESSION['name']);?></a>, tienes <a href="#messages" rel="modal" title="3 Messages">0 Mensajes</a><br />
                    <br />
                    <a href="#" title="View the Site">Acerca de Doc. Finder</a> | <a href="/Colpatria/lib/general/logout.php" title="Sign Out">Salir</a>
                </div>        

                <ul id="main-nav">  <!-- Accordion Menu -->
                    <?php if( $_SESSION['group'] == "1" OR $_SESSION['group'] == "2"
                                OR $_SESSION['group'] == "3" OR $_SESSION['group'] == "4" 
                            OR $_SESSION['group'] == "5") {?>
                    <li>
                        <a href="/Colpatria/procesos/index.php" class="nav-top-item no-submenu"> <!-- Add the class "no-submenu" to menu items with no sub menu -->
						Consulta general
                        </a>       
                    </li>
                    <?php
                    }
                    ?>
                      <?php if( $_SESSION['group'] == "1" OR $_SESSION['group'] == "5"
                                OR $_SESSION['group'] == "3") {?>
                    <li> 
                        <a href="#" class="nav-top-item"> <!-- Add the class "current" to current menu item -->
					Módulo operativo
                        </a>
                        <ul>                            
                            <li><a href="/Colpatria/procesos/internal/recordImages.php">Digitalizar imágenes</a></li>                                
                            <li><a href="#" onClick="pantallaCompleta('/Colpatria/procesos/internal/fingering.php');return false;" target="_blank">Digitar imágenes</a></li> <!-- Add class "current" to sub menu items also -->
                        </ul>
                    </li>
                    <?php } ?>
                      <?php if( $_SESSION['group'] == "1" ) {?>
                    <li> 
                        <a href="#" class="nav-top-item"> <!-- Add the class "current" to current menu item -->
					Herramientas admon.
                        </a>
                        <ul>
                            <li><a href="/Colpatria/procesos/admin/users.php">Control de usuarios</a></li>
                        </ul>
                    </li> 
                    <?php } ?>
                      <?php if( $_SESSION['group'] == "1" OR $_SESSION['group'] == "5")
                               {?>
                               <li> 
                        <a href="#" class="nav-top-item"> <!-- Add the class "current" to current menu item -->
					WorkFlow
                        </a>
                        <ul>
                            <li><a href="/Colpatria/procesos/workflow/cases.php">Casos</a></li>
                        </ul>
                    </li>   
                    <?php } ?>
                      <?php if( $_SESSION['group'] == "1" OR $_SESSION['group'] == "5"
                              ) {?>
                    <li> 
                        <a href="#" class="nav-top-item"> <!-- Add the class "current" to current menu item -->
					Reportes e informes
                        </a>
                        <ul>
                            <li><a href="#">Reporte general</a></li>
                        </ul>
                    </li>    
                    <?php } ?>
                      <?php if( $_SESSION['group'] == "1" OR $_SESSION['group'] == "2"
                                OR $_SESSION['group'] == "3" OR $_SESSION['group'] == "4" 
                            OR $_SESSION['group'] == "5") {?>
                    <li> 
                        <a href="#" class="nav-top-item current"> <!-- Add the class "current" to current menu item -->
					Mis opciones
                        </a>
                        <ul>
                            <li><a href="#change_password" rel="modal" title="3 Messages">Cambiar contraseña</a></li>
                          <li><a href="/Colpatria/lib/general/logout.php">Salir</a></li> <!-- Add class "current" to sub menu items also -->
                        </ul>
                    </li>
                    <?php } ?>
                </ul> <!-- End #main-nav -->

                <div id="change_password" style="display: none"> <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->

                    <h3>CAMBIAR CONTRASEÑA PERSONAL</h3>
                    <p>
                        El cambio de su contraseña periodicamente ayuda a mantener su cuenta 
                        más segura, evitando así que otras personas accedan sin su concentimiento.
                    </p>

                    <form action="../../lib/general/procesos.php" method="POST" name="password_form" id="password_form">
                        <h4>Realizar el cambio ...</h4>
                        <br />
                        <fieldset>
                            <b>Contraseña actual:</b><br/>
                            <input class="text-input medium-input" type="password" id="medium-input" name="medium-input" />
                        </fieldset>
                        <br />
                        <fieldset>
                            <b>Nuevo contraseña:</b><br/>
                            <input class="text-input medium-input" type="password" id="medium-input" name="medium-input" />
                        </fieldset>
                        <br />
                        <fieldset>
                            <b>Re-escribir nueva contraseña:</b></br>
                            <input class="text-input medium-input" type="password" id="medium-input" name="medium-input" />
                        </fieldset>                            
                        <br /><br />
                        <fieldset>
                            <center><input class="button" type="submit" id="cambiar_pass" value="Cambiar contraseña >>" /></center>
                        </fieldset>
                    </form>

                </div> <!-- End #messages -->
            </div></div> <!-- End #sidebar -->
        <div id="main-content"> <!-- Main Content Section with everything -->