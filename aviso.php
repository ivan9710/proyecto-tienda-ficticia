<?php
	
	include("consultas.php");//Para poder utilizar las funciones dentro de consultas.php
	$idcliente = "-";//Se da el valor cliente, para que cuando ingrese el cliente cambie la barra de navegación
	if (isset($_GET["idcliente"])){
		$idcliente = $_GET["idcliente"];
	}


	if(isset($_POST["null"])){//Este isset funciona si los valores del form dan nulos, para notificar que debe iniciar sesión
		echo "<script language='javascript'>
				alert('Inicie sesión por favor');
				document.location.href='index.php';
			</script>";
	}

?>

<!DOCTYPE html>
<html>
<head>
	<!-- Configurado al español -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title>SAPPHIRE CARE | INICIO</title>
</head>
<body>

	<!--  NAVBAR -->
	<nav class="navbar navbar-light bg-light">
		<?php
			if ($idcliente == "-"){	//Cambia el enlace de la página para que no se pierda la vista de cliente
  				echo "<a class='navbar-brand' href='index.php'>";
  			} else {
  				echo "<a class='navbar-brand' href='index.php?idcliente=".$idcliente."'>";
  			};
  		?>
    		<img src="imagenes/logo1.png" height="100px" width="100px">
  		</a>
  		<form class="form-inline my-2 my-lg-0 mx-auto">
  		</form>
  		<ul class="navbar-nav" style="margin-right:10px;">
    		<li class="nav-item">
    			<?php
    				if ($idcliente == "-"){//Si se inicia sesión cambian los valores dentro de barra de navegación
      					echo "<a class='nav-link btn my-2 my-sm-0' href='cuenta.php' style='border: black solid;padding:3px'>Iniciar sesión</a>";
			echo "</li>";
		echo "</ul>";
		echo "<button onclick='sesion(2)' class='btn my-2 my-sm-0' type='submit'>
			<img src='imagenes\cComprasN.png' class='rounded float-end' width='40' height='40' style='border: solid; padding: 3px'>
		</button>";		
      				} else {
      					echo "<div class='dropdown' style='margin-right: 50px;'>";
							echo "<button class='btn dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='border: black solid;padding:3px'>";
								echo "Cuenta";
							echo "</button>";
							echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
								echo "<a class='dropdown-item' onclick='recargar()' href='#'>¡Hola! ";
								mostrarNombre($idcliente);
								echo "</a>";
								echo "<a class='dropdown-item' href='pedidos.php?idcliente=".$idcliente."'>Pedidos</a>";
								echo "<a class='dropdown-item' href='index.php' onclick='sesion(1)'>Cerrar Sesión</a>";
							echo "</div>";	
						echo "</div>";
			echo "</li>";
		echo "</ul>";
		echo "<a href='carrito.php?idcliente=".$idcliente."' class='btn my-2 my-sm-0' type='submit'>
			<img src='imagenes\cComprasN.png' class='rounded float-end' width='40' height='40' style='border: solid; padding: 3px'>
		</a>";	
      				}
      			?>
  		
	</nav>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<div class="container-fluid">
    		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      			<div class="navbar-nav">
      				<?php
        				if ($idcliente == "-"){//Cambian los enlaces para que no se pierda la vista de cliente
        					echo "<a class='nav-link active' aria-current='page' href='index.php'>Inicio</a>
        					<a class='nav-link' href='about.php'>Nosotros</a>
        					<a class='nav-link' href='tyc.php'>Terminos y condiciones</a>
        					<a class='nav-link' href='aviso.php'>Aviso de privacidad</a>";
        				} else {
        					echo "<a class='nav-link active' aria-current='page' href='index.php?idcliente=".$idcliente."'>Inicio</a>
        					<a class='nav-link' href='about.php?idcliente=".$idcliente."'>Nosotros</a>
        					<a class='nav-link' href='tyc.php?idcliente=".$idcliente."'>Terminos y condiciones</a>
        					<a class='nav-link' href='aviso.php?idcliente=".$idcliente."'>Aviso de privacidad</a>";
        				}

        			?>
      			</div>
    		</div>
    		<form class="d-flex">
      			<input class="form-control" type="search" placeholder="Buscar" aria-label="Search" style="margin-top: 8px;">
      			<button class='btn' type='submit'>
      				<img src="imagenes/lupa.png" class='rounded float-end' width='40' height='40' style='border: solid; padding: 3px'>
      			</button>
    		</form>
      		<button class='btn my-2 my-sm-0' type='submit'>
				<img src='imagenes\ayuda.png' class='rounded float-end' width='40' height='40' style='border: solid; padding: 3px'>
			</button>
  		</div>
	</nav>
	<!-- FIN NAVBAR -->


<div class="acordeon-cuerpo" style="margin: 50px; text-align: justify;">
  <div class="acordeon">
    <h1>Aviso de privacidad</h1>
    <hr>
    <div class="contenedor">
      <div class="etiqueta">General</div>
      <div class="contenido">
      <p>En cumplimiento con la Ley Federal de Protección de Datos Personales en Posesión de los Particulares (LFPDPPP) y su reglamento, Sapphire Care es el responsable de recabar tus datos personales, del uso que se le dé a los mismos y de su protección.<br>En Sapphire Care, valoramos y respetamos tu privacidad. Este aviso de privacidad tiene como objetivo informarte sobre cómo recopilamos, utilizamos, protegemos y divulgamos la información personal que nos proporcionas cuando utilizas nuestros servicios.</p>
