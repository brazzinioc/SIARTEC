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
       Registro de Devolución
        <small>Aquí podrás realizar la devolución de los préstamos.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
          <div class="col-xs-12">
            <!-- Default box -->
            <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Administre la devolución en esta sección</h3>
                  </div>
                  <div class="table-responsive altura-tabla"">
                    <table id="registros" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                                <th>Número</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>DNI</th>
                                <th>Tipo de Usuario</th>
                                <th>Grado</th>
                                <th>Sección</th>
                                <th>Lista Equipos</th>
                                <th>Observación</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                          </thead>

                          <tbody>
                              <?php 
                                  $numero = 1;
                                  $prestamos = extreaListaPrestamo();

                                  while ( $prestamo =  $prestamos -> fetch_assoc() ):
                              ?> 
                              <tr>
                                  <td> <?php  echo $numero; ?> </td>
                                  <td> <?php  echo $prestamo['fecha']; ?> </td>
                                  <td> <?php  echo $prestamo['hora']; ?> </td>
                                  <td> <?php  echo $prestamo['dniUsuario']; ?> </td>
                                  <td> <?php  echo $prestamo['tipo']; ?> </td>
                                  <td> <?php  echo $prestamo['grado']; ?> </td>
                                  <td> <?php  echo $prestamo['seccion']; ?> </td>
                                  <td> <?php  echo $prestamo['listaEquipos']; ?> </td>
                                  <td> <?php  echo $prestamo['observacion']; ?> </td>
                                  <td> 
                                      <?php 
                                          if( $prestamo['estado'] == 1) { 
                                              echo "Activo"; 
                                          } else { echo "Desactivado"; }   
                                      ?> 
                                  </td>
                                  <td> 
                                      <a href="#" data-id="<?php echo $prestamo['id']; ?>" data-tipo="prestamo" title="devolver" class="btn bg-maroon btn-flat margin devolver_prestamo">
                                          <i class="fa fa-check-circle-o"></i> 
                                      </a>   
                                  </td>
                              </tr>

                              <?php 
                                  $numero++;
                                  endwhile;
                              ?>
                              
                              
                          
                          </tbody>
                          <tfoot>
                              <tr>
                                <th>Número</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>DNI</th>
                                <th>Grado</th>
                                <th>Sección</th>
                                <th>Lista Equipos</th>
                                <th>Observación</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                              </tr>
                          </tfoot>
                    </table>
                  </div>
            </div>
            <!-- /.box -->
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php 
  include ('includes/templates/footer.php');
 ?>