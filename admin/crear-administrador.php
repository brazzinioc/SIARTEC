<?php
include ('../includes/funciones/sesiones.php');

include ('includes/templates/header.php');

include ('includes/templates/barra.php');

include ('includes/templates/navegacion.php');
?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Crear Administradores
        <small>Llene el formulario para poder crear un administrador</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Datos del administrador</h3>
        </div>
        <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-administrador.php"> 
                  <div class="box-body">
                    <div class="form-group">
                      <label for="usuario">Usuario:</label>
                      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa un usuario">
                    </div>

                    <div class="form-group">
                      <label for="nombre">Nombre:</label>
                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre y apellidos">
                    </div>

                    <div class="form-group">
                      <label for="contrasenia">Contraseña:</label>
                      <input type="password" class="form-control" id="contrasenia" name="contrasenia" placeholder="Ingresa una contraseña">
                    </div>

                    <div class="form-group">
                      <label for="contrasenia">Repetir contraseña:</label>
                      <input type="password" class="form-control" id="repetir_contrasenia" name="repetir_contrasenia" placeholder="Repita la contraseña">
                      <span id="resultado_contrasenia" class="help-block"></span>
                    </div>

                  </div>
                  <div class="box-footer">
                    <input type="hidden" name="registro" value="nuevo">
                    <button type="submit" class="btn btn-primary" id="crear_registro_admin">Añadir</button>
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