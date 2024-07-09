<?php
session_start();
require 'config/conexion.php';
date_default_timezone_set('America/Argentina/buenos_aires');
$fecha = date('d-m-y', time());
	// verifico si el usuario tiene creada la sesion previamente, si el email esta en la variable de sesion.
	if(isset($_SESSION['email']) && !empty($_SESSION['email'])){

		$email = $_SESSION['email'];
		//$cargo = $_SESSION['cargo'];
		// Traigo los datos del email correspondiente, por ej. nombre de usuario, apellido, nombre ,etc
		$get_datos_usuario = mysqli_query($db_connection, "SELECT * FROM `usuarios` WHERE email = '$email'");
		while($fetch = mysqli_fetch_array($get_datos_usuario)){
			$silo=$fetch['silo'];
			$usuario=$fetch['usuario'];
			$cargo = $fetch['cargo'];
	    }
		$datosUsuario =  mysqli_fetch_assoc($get_datos_usuario);
		// si el cargo es administrador lo manda a admin
		if($cargo == "administrador"){
			header('Location: administrador/administrador.php');
		}
	}else{
		//si no esta es porque no pasó por el formulario de login, asi que afuera
		header('Location: config/salir.php');
	exit;
}
$query="SELECT * FROM registrosilo WHERE silo='$silo'";
$datos= mysqli_query($db_connection,$query);
while($fila=mysqli_fetch_array($datos))
{
$inactivo=$fila['estado'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/empleados3434.css">
	<script src="https://kit.fontawesome.com/4989dcb279.js" crossorigin="anonymous"></script>
    <title>Inicio</title>
</head>
<body onload="startTime()">
	
<div class="grid-contenedor">
	<div class="grid-header">
		<div class="usuario-flex">
			<p style="float:right;">Nº de silo: <?php echo $silo; ?></p>
			<a href="config/salir.php"><i class="fa-solid fa-door-closed"></i> Cerrar sesion</a>
		</div>
		<div id="clockdate">
			<div class="clockdate-wrapper">
				<div id="clock"></div>
				<div id="date"></div>
			</div>
		</div>

	</div>
	<div class="grid-datos">
		<div class="fecha">
			<p><?php echo $fecha; ?></p>
		</div>
		<h1>Bienvenido <?php echo $usuario; ?></h1>
		<div class="contenedor-flex">
			<div class="flex-fondo"></div>
			<div class="flex-dato">
				<form action="empleados/registroTemperatura.php" method="post">
					<input type="text" name="nombre" hidden value="<?php echo $usuario; ?>">
					<input type="text" name="silo" hidden value="<?php echo $silo; ?>">
					<div class="input-flex">
						<div class="icono1">
						<i class="fa-solid fa-temperature-arrow-up"></i>
						</div>
						<input type="text"  pattern="[1-2-3-4-5-6-7-8-9-0]+" required class="form-control" name="temperatura" id="" aria-describedby="helpId" <?php if($inactivo=="inactivo"){ echo "disabled";}else{} ?> placeholder="Ingrese la temperatura">
					</div>
					<div class="input-flex">
						<div class="icono2">
							<i class="fa-solid fa-droplet"> </i>
						</div>
					<input type="text" class="form-control" pattern="[1-2-3-4-5-6-7-8-9-0]+" required name="humedad" id="" aria-describedby="helpId" <?php if($inactivo=="inactivo"){ echo "disabled";}else{} ?> placeholder="Ingrese la humedad">
					</div>
					<div class="input-flex">
						<div class="icono3">
							<i class="fa-brands fa-cloudscale"> </i>
						</div>
					<input type="text" class="form-control" pattern="[1-2-3-4-5-6-7-8-9-0]+" required name="gases" id="" aria-describedby="helpId" <?php if($inactivo=="inactivo"){ echo "disabled";}else{} ?> placeholder="Ingrese el nivel de gases">
					</div>
					<div class="contenedor-boton">
						<button type="submit" <?php if($inactivo=="inactivo"){ echo "disabled";}else{} ?> name="enviar">Enviar datos</button>
					</div>
				</form>
				<form action="empleados\historial.php" method="post">
					<div class="historial">
							<input type="text" name="silo" hidden value="<?php echo $silo; ?>">
							<button type="submit" name="btn-historial"><i class="fa-solid fa-box-archive"></i> Ver historial y sacar promedio</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="grid-tabla">
		
		<table>
			<thead>
				<tr>
					<th>Temperatura</th>
					<th>Humedad</th>
					<th>Nivel de gases</th>
					
				</tr>
			</thead>

			<tbody>
			<?php
				include("config/conexion.php");
				$query = mysqli_query($db_connection, "SELECT * FROM `silos` WHERE silo='$silo'");
				while($fetch = mysqli_fetch_array($query)){
            ?>
				<tr>
					<td><?php echo $fetch['temperatura'] ?></td>
					<td><?php echo $fetch['humedad'] ?></td>
					<td><?php echo $fetch['gases'] ?></td>
					
				</tr>
				<?php
			}
				?>
			</tbody>
		</table>
	
	</div>
</div>
	
</body>
<script src="js/horitas.js"></script>
</html>