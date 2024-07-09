<?php 
include ("../config/conexion.php");
date_default_timezone_set('America/Argentina/buenos_aires');
$fecha = date('Y-m-d', time());
$no="no";
$repetido=null;

$query2="SELECT * FROM usuarios WHERE id=".$_POST['id'];
$datos2= mysqli_query($db_connection,$query2);
while($fetch=mysqli_fetch_array($datos2)){
    $silo_viejo=$fetch['silo'];
}
$verificar="SELECT * FROM usuarios";
$datos3= mysqli_query($db_connection,$verificar);
while($fetch2=mysqli_fetch_array($datos3)){

    if($fetch2['silo'] == $silo_viejo){
        $repetido="si";
    }else{
        $repetido=null;
    }
}
if(is_numeric($silo_viejo)){
    $query = "UPDATE usuarios SET silo='($silo_viejo)', email='',password='',fec_egr='$fecha' WHERE id=".$_POST['id'];
    mysqli_query($db_connection, $query);
    if(!$query){
        echo "error al eliminar";
    }
    if (mysqli_query($db_connection,$query)){
        header("location:modificarEmpleados.php");
    }
}else{
    ?>
    <script>
        alert("El trabajador ya fue eliminado.");
        window.location.replace("modificarEmpleados.php");
    </script>
    <?php
}
if($repetido===null){
    $cambiar_asignacion = "UPDATE registrosilo SET asignacion='$no' WHERE silo='$silo_viejo'";
    mysqli_query($db_connection, $cambiar_asignacion);
}
mysqli_close($db_connection);
?>