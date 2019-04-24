<?php
include ('../includes/funciones/sesiones.php');

include ('../includes/funciones/funciones.php');

include ('includes/templates/header.php');

include ('includes/templates/barra.php');

include ('includes/templates/navegacion.php');

if(isset ($_GET['respuesta'])){
  $respuesta = filter_var($_GET['respuesta'], FILTER_SANITIZE_STRING);
}

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Descarga de Reportes en Excel
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <div class="box-body">
            <?php

                if( $respuesta === "correcto"){
                    echo "<p> Reporte descargado correctamente. <p>";
                } else if( $respuesta === "error"){
                    echo "<p> No se encuentra registros en el rango de fechas ingresadas. <p>";
                } else {
                    echo "<p> {$respuesta} <p>";
                }

                sleep(5);

                header("Location: reporte-excel.php");
            ?> 
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php 
  include ('includes/templates/footer.php');
 ?>