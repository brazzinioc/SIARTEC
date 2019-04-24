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
        Registro de Administrativos
        <small>Llene el formulario para poder registrar un administrativo</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Datos del administrativo</h3>
        </div>
            <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="includes/modelos/modelo-administrativo.php"> 
                  <div class="box-body">
                    <div class="form-group">
                      <label for="dni">DNI:</label>
                      <input type="text" maxlength="8"  class="form-control" id="dni" name="dni" placeholder="Ingresa DNI del administrativo" required="true">
                    </div>

                    <div class="form-group">
                      <label for="nombres">Nombres:</label>
                      <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingresa nombres del administrativo" required="true">
                    </div>

                    <div class="form-group">
                      <label for="apellidos">Apellidos:</label>
                      <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingresa apellidos del administrativo" required="true">
                    </div>

                    <div class="form-group">
                      <label for="tipoUsuario">Tipo de Usuario:</label>
                      <select class="form-control select2" id="tipoUsuario" name="tipoUsuario" style="width: 100%;">
                        <option> - Seleccione -</option>
                        <?php 
                          $tipoUsuarios = extraeTipoUsuario();
                          foreach( $tipoUsuarios as $tipoUsuario ):
                            if($tipoUsuario['tipo'] === "Administrativo"){
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

                    <div class="form-group">
                      <label for="cargo">Cargo:</label>
                      <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Ingresa la cargo del administrativo" required="true">
                    </div>

                    <div class="form-group">
                      <label for="profesion">Profesión:</label>
                      <input type="text" class="form-control" id="profesion" name="profesion" placeholder="Ingresa la profesion del administrativo" required="true">
                    </div>

                    <div class="form-group">
                      <label for="estado">Estado:</label>
                      <select class="form-control select2" id="estado" name="estado" style="width: 100%;">
                        <option> - Seleccione -</option>
                        <option selected value="1">Activo</option>
                        <option value="0">Desactivado</option>
                      </select>
                    </div>
                  </div>

                  <div class="box-footer">
                    <input type="hidden" name="accion" value="crear">
                    <button type="submit" class="btn btn-primary" id="crear_registro_docente">Añadir</button>
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