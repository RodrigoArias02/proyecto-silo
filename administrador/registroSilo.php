<?php
include ("../config/conexion.php");
if (!$db_connection) {
    echo 'error en la conexion';
} else {
    echo 'conectado la base de datos <br>';
}
if (!isset($_POST['registro_silo'])) {
    echo "no se enviaron datos";

} else {
    date_default_timezone_set('America/Argentina/buenos_aires');
    $fec_registro = date('Y-m-d', time());
    $n_silo = mysqli_real_escape_string($db_connection, $_POST['n_silo']);
    $estado = 'activo';
    $asignacion = 'no';
    $ubicacion = mysqli_real_escape_string($db_connection, $_POST['ubicacion']);
    $verificar_silo = mysqli_query($db_connection, "SELECT * FROM `registrosilo` WHERE silo='$n_silo'");
    if (mysqli_num_rows($verificar_silo) > 0) {
        ?>
        <script>
            alert("El silo ya existe")
            window.location.replace("registrarSilo.php");
        </script>
        <?php
        exit();
    }
    if (!empty($ubicacion) && !empty($n_silo)) {
        $sql_insert = "INSERT INTO registrosilo(silo,estado,asignacion,ubicacion,fec_registro) 
    VALUES ('$n_silo','$estado','$asignacion','$ubicacion','$fec_registro');";
        mysqli_query($db_connection, $sql_insert);
        ?>
        <script>
            alert("Registrado exitosamente!")
            window.location.replace("registrarSilo.php");
        </script>

        <?php
    } else {
        ?>
        <script>
            alert("Rellene campos")
            window.location.replace("registrarSilo.php");
        </script>

        <?php
    }


}
?>