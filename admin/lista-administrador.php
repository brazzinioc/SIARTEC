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
       Lista de Administradores
        <small>Aquí podrás editar o borrar los administradores</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Administra los docentes en esta sección</h3>
                    </div>
                    <div class="table-responsive altura-tabla"">
                        <table id="registros" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Número</th>
                                <th>Nombres y Apellidos</th>
                                <th>Usuario</th>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $numero = 1;
                                    $administradores = extraeListaAdministrador();

                                    while ( $administrador =  $administradores -> fetch_assoc() ):
                                ?> 
                                <tr>
                                    <td> <?php  echo $numero; ?> </td>
                                    <td> <?php  echo $administrador['nombre']; ?> </td>
                                    <td> <?php  echo $administrador['usuario']; ?> </td>
                                    <td> <img src="<?php echo 'img/administradores/'. $administrador['urlImagen']?>" class="rounded" alt="Imagen Administrador" width="150"> </td>
                                    <td> 
                                        <?php 
                                            if( $administrador['estado'] == 1) { 
                                                echo "Activo"; 
                                            } else { echo "Desactivado"; }   
                                        ?> 
                                    </td>
                                    <td> 

                                        <a href="editar-administrador.php?id=<?php echo encriptaDato($administrador['id']); ?>; ?>" class="btn bg-orange btn-flat margin"> 
                                            <i class="fa fa-pencil"></i> 
                                        </a> 
                                        <a href="#" data-id="<?php echo $administrador['id']; ?>" data-tipo="administrador" class="btn bg-maroon btn-flat margin borrar_registro">
                                            <i class="fa fa-trash"></i> 
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
                                <th>Nombres y Apellidos</th>
                                <th>Usuario</th>
                                <th>Imagen</th>
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