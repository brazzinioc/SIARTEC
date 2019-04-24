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
        Edición de Administrador
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Datos del administrador</h3>
        </div>
            <?php 
                $administrador = extraeAdministrador($id) -> fetch_assoc();
            ?>
            <form role="form" name="guardar-registro-archivo" id="guardar-registro-archivo" method="POST" action="includes/modelos/modelo-administrador.php" enctype="multipart/form-data"> 
                  <div class="box-body">

                    <div class="form-group">
                      <label for="nombres">Nombres y Apellidos:</label>
                      <input type="text" class="form-control" id="nombres" name="nombres"  value="<?php echo $administrador['nombre']; ?>"; required="true">
                    </div>

                    <div class="form-group">
                      <label for="usuario">Usuario:</label>
                      <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $administrador['usuario']; ?>"; required="true">
                    </div>

                    <div class="form-group">
                        <label for="contrasenia">Contraseña: </label>
                        <input type="password" class="form-control" id="contrasenia" name="contrasenia">
                    </div>

                    <div class="form-group">
                        <label for="imagenAdministrador"> Imagen: </label>
                        <input class="form-control" type="file" id="imagenAdministrador" name="imagenAdministrador">
                        <p class="help-block"> Añada la imagen del administrador aquí</p>
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
                    <input type="hidden" name="accion" value="actualizar">
                    <input type="hidden" name="id" value="<?php echo $administrador['id']; ?>">
                    <button type="submit" class="btn btn-primary" id="crear_registro_administrador">Añadir</button>
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