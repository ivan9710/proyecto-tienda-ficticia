<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sesion</title>
</head>
	
<body>
	
<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sapphire";//Los datos para poder entrar a la base de datos
  
$id = $_REQUEST['user'];  
$contra = $_REQUEST['pass'];//Los datos recuperados de la pagina de inicio de sesión
	
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT IdCliente, Nombre, Correo FROM Cliente WHERE IdCliente='$id' AND Contrasena='$contra'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {//Si se encuentra el usuario se accede y se regresa al index con la url modificada
    $id = $row["IdCliente"];
    echo "<script language='javascript'>";
      echo "alert('Has iniciado sesión');";
      echo "document.location.href='index.php?idcliente=".$id."';";
    echo "</script>";
    //header( "refresh:3;url=index.php?idcliente=".$id);
  }

} else {
    echo "<script language='javascript'>";// en dado caso de no encontrar el usuario avisa que no se encuentra y manda a la pagina para registrarse
      echo "alert('Usuario no registrado');";
      echo "document.location.href='cuenta.php';";//cambios
    echo "</script>";
  $conn->close();
  //header( "refresh:3;url=cuenta.php" );
}
?>

</body>

</html>