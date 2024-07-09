<?php
if(isset($_POST['cambiar'])){
    $id_empleado=$_POST['id_empleado'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/btn.css">
    <title>Document</title>
</head>
<body>
<div class="contenedor-flex">
        <div class="flex-caja">
            <div class="flex-imagen">
                
            </div>
            <div class="flex-registro">
                <div>
                    <h2><i class="fa-solid fa-cow"></i> Editar empleado</h2>
                </div>
                <div class="flex-hr">
                    <hr>
                </div>
                    <form action="" method="POST">
                        <?php
                        require("../config/conexion.php");
                        $query2="SELECT * FROM usuarios WHERE id='$id_empleado'";
                        $datos2= mysqli_query($db_connection,$query2);
                        while($fetch=mysqli_fetch_array($datos2)){
                            $silo_viejo=$fetch['silo'];
                        }
                        ?>
                        <input type="text" name="id_empleado" hidden value="<?php echo $id_empleado ?>">
                        <input type="text" name="siloviejo" hidden value="<?php echo $silo_viejo ?>">
                        <label for="id">Seleccione silo al cual cambiarlo</label>
                        <div class="nombre-flex-largo">
                            <select name="select" id="">
                                <option value="ninguno">Ninguno de momento</option>
                                <?php
                                
                                $query="SELECT * FROM registrosilo";
                                $datos= mysqli_query($db_connection,$query);
                                while($fila=mysqli_fetch_array($datos)){
                                    if($fila['estado']=="activo" && $fila['silo']!=0){
                                    ?>
                                <option value="<?php echo $fila['silo']; ?>"><?php echo $fila['silo']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                                
                            </select>
                        </div>
                        <button type="submit" name="cambiar2">Cambiar</button>
                    </form>
                    <div class="flex-volver">
                        <a href="administrador.php"><i class="fa-solid fa-door-open"></i> Volver</a>
                    </div>
                </div>
        </div>
    </div>
</body>
</html>

<?php
    
if(isset($_POST['cambiar2'])){
    require('../config/conexion.php');
    $silo_viejito=$_POST['siloviejo'];
    $silo_nuevo=$_POST['select'];
    $id_empleados=$_POST['id_empleado'];
    $repetido=null;
    $si="si";
    $no="no";
    $sql="UPDATE usuarios SET silo='$silo_nuevo' WHERE id='$id_empleados'";
    if($db_connection->query($sql)===TRUE){
        echo "usuario actualizado";
        header('location:modificarEmpleados.php');
    }else{
        echo "error al actualizar";
    }
    $cambiar_asignacion = "UPDATE registrosilo SET asignacion='$si' WHERE silo='$silo_nuevo'";
    mysqli_query($db_connection, $cambiar_asignacion);

    $verificar="SELECT * FROM usuarios";
    $datos3= mysqli_query($db_connection,$verificar);
    while($fetch2=mysqli_fetch_array($datos3)){

        if($silo_viejito==$fetch2['silo']){
            $repetido="si";
        }
    }
    if($repetido==null){
        $cambiar_asignacion2 = "UPDATE registrosilo SET asignacion='$no' WHERE silo='$silo_viejito'";
        mysqli_query($db_connection, $cambiar_asignacion2);
    }
    mysqli_close($db_connection);
}
?>