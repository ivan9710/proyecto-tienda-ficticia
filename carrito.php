<?php
	include("consultas.php");//Para poder utilizar las funciones dentro de consultas.php
	if (isset($_GET["idcliente"])){//Se da el valor cliente, para que cuando ingrese el cliente cambie la barra de navegación
		$idcliente = $_GET["idcliente"];
	}

	date_default_timezone_set('America/Mexico_City');
	$fechaPedido = date("d-m-Y"); //Es la fecha del día de hoy
    $fechaEntrega = date("d-m-Y",strtotime($fechaPedido."+ 7 day"));//La fecha de la posible entrega del producto (7 días despues de la fecha pedido)

	if(isset($_POST["comprar"])){//Los datos que se necesitan para poder procesar la compra
		$idcliente = $_REQUEST["idcliente"];
		$amount = $_REQUEST["amount"];
		$entrega = $_REQUEST["entrega"];
		$stock = $_REQUEST["stock"];
		$producto = $_REQUEST["producto"];
		comprar($idcliente,$amount,$entrega,$fechaPedido,$fechaEntrega,$stock,$producto);//Funcion que se encuentra en consultas.php


	}

	if(isset($_POST["eliminar"])){//Los datos que se necesitan por si desea elimnar un producto del carrito
		$idproducto = $_REQUEST["idproducto"];
		eliminarC($idcliente,$idproducto);//Funcion que se encuentra en consultas.php
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
	<title>SAPPHIRE CARE | CARRITO DE COMPRAS</title>
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


	<!-- CARRITO -->
	

	<div class="row d-flex align-items-center justify-content-center" style="margin: 25px;">

	    <div class="col-md-3"></div>

		<?php
			
			mostrarC($idcliente);//Funcion que se encuentra en consultas.php

		?>

	    <div class="col-md-3"></div>

	</div>


	<!-- FIN CARRITO -->

	<script src="app.js" type="text/javascript"></script>

	<!-- FOOTER -->

	<script src="app.js" type="text/javascript"></script>

	<div class="container">
	  <footer class="py-3 my-4">
	    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
	    	<?php
	      	
	      	if ($idcliente == "-"){//Cambian los enlaces para que no se pierda la vista de cliente
		      	echo "<li class='nav-item'><a href='index.php' class='nav-link px-2 text-muted'>Inicio</a></li>";
		      	echo "<li class='nav-item'><a href='terminos-y-condiciones.php' class='nav-link px-2 text-muted'>Terminos y condiciones</a></li>";
		      	echo "<li class='nav-item'><a href='aviso-de-privacidad.php' class='nav-link px-2 text-muted'>Aviso de privacidad</a></li>";
		      	echo "<li class='nav-item'><a href='faqs.php' class='nav-link px-2 text-muted'>FAQs</a></li>";
		      	echo "<li class='nav-item'><a href='about.php' class='nav-link px-2 text-muted'>Nosotros</a></li>";
		      } else {
		      	echo "<li class='nav-item'><a href='index.php?idcliente=".$idcliente."' class='nav-link px-2 text-muted'>Inicio</a></li>";
		      	echo "<li class='nav-item'><a href='terminos-y-condiciones.php?idcliente=".$idcliente."' class='nav-link px-2 text-muted'>Terminos y condiciones</a></li>";
		      	echo "<li class='nav-item'><a href='aviso-de-privacidad.php?idcliente=".$idcliente."' class='nav-link px-2 text-muted'>Aviso de privacidad</a></li>";
		      	echo "<li class='nav-item'><a href='faqs.php?idcliente=".$idcliente."' class='nav-link px-2 text-muted'>FAQs</a></li>";
		      	echo "<li class='nav-item'><a href='about.php?idcliente=".$idcliente."' class='nav-link px-2 text-muted'>About</a></li>";		      	
		      }
	      	
	      	?>
	    </ul>
	    <p class="text-center text-muted">&copy; 2023 Sapphire Care S.A. de C.V.</p>
	  </footer>
	</div>
	<!-- FIN FOOTER -->

</body>
</html>