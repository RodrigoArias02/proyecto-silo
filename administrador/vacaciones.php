<?php
if(isset($_POST['vacaciones'])){
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
                        <input type="text" name="id_empleado" hidden value="<?php echo $id_empleado ?>">
                        <label for="id">¿Esta de vacaciones?</label>
                        <div class="nombre-flex-largo">
                            <select name="select" id="">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <button type="submit" name="vacacion">Mandar a vacacionar</button>
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
    require('../config/conexion.php');
if(isset($_POST['vacacion'])){
    $vaca=$_POST['select'];
    $id_empleados=$_POST['id_empleado'];
    $sql="UPDATE usuarios SET vacaciones='$vaca' WHERE id='$id_empleados'";
    if($db_connection->query($sql)===TRUE){
        echo "usuario actualizado";
        header('location:modificarEmpleados.php');
    }else{
        echo "error al actualizar";
    }
}
?>