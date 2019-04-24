<?php
include ('../includes/funciones/sesiones.php');

include ('includes/funciones/funciones.php');

include ('includes/templates/header.php');

include ('includes/templates/barra.php');

include ('includes/templates/navegacion.php');
?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Registro de Préstamos
        <small>Llene el formulario para poder registrar un préstamo</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"> <b> Datos del préstamo </b> </h3>
        </div>
            <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="includes/modelos/modelo-prestamo.php"> 
                <div class="box-body">

                    <fieldset id="busqueda-datos">
                        <legend> <small> Búsqueda de Información  </small> </legend>
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <label for="fecha">Fecha:</label>
                            <div class="input-group date">
                            
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text"    class="form-control pull-right datepicker" id="fecha" name="fecha" required="true">
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <label for="hora">Hora:</label>
                            <div class="input-group">
                                <input type="text" maxlength="8" class="form-control timepicker" id="hora" name="hora" required="true">

                                <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <label for="tipoUsuario">Tipo de Usuario:</label>
                            <select class="form-control select2" id="tipoUsuario" name="tipoUsuario" style="width: 100%;" required="true">
                                <option value=""> - Seleccione -</option>
                                <?php 
                                    $tipoUsuarios = extraeTipoUsuario();
                                    foreach( $tipoUsuarios as $tipoUsuario ):
                                ?>  
                                        <option value="<?php echo $tipoUsuario['id']; ?>"> <?php echo $tipoUsuario['tipo']; ?></option>;  
                                <?php
                                    endforeach;
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <label for="dni">DNI:</label>
                            <input type="text" maxlength="8"  class="form-control" id="dni" name="dni" required="true">
                        </div>
                        
                        <div class="box-footer col-md-12 col-sm-12 col-xs-12">
                            <button type="button" class="btn btn-warning" id="buscar_dni"> Buscar DNI </button>
                        </div>
                    </fieldset>
                        
                    <hr>
                    
                    <fieldset id="ingreso-datos">
                        <legend> <small> Ingrese Datos </small> </legend>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label for="grado"> Grado:</label>
                            <select class="form-control select2" id="grado" name="grado" style="width: 100%;" required="true">
                                <option value=" "> - Seleccione - </option>
                                <?php 
                                    $grados = extraeGrados();
                                    foreach($grados as $grado){
                                ?>
                                        <option value="<?php echo $grado['idGrado']; ?>"> <?php echo $grado['grado']; ?> </option>
                                <?php
                                    }

                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label for="seccion"> Sección:</label>
                            <select class="form-control select2" id="seccion" name="seccion" style="width: 100%;" required="true">
                                <option value=""> - Seleccione -</option>
                                <?php
                                    $secciones = extraeSecciones();
                                    foreach( $secciones as $seccion){
                                ?>
                                        <option value="<?php echo $seccion['idSeccion']; ?>"> <?php echo $seccion['seccion']; ?> </option>

                                <?php 
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label for="listaEquipos"> Lista de Equipos: </label>
                            <textarea class="form-control" rows="6" name="listaEquipos" placeholder="Ingrese la lista de equipos separados por una coma." required="true"></textarea>
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label for="observacion"> Observación: </label>
                            <textarea class="form-control" rows="6" name="observacion" placeholder="Ingrese una observación." required="true"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select class="form-control select2" id="estado" name="estado" style="width: 100%;">
                                <option> - Seleccione -</option>
                                <option selected value="1">Activo</option>
                                <option value="0">Desactivado</option>
                            </select>
                        </div>

                        <div class="box-footer">
                            <input type="hidden" name="accion" value="crear">
                            <button type="submit" class="btn btn-primary" id="crear_registro_prestamo">Añadir</button>
                        </div>
                  </fieldset>
                </div>
            </form>   
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php 
  include ('includes/templates/footer.php');
 ?>