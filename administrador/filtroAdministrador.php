<?php
  $mostrar=null;
  $acumulador_temperatura=0;
  $cantidad_temperatura=0;
  $maximo_temperatura=0;
  $promedio_temperatura=0;
  $primer_valor_temperatura=null;
  $ultimo_valor_temperatura=null;

  $promedio_humedad=0;
  $acumulador_humedad=0;
  $cantidad_humedad=0;
  $maximo_humedad=0;
  $primer_valor_humedad=null;
  $ultimo_valor_humedad=null;

  $promedio_gases=0;
  $acumulador_gases=0;
  $cantidad_gases=0;
  $maximo_gases=0;
  $primer_valor_gases=null;
  $ultimo_valor_gases=null;
  require '../config/conexion.php';
  if(ISSET($_POST['filtrar'])){

    if(!empty($_POST['date1']) && !empty($_POST['date2']) && !empty($_POST['extra'])){
    $date1 = date("Y-m-d", strtotime($_POST['date1']));
    $date2 = date("Y-m-d", strtotime($_POST['date2']));
    $datoExtra=$_POST['extra'];
    }elseif(empty($_POST['date1']) && empty($_POST['date2']) && !empty($_POST['extra'])){
      $datoExtra=$_POST['extra'];
      $date1='vacio';
      $date2='vacio';
    }elseif(!empty($_POST['date1']) && !empty($_POST['date2']) && empty($_POST['extra'])){
      $date1 = date("Y-m-d", strtotime($_POST['date1']));
      $date2 = date("Y-m-d", strtotime($_POST['date2']));
      $datoExtra='vacio';
    }elseif(empty($_POST['date1']) && empty($_POST['date2']) && empty($_POST['extra'])){
      $datoExtra='vacio';
      $date1='vacio';
      $date2='vacio';
    }
    $query=mysqli_query($db_connection, "SELECT * FROM `silos` WHERE `fec_evaluacion` BETWEEN '$date1' AND '$date2'") or die(mysqli_error());
    $row=mysqli_num_rows($query);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/tabla.css">
  <script src="https://kit.fontawesome.com/4989dcb279.js" crossorigin="anonymous"></script>
  <title>Document</title>
</head>
<body>

  <div class="volver2">
    <div class="btn-volver">
      <a href="administrador.php"><i class="fa-solid fa-person-walking-arrow-loop-left"></i>Volver</a>
    </div>
    <div>
    <label for="btn-modal" class="lbl-modal">Ver mas datos</label>
    </div>
  </div>
  <input type="checkbox" id="btn-modal">

<div class="tablas">
      <table>
          <thead>

            <tr>
              <th>Numero de Silo</th>
              <th>Temperatura</th>
              <th>Humedad</th>
              <th>Gases</th>
              <th>Fecha de evaluacion</th>
              <th>Hora de evaluacion</th>
              <th>Nombre del Empleado</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </tr>
            
          </thead>
    <?php
    if($row>0){
      while($fetch=mysqli_fetch_array($query)){
?>
<tbody>
  <?php  
  if(is_numeric($datoExtra)){
    if($datoExtra == $fetch['silo']){
      include ('algoritmo.php');
  ?>
  <tr>
        <td><?php echo $fetch['silo']; ?></td>
        <td><?php echo $fetch['temperatura']; ?></td>
        <td><?php echo $fetch['humedad']; ?></td>
        <td><?php echo $fetch['gases']; ?></td>
        <td><?php echo $fetch['fec_evaluacion']; ?></td>
        <td><?php echo $fetch['hora_evaluacion']; ?></td>
        <td><?php echo $fetch['nombre_empleado']; ?></td>

        <form action="editarHistorialAdministrador.php" method="POST">
        <td><input type="submit" name="actualizar" class="editar" value=Editar> <input type="text" hidden name=silos value="<?php echo $fetch['silo']; ?>"></td>
    <input type="hidden"  name="id" id="id" value="<?php echo $fetch['id'];?>">
    </form>

	<form action="eliminarHistorialAdministrador.php" method="POST">
    <td><input type="submit" class="eliminar" value="Eliminar"></td>
    <input type="hidden" class="d-none" name="id" id="id" value="<?php echo $fetch['id'];?>">
    </form>
  </tr>
  <?php
  }
}elseif(empty($_POST['extra'])){
  ?>
    <tr>
        <td><?php echo $fetch['silo']; ?></td>
        <td><?php echo $fetch['temperatura']; ?></td>
        <td><?php echo $fetch['humedad']; ?></td>
        <td><?php echo $fetch['gases']; ?></td>
        <td><?php echo $fetch['fec_evaluacion']; ?></td>
        <td><?php echo $fetch['hora_evaluacion']; ?></td>
        <td><?php echo $fetch['nombre_empleado']; ?></td>

        <form action="editarHistorialAdministrador.php" method="POST">
        <td><input type="submit" name="actualizar" class="editar" value=Editar> <input type="text" hidden name=silos value="<?php echo $fetch['silo']; ?>"></td>
    <input type="hidden"  name="id" id="id" value="<?php echo $fetch['id'];?>">
    </form>

	<form action="eliminarHistorialAdministrador.php" method="POST">
    <td><input type="submit" class="eliminar" value="Eliminar"></td>
    <input type="hidden" class="d-none" name="id" id="id" value="<?php echo $fetch['id'];?>">
    </form>
  </tr>
  <?php
}else{
  if($datoExtra == $fetch['nombre_empleado']){
    include ('algoritmo.php');
  ?>
    <tr>
        <td><?php echo $fetch['silo']; ?></td>
        <td><?php echo $fetch['temperatura']; ?></td>
        <td><?php echo $fetch['humedad']; ?></td>
        <td><?php echo $fetch['gases']; ?></td>
        <td><?php echo $fetch['fec_evaluacion']; ?></td>
        <td><?php echo $fetch['hora_evaluacion']; ?></td>
        <td><?php echo $fetch['nombre_empleado']; ?></td>

        <form action="editarHistorialAdministrador.php" method="POST">
        <td><input type="submit" name="actualizar" class="editar" value=Editar> <input type="text" hidden name=silos value="<?php echo $fetch['silo']; ?>"></td>
    <input type="hidden"  name="id" id="id" value="<?php echo $fetch['id'];?>">
    </form>

	<form action="eliminarHistorialAdministrador.php" method="POST">
    <td><input type="submit" class="eliminar" value="Eliminar"></td>
    <input type="hidden" class="d-none" name="id" id="id" value="<?php echo $fetch['id'];?>">
    </form>
  </tr>
  <?php
  }
}
      }
  ?>
</tbody>
<?php
    }else{
      $query=mysqli_query($db_connection, "SELECT * FROM `silos`") or die(mysqli_error());
      while($fetch=mysqli_fetch_array($query)){
        if((empty($_POST['date1']) && empty($_POST['date2']) && empty($_POST['extra']))){
          include ('algoritmo.php');
          ?>
          <tbody>
            <tr>
              <td><?php echo $fetch['silo']; ?></td>
              <td><?php echo $fetch['temperatura']; ?></td>
              <td><?php echo $fetch['humedad']; ?></td>
              <td><?php echo $fetch['gases']; ?></td>
              <td><?php echo $fetch['fec_evaluacion']; ?></td>
              <td><?php echo $fetch['hora_evaluacion']; ?></td>
              <td><?php echo $fetch['nombre_empleado']; ?></td>
                  <form action="editarHistorialAdministrador.php" method="POST">
                  <td><input type="submit" name="actualizar" class="editar" value=Editar> <input type="text" hidden name=silos value="<?php echo $fetch['silo']; ?>"></td>
                <input type="hidden"  name="id" id="id" value="<?php echo $fetch['id'];?>">
                </form>
                <form action="eliminarHistorialAdministrador.php" method="POST">
              <td><input type="submit" class="eliminar" value="Eliminar"></td>
              <input type="hidden" class="d-none" name="id" id="id" value="<?php echo $fetch['id'];?>">
              </form>
            </tr>
          </tbody>
          <?php
        }elseif(empty($_POST['date1']) && empty($_POST['date2']) && !empty($_POST['extra'])){
          if(is_numeric($datoExtra)){
          ?>
          <tbody>
            <?php
            if($datoExtra == $fetch['silo']){
              include ('algoritmo.php');
                ?>
            <tr>
              <td><?php echo $fetch['silo']; ?></td>
              <td><?php echo $fetch['temperatura']; ?></td>
              <td><?php echo $fetch['humedad']; ?></td>
              <td><?php echo $fetch['gases']; ?></td>
              <td><?php echo $fetch['fec_evaluacion']; ?></td>
              <td><?php echo $fetch['hora_evaluacion']; ?></td>
              <td><?php echo $fetch['nombre_empleado']; ?></td>
                  <form action="editarHistorialAdministrador.php" method="POST">
                  <td><input type="submit" name="actualizar" class="editar" value=Editar> <input type="text" hidden name=silos value="<?php echo $fetch['silo']; ?>"></td>
                <input type="hidden"  name="id" id="id" value="<?php echo $fetch['id'];?>">
                </form>
                <form action="eliminarHistorialAdministrador.php" method="POST">
              <td><input type="submit" class="eliminar" value="Eliminar"></td>
              <input type="hidden" class="d-none" name="id" id="id" value="<?php echo $fetch['id'];?>">
              </form>
            </tr>
            <?php
            }
            ?>
          </tbody>
          <?php
          }else{
            ?>
            <tbody>
              <?php
              if($datoExtra == $fetch['nombre_empleado']){
                include ('algoritmo.php');
              ?>
              <tr>
                <td><?php echo $fetch['silo']; ?></td>
                <td><?php echo $fetch['temperatura']; ?></td>
                <td><?php echo $fetch['humedad']; ?></td>
                <td><?php echo $fetch['gases']; ?></td>
                <td><?php echo $fetch['fec_evaluacion']; ?></td>
                <td><?php echo $fetch['hora_evaluacion']; ?></td>
                <td><?php echo $fetch['nombre_empleado']; ?></td>
                    <form action="editarHistorialAdministrador.php" method="POST">
                    <td><input type="submit" name="actualizar" class="editar" value=Editar> <input type="text" hidden name=silos value="<?php echo $fetch['silo']; ?>"></td>
                  <input type="hidden"  name="id" id="id" value="<?php echo $fetch['id'];?>">
                  </form>
                  <form action="eliminarHistorialAdministrador.php" method="POST">
                <td><input type="submit" class="eliminar" value="Eliminar"></td>
                <input type="hidden" class="d-none" name="id" id="id" value="<?php echo $fetch['id'];?>">
                </form>
              </tr>
              <?php
              }
              ?>
            </tbody>
            <?php
          }
        }
      }
      }
    }
    

?>
</table>

</div>
<div class="modal">
		<div class="contenedor">
			<header>¡Bienvenidos!</header>
			<label for="btn-modal">X</label>
			<div class="contenido">
        <?php
if($datoExtra!='vacio' && is_numeric($datoExtra)){
  echo "La temperatura maxima es:",$maximo_temperatura;
  echo "<br>";
  echo "El promedio de temperatura es:",$acumulador_temperatura/$cantidad_temperatura;
  echo "<br>";
  $porcentaje_temperatura=(($primer_valor_temperatura-$ultimo_valor_temperatura)/$primer_valor_temperatura)*100;
  $porcentaje_humedad=(($primer_valor_humedad-$ultimo_valor_humedad)/$primer_valor_humedad)*100;
  $porcentaje_gases=(($primer_valor_gases-$ultimo_valor_gases)/$primer_valor_gases)*100;

  if($primer_valor_temperatura>$ultimo_valor_temperatura){
    $porcentaje_temperatura=$porcentaje_temperatura * (-1);
    $resultado_temperatura = floor(($porcentaje_temperatura*100))/100;
    echo "La temperatura bajo un:",$resultado_temperatura,"%";
  }else if($primer_valor_temperatura < $ultimo_valor_temperatura){
      $porcentaje_temperatura=$porcentaje_temperatura*(-1);
      $resultado_temperatura = floor(($porcentaje_temperatura*100))/100;
      echo "La temperatura subio un:",$resultado_temperatura,"%";
  }
  echo "<br>";
  echo "<br>";
  echo "La humedad maxima es:",$maximo_humedad;
  echo "<br>";
  echo "El promedio de humedad es:",$acumulador_humedad/$cantidad_humedad;
  echo "<br>";
  if($primer_valor_humedad>$ultimo_valor_humedad){
    $porcentaje_humedad=$porcentaje_humedad * (-1);
    $resultado_humedad = floor(($porcentaje_humedad*100))/100;
    echo "La humedad bajo un:",$resultado_humedad,"%";
  }else if($primer_valor_humedad < $ultimo_valor_humedad){
      $porcentaje_humedad=$porcentaje_humedad*(-1);
      $resultado_humedad = floor(($porcentaje_humedad*100))/100;
      echo "La humedad subio un:",$resultado_humedad,"%";
  }
  echo "<br>";
  echo "<br>";
  echo "Maximo de gases:",$maximo_gases;
  echo "<br>";
  echo "El promedio de gases es:",$acumulador_gases/$cantidad_gases;
  echo "<br>";
  if($primer_valor_gases>$ultimo_valor_gases){
    $porcentaje_gases=$porcentaje_gases * (-1);
    $resultado_gases = floor(($porcentaje_gases*100))/100;
    echo "La gases bajo un:",$resultado_gases,"%";
  }else if($primer_valor_gases < $ultimo_valor_gases){
    $porcentaje_gases=$porcentaje_gases*(-1);
    $resultado_gases = floor(($porcentaje_gases*100))/100;
    echo "La gases subio un:",$resultado_gases,"%";
  }
}else{
  echo "No hay datos ya que no se a seleccionado un silo o persona";
}
        ?>
			</div>
		</div>
	</div>
</body>
</html>