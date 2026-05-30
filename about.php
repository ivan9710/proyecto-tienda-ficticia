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
	<title>SAPPHIRE CARE | ACERCA DE NOSOTROS</title>

	<style>
		*{
			padding: 0;
			margin: 0;
			box-sizing: border-box;
		}

		body{
			background: #fefefe;
		}

		.container{
			width: 90%;
			margin: 50px auto;
		}

		.heading{
			text-align: center;
			font-size: 30px;
			margin-bottom: 50px;
		}

		.row{
			display: flex;
			flex-direction: row;
			justify-content: space-around;
			flex-flow: wrap;
		}

		.card{
			background: #fff;
			border: 1px solid #ccc;
			margin-bottom: 50px;
			transition: 0.3s;
		}

		.card-header{
			text-align: center;
			padding: 50px 10px;
			background: linear-gradient(to right, #168984, #16894e);
			color: #fff;
		}

		.card-body{
			padding: 30px 20px;
			text-align: center;
			font-size: 18px;
			color: #000000;
		}

		.card:hover{
			transform: scale(1.05);
			box-shadow: 0 0 40px -10px rgba(0, 0, 0, 0.25);
		}

	</style>
</head>
<body>

	<!--  NAVBAR -->
	<nav class="navbar navbar-light bg-light">
		<?php
			if ($idcliente == "-"){//Cambia el enlace de la página para que no se pierda la vista de cliente
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

	<!-- ACERCA DE-->

	<div>
		
		 <div class="container" style="text-align: center;" id="acerca-de">
    		<div class="heading">
      			<hr>
      			<h1>¿QUIÉNES SOMOS?</h1>
      			<hr>
      			<img src="imagenes/logo1.png" style="margin: 50px;">
      			<br> 
      			<h5>El nombre proviene de la idea del cuidado personal como si fuese una joya, y que mejor que hacerlo con un zafiro que además de ser una gema hermosa muchas personas suelen asociarla como la piedra de la sabiduría, con ello se busca hacer alusión a que debemos ser sabios al momento del cuidado personal.</h5><br>
      			<h6>Para cualquiera que su belleza y salud sea importante puede ser nuestro cliente.<br>Todo lo que tu piel necesita <bold>SAPPHIRE CARE&copy;</bold></h6>
    		</div>
  		</div>

  		<div class="row">

  			<div class="col-md-2"></div>

  			<div class="col-md-4">
    			<div class="card">
      			<div class="card-header">
        			<h1>Misión</h1>
      			</div>
      			<div class="card-body">
        			<p>Brindar productos de bienestar, belleza y cuidado personal de calidad que satisfagan y superen las expectativas de nuestros clientes.</p>
      			</div>
    			</div>
    		</div>

    		<div class="col-md-4">	
    			<div class="card">
      			<div class="card-header">
        			<h1>Visión</h1>
      			</div>
      			<div class="card-body">
        			<p>Ser lideres regionales en la producción y comercialización de productos de productos de cuidado personal distinguiéndonos por la calidad que brindamos a nuestros clientes.</p>
      			</div>
    			</div>
    		</div>

    		<div class="col-md-2"></div>

  		</div>

  		<br><br><br>

  		<div class="row">
  			
  			<div class="col-md-1"></div>

  			<div class="col-md-5">
  			  <div class="card">
      			<div class="card-header">
        			<h1>Valores</h1>
     			</div>

      		<div class="card-body" style="margin: 20px;">
        			<p>
        				<ul>
        					<li type="circle">Colaboración</li>
        					<li type="circle">Integridad</li>
        					<li type="circle">Responsabilidad</li>
        					<li type="circle">Pasión</li>
        					<li type="circle">Diversidad</li>
        					<li type="circle">Calidad</li>
        					<li type="circle">Seguridad</li>
        					<li type="circle">Libertad</li>
        					<li type="circle">Compromiso</li>
        					<li type="circle">Accesibilidad</li>
        				</ul>
        			</p>
      			</div>
    			</div>
    		</div>

    		<div class="col-md-5">
    			<div class="card">
      			<div class="card-header">
        			<h1>Objetivos</h1>
      			</div>
      			<div class="card-body" style="margin: 20px;">
        			<p>
        				<ul>
        					<li type="square">Mantener o aumentar la rentabilidad del negocio.</li>
        					<li type="square">Obtener mayor alcance dentro de la república.</li>
        					<li type="square">Ofrecer un excelente servicio al cliente</li>
        					<li type="square">Atraer y retener al capital humano.</li>
        					<li type="square">Alcanzar a los clientes adecuados.</li>
        					<li type="square">Mantener los valores fundamentales de la empresa</li>
        					<li type="square">Tener un crecimiento sostenible.</li>
        					<li type="square">Optimizar la gestión del cambio</li>
        					<li type="square">Sobresalir ante la competencia.</li>
        					<li type="square">Mantener un flujo de caja saludable.</li>
        				</ul>
        			</p>
      			</div>
    			</div>
    		</div>

    		<div class="col-md-1"></div>

  		</div>


			<div class="container" style="text-align: center;" id="contacto">
    		<div class="heading">
      			<hr>
      			<h1>CONTÁCTANOS EN:</h1>
      			<hr>
    		</div>
  		</div>

  		<div class="row">
  			
  			<div class="col-md-2"></div>

  			<div class="col-md-3">
  				<div class="card">
      			<div class="card-header">
       				<h1>Correo</h1>
	     			</div>
	   				<div class="card-body">
	     			<p>contacto@sapphirecare.com</p>
	     			</div>
	     		</div>
    		</div>

    		<div class="col-md-2"></div>

  			<div class="col-md-3">
					<div class="card">
						<div class="card-header">
							<h1>Teléfono</h1>
						</div>
						<div class="card-body">
							<p>55 46 87 54 11</p>
						</div>
					</div>
				</div>

				<div class="col-md-2"></div>

  		</div>

  		<center>
  			<h3>UBICACI&Oacute;N: <br>Cuautitl&aacute;n-Teoloyucan Km 2.5 Col. San Sebasti&aacute;n Xhala, Cuautitl&aacute;n Izcalli,Edo. M&eacute;xico C.P. 54714<br> </h3>
  			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3756.5634165424003!2d-99.19184202414412!3d19.688622932453605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f55f752d8035%3A0x18d253a85bb8bf58!2sFESC%20Campo%204%20Acceso%202!5e0!3m2!1ses-419!2smx!4v1694563800859!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  		</center>

	</div>

	<!--FIN ACERCA DE -->

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
