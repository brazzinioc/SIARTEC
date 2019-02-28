<footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Desarrollado por <a target="_blank" href="http://www.brazzinioc.com"> Brazzini OC </a> con &#10084; para la I. E. <a target="_blank" href="https://iesimonbolivarchaparra.blogspot.com/"> "Simón Bolívar"</a> </p>
        </div>
      </footer>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/app.js"></script>
    <?php 
      //Condición para evaluar la página actual y carga el archivo JS
      if($pagina == 'ingresar' || $pagina == 'crear-cuenta'){ //Valida si la pagg cargada es invitados.
        echo '<script src="js/formulario.js"></script>';
      } 
    ?>
  </body>
</html>