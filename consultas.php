<?php
	/*----------------FUNCIONES GENERALES----------------*/
	// Se utiliza para mostrar una coma si los montos son mayores de $1,000
	function coma($precio){
		$cadena = $precio;

		// Contar los caracteres
		$numero_caracteres = strlen($cadena);

		// Verificar si hay más de 4 caracteres
		if ($numero_caracteres >= 4) {
		    // Insertar una coma antes de los últimos 3 caracteres
		    $cadena_modificada = substr($cadena, 0, $numero_caracteres - 3) . ',' . substr($cadena, -3);
		} else {
		    // No hay necesidad de modificar la cadena si tiene 4 o menos caracteres
		    $cadena_modificada = $cadena;
		}

		return $cadena_modificada;
	}

	/*----------------FUNCIONES DE INDEX.PHP----------------*/
	// Muestra el catalogo, a partir de las tablas producto, y stock
	function catalogo($idcliente){
		$conexion = mysqli_connect("localhost", "root", "", "sapphire") or die ("Cero Conexión");
		// Consulta a la tabla 1
		$query1 = "Select * from producto";
		$consulta1 = mysqli_query($conexion, $query1);

		// Consulta a la tabla 2
		$query2 = "select distinct ruta from stock";
		$consulta2 = mysqli_query($conexion, $query2);
		$i = 0;//Se utiliza para poner el catalogo en orden
		if ($consulta2) {
			while ($row = mysqli_fetch_assoc($consulta2)){
				//Al encontrar los datos de la tabla stock, esxtraemos los datos de la columna ruta
				$ruta = $row["ruta"];
				$idproducto = substr($ruta, -2);//A esta se le substraen los primeros dos caracteres para crear la variable $idproducto
				if ($consulta1){
					if ($row = mysqli_fetch_assoc($consulta1)){
						if ($i == 0){
			        	echo "<div class='col-md-1'></div>";
						}
						$nombre = $row["Nombre"];
						$descripcion = $row["Descripcion"];
						$precio = $row["Precio"];
						if ($idcliente == "-"){
							$href = "producto.php?producto=".$idproducto;
						} else {
							$href = "producto.php?producto=".$idproducto."&idcliente=".$idcliente;
						}
						echo "<div class='col-md-2'>
		     				<div class='card text-dark bg-light mb-5 text-center'>";
		      					echo "<a href=".$href."><img class='card-img-top' src='catalogo/0".$idproducto.".png' alt='Producto 00".$idproducto."'></a>";
								echo "<div class=card-body>
									<h5 class='card-title'>".$nombre."</h5>
			        				<p>".$descripcion."</p>
			        				<p>$".$precio.".00</p>
			        				<!--<button>Añadir al carrito</button>-->
			        			</div>
			        		</div>
			        	</div>";
			        	$i++;
			        	if ($i > 4){
			        	echo "<div class='col-md-1'></div>";
			        	$i = 0;
			        	}

			        }
				}
			}
		}
		mysqli_close($conexion);
	}

	// Muestra los productos, a partir de la o las palabras escritas en el buscador
	function buscar($search,$idcliente){
		if ($search == NULL) {//En dado caso que se apriete por error el boton de buscar
			echo "<br><br><br><div><center><h1>Por favor escriba lo que desea buscar</h1></center></div>";
 			if ($idcliente == "-"){
				$href = "index.php";
			} else {
				$href = "index.php?idcliente=".$idcliente;
			}
 			echo "<br><br><br><div><center><a href=".$href."><h1>Consulte nuestro catalogo</h1></a></center></div>";//Se pone un link para poder regresar al index, donde se encuentra el catalogo
		} else {
			$conexion = mysqli_connect("localhost", "root", "", "sapphire") or die ("Cero Conexión");
			$consulta = mysqli_query($conexion, "SELECT * FROM producto WHERE Descripcion LIKE '%$search%' OR Nombre LIKE  '%$search%'") or die ("<script language='javascript'>
					alert('Problemas con el select');
					document.location.href='index.php';
				</script>");
			$i = 0;
			if (mysqli_num_rows($consulta) > 0){
	   			// despues de verificar que si hay registro recorres el objeto
	   			echo "<br><br><br><div><center><h1>Resultados para '".$search."'</h1></center></div>";
				echo "<div class='row' style='padding-top:5%;' id='catalogo'>";
	   			while ($row = mysqli_fetch_assoc($consulta)){
	       			// imprimes los registros
	       			if ($i == 0){
				        echo "<div class='col-md-1'></div>";
					}
					$idproducto = $row["IdProducto"];
					$nombre = $row["Nombre"];
					$descripcion = $row["Descripcion"];
					$precio = $row["Precio"];
					if ($idproducto < 10){
						$idproducto = "0".$idproducto;
					}
					if ($idcliente == "-"){
						$href = "producto.php?producto=".$idproducto;
					} else {
						$href = "producto.php?producto=".$idproducto."&idcliente=".$idcliente;
					}
					echo "<div class='col-md-2'>
			     		<div class='card text-dark bg-light mb-5 text-center'>";
			      			echo "<a href=".$href."><img class='card-img-top' onmouseout=this.src='catalogo/0".$idproducto.".png'; onmouseover=this.src='catalogo/0".$idproducto."-2.png'; src='catalogo/0".$idproducto.".png' alt='Producto 00".$idproducto."'></a>";
							echo "<div class=card-body>
								<h5 class='card-title'>".$nombre."</h5>
				        		<p>".$descripcion."</p>
				        		<p>$".coma($precio).".00</p>
				        		<!--<button>Añadir al carrito</button>-->
				        	</div>
				        </div>
				    </div>";
				    $i++;
				    if ($i > 4){
				        echo "<div class='col-md-1'></div>";
				        $i = 0;
					} 
				}
			echo "</div>";
			} else {//En caso que no encuentre datos para la palabra se le notifica y se pone un enlace para regresar al catalogo
	 			echo "<br><br><br><div><center><h1>No existen resultados para '".$search."'</h1></center></div>";
	 			if ($idcliente == "-"){
					$href = "index.php";
				} else {
					$href = "index.php?idcliente=".$idcliente;
				}
	 			echo "<br><br><br><div><center><a href=".$href."><h1>Consulte nuestro catalogo</h1></a></center></div>";
	 		}
			mysqli_close($conexion);
			echo "</div>";
		}
	}

	/*----------------FUNCIONES DE PRODUCTO.PHP----------------*/
	//Muestra los datos del producto nombre y precio, dependiendo de lo que se este buscando			      	
	function dProducto($idproducto, $numero){
		$conexion = mysqli_connect("localhost", "root", "", "sapphire") or die ("Cero Conexión");
		$consulta = mysqli_query($conexion, "select * from producto where IdProducto = '$idproducto'") or die ("<script language='javascript'>
				alert('Problemas con el select');
				document.location.href='index.php';
			</script>");
		if ($consulta) {
			while ($row = mysqli_fetch_assoc($consulta)){
				$nombre = $row["Nombre"];
				$precio = $row["Precio"];
				if ($numero == "1"){
					return $nombre;
				}
				if ($numero == "2"){
					return $precio;
				}
			}
		}
		mysqli_close($conexion);
	}

	//Muestra la cantidad de productos disponibles
	function cantidad($idproducto){
		$idproducto = ltrim($idproducto, '0');
		$conexion = mysqli_connect("localhost", "root", "", "sapphire") or die ("Cero Conexión");
		$consulta = mysqli_query($conexion, "select * from stock where IdProducto = '$idproducto'") or die ("<script language='javascript'>
				alert('Problemas con el select');
				document.location.href='index.php';
			</script>");
		//echo "select * from stock where IdProducto = '$idproducto'";
		if ($consulta) {
			while ($row = mysqli_fetch_assoc($consulta)){
				$cantidad = $row["Cantidad"];
				if ($cantidad >= 5){
					return $cantidad;
				} elseif ($cantidad == 0) {
					return $cantidad;
				} else {
					return $cantidad;
				}
			}
		}
		mysqli_close($conexion);
	}

	//Agrega al carrito el producto seleccionado
	function agregarC($idcliente,$idproducto,$cantidad){

		//echo "insert into carrito (IdCliente, IdProducto, Agregado) values ('$idcliente', '$idproducto', '$cantidad')";
		$conexion = mysqli_connect("localhost", "root", "", "sapphire") or die ("Cero Conexión");
		$consulta = mysqli_query($conexion, "insert into carrito (IdCliente, IdProducto, Agregado) values ('$idcliente', '$idproducto', '$cantidad')") or die ("<script language='javascript'>
				alert('Problemas con el select agregar al carro');
				document.location.href='index.php?idcliente=".$idcliente."';
			</script>");
		if ($consulta) {
			echo "<script language='javascript'>
				alert('Producto(s) agregado(s) correctamente');
				document.location.href='index.php?idcliente=".$idcliente."';
			</script>";
		}
		mysqli_close($conexion);
		CStock ($idproducto,$cantidad,"1", $idcliente);
	}

	/*----------------FUNCIONES DE CARRITO.PHP----------------*/
	//Muestra los productos agregados al carrito 
	function mostrarC($idcliente){
		//echo "select * from carrito inner join producto on carrito.IdProducto = producto.IdProducto inner join stock on carrito.IdProducto = stock.IdProducto where carrito.IdCliente ='$idcliente'";
		$conexion = mysqli_connect("localhost", "root", "", "sapphire") or die ("Cero Conexión");
		$consulta = mysqli_query($conexion, "select * from carrito inner join producto on carrito.IdProducto = producto.IdProducto inner join stock on carrito.IdProducto = stock.IdProducto where carrito.IdCliente ='$idcliente'") or die ("<script language='javascript'>
			alert('problemas en el select');
			document.location.href='prestamos.php';
		</script>");
		$total = 0;
		$stock = "";
		$productoString = "";
		if ($consulta) {
			echo "<div class='col-md-3'>";
			while ($row = mysqli_fetch_assoc($consulta)){
				$agregado = $row["Agregado"];
				$nombre = $row["Nombre"];
				$descripcion = $row["Descripcion"];
				$precio = $row["Precio"];
				$producto = $row["IdProducto"];
				$idproducto = $row["Ruta"];
				$monto = $agregado*$precio;
					echo "<div class='card text-white bg-dark mb-4 text-center'>
		        		<img class='card-img-top' onmouseout=this.src='catalogo/".$idproducto.".png'; onmouseover=this.src='catalogo/".$idproducto."-2.png'; src='catalogo/".$idproducto.".png' alt='Producto 0".$idproducto."'>
		        		<div class='card-body'>
		       				<h3 class='card-title'>".$nombre."</h3>
		       				<p class='card-text'>".$descripcion."</p>
		       				<p class='card-text'>Precio unitario: $".coma($precio).".00</p>
		       				<p class='card-text'>Cantidad: ".$agregado."</p>
		       				<form method='POST' class='text-center'>
		       					<input type='hidden' name='idproducto' value='".$producto."'>
		       					<input type='hidden' name='stock' value='".$agregado."'>
								<input type='submit' class='btn btn-primary mr-2' name='eliminar' value='Eliminar'>
		       				</form>
		       			</div>
		    		</div>";
		    		$total = $total + $monto;
		    		$stock = $stock.$agregado."-";
		    		$productoString = $productoString.$producto."-";
		    	} if ($total != 0){
				echo "</div>
				<div class='col-md-3'>
	      			<div style='margin:25px' class='m-0 row justify-content-center text-center'>
	      				<img src='imagenes\logo.png' alt='Logo' width='50%' height='50%'>
	      				<form id='myForm' method='POST' class='text-center'>
							<input type='hidden' name='cmd' value='_xclick'>
							<input type='hidden' name='business' value='shoksito22@gmail.com'>
							<input type='hidden' name='lc' value='MX'>
							<input type='hidden' name='item_name' value='nombre'>
							<input type='hidden' name='amount' value='".coma($total).".00'>
							<input type='hidden' name='currency_code' value='MXN'>
							<input type='hidden' name='button_subtype' value='services'>
							<input type='hidden' name='no_note' value='0'>
							<input type='hidden' name='idcliente' value='".$idcliente."'>
							<input type='hidden' name='stock' value='".$stock."'>
							<input type='hidden' name='producto' value='".$productoString."'>
							<div class='form-group'>
								<h3>Monto total:</h3>
								<h1>MXN $".coma($total).".00</h1>
							</div>
							<div class='form-group' id='nota'>
								<p><strong>**NOTA**</strong></p>
								<h5><strong>Recuerda no cerrar esta página para concretar su pedido</strong></h5>
							</div>
							<div class='form-group' id='entrega' hidden>
								<p>Indicaciones de entrega</p>
								<textarea class='form-control' id='textArea' rows='3' name='entrega' required placeholder='Breve descripcion del domicilio'></textarea>
							</div>
							<div class='form-group'>
								<input type='button' id='submitButton' onclick=paypal() class='btn btn-primary mr-2' id='boton' value='Pagar'>
							</div>
							<div class='form-group'>
								<h4><strong>**NO OLVIDES MANDARNOS TU COMPROBANTE DE PAGO A NUESTRO <a href='about.php' target='_blank'>CORREO</a>**</strong></h4>
							</div>
						</form>
					</div>
	    		</div>";
	    	} else {
		    	echo "<div class='text-dark bg-white mb-4 text-center'>
				    <div>
						<h5>No hay nada aquí</h5>
				    </div>
				</div>
			</div>";
			    	
			echo "<div class='col-md-3'>
			    <div style='margin:25px' class='m-0 row justify-content-center text-center'>
			    	<a href='index.php?idcliente='".$idcliente.">
			      		<h5>Dale aquí para ir al catalogo</h5>
			      	</a>
			    </div>
			</div>";
			}

	    }

		mysqli_close($conexion);
	}

	//Agrega los productos en el carrito a la tabla pedidos concluyendo así el proceso de compra
	function comprar($idcliente,$amount,$entrega,$fechaPedido,$fechaEntrega,$stock,$producto){

		$conexion = mysqli_connect("localhost", "root", "", "sapphire") or die ("Cero Conexión");

		$consulta = mysqli_query($conexion, "select * from pedidos") or die ("<script language='javascript'>
					alert('Problemas con el select obtenerIdPedido');
				</script>");
		if ($consulta) {
			while ($row = mysqli_fetch_assoc($consulta)){
				$idpedido = $row["IdPedido"];
				}
				if ($idpedido >= 1){
					$idpedido = $idpedido + 1;
				} else {
					$idpedido = 1;
				}
				echo "<br>".$idpedido;
			}

		
		$query = "insert into pedidos (IdPedido, IdCliente, MontoAPagar, IndicacionesDeEntrega, FechaPedido, FechaEntrega) values ('$idpedido', '$idcliente', '$amount', '$entrega', '$fechaPedido', '$fechaEntrega')";
		//echo $query;

		/*----------------Agrega un producto a pedido y elimina del carrito----------------*/
		
		$conexion = mysqli_connect("localhost", "root", "", "sapphire") or die ("Cero Conexión");

		$consulta = mysqli_query($conexion, $query) or die ("<script language='javascript'>
					alert('Problemas con el select insertToPedidos');
				</script>");
		if ($consulta) {
			$consulta = mysqli_query($conexion, "delete from carrito where IdCliente = '$idcliente'") or die ("<script language='javascript'>
					alert('Problemas con el select deleteCarrito');
					document.location.href='index.php?idcliente=".$idcliente."';
				</script>");
			if ($consulta){
				echo "<script language='javascript'>
					alert('Su compra se realizó satisfactoriamente');
					document.location.href='index.php?idcliente=".$idcliente."';
				</script>";		
				//redStock($stock,$producto);
				agregarDetalle($idpedido,$idcliente,$producto,$stock);
			}
		}
		mysqli_close($conexion);

	}

	//Reduce la cantidad del stock a partir de la cantidad comprada
	function redStock($stock,$producto){

		$reducir = explode("-", $stock);
		$idproducto = explode("-",$producto);
		for ($i = 0; $i < count($idproducto); $i++) {
			for ($i = 0; $i < count($reducir); $i++) {
				if ($producto[$i] != " "){
			    	//echo "Id Producto ".$producto[$i]. "<br>";
			    	//echo "Stock ".$reducir[$i] . "<br>";
					$conexion = mysqli_connect("localhost", "root", "", "sapphire") or die ("Cero Conexión");
					$consulta = mysqli_query($conexion, "update stock set Cantidad = Cantidad - '$reducir[$i]' where IdProducto = '$idproducto[$i]'") or die ("<script language='javascript'>
							alert('Problemas con el select redStock');
						</script>");
					if ($consulta) {
						echo "";
					}
					mysqli_close($conexion);
				}
			}
		}
	}

	//La tabla detalle funciona para poder mostrar la información de los pedidos, así como la información de los productos dentro de este pedido
	function agregarDetalle($idpedido,$idcliente,$producto,$stock){

		$reducir = explode("-", $stock);
		$idproducto = explode("-",$producto);
		for ($i = 0; $i < count($idproducto); $i++) {
			for ($i = 0; $i < count($reducir); $i++) {
				if ($producto[$i] != " "){
			    	//echo "Id Producto ".$producto[$i]. "<br>";
			    	//echo "Stock ".$reducir[$i] . "<br>";
					$conexion = mysqli_connect("localhost", "root", "", "sapphire") or die ("Cero Conexión");
						$consulta = mysqli_query($conexion, "insert into Detalle (IdPedido, IdCliente, IdProducto, Comprado) values ('$idpedido', '$idcliente', '$idproducto[$i]', '$reducir[$i]')") or die ("<script language='javascript'>
								alert('Problemas con el select agregarDetalle');
							</script>");
						if ($consulta) {
							echo "";
						}
					mysqli_close($conexion);
				}
			}
		}
	}

	//Botón para eliminar el producto del carrito
	function eliminarC ($idcliente,$idproducto){

		//echo "DELETE FROM `carrito` WHERE IdCliente = "$idcliente" and IdProducto = '$idproducto'";

		$conexion = mysqli_connect("localhost", "root", "", "sapphire") or die ("Cero Conexión");
		$consulta = mysqli_query($conexion, "DELETE FROM `carrito` WHERE IdCliente = '$idcliente' and IdProducto = '$idproducto'") or die ("<script language='javascript'>
				alert('Problemas con el select eliminarC');
			</script>");
		if ($consulta) {
			echo "<script language='javascript'>
				document.location.href='carrito.php?idcliente=".$idcliente."';
			</script>";
		}
		CStock ($idproducto,$stock,"2",$idcliente);
		mysqli_close($conexion);


	}

	function CStock ($idproducto,$stock,$n, $idcliente){


		$idproducto = ltrim($idproducto, '0');
		//echo "SELECT * FROM stock where IdProducto = '$idproducto'";
		$conexion = mysqli_connect("localhost", "root", "", "sapphire") or die ("Cero Conexión");
		$consulta = mysqli_query($conexion, "SELECT * FROM stock where IdProducto = '$idproducto'") or die ("<script language='javascript'>
				alert('Problemas con el select eliminarC');
			</script>");
		if ($consulta) {
			while ($row = mysqli_fetch_assoc($consulta)){
				$cantidad = $row["Cantidad"];
			}
		}
		if ($n == "1"){
			$nuevo = $cantidad - $stock;
		}
		if ($n == "2"){
			$nuevo = $cantidad + $stock;
		}
		$consulta = mysqli_query($conexion, "UPDATE `stock` SET `Cantidad`= '$nuevo' WHERE IdProducto = '$idproducto'") or die ("<script language='javascript'>
				alert('Problemas con el select eliminarC');
			</script>");
		mysqli_close($conexion);
	}

	/*----------------FUNCIONES BARRA DE NAVEGACIÓN----------------*/
	function mostrarNombre($idcliente){
		$conexion = mysqli_connect("localhost", "root", "", "sapphire") or die ("Cero Conexión");
		$consulta = mysqli_query($conexion, "select * from cliente where IdCliente = '$idcliente'") or die ("<script language='javascript'>
				alert('Problemas con el select mostrarNombre');
			</script>");
		if ($consulta) {
			if ($row = mysqli_fetch_assoc($consulta)){
				$nombre = $row["Nombre"];
				$completo = explode(" ",$nombre);
				$primerNombre = $completo[0];
				echo $primerNombre;

			}
		}
		mysqli_close($conexion);

	}

	/*---------------- FUNCIONES DE PEDIDOS.PHP ----------------*/
	function mostrarPedidos($idcliente){

		$total = 0;
		$conexion = mysqli_connect("localhost", "root", "", "sapphire") or die ("Cero Conexión");
		$consulta = mysqli_query($conexion, "delete from detalle where IdProducto = ' '") or die ("<script language='javascript'>
			alert('problemas en el select mostrarPedidos-1');
		</script>");
		if ($consulta){
			$consulta = mysqli_query($conexion, "SELECT DISTINCT IdPedido, MontoAPagar, IndicacionesDeEntrega, FechaPedido, FechaEntrega FROM pedidos where IdCliente = '".$idcliente."'") or die ("<script language='javascript'>
				alert('problemas en el select mostrarPedidos-2');
			</script>");
			if ($consulta) {
				while ($row = mysqli_fetch_assoc($consulta)){
					$cantidadfinal = 0;
					$idpedido = $row["IdPedido"];
					$monto = $row["MontoAPagar"];
					$indicaciones = $row["IndicacionesDeEntrega"];
					$pedido = $row["FechaPedido"];
					$entrega = $row["FechaEntrega"];
					echo "<div class='card  bg-dark text-white' style='margin:25px'>
						<div class='card-body'>
					    	<p class='card-text'>Folio 000".$idpedido."</p>
					    	<h3><strong>Monto total: $".$monto.".00</strong></h3>
				       		<p>Indicaciones de entrega: ".$indicaciones."</p>
				       		<p>Fecha de pedido: ".$pedido."</p>
				       		<p>Fecha de estimada de entrega: ".$entrega."</p>
				       		<p>Detalle de los productos</p>
					  	</div>";
						$consulta2 = mysqli_query($conexion, "select distinct Nombre, Descripcion, Precio, Comprado, Ruta from detalle inner join pedidos on detalle.IdPedido = pedidos.IdPedido inner join producto on detalle.IdProducto = producto.IdProducto inner join stock on detalle.IdProducto = stock.IdProducto where detalle.IdPedido = '$idpedido' and detalle.IdCliente = '$idcliente'") or die ("<script language='javascript'>
							alert('problemas en el select mostrarPedidos-3');
							</script>");
						if ($consulta2) {
							$i = 1;
							while ($row = mysqli_fetch_assoc($consulta2)){
								$nombre = $row["Nombre"];
								$descripcion = $row["Descripcion"];
								$precio = $row["Precio"];
								$comprado = $row["Comprado"];
								$ruta = $row["Ruta"];
								echo "<div class='card-body'>
						    	<div class='row align-items-center justify-content-center'>
						      		<div class='col-md-6 justify-content-center'>
				        				<p>Producto ".$i."</p>
				        				<p>".$nombre."</p>
				        				<p>".$descripcion."</p>
				        				<p>Precio unitario: $".$precio."</P>
				        				<p>Cantidad: ".$comprado."</p>";
				        				$total = $precio * $comprado;
				        				echo "<p>Precio total: $".$total.".00</p>
						      		</div>
						      		<div class='col-md-6'>
			      						<img src='catalogo/".$ruta.".png' class='img-fluid float-left' alt='Descripción de la imagen' style='margin-right:20px'>
						      		</div>
						    	</div>
						    </div>";
						    	$i++;
						    	$cantidadfinal = $cantidadfinal + $comprado;
							}
								echo "<div class='card-body'>
									<h5><strong>Cantidad de productos del pedido: ".$cantidadfinal."</strong></h5>
								</div>";
						}
				echo "</div>";
				}
			}
		}
		mysqli_close($conexion);

	}


?>