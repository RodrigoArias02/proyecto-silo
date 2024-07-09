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
    <link rel="stylesheet" href="../css/btn.css">
    <script src="https://kit.fontawesome.com/4989dcb279.js" crossorigin="anonymous"></script>
    <title>Editar Empleado</title>
</head>
<body>
    <?php
    require('../config/conexion.php');
    if(isset($_POST['update'])){
        $apellido=$_POST['apellido'];
        $nombre=$_POST['nombre'];
        $query = mysqli_query($db_connection, "SELECT * FROM `registrosilo` WHERE silo=".$_POST['silo']);
        $estado=null;
        while($fetch = mysqli_fetch_array($query)){
            $estado = $fetch['estado'];
        }
        if($estado=="activo"){
            $sql="UPDATE usuarios SET apellido='$apellido',nombre='$nombre' WHERE id=".$_POST['id'];
            if($db_connection->query($sql)===TRUE){
                ?><script>alert("Actualizado con exito!!")</script><?php
                 header('location:modificarEmpleados.php');
            }else{
                echo "error al actualizar";
            }

        }else if($estado=="inactivo"){
            ?>
            <script>
                alert("el silo esta inactivo")
                window.location.replace("../administrador/modificarEmpleados.php");
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("el silo no fue registrado")
                 window.location.replace("../administrador/modificarEmpleados.php");
            </script>
            <?php
        }
    }


    $id=isset($_POST['id'])?(int)$_POST['id'] :0;

    $sql="SELECT * FROM usuarios WHERE id={$id}";
    $result=mysqli_query($db_connection,$sql);
    $row= mysqli_fetch_assoc($result);

    ?>
 <div class="contenedor-flex">
        <div class="flex-caja">
            <div class="flex-imagen-editar">
                
            </div>
            <div class="flex-registro">
                <div>
                    <h2><i class="fa-solid fa-cow"></i> Editar empleado</h2>
                </div>
                <div class="flex-hr">
                    <hr>
                </div>
                    <form action="" method="POST">
                        
                        <div class="nombre-flex-largo">
                            <input type="text" readonly="" hidden value="<?php echo $row['id'];?>" name="id">
                            <input type="text" readonly="" hidden value="<?php echo $row['silo'];?>" name="silo">
                        </div>
                        <label>Apellido</label>
                        <div class="nombre-flex-largo">
                            <input type="text" name="apellido" id="apellido" value="<?php echo $row['apellido']; ?>">
                        </div>
                        <label>Nombre</label>
                        <div class="nombre-flex-largo">
                            <input type="text" name="nombre" id="nombre" value="<?php echo $row['nombre']; ?>">
                        </div>
                        <button type="submit" name="update" value="Actualizar">Registrar</button>
                    </form>
                    <div class="flex-volver">
                        <a href="administrador.php"><i class="fa-solid fa-door-open"></i> Volver</a>
                    </div>
                </div>
        </div>
    </div>
    
</body>
</html>