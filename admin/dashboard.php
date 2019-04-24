<?php
include ('../includes/funciones/sesiones.php');

include ('../includes/funciones/funciones.php');

include ('includes/templates/header.php');

include ('includes/templates/barra.php');

include ('includes/templates/navegacion.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box box-info">
          <div class="box-header with-border text-center">
            <h3 class="box-title">Resúmen gráfico de préstamos registrados.</h3>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="grafica-prestamos" style="height: 300px;"></div>
          </div>
        </div>
      </div> <!--.row -->

      <h3>Resúmen de préstamos y devoluciones <strong> del día </strong>.</h3>

      <div class="row">
        <div class=" col-xs-6 col-md-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <?php 
                  $cantidadPrestamoDia = cantidadPrestamosDelDia() -> fetch_assoc();
                  $cantidadPrestamoTotal = cantidadPrestamosTotal() -> fetch_assoc();
                ?>
                <h3> <?php echo $cantidadPrestamoDia['cantidad']; ?> </h3>
                <p> Préstamos registrados</p>
                <small> <b> TOTAL : <?php echo $cantidadPrestamoTotal['cantidad']; ?> </b> </small>
              </div>
              <div class="icon">
                <i class="fa fa-handshake-o"></i>
              </div>
              <a href="lista-prestamo.php" class="small-box-footer"> Más información <i class="fa fa-arrow-circle-right"></i> </a>
            </div>
        </div>

        <div class="col-xs-6 col-md-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <?php
                  $cantidadDevolucionesDia = cantidadDevolucionesDelDia() -> fetch_assoc();
                  $cantidadDevolucionesTotal = cantidadDevolucionesTotal() -> fetch_assoc();
                ?>
                <h3> <?php echo $cantidadDevolucionesDia['cantidad']; ?> </h3>
                <p> Devoluciones registrados</p>
                <small> <b> TOTAL : <?php echo $cantidadDevolucionesTotal['cantidad']; ?> </b> </small>
              </div>
              <div class="icon">
                <i class="fa fa-check"></i>
              </div>
              <a href="lista-devolucion.php" class="small-box-footer"> Más información <i class="fa fa-arrow-circle-right"></i> </a>
            </div>
        </div>
      </div>

      <h3>Resúmen de Tipos de Usuario.</h3>

      <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <?php 
                  $cantidadAlumnosTotal = cantidadAlumnosTotal() -> fetch_assoc();
                ?>
                <h3> <?php echo  $cantidadAlumnosTotal['cantidad']; ?> </h3>
                <p> Alumnos registrados</p>
              </div>
              <div class="icon">
                <i class="fa fa-graduation-cap"></i>
              </div>
              <a href="lista-alumno.php" class="small-box-footer"> Más información <i class="fa fa-arrow-circle-right"></i> </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
              <div class="inner">
                <?php
                  $cantidadDocentesTotal = cantidadDocentesTotal() -> fetch_assoc();
                ?>  
                <h3> <?php echo $cantidadDocentesTotal['cantidad']; ?> </h3>
                <p> Docentes registrados</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-circle"></i>
              </div>
              <a href="lista-docente.php" class="small-box-footer"> Más información <i class="fa fa-arrow-circle-right"></i> </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-purple-active">
              <div class="inner">
                <?php 
                  $cantidadAdministrativosTotal = cantidadAdministrativosTotal() -> fetch_assoc();
                ?>
                <h3> <?php echo $cantidadAdministrativosTotal['cantidad']; ?> </h3>
                <p> Administrativos registrados</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-o"></i>
              </div>
              <a href="lista-administrativo.php" class="small-box-footer"> Más información <i class="fa fa-arrow-circle-right"></i> </a>
            </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php 
  include ('includes/templates/footer.php');
 ?>