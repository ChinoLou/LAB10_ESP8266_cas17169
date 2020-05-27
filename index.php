<?php
header("Content-type: text/html; charset=\"utf-8\"");
$id_color = 0;
$carnet = 0;
$color = 0;

//print_r($_POST);
if($_POST){
	$id_color = $_POST['id_color'];
	$carnet = $_POST['carnet'];
    $color = $_POST['color'];
	
							 //IP_BaseDatos:puerto, usuario:default-"root", password: vacío " ", NombreBaseDatosConexion: "prueba"
    $conexion = mysqli_connect("localhost:3306","root","", "prueba");   //Se hace la conexion con la base de datos llamada: prueba mediante el puerto --> 3306 de MySQL
    if(!$conexion){
        echo "Error: No se pudo conectar a MySQL.".PHP_EOL;
        echo "errno de depuración: ". mysqli_connect_errno().PHP_EOL;
        echo "error de depuración: ". mysqli_connect_error().PHP_EOL;
     
	//si se da la conexion hace este query  
    }else{  						  // inserta los datos de la tabla creada (deben ser los mismos nombres!!!)  
        $query = "INSERT INTO `datos` (`id`, `fecha`, `id_color`, `carnet`, `color`) VALUES (NULL, CURRENT_TIMESTAMP, '$id_color', '$carnet', '$color');";
        mysqli_query($conexion, $query);
	
    }
	mysqli_close($conexion);
}

$conexion = mysqli_connect("localhost:3306","root","", "prueba");
if(!$conexion){
    echo "Error: No se pudo conectar a MySQL.".PHP_EOL;
    echo "errno de depuración: ". mysqli_connect_errno().PHP_EOL;
    echo "error de depuración: ". mysqli_connect_error().PHP_EOL;
}else{
    $query = "SELECT * FROM `datos` ORDER BY id DESC LIMIT 2"; //SE LIMITA A VISUALIZAR 8 DATOS --> YA QUE SON 8 COLORES POSIBLES CON EL RGB de la TivaC
    $result = mysqli_query($conexion,$query);
	$fecha =1;
}
mysqli_close($conexion);

    
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <title>LAB10 MóduloWifi-ESP8266</title>
</head>

//---- Steven Josue Castillo Lou - Carné: 17169 Experimento 3



<body>
  <div class='container'>
    <br>
    <h1><strong> Laboratorio #10 MóduloWifi-ESP8266 (cas17169)</strong></h1>
    <br>

    <table class="table">

      <thead class="bg-primary text-white">
        <tr>
          <th>Fecha</th>
          <th>Carnet</th>
		  <th>ID_Color</th>
		  <th>Color LED - TivaC</th>
        </tr>
      </thead>
      <tbody>
        <?php
                    while($fila = mysqli_fetch_array($result)){ //se separa el arreglo de datos por filas cada vez que se manda un dato
                      echo "<tr>
                                <td>".$fila['fecha']."</td>
                                <td>".$fila['id_color']."</td>
                                <td>".$fila['carnet']."</td>
                                <td>".$fila['color']."</td>
                           </tr>";       
                        
                    }
                ?>
      </tbody>
    </table>
    <br>
    <div class="container" id="formulariodiv">
      <form id="formulario" action="index.php" method="POST" accept-charset="utf-8">
        <br><h2> Formulario </h2>
		
        <br> Carnet: <br>
        <input type="text" name="carnet" id="carnet">
		
		<br> ID_Color: <br>
        <input type="text" name="id_color" id="id_color">
		
		<br> Color LED - TivaC: <br>
        <input type="text" name="color" id="color">
		
        <br>
        <br><input type="submit" value="Enviar">
      </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
      integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
      crossorigin="anonymous"></script>
</body>

</html>