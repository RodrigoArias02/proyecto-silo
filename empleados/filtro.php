
<?php
  require '../config/conexion.php';
  if(ISSET($_POST['filtrar'])){
    $silo=$_POST['silo'];
    $date1 = date("Y-m-d", strtotime($_POST['date1']));
    $date2 = date("Y-m-d", strtotime($_POST['date2']));
    $query=mysqli_query($db_connection, "SELECT * FROM `silos` WHERE `fec_evaluacion` BETWEEN '$date1' AND '$date2'") or die(mysqli_error());
    $row=mysqli_num_rows($query);
    ?>
    <table>
        <thead>

          <tr>
            <th>Id</th>
            <th>Número de silo</th>
            <th>Temperatura</th>
            <th>Humedad</th>
            <th>Gases</th>
            <th>Fecha de la evaluación</th>
            <th>Hora de la evaluación</th>
            <th>Nombre del empleado</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr>  
        </thead>
    <?php
    if($row>0){
      while($fetch=mysqli_fetch_array($query)){
        if($fetch['silo']==$silo){
    
?>
<tbody>
  <tr>
        <td><?php echo $fetch['id']; ?></td>
        <td><?php echo $fetch['silo']; ?></td>
        <td><?php echo $fetch['temperatura']; ?></td>
        <td><?php echo $fetch['humedad']; ?></td>
        <td><?php echo $fetch['gases']; ?></td>
        <td><?php echo $fetch['fec_evaluacion']; ?></td>
        <td><?php echo $fetch['hora_evaluacion']; ?></td>
        <td><?php echo $fetch['nombre_empleado']; ?></td>
        
	<form action="editar.php" method="POST">
    <td><input type="submit" value=Editar></td>
    <input type="hidden"  name="id" id="id" value="<?php echo $fetch['id'];?>">
    </form>

	<form action="eliminar.php" method="POST">
    <td><input type="submit"  value="Eliminar"></td>
    <input type="hidden" class="d-none" name="id" id="id" value="<?php echo $fetch['id'];?>">
    </form>
  </tr>
</tbody>
<?php
      }
      }
    }else{
      echo'
      <tr>
        <td colspan = "4"><center>Los registros no existen</center></td>
      </tr>';
    }
  }else{
    $query=mysqli_query($db_connection, "SELECT * FROM `silos`") or die(mysqli_error());
    while($fetch=mysqli_fetch_array($query)){
      if($fetch['silo']==$silo){
?>
<tbody>
  <tr>
        <td><?php echo $fetch['id']; ?></td>
        <td><?php echo $fetch['silo']; ?></td>
        <td><?php echo $fetch['temperatura']; ?></td>
        <td><?php echo $fetch['humedad']; ?></td>
        <td><?php echo $fetch['gases']; ?></td>
        <td><?php echo $fetch['fec_evaluacion']; ?></td>
        <td><?php echo $fetch['hora_evaluacion']; ?></td>
        <td><?php echo $fetch['nombre_empleado']; ?></td>
  </tr>
</tbody>
<?php
    }
    }
  }
?>
</table>