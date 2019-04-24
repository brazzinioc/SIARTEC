<?php
include ('../includes/funciones/sesiones.php');

include ('includes/funciones/funciones.php');

include ('includes/templates/header.php');

include ('includes/templates/barra.php');

include ('includes/templates/navegacion.php');

$id = desencriptaDato($_GET['id']);

?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Edición de Préstamo
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"> <b> Datos del préstamo </b> </h3>
          <?php 
            $prestamo = extraePrestamo( $id ) -> fetch_assoc();
          ?>
        </div>
            <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="includes/modelos/modelo-prestamo.php"> 
                <div class="box-body">

                    <fieldset>
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <label for="fecha">Fecha:</label>
                            <div class="input-group date">
                            
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker" name="fecha"  value="<?php echo $prestamo['fecha']; ?>"  required="true">
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <label for="hora">Hora:</label>
                            <div class="input-group">
                                <input type="text" maxlength="8" class="form-control timepicker" name="hora"  value="<?php echo $prestamo['hora']; ?>" required="true">

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
                                        if( $tipoUsuario['id'] === $prestamo['idTipoUsuario']){
                                ?>  
                                            <option selected value="<?php echo $tipoUsuario['id']; ?>"> <?php echo $tipoUsuario['tipo']; ?></option>;  
                                <?php
                                        } else {
                                ?>
                                            <option value="<?php echo $tipoUsuario['id']; ?>"> <?php echo $tipoUsuario['tipo']; ?></option>;  
                                <?php
                                        }
                                    endforeach;
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <label for="dni">DNI:</label>
                            <input type="text" maxlength="8"  class="form-control" id="dni"  value="<?php echo $prestamo['dniUsuario']; ?>" disabled required="true">
                        </div>  
                    </fieldset>
                    
                    <fieldset>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label for="grado"> Grado:</label>
                            <select class="form-control select2" id="grado" name="grado" style="width: 100%;" required="true">
                                <option value=" "> - Seleccione - </option>
                                <?php 
                                    $grados = extraeGrados();
                                    foreach($grados as $grado):
                                        if( $grado['idGrado'] === $prestamo['idGrado']){
                                ?>
                                        <option selected value="<?php echo $grado['idGrado']; ?>"> <?php echo $grado['grado']; ?> </option>
                                <?php
                                        } else {
                                ?>
                                        <option value="<?php echo $grado['idGrado']; ?>"> <?php echo $grado['grado']; ?> </option>
                                <?php 
                                        }
                                    endforeach;

                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label for="seccion"> Sección:</label>
                            <select class="form-control select2" id="seccion" name="seccion" style="width: 100%;" required="true">
                                <option value=""> - Seleccione -</option>
                                <?php
                                    $secciones = extraeSecciones();
                                    foreach( $secciones as $seccion):
                                        if( $seccion['idSeccion'] === $prestamo['idSeccion']){
                                ?>
                                        <option selected value="<?php echo $seccion['idSeccion']; ?>"> <?php echo $seccion['seccion']; ?> </option>

                                <?php 
                                        } else {
                                ?>
                                        <option value="<?php echo $seccion['idSeccion']; ?>"> <?php echo $seccion['seccion']; ?> </option>
                                <?php
                                        }
                                    endforeach;
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label for="listaEquipos"> Lista de Equipos: </label>
                            <textarea class="form-control" rows="6" name="listaEquipos" required="true"> <?php echo $prestamo['listaEquipos']; ?>  </textarea>
                        </div>

                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label for="observacion"> Observación: </label>
                            <textarea class="form-control" rows="6" name="observacion"  required="true">  <?php echo $prestamo['observacion']; ?>   </textarea>
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
                            <input type="hidden" name="accion" value="actualizar">
                            <input type="hidden" name="id" value="<?php echo $prestamo['id']; ?>">
                            <input type="hidden" name="dni" value="<?php echo $prestamo['dniUsuario']?>">
                            <button type="submit" class="btn btn-primary" id="crear_registro_prestamo"> Actualizar </button>
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