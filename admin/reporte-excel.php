<?php
include ('../includes/funciones/sesiones.php');

include ('../includes/funciones/funciones.php');

include ('includes/templates/header.php');

include ('includes/templates/barra.php');

include ('includes/templates/navegacion.php');


if(isset($_GET['respuesta'])){
  
  $respuesta = $_GET['respuesta'];
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
            <form role="form" id="form-reporte"> 
                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                    <label for="fecha">Fecha Inicio:</label>
                    <div class="input-group date">
                            
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right datepicker" id="fechaInicio" name="fechaInicio" required="true">
                    </div>
                </div>
                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                    <label for="fecha">Fecha Fin:</label>
                    <div class="input-group date">
                            
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right datepicker" id="fechaFin" name="fechaFin" required="true">
                    </div>
                </div>
                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                    <label for="fecha">Filtro:</label>
                    <select class="form-control select2" id="filtro" name="filtro" style="width: 100%;">
                        <option value=""> - Seleccione -</option>
                        <?php 
                            $tipoUsuarios = extraeTipoUsuario();
                            foreach( $tipoUsuarios as $tipoUsuario ):
                        ?>  
                                <option value="<?php echo $tipoUsuario['id']; ?>"> <?php echo "Prestamos devueltos de " . $tipoUsuario['tipo'] . "s"; ?></option>;  
                        <?php
                            endforeach;
                        ?>
                        <option value="4"> Prestamos por devolver </option>
                    </select>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="descargar_reporte"> Descargar </button>
                    <?php 
                        if( $respuesta === "error"){
                          echo "<p class='mensaje-reporte text-danger'> <br><br> No existe registros en el rango de fechas ingresadas.</p>";
                        } 
                    ?>
                </div>

            </form>
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