<?php
// Inicializar la sesion
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tabla.css">
    <script src="https://kit.fontawesome.com/4989dcb279.js" crossorigin="anonymous"></script>
    <title>Modificar & Eliminar empleados</title>
</head>
<body>
  <div class="volver">
    <a href="administrador.php"><i class="fa-solid fa-person-walking-arrow-loop-left"></i>Volver</a>
  </div>
    <div class="tablas">
    <table class="table table-bordered">
  <thead>
    <tr>
      
      <th scope="col">Apellido</th>
      <th scope="col">Nombre</th>
      <th scope="col">DNI</th>
      <th scope="col">Telefono</th>
      <th scope="col">Cargo</th>
      <th scope="col">Direccion</th>
      <th scope="col">Silo</th>
      <th scope="col">Fecha de ingreso</th>
      <th scope="col">Vacaciones</th>
      <th scope="col">Fecha de baja</th>
      <th scope="col">Editar</th>
      <th scope="col">Eliminar</th>
      <th scope="col">Vacaciones</th>
      <th scope="col">Asignar otro silo</th>
    </tr>
  </thead>


<?php
//muestra la lista de usuarios ingresados en la base de datos
require("../config/conexion.php");
$query="SELECT * FROM usuarios";
$datos= mysqli_query($db_connection,$query);
while($fila=mysqli_fetch_array($datos)){?>
  <tbody>
  <tr>
   
    <td><?php echo $fila['apellido'] ?></td>
    <td><?php echo $fila['nombre'] ?></td>
    <td><?php echo $fila['dni'] ?></td>
    <td><?php echo $fila['telefono'] ?></td>
    <td><?php echo $fila['cargo'] ?></td>
    <td><?php echo $fila['direccion'] ?></td>
    <td><?php echo $fila['silo'] ?></td>
    <td><?php echo $fila['fec_ing'] ?></td>
    <td><?php echo $fila['vacaciones'] ?></td>
    <td><?php echo $fila['fec_egr'] ?></td>
    <form action="editar_lista.php" method="POST">
    <td>
    <input type="text" hidden name="silo" value="<?php echo $fila['silo']; ?>">
    <input type="hidden"  name="id" id="id" value="<?php echo $fila['id'];?>">
    <input type="submit" name="editar" class="editar" value=Editar> 
    </td>
    </form>
    
    <form action="eliminar_lista.php" method="POST">
    <td><input type="submit" class="eliminar" value=Eliminar></td>
    <input type="hidden" class="d-none" name="id" id="id" value="<?php echo $fila['id'];?>">
    </form>

    <td><form action="vacaciones.php" method="post"><input type="submit" class="btn-vacaciones" name="vacaciones" value="Vacaciones"> <input type="text" name="id_empleado" hidden value="<?php echo $fila['id']; ?>"></form></td>
    <td><form action="cambiarSilo.php" method="post"><input type="submit" class="btn-silo" name="cambiar" value="Cambiar"> <input type="text" name="id_empleado" hidden value="<?php echo $fila['id']; ?>"></form></td>
    <?php
  }
  ?>
  
  </tbody>
    </table>
    </div>

    
</body>
</html>