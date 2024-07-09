<?php 
include ("../config/conexion.php");
date_default_timezone_set('America/Argentina/buenos_aires');
$fecha = date('Y-m-d', time());

$query = "UPDATE registrosilo SET estado='inactivo',asignacion='no',fec_baja='$fecha' WHERE id=".$_POST['id'];
mysqli_query($db_connection, $query);
if(!$query){
    echo "error al eliminar";
}
if (mysqli_query($db_connection,$query)){
    header("location:registrarSilo.php");
}
mysqli_close($db_connection);
?>