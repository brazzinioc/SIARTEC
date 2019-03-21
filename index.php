<?php 
include('includes/templates/header.php');

if(isset($_GET['cerrar_sesion'])){
  session_destroy();
  header('Location: index.php');
}

?>
      <main role="main" class="inner cover">
        <h1 class="cover-heading">Sistema Integrado para la Administración de Recursos Tecnológicos</h1>
        <p class="lead">Aplicación web que <span>automatiza el registro de préstamo y devolución de equipos tecnológicos dentro de una institución educativa</span>. <i>Aplicación inspirada en un problema encontrado en el área de Coordinación e Innovación Tecnológica de la I.E. "Simón Bolívar" - Cháparra - Arequipa - Perú.</i></p>
        <p class="lead">
          <a href="crear-cuenta.php" class="btn btn-lg btn-secondary sing-up">Crear cuenta</a>
        </p>
      </main>

<?php include('includes/templates/footer.php');?>