<?php
session_start();
require '../config/conexion.php';

	// verifico si el usuario tiene creada la sesion previamente, si el email esta en la variable de sesion.
	if(isset($_SESSION['email']) && !empty($_SESSION['email'])){

		$email = $_SESSION['email'];
		//$cargo = $_SESSION['cargo'];
		// Traigo los datos del email correspondiente, por ej. nombre de usuario, apellido, nombre ,etc
		$get_datos_usuario = mysqli_query($db_connection, "SELECT * FROM `usuarios` WHERE email = '$email'");
		while($fetch = mysqli_fetch_array($get_datos_usuario)){
			$silo=$fetch['silo'];
			$nombre=$fetch['nombre'];
			$cargo = $fetch['cargo'];
	    }
		$datosUsuario =  mysqli_fetch_assoc($get_datos_usuario);
		// si el cargo es administrador lo manda a admin
		if($cargo == "empleado"){
			header('Location: ../inicio.php');
		}
	}else{
		//si no esta es porque no pasó por el formulario de login, asi que afuera
		header('Location: ../config/salir.php');
	exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/admin1.css">
	<link rel="icon" href="../img/silo.png">
	<script src="https://kit.fontawesome.com/4989dcb279.js" crossorigin="anonymous"></script>
    <title>Administrador</title>
</head>
<body>
	<div class="grid-contenedor">
		<div class="grid-header">
			<header>
				<div class="logo">
					<i class="fa-solid fa-tractor"></i>
					<div class="nombre">
					<p class="luroweb">AgroSilo</p>
					<p class="corporation">CORPORATION</p>
					</div>
				</div>
				<nav id="menu">
					<ul>
						<li><a href="registrarSilo.php">Registrar silo</a></li>
						<li><a href="historialAdministrador.php">Historial del mantenimiento del silo</a></li>
						
					</ul>
				</nav>
				<div class="menu-toggle">
					<i class="fa-solid fa-ellipsis"></i>
				</div>
			</header>
		</div>
		<div class="grid-cuerpo">
			<div class=grid-elegir>
				<a href="registrarEmpleados.php">
					<div class=grid-fotos>
						<div class=fondo-imagen></div>
						<div class=texto><h2>Registrar trabajador</h2></div>
					</div>
				</a>
				<a href="modificarEmpleados.php">
					<div class=grid-videos>
						<div class=fondo-video></div>
						<div class=texto><h2>Historial de empleados</h2></div>
					</div>
				</a>
				<div class=grid-volver>
					<div class=flex-volver>
						<a href="../config/salir.php" class=fuente-icono>  <i class="fa-solid fa-door-closed"> </i>  <p>  Cerrar sesion</p></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="../js/menu1.js"></script>
</html>