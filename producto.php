<?php
	
	include("consultas.php");
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

	$idproducto = "-";//Se da el valor del producto
	if (isset($_GET["producto"])){
		$idproducto = $_GET["producto"];
	}

	if(isset($_POST["carrito"])){ /*Si se aprieta el boton del formulario de "Agregar al carrito", se recuperan los valores de cada input del formulario por su name respectivo*/
		$cantidad = $_REQUEST["cantidad"];
		$id = $_REQUEST["id"];
		agregarC($idcliente,$id,$cantidad);
		
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
	<title>SAPPHIRE CARE  | PRODUCTO <?php echo $idproducto; ?></title>
</head>
<body>

	<!--  NAVBAR -->
	<nav class="navbar navbar-light bg-light">
		<?php
			if ($idcliente == "-"){	//Este isset funciona si los valores del form dan nulos, para notificar que debe iniciar sesión
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


	<!-- PRODUCTO -->

	<div class='row d-flex align-items-center justify-content-center' style='margin: 25px;'>

    	<div class='col-md-3'></div>

	<?php
		echo "<div class='col-md-3 justify-content-center'>
      		<div class='card text-white bg-dark mb-4 text-center'>
				<img class='card-img-top' src='catalogo/0".$idproducto.".png' alt='Producto 00".$idproducto."'>
	       		<div class='card-body'>
	       			<h5 class='card-title'>";
	       			$idp = ltrim($idproducto, "0");//Se le quita el primer cero a la izquierda, para poder localizarlo en la base de datos
	       			$nombre = dProducto($idp,"1");
	       			$precio = dProducto($idp, "2");//Funciones que se encuentran en consultas.php
	       			echo $nombre;
	       			echo "</h5>
	       		</div>
	        </div>
    	</div>  	

    	<div class='col-md-3'>
      		<div style='margin:25px' class='m-0 row justify-content-center'>
				<form method='POST' id='form' class='text-center'>
					<input type='hidden' name='cmd' value='_xclick'>
					<input type='hidden' name='business' value='shoksito22@gmail.com'>
					<input type='hidden' name='lc' value='MX'>
					<input type='hidden' name='item_name' value='";
					echo $precio;
					echo "'>
					<input type='hidden' name='amount' value='";
					echo $precio;
					echo "'>
					<input type='hidden' name='currency_code' value='MXN'>
					<input type='hidden' name='button_subtype' value='services'>
					<input type='hidden' name='no_note' value='0'>
					<input type='hidden' name='bn' value='PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest'>
					<div class='form-group'>
				      	<h1>MXN $";
				      	echo $precio;
				      	echo ".00</h1>
				      	<input type='hidden' name='precio' value='";
				      	echo $precio;
				      	echo "'>
				      	<input type='hidden' name='id' value='";
				      	echo $idp;
				      	echo "'>
				      	<input type='hidden' name='nombre' value='";
				      	echo $nombre;
				      	echo "'>
				    </div>
				    <p><strong>**NOTA**</strong></p>
				    <p>Recuerda que antes de pagar debes tener cuenta en paypal</p>
				    <p>Si deseas más de un producto, solo podrás agregarlos al carrito</p>
				    <div class='form-group'>
				    	<label name='cantidad'>Cantidad:</label><br>";
					$cantidad = cantidad($idproducto);//Funcion que se encuentra en consultas.php
						if (cantidad($idproducto) <= 0){
							echo "<h3 style='color:red;'><p>¡PRODUCTO AGOTADO!</p></h3>";
							if ($idcliente == "-"){//Cambia la ruta del enlace dependiendo si se inicio sesión o no
								$inicio = "index.php";
							} else {
								$inicio = "indexp.php?idcliente=".$idcliente;
							}
							echo "<a href='".$inicio."'><p>Regresar al catálogo</p></a>";
							echo "</div>";
						} else {
							if (cantidad($idproducto) >= 5){//Si la cantidad es mayor o igual a 5 manda el input hasta con un valor de 5
								echo "<label name='cantidad'>Cantidad:</label><br>
								<input type='number' id='cantidad' name='cantidad' min='1' max='5' value='1'>";
							} else {//En caso contrario manda el input hasta con el valor que se obtenga
								echo "<label name='cantidad'>Cantidad:</label><br>
								<input type='number' id='cantidad' name='cantidad' min='1' max='".$cantidad."' value='1'>";
							}
						    echo "</div>";
					        if ($idcliente == "-"){//Si el cliente inicio sesión puede procede a comprar o agregar al carrito, en caso contrario se le invita a que inicie sesión
					        	echo "<button href='#' type='submit' name='null' class='btn btn-primary mr-2'>Agregar al carrito</button>";
					        	echo "<button href='#' type='submit' name='null' class='btn btn-primary mr-2'>Pagar</button>";
					        } else {
						        echo "<button id='miBoton' onclick='post()' class='btn btn-primary mr-2'>Agregar al carrito</button>";
						        echo "<button id='comprar' onclick='compra()' class='btn btn-primary mr-2'>Comprar</button>";   
						    }
						}
				echo "</form>
      		</div>
      	</div>";
	
	?>

    	<div class='col-md-3'></div>

	</div>

	<!-- FIN PRODUCTO -->
	
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
		      	echo "<li class='nav-item'><a href='about.php' class='nav-link px-2 text-muted'>Nosotros</a></li>";
		      } else {
		      	echo "<li class='nav-item'><a href='index.php?idcliente=".$idcliente."' class='nav-link px-2 text-muted'>Inicio</a></li>";
		      	echo "<li class='nav-item'><a href='terminos-y-condiciones.php?idcliente=".$idcliente."' class='nav-link px-2 text-muted'>Terminos y condiciones</a></li>";
		      	echo "<li class='nav-item'><a href='aviso-de-privacidad.php?idcliente=".$idcliente."' class='nav-link px-2 text-muted'>Aviso de privacidad</a></li>";
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