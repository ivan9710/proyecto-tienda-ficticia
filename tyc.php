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
	<title>SAPPHIRE CARE |TÉRMINOS Y CONDICIONES</title>
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

	<!-- TYC -->

	<div class="bd-example bg-light text-dark" style="margin-top: 50px;">
	  	<div class="row">
	    	<div class="col-4">
	      		<nav class="navbar navbar-dark flex-column">
	        		<a class="navbar-brand" href="#item-0">TERMINOS Y CONDICIONES</a>
		        	<nav class="nav nav-pills flex-column">
		        		<a class="navbar-link" href="#item-l">1. USO Y RESTRICCIONES</a>
		        		<nav class="nav nav-pills flex-column">
		          			<a class="nav-link" href="#item-1-1">1.1. RESTRICCIONES</a>
		  				</nav>
		        		<a class="navbar-link" href="#item-2">2. PROPIEDAD INTELECTUAL</a>
		        		<a class="navbar-link" href="#item-3">3. PROPIEDAD INTELECTUAL DE TERCEROS</a>
		        		<a class="navbar-link" href="#item-4">4. CALIDAD DE LOS SERVICIOS Y CONTENIDOS</a>
		        		<a class="navbar-link" href="#item-5">5. BIENES Y SERVICIOES DE TERCEROS ENLAZADOS</a>
		        		<a class="navbar-link" href="#item-6">6. CONFIDENCIALIDAD</a>
		        		<a class="navbar-link" href="#item-7">7. USO DE LA INFORMACIÓN NO CONFIDENCIAL O INDIVIDUAL</a>
		        		<a class="navbar-link" href="#item-8">8. COOKIES</a>
		        		<a class="navbar-link" href="#item-9">9. AVISO DE PRIVACIDAD DE DATOS PERSONALES</a>
		        		<a class="navbar-link" href="#item-10">10. CLAVES DE ACCESO</a>
		        		<a class="navbar-link" href="#item-11">11. GEOLOCALIZACIÓN</a>
		        		<a class="navbar-link" href="#item-12">12. MODIFICACIONES</a>
		        		<a class="navbar-link" href="#item-13">13. LEYES APLICABLES Y JURISDICCIÓN</a>
		        	</nav>
				</nav>
	    	</div>
		    <div class="col-8">
		      	<div data-spy="scroll" data-target="#navbar-example3" data-offset="0" class="scrollspy-example-2">

		      		<h1 id="item-0">TÉRMINOS Y CONDICIONES</h1>
		      		<p>A los Usuarios les informamos de los siguientes Términos y Condiciones de Uso  y Privacidad, les son aplicables por el simple uso o acceso a cualquiera de las  páginas que integran el Portal de “Sapphire Care” (en adelante conjuntamente  e indistintamente el "Portal"), por lo que entenderemos que los acepta, y acuerda  en obligarse en su cumplimiento.</p> 
					<p>En el caso de que no esté de acuerdo con los Términos y Condiciones de Uso y  Privacidad deberá abstenerse de acceder o utilizar el Portal. </p>
					<p>La empresa “Sapphire Care” S.A. de C.V., al igual que el Portal han sido  desarrollados con fines académicos para la materia de “Seminario de  Programación en Internet II”. La empresa y los productos que se presentan en el  sitio son ficticios y no representan una empresa real. El sitio web se desarrolló  con fines académicos y de demostración de los conocimientos obtenidos en la  materia, por lo que no tiene fines comerciales ni de lucro.</p>  
					<p>Al acceder y al utilizar el sitio el usuario acepta que la información proporcionada  es sólo para fines académicos o de demostración y que no se ofrece ninguna  garantía sobre la precisión o veracidad de la información presentada.</p>  
					<p>“Sapphire Care” no tiene ningún tipo de responsabilidad legal ni comercial ante  los usuarios del sitio web, además de que se reservan el derecho de modificar  discrecionalmente el contenido del Portal en cualquier momento, sin necesidad  de previo aviso.</p> 
					<p>El usuario entendido como aquella persona que realiza el uso o acceso mediante  equipo de cómputo y/o de comunicación (en adelante el “Usuario”), conviene en  no utilizar dispositivos, software, o cualquier otro medio tendiente a interferir tanto  en las actividades y/u operaciones del Portal o en las bases de datos y/o  información que se contenga en el mismo.
					</p>

					<h2 id="item-1">1. Uso y restricciones</h2>
		        	<p>El acceso o utilización del Portal expresa la adhesión plena y sin reservas del  Usuario a los presentes Términos y Condiciones de Uso y Privacidad. A través  del Portal, el Usuario se servirá y/o utilizará diversos servicios y contenidos (en  lo sucesivo, los "Servicios y Contenidos"), puestos a disposición de los Usuarios  por “Sapphire Care”, y/o por terceros proveedores de Servicios y Contenidos.  “Sapphire Care” tendrá el derecho a negar, restringir o condicionar al Usuario  el acceso al Portal, total o parcialmente, a su entera discreción, así como a  modificar los Servicios y Contenidos del Portal en cualquier momento y sin  necesidad de previo aviso.</p> 
					<p>El Usuario reconoce que no todos los Servicios y Contenidos están disponibles  en todas las áreas geográficas y que algunos Servicios y Contenidos pueden ser  utilizados solamente con posterioridad a su contratación, activación o registro  previo por el Usuario y/o mediante el pago de una comisión, según se indique en  las condiciones de contratación que se establezcan en la documentación  respectiva. “Sapphire Care” no garantiza la disponibilidad y continuidad de la operación del Portal y de los Servicios y Contenidos, ni la utilidad del Portal o los  Servicios y Contenidos en relación con cualquier actividad específica,  independientemente del medio de acceso que utilice el Usuario incluido la  telefonía móvil. “Sapphire Care” no será responsable por daño o pérdida  alguna de cualquier naturaleza que pueda ser causado debido a la falta de  disponibilidad o continuidad de operación del Portal y/o de los Servicios y  Contenidos.</p> 
					<p>El aprovechamiento de los Servicios y Contenidos del Portal es exclusiva  responsabilidad del Usuario, quien en todo caso deberá servirse de ellos acorde  a las funcionalidades permitidas en el propio Portal y a los usos autorizados en  los presentes Términos y Condiciones de Uso y Privacidad, por lo que el Usuario  se obliga a utilizarlos de modo tal que no atenten contra las normas de uso y  convivencia en Internet, las leyes de los Estados Unidos Mexicanos y la  legislación vigente en el país en que el Usuario se encuentre al usarlos, las  buenas costumbres, la dignidad de la persona y los derechos de terceros. El  Portal es para el uso individual del Usuario por lo que no podrá comercializar de  manera alguna los Servicios y Contenidos.</p>
		        
		        	<h5 id="item-1-1">1.1. Restricciones</h5>
		        	<p>El Usuario no tiene el derecho de colocar híper ligas dentro del Portal, a utilizar  las ligas del Portal, ni el derecho de colocar o utilizar los Servicios y Contenidos  en sitios o páginas propias o de terceros sin autorización previa y por escrito de  “Sapphire Care”. Asimismo, el Usuario no tendrá el derecho de limitar o  impedir a cualquier otro Usuario el uso del Portal.</p>
		        
		        	<h2 id="item-2">2. Propiedad intelectual</h2>
		        	<p>Los derechos de propiedad intelectual respecto de los Servicios y Contenidos y  los signos distintivos y dominios de las Páginas o el Portal, así como los derechos  de uso y explotación de los mismos, incluyendo su divulgación, publicación,  reproducción, distribución y transformación, son propiedad exclusiva de “inserte  nombre”. El Usuario no adquiere ningún derecho de propiedad intelectual por el  simple uso o acceso de los Servicios y Contenidos del Portal y en ningún  momento dicho uso será considerado como una autorización o licencia para  utilizar los Servicios y Contenidos con fines distintos a los que se contemplan en  los presentes Términos y Condiciones de Uso y Privacidad y a los contratos  respectivos.</p>
		        
		        	<h2 id="item-3">3. Propiedad intelectual de terceros</h2>
		        	<p>Utilizamos <strong>cookies</strong> para mejorar nuestros servicios y mostrarle publicidad relacionada con sus preferencias de navegación y el contenido de sus visitas anteriores. Al visitar nuevamente los sitios web del Responsable, las <strong>cookies</strong> nos pueden permitir personalizar nuestro contenido de acuerdo con sus preferencias.</p>
		        	<p>Hacemos notar que las páginas de internet del Responsable no usan o guardan <strong>cookies</strong> para obtener datos de identificación personal de la computadora del Titular que no se hayan enviado originalmente como parte de la cookie. Aunque la mayoría de los navegadores aceptan <strong>cookies</strong>, el titular puede configurar su navegador para que no los acepte. Estas tecnologías pueden deshabilitarse siguiendo los procedimientos respectivos a cada navegador, sin embargo, debe tomar en cuenta que desactivarlas podría limitar el funcionamiento que ofrece la plataforma.</p>
		        
		        	<h2 id="item-4">4. Calidad de los servicios y contenidos</h2>
		        	<p>Ni “Sapphire Care”, ni sus proveedores o socios comerciales serán  responsables de cualquier daño o perjuicio que sufra el Usuario a consecuencia de inexactitudes, consultas realizadas, asesorías, errores tipográficos y cambios  o mejoras que se realicen periódicamente a los Servicios y Contenidos. Las  recomendaciones y consejos obtenidos a través del Portal son de naturaleza  general, por lo que no deben tomarse en cuenta en la adopción de decisiones  personales ni profesionales. Para ello se debe consultar a un profesional  apropiado que pueda asesorar al Usuario de acuerdo con sus necesidades  específicas.</p>

		        	<h2 id="item-5">5. Bienes y servicios de terceros enlazados</h2>
		        	<p>El hecho de que se ofrezca información en el Portal o en otros ligados o  vinculados, no implica la recomendación, garantía, patrocinio o aprobación por  parte de “Sapphire Care” respecto de dicha información, bienes y/o servicios.  La disponibilidad de bienes y/o servicios ofertados por terceros o por sitios  ligados o vinculados, no es responsabilidad de “Sapphire Care”. En vista de lo  anterior, “Sapphire Care” no será responsable ante cualquier autoridad de  cualquier naturaleza, por cualquier asunto relacionado con la venta, consumo,  distribución, entrega, disponibilidad o prestación con respecto de cualquiera de  los bienes y/o servicios ofertados por terceros o por sitios ligados o vinculados a  través del Portal.</p>
		        	<p>Respecto de los Servicios y Contenidos que prestan terceros dentro o mediante  enlaces a la Página (tales como ligas, banners y botones), “Sapphire Care” se  limita exclusivamente, para conveniencia del Usuario, a: (i) informar al Usuario  sobre los mismos, y (ii) a proporcionar un medio para poner en contacto al  Usuario con proveedores o vendedores. Los productos y/o servicios que se  comercializan dentro del Portal y/o en los sitios de terceros enlazados son  suministrados por comerciantes independientes a “Sapphire Care”. No existe  ningún tipo de relación laboral, asociación o sociedad, entre “Sapphire Care” y  dichos terceros. Toda asesoría, consejo, declaración, información y contenido de  las páginas de terceros enlazadas o dentro del Portal representan las opiniones  y juicios de dicho tercero, consecuentemente, “Sapphire Care” no será  responsable de ningún daño o perjuicio que sufra el Usuario a consecuencia de  los mismos.</p>

		        	<h2 id="item-6">6. Confidencialidad</h2>
		        	<p>“Sapphire Care” se obliga a mantener confidencial la información que reciba  del Usuario que tenga dicho carácter conforme a las disposiciones legales  aplicables, en los Estados Unidos Mexicanos. “Sapphire Care” no asume  ninguna obligación de mantener confidencial cualquier otra información que el  Usuario le proporcione, ya sea al inscribirse al Portal o en cualquier otro  momento posterior, incluyendo aquella información que el Usuario proporcione  a través de boletines, pizarras o plática en línea (chats); así como, la información  que obtenga el Grupo Financiero Banamex a través de las Cookies que se  describen en inciso 8.</p>

		        	<h2 id="item-7">7. Uso de la información no confidencial o individual</h2>
		        	<p>Mediante el uso del Portal, el Usuario autoriza a “Sapphire Care” a utilizar,  publicar, reproducir, divulgar, comunicar públicamente y transmitir la información  no confidencial o no individual, en términos de lo establecido en el artículo 109  de la Ley Federal de los Derechos de Autor y de la fracción I, del artículo 76 bis  de la Ley Federal de Protección al Consumidor.</p>

		        	<h2 id="item-8">8. Cookies</h2>
		        	<p>El Usuario que tenga acceso al Portal, conviene recibir archivos que les  transmitan los servidores de “Sapphire Care”. "Cookie" significa un archivo de  datos que se almacena en el disco duro de la computadora del Usuario cuando  éste tiene acceso a la Página. Dichos archivos pueden contener información tal  como la identificación proporcionada por el Usuario o información para rastrear  las páginas que el Usuario ha visitado. Una Cookie no puede leer los datos o  información del disco duro del Usuario ni leer las Cookies creadas por otros sitios  o páginas.</p>

		        	<h2 id="item-9">9. Aviso de privacidad de datos personales</h2>
		        	<p>Toda la información que “Sapphire Care” recabe del Usuario es tratada con  absoluta confidencialidad conforme las disposiciones legales aplicables. </p>

		        	<h2 id="item-10">10. Claves de acceso</h2>
		        	<p>En todo momento, el Usuario es el responsable único y final de mantener en  secreto sus claves de acceso con la cual tenga acceso a ciertos Servicios y  Contenidos del Portal; así como a las páginas de terceros. </p>

		        	<h2 id="item-11">11. Geolocalización</h2>
		        	<p>Para cumplir con regulaciones y en otros casos para implementar medidas de  seguridad, durante la sesión de banca electrónica por internet, “inserte  nombre” puede recopilar y usar información que identifica la ubicación del  dispositivo por medio del cual el Usuario ingresará a los Servicios y Contenidos  de dicha banca electrónica, mediante el uso de coordenadas de latitud y longitud  y otros medios (en adelante la "Geolocalización"). En caso de que el Usuario no  esté de acuerdo en que se recabe la Geolocalización de su dispositivo deberá  abstenerse de ingresar a la banca electrónica por internet.</p>

		        	<h2 id="item-12">12. Modificaciones</h2>
		        	<p>“Sapphire Care” tendrá el derecho de modificar en cualquier momento los  Términos y Condiciones de Uso y Privacidad. En consecuencia, el Usuario debe  leer atentamente los Términos y Condiciones de Uso y Privacidad cada vez que  pretenda utilizar el Portal. Ciertos Servicios y Contenidos ofrecidos a los Usuarios  en y/o a través del Portal están sujetos a condiciones particulares propias que  sustituyen, completan y/o modifican los Términos y Condiciones de Uso y  Privacidad (en lo sucesivo, las "Condiciones Particulares"). Consiguientemente,  el Usuario también debe leer atentamente las correspondientes Condiciones  Particulares antes de acceder a cualquiera de los Servicios y Contenidos.</p>
		        	<p>De conformidad con la legislación aplicable ciertos servicios requerirán de la  instalación de herramientas de protección para la información que se solicite, por lo que el servicio será negado en caso de no ser aceptada la instalación requerida.</p>

		        	<h2 id="item-13">13. Leyes aplicables y jurisdicción</h2>
		        	<p>Para la interpretación, cumplimiento y ejecución de los presentes Términos y  Condiciones de Uso y Privacidad, el Usuario está de acuerdo en que serán  aplicables las leyes Federales de los Estados Unidos Mexicanos y competentes  los tribunales de la Ciudad de México, renunciando expresamente a cualquier  otro fuero o jurisdicción que pudiera corresponderles en razón de sus domicilios  presentes o futuros o por cualquier otra causa.</p>
		        
		      	</div>
		    </div>
	  	</div>
	</div>

	<!-- FIN TYC -->
	
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
