
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>TEC</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIAR</b>TEC</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"> X </span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tienes X notificaciones <small> <b> Funcionalidad en próxima actualización. </b> </small>.</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-laptop text-aqua"></i> Tiene X equipos por devolver
                    </a>
                  </li>
                </ul>
              </li>
              <!--<li class="footer"><a href="#">View all</a></li>-->
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                
                require_once('includes/funciones/funciones.php');

                if(!isset($_SESSION)) { 
                  session_start();
                  $usuario = $_SESSION['usuario'];
                } else {
                  $usuario = $_SESSION['usuario'];
                }

                $imagenUsuario = extraeImagenUsuario($usuario) -> fetch_assoc();

              ?> 
              <img src="img/administradores/<?php echo $imagenUsuario['urlImagen']; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs">
                 <?php 
                    if(!isset($_SESSION)) { 
                        session_start();
                        echo $_SESSION['nombreApellido'];
                    } else {
                        echo $_SESSION['nombreApellido'];
                    }
                 ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="img/administradores/<?php echo $imagenUsuario['urlImagen']; ?>" class="img-circle" alt="User Image">
                <p>
                  <?php 
                    if(!isset($_SESSION)) { 
                        session_start();
                        echo $_SESSION['nombreApellido'];
                    } else {
                        echo $_SESSION['nombreApellido'];
                    }
                 ?>
                  <small> Usuario desde <?php echo $_SESSION['fechaCreacion'];?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="editar-administrador.php?id=<?php echo encriptaDato( $_SESSION['id']);?>" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="../index.php?cerrar_sesion=true" class="btn btn-default btn-flat">Cerrar sesión</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->
