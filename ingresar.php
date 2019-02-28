<?php include('includes/templates/header.php');?>

      <main role="main" class="inner cover">
        <h1 class="cover-heading">Inicio de Sesión</h1>
        <form class="form-login" id="formulario">
          <div class="form-group text-left">
            <label  for="usuario">Usuario</label>
            <input type="text" class="form-control" id="usuario" placeholder="Ingrese usuario" required>
          </div>
          <div class="form-group text-left">
            <label for="contrasenia">Contraseña</label>
            <input type="password" class="form-control" id="contrasenia" placeholder="Ingrese contraseña" required>
            <p class="text-right font-weight-bold"> <a href="crear-cuenta.php"> <u>Crear cuenta</u> </a> </p>
          </div>
          <input type="hidden" id="accion" value="ingresar"> 
          <button type="submit" id="btn-ingresar" class="btn btn-success btn-lg">Ingresar</button>
        </form>
      </main>

<?php include('includes/templates/footer.php');?>