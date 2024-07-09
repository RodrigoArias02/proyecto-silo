<?php
include("../config/conexion.php");
if(!$db_connection){
    echo 'error en la conexion';
}else{
    echo 'conectado la base de datos <br>';
}
if(!isset($_POST['enviar'])){ 
    echo"no se enviaron datos";   

}else{
$nombre=mysqli_real_escape_string($db_connection,$_POST['nombre']);
$silo=mysqli_real_escape_string($db_connection,$_POST['silo']);
$temperatura=mysqli_real_escape_string($db_connection,$_POST['temperatura']);
$humedad=mysqli_real_escape_string($db_connection,$_POST['humedad']);
$gases=mysqli_real_escape_string($db_connection,$_POST['gases']);

date_default_timezone_set('America/Argentina/buenos_aires');
$hora = date("H:i:s"); 
$fecha = date('Y-m-d', time());

$sql_insert = "INSERT INTO silos(silo,temperatura,humedad,gases,fec_evaluacion,hora_evaluacion,nombre_empleado) 
VALUES ('$silo','$temperatura','$humedad','$gases','$fecha','$hora','$nombre');";
mysqli_query($db_connection,$sql_insert);
?>
<script>
    alert("registrado exitosamente!")
    window.location.replace("../inicio.php");
</script>
<?php
}
?>