<p>Si tiene alguna pregunta sobre este Aviso de Privacidad puede ponerse en contacto con nosotros en cualquier momento a través de [correo] o de nuestras diferentes formas de contacto.
</p></div>
    </div>
    <hr>
    <div class="contenedor">
      <div class="etiqueta">Datos Personales Recopilados:</div>
      <div class="contenido">Para brindarte nuestros servicios, podemos recopilar la siguiente información personal:
        <ol type="i" start="1">
          <li>Nombre completo.</li>
          <li>Dirección de correo electrónico.</li>
          <li>Número de teléfono.</li>
          <li>Información de pago (por ejemplo, número de tarjeta de crédito) para procesar transacciones, según sea necesario.</li>
        </ol></div>
    </div>
  <hr>
	  <div class="contenedor">
      <div class="etiqueta">Finalidad del Tratamiento de los Datos Personales</div>
      <div class="contenido">La información personal recopilada tiene como finalidad:
        <ol type="i" start="1">
         	<li>Procesar y completar tus pedidos y transacciones.</li>
			<li>Mantener una comunicación efectiva contigo, incluyendo el envío de confirmaciones, actualizaciones y notificaciones relacionadas con nuestros servicios.</li>
			<li>Brindar atención al cliente y soporte técnico.</li>
			<li>Personalizar y mejorar tu experiencia en nuestro sitio web y aplicaciones.</li>
			<li>Enviar información promocional sobre nuestros productos y servicios, siempre y cuando hayas dado tu consentimiento para recibir dichas comunicaciones.</li>
			<li>Cumplir con nuestras obligaciones legales y proteger nuestros derechos legales.</li>
        </ol></div>
    </div>
  <hr>
	  <div class="contenedor">
      <div class="etiqueta">Transferencia de Datos Personales:</div>
      <div class="contenido">
      <p>Sapphire Care podrá transferir tus datos personales a terceros únicamente cuando sea necesario para cumplir con los fines descritos anteriormente y siempre que exista un fundamento legal para dicha transferencia.</p>
	</div>
    </div>
    <hr>
	  <div class="contenedor">
      <div class="etiqueta">Medidas de Seguridad:</div>
      <div class="contenido">
      <p>Sapphire Care cuenta con medidas de seguridad administrativas, técnicas y físicas para proteger tus datos personales y evitar su pérdida, uso indebido, acceso no autorizado, divulgación o alteración. Estas medidas se actualizan y mejoran de manera constante para garantizar la confidencialidad y seguridad de tus datos.
</p></div>
    </div>
    <hr>
	  <div class="contenedor">
      <div class="etiqueta">Derechos ARCO:</div>
      <div class="contenido">
      <p>Como titular de los datos personales, tienes derecho a acceder, rectificar, cancelar u oponerte al tratamiento de tus datos personales, así como a revocar el consentimiento otorgado para el tratamiento de los mismos. Para ejercer tus derechos ARCO, puedes enviar una solicitud por escrito a nuestra dirección de correo electrónico [correo electrónico de contacto] o comunicarte con nosotros a través de [número de teléfono de contacto].
</p></div>
    </div>
    <hr>
	  <div class="contenedor">
      <div class="etiqueta">Cambios al Aviso de Privacidad:</div>
      <div class="contenido">
      <p>Sapphire Care se reserva el derecho de realizar modificaciones o actualizaciones a este aviso de privacidad para cumplir con nuevas disposiciones legales, políticas internas o requerimientos de las autoridades competentes.
      Nos reservamos el derecho de modificar el Aviso de Privacidad, en cualquier momento y a nuestra entera consideración</p></div>
    </div>
    <hr>
	  <p>Fecha de actualización: 14 de noviembre de 2023<br>

Te recomendamos revisar periódicamente este aviso de privacidad para estar informado sobre cómo protegemos y utilizamos tus datos personales.<br>

Agradecemos tu confianza y estamos comprometidos con el manejo adecuado y confidencialidad de tus datos personales.<br>

Atentamente,<br>

Sapphire Care</p>



  </div>
  </div>

	<!-- FOOTER -->

	<script src="app.js" type="text/javascript"></script>

	<div class="container">
	  <footer class="py-3 my-4">
	    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
	    	<?php
	      	
	      	if ($idcliente == "-"){//Cambian los enlaces para que no se pierda la vista de cliente
		      	echo "<li class='nav-item'><a href='index.php' class='nav-link px-2 text-muted'>Inicio</a></li>";
		      	echo "<li class='nav-item'><a href='tyc.php' class='nav-link px-2 text-muted'>Terminos y condiciones</a></li>";
		      	echo "<li class='nav-item'><a href='aviso.php' class='nav-link px-2 text-muted'>Aviso de privacidad</a></li>";
		      	echo "<li class='nav-item'><a href='about.php' class='nav-link px-2 text-muted'>Nosotros</a></li>";
		      } else {
		      	echo "<li class='nav-item'><a href='index.php?idcliente=".$idcliente."' class='nav-link px-2 text-muted'>Inicio</a></li>";
		      	echo "<li class='nav-item'><a href='tyc.php?idcliente=".$idcliente."' class='nav-link px-2 text-muted'>Terminos y condiciones</a></li>";
		      	echo "<li class='nav-item'><a href='aviso.php?idcliente=".$idcliente."' class='nav-link px-2 text-muted'>Aviso de privacidad</a></li>";
		      	echo "<li class='nav-item'><a href='about.php?idcliente=".$idcliente."' class='nav-link px-2 text-muted'>Nosotros</a></li>";		      	
		      }
	      	
	      	?>
	    </ul>
	    <p class="text-center text-muted">&copy; 2023 Sapphire Care S.A. de C.V.</p>
	  </footer>
	</div>
	<!-- FIN FOOTER -->

</body>
</html>
