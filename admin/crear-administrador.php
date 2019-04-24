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
        Registro de Administradores
        <small>Llene el formulario para poder registrar un administrador</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Datos del administrador</h3>
        </div>
            <form role="form" name="guardar-registro-archivo" id="guardar-registro-archivo" method="POST" action="includes/modelos/modelo-administrador.php" enctype="multipart/form-data"> 
                  <div class="box-body">

                    <div class="form-group">
                      <label for="nombres">Nombres y Apellidos:</label>
                      <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingresa nombres del administrativo" required="true">
                    </div>

                    <div class="form-group">
                      <label for="usuario">Usuario:</label>
                      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa usuario del administrador" required="true">
                    </div>

                    <div class="form-group">
                        <label for="contrasenia">Contraseña: </label>
                        <input type="password" class="form-control" id="contrasenia" name="contrasenia" placeholder="Ingrese contraseña" required="true">
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
                    <input type="hidden" name="accion" value="crear">
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