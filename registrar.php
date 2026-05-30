<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registro</title>
	
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body>
	
<div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
          <div class="card-img-left d-none d-md-flex">
            <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Registrar cuenta</h5>
            <form action="alta.php" method="post"><!--Se mandan los datos a alta.php para que se pueda iniciar sesión-->

              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInputUsuario" name="usr" placeholder="nombreusuario" required autofocus>
                <label for="floatingInputUsuario">Usuario</label>
              </div>

              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInputCorreo" name="cor" placeholder="nombre@ejemplo.com" required>
                <label for="floatingInputCorreo">Correo</label>
              </div>

			  <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInputNombre" name="nom" placeholder="nombre" required>
                <label for="floatingInputNombre">Nombre</label>
              </div>
				
			  <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInputTelefono" name="tel" placeholder="telefono" maxlength="10" required>
                <label for="floatingInputTelefono">Telefono (máximo 10 dígitos)</label>
              </div>
				
			  <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInputDireccion" name="dir" placeholder="direccion" required>
                <label for="floatingInputDirrecion">Dirreccion</label>
              </div>
				
				
              <hr>

              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingContraseña" name="con" placeholder="contraseña" required>
                <label for="floatingContraseña">Contraseña</label>
              </div>

              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingConfirmarContraseña" placeholder="confirmar contraseña" required>
                <label for="floatingConfirmarContraseña">Confirmar contraseña</label>
              </div>

              <div class="d-grid mb-2">
                <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Registrar</button>
              </div>

              <a class="d-block text-center mt-2 small" href="cuenta.php">¿Ya tienes una cuenta? Inicia sesion aqui.</a>

              <hr class="my-4">


            </form>
          </div>
        </div>
      </div>
    </div>
  </div>	
	
<style>


.card-img-left {
  width: 50%;
  /* Link to your background image using in the property below! */
  background: scroll center url('imagenes/logo2.png');
  background-size: cover;
}

.btn-login {
  font-size: 0.9rem;
  letter-spacing: 0.05rem;
  padding: 0.75rem 1rem;
}

</style>
	
<script>
var password = document.getElementById("floatingContraseña")
  , floatingConfirm = document.getElementById("floatingConfirmarContraseña");

function validatePassword(){
  if(password.value != floatingConfirm.value) {
    floatingConfirm.setCustomValidity("Contraseña no coincide");
  } else {
    floatingConfirm.setCustomValidity('');
  }
}

password.onchange = validatePassword;
floatingConfirm.onkeyup = validatePassword;	
</script>	
	
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