<?php 
	include("consultas.php");
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SAPPHIRE CARE | INICIAR SESIÓN</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">  
</head>

<body class="p-3 mb-2">

  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <img src="imagenes/logo1.png" style="margin-left: 75px; margin-bottom: 15px;"></br>
            <h5 class="card-title text-center mb-5 fw-light fs-5">Iniciar sesion</h5>
            <form action="sesion.php" method="post"><!--Se inicia sesión y se mandan los datos a sesion.php-->
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="user" placeholder="usuario" required>
                <label for="floatingInput">Usuario</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" name="pass" placeholder="contraseña" required>
                <label for="floatingPassword">Contraseña</label>
              </div>

              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                <label class="form-check-label" for="rememberPasswordCheck">
                  Recordar contraseña
                </label>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Iniciar sesion</button>
              </div>

	      <a class="d-block text-center mt-2 small" href="registrar.php">¿No tienes una cuenta? Registrate aqui.</a>

              <hr class="my-4">
              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>	
	
	
  <style>

  .btn-login {
    font-size: 0.9rem;
    letter-spacing: 0.05rem;
    padding: 0.75rem 1rem;
  }
	
  </style>	
	
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  
 <!-- FOOTER -->

  <script src="app.js" type="text/javascript"></script>

  <div class="container">
    <footer class="py-3 my-4">
      <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class='nav-item'><a href='index.php' class='nav-link px-2 text-muted'>Inicio</a></li>
        <li class='nav-item'><a href='terminos-y-condiciones.php' class='nav-link px-2 text-muted'>Terminos y condiciones</a></li>
        <li class='nav-item'><a href='aviso-de-privacidad.php' class='nav-link px-2 text-muted'>Aviso de privacidad</a></li>
        <li class='nav-item'><a href='about.php' class='nav-link px-2 text-muted'>Nosotros</a></li>
      </ul>
      <p class="text-center text-muted">&copy; 2023 Sapphire Care S.A. de C.V.</p>
    </footer>
  </div>
  <!-- FIN FOOTER -->

</body>
</html>


  </body>
</html>
