<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <title>SIARTEC</title>
    
    <?php 
      //Obtiene el nombre del archivo actual.
      $archivo = basename($_SERVER['PHP_SELF']); //Retorna el nombre del archivo que está cargando actualmente.
      $pagina = str_replace(".php", "", $archivo); //busca , reemplaza y fuente de datos.
    ?>

  
  </head>

  <body class="text-center <?php echo $pagina; ?>">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand"> <a href="index.php"> SIARTEC </a> </h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link" id="inicio" href="index.php">Inicio</a>
            <a class="nav-link" id="soporte" href="soporte.php">Soporte</a>
            <a class="nav-link" id="ingresar" href="ingresar.php">Ingresar</a>
            <a class="nav-link" id="registrarse" href="crear-cuenta.php">Registrarse</a>
            <?php
              session_start();
              if(isset($_SESSION['usuario'])){
                echo '<a class="nav-link" id="dashboard" href="admin/admin-area.php">Dashboard</a>';
              }?>
          </nav>
        </div>
      </header>