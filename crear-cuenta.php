<?php include('includes/templates/header.php');?>

      <main role="main" class="inner cover">
        <h1 class="cover-heading">Creación de Cuenta</h1>

        <form class="form-sing-up" id="formulario">
          <div class="form-group text-left">
            <label  for="usuario">Usuario</label>
            <input type="text" class="form-control" id="usuario" placeholder="Ingrese usuario" required>
          </div>
          <div class="form-group text-left">
            <label for="contrasenia">Contraseña</label>
            <input type="password" class="form-control" id="contrasenia" placeholder="Ingrese contraseña" required>
            <small id="passwHelp" class="form-text">  </small>
          </div>
          <div class="form-group text-left">
            <label for="contrasenia-confirmacion">Repetir Contraseña</label>
            <input type="password" class="form-control" id="contrasenia-confirmacion" placeholder="Confirme la contraseña" required>
            <small id="passwHelp" class="form-text">  </small>
            <p class="text-right font-weight-bold"> <a href="ingresar.php"> <u>Iniciar sesión</u> </a> </p>
          </div>
          <input type="hidden" id="accion" value="registrar"> 
          <button type="submit" id="btn-crear" class="btn btn-success btn-lg">Crear</button>
        </form>

      </main>

<?php include('includes/templates/footer.php');?>