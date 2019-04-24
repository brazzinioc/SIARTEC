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
        Lista de Devoluciones
        <small>Aquí podrás observar las devoluciones realizadas.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"> </h3>
            </div>
            <div class="table-responsive altura-tabla"">
                <table id="registros" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th>Número</th>
                          <th>Fecha</th>
                          <th>Hora</th>
                          <th>DNI</th>
                          <th>Lista Equipos</th>
                          <th>Obs. Préstamo</th>
                          <th>Obs. Devolución</th>
                          <th>Tipo Usuario</th>
                          <th>Grado</th>
                          <th>Sección</th>
                      </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $numero = 1;
                            $devoluciones = extraeListaDevolucion();

                            while ( $devolucion =  $devoluciones -> fetch_assoc() ):
                        ?> 
                        <tr>
                            <td> <?php  echo $numero; ?> </td>
                            <td> <?php   echo $devolucion['fecha']; ?> </td>
                            <td> <?php   echo $devolucion['hora']; ?> </td>
                            <td> <?php   echo $devolucion['dniUsuario']; ?> </td>
                            <td> <?php   echo $devolucion['listaEquipos']; ?> </td>
                            <td> <?php   echo $devolucion['obsPrestamo']; ?> </td>
                            <td> <?php   echo $devolucion['obsDevolucion']; ?> </td>
                            <td> <?php   echo $devolucion['tipo']; ?> </td>
                            <td> <?php   echo $devolucion['grado']; ?> </td>
                            <td> <?php   echo $devolucion['seccion']; ?>  </td>
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
                          <th>Lista Equipos</th>
                          <th>Obs. Préstamo</th>
                          <th>Obs. Devolución</th>
                          <th>Tipo Usuario</th>
                          <th>Grado</th>
                          <th>Sección</th>
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