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
        Reporte gráfico
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <h3 class="text-center">Gráficos del <b>día</b></h3>
            <div class="col-lg-6 col-xs-6">
                <!-- DONUT CHART -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                    <h3 class="box-title"> Préstamos por tipo de Usuario</h3>

                    </div>
                    <div class="box-body">
                        <div id="prestamosTipoUsuario" style="height: 300px;"></div>
                    </div>  <!-- /.box-body -->
                </div> <!-- /.box -->
            </div>

            <div class="col-lg-6 col-xs-6">
                <!-- DONUT CHART -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                    <h3 class="box-title"> Préstamo por estado</h3>

                    </div>
                    <div class="box-body">
                        <div id="prestamosEstado" style="height: 300px;"></div>
                    </div>  <!-- /.box-body -->
                </div> <!-- /.box -->
            </div>

            <h3 class="text-center"> Gráfico de préstamos en la Base de Datos </h3>
            <div class="col-lg-12 col-xs-12">
                <!-- DONUT CHART -->
                <div class="box box-success">
                    <div class="box-header with-border">
                    <h3 class="box-title"> Préstamos por tipo de usuario</h3>

                    </div>
                    <div class="box-body">
                        <div id="prestamoTotalTipoUsuario" style="height: 300px;"></div>
                    </div>  <!-- /.box-body -->
                </div> <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php 
  include ('includes/templates/footer.php');
 ?>