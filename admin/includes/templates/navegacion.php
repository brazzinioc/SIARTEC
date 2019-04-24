  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
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
          <img src="img/administradores/<?php echo $imagenUsuario['urlImagen']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
            <?php
              if(!isset($_SESSION)) { 
                  session_start();
                  echo $_SESSION['nombreApellido'];
              } else {
                  echo $_SESSION['nombreApellido'];
              }
            ?>
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header text-center" style="color:white;font-weight:bold;">Menú de administración</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="dashboard.php"><i class="fa fa-home"></i> Dashboard </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-handshake-o"></i>
            <span>Préstamo</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="lista-prestamo.php"><i class="fa fa-list-ul"></i> Ver todos</a></li>
            <li><a href="crear-prestamo.php"><i class="fa fa-plus-circle"></i> Agregar </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-check"></i>
            <span>Devolución</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="lista-devolucion.php"><i class="fa fa-list-ul"></i> Ver todos</a></li>
            <li><a href="crear-devolucion.php"><i class="fa fa-plus-circle"></i> Agregar </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-graduation-cap"></i>
            <span>Alumno</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="lista-alumno.php"><i class="fa fa-list-ul"></i> Ver todos</a></li>
            <li><a href="crear-alumno.php"><i class="fa fa-plus-circle"></i> Agregar </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-circle"></i>
            <span>Docente</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="lista-docente.php"><i class="fa fa-list-ul"></i> Ver todos</a></li>
            <li><a href="crear-docente.php"><i class="fa fa-plus-circle"></i> Agregar </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-o"></i>
            <span>Administrativo</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="lista-administrativo.php"><i class="fa fa-list-ul"></i> Ver todos</a></li>
            <li><a href="crear-administrativo.php"><i class="fa fa-plus-circle"></i> Agregar </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span> Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="reporte-grafico.php"><i class="fa fa-pie-chart"></i> Gráficos </a></li>
            <li><a href="reporte-excel.php"><i class="fa fa-download"></i> Descargar en Excel </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-plus"></i>
            <span>Administradores</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="lista-administrador.php"><i class="fa fa-list-ul"></i> Ver todos</a></li>
            <li><a href="crear-administrador.php"><i class="fa fa-plus-circle"></i> Agregar </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Mantenimiento</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" id="mantenimiento-bd"><i class="fa fa-database"></i> Base de Datos </a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->