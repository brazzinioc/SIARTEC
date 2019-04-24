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
       Lista de Administrativo
        <small>Aquí podrás editar o borrar los administrativos</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Administra los administrativos esta sección</h3>
                    </div>
                    <div class="table-responsive altura-tabla"">
                        <table id="registros" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Número</th>
                                <th>DNI</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Tipo de Usuario</th>
                                <th>Cargo</th>
                                <th>Profesion</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $numero = 1;
                                    $administrativos = extraeListaAdministrativo();

                                    while ( $administrativo =  $administrativos -> fetch_assoc() ):
                                ?> 
                                <tr>
                                    <td> <?php  echo $numero; ?> </td>
                                    <td> <?php  echo $administrativo['dni']; ?> </td>
                                    <td> <?php  echo $administrativo['nombres']; ?> </td>
                                    <td> <?php  echo $administrativo['apellidos']; ?> </td>
                                    <td> <?php  echo $administrativo['tipo']; ?> </td>
                                    <td> <?php  echo $administrativo['cargo']; ?> </td>
                                    <td> <?php  echo $administrativo['profesion']; ?> </td>
                                    <td> 
                                        <?php 
                                            if( $administrativo['estado'] == 1) { 
                                                echo "Activo"; 
                                            } else { echo "Desactivado"; }   
                                        ?> 
                                    </td>
                                    <td> 

                                        <a href="editar-administrativo.php?id=<?php echo encriptaDato($administrativo['id']); ?>" class="btn bg-orange btn-flat margin"> 
                                            <i class="fa fa-pencil"></i> 
                                        </a> 
                                        <a href="#" data-id="<?php echo $administrativo['id']; ?>" data-tipo="administrativo" class="btn bg-maroon btn-flat margin borrar_registro">
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
                                <th>DNI</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Tipo de Usuario</th>
                                <th>Cargo</th>
                                <th>Profesion</th>
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