<?php 
include ("../config/conexion.php");
$query = "DELETE FROM silos where id=".$_POST['id'];
mysqli_query($db_connection, $query);
if(!$query){
    ?>
        <script>
            alert("error al eliminar,intentelo mas tarde")
            window.location.replace("administrador.php");
        </script>
        <?php
}
if (mysqli_query($db_connection,$query)){
    ?>
        <script>
            alert("eliminado exitosamente!")
            window.location.replace("administrador.php");
        </script>
        <?php
}
mysqli_close($db_connection);
?>
