<?php
require '../config/conexion.php';
if(isset($_POST['actualizar'])){
	$silo=$_POST['silos'];
}
if(isset($_POST['update'])){
    $temperatura=$_POST['temperatura'];
    $humedad=$_POST['humedad'];
    $gases=$_POST['gases'];
    
    $sql="UPDATE silos SET temperatura='$temperatura',humedad='$humedad',gases='$gases' WHERE id=".$_POST['id'];

    if($db_connection->query($sql)===TRUE){
        ?>
        <script>
            alert("Modificacion correcta")
            window.location.replace('administrador.php');
        </script>
    <?php
    }else{
        ?>
        <script>
            alert("error al actualizar")
            window.location.replace('administrador.php');
        </script>
    <?php
    }
}


$id=isset($_POST['id'])?(int)$_POST['id'] :0;

$sql="SELECT * FROM silos WHERE id={$id}";
$result=mysqli_query($db_connection,$sql);

$row= mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/editar.css">
	<script src="https://kit.fontawesome.com/4989dcb279.js" crossorigin="anonymous"></script>
    <title>Editar</title>
</head>
<body>
<div class="grid-contenedor">
	<div class="grid-header">
		<div class="usuario-flex">
			<p style="float:right;">Nº de silo: <?php echo $silo; ?></p>
			<a href="../inicio.php"><i class="fa-solid fa-person-walking-arrow-loop-left"></i>Volver</a>
		</div>
	</div>
	<div class="grid-datos">
		
		<div class="contenedor-flex">
			<div class="flex-fondo"></div>
			<div class="flex-dato">
				<form action="" method="post">
					
					<div class="input-flex">
						<div class="icono1">
						<i class="fa-solid fa-temperature-arrow-up"></i>
						</div>
                        <input type="hidden" value="<?php echo $row['id'];?>" name="id">

						<input type="text" pattern="[1-2-3-4-5-6-7-8-9-0]+" value="<?php echo $row['temperatura']; ?>" required class="form-control" name="temperatura" id="" aria-describedby="helpId" placeholder="Ingrese la temperatura">
					</div>
					<div class="input-flex">
						<div class="icono2">
							<i class="fa-solid fa-droplet"> </i>
						</div>
					<input type="text" class="form-control" pattern="[1-2-3-4-5-6-7-8-9-0]+" value="<?php echo $row['humedad']; ?>" required name="humedad" id="" aria-describedby="helpId" placeholder="Ingrese la humedad">
					</div>
					<div class="input-flex">
						<div class="icono3">
							<i class="fa-brands fa-cloudscale"> </i>
						</div>
					<input type="text" class="form-control" pattern="[1-2-3-4-5-6-7-8-9-0]+" required name="gases" value="<?php echo $row['gases']; ?>" id="" aria-describedby="helpId" placeholder="Ingrese el nivel de gases">
					</div>
					<div class="contenedor-boton">
						<button type="submit" name="update">Modificar</button>
					</div>
				</form>