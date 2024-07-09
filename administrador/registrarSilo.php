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
    <link rel="stylesheet" href="../css/registroSilo.css">
    <script src="https://kit.fontawesome.com/4989dcb279.js" crossorigin="anonymous"></script>
    <title>Registro de silos</title>
</head>
<body>
  <div class="contenedor-grid">
    <div class="grid-texto">
      <div class="caja-flex">
        <div class="imagen">
        </div>
        <div class="datos">
          <h1>Usted va a registrar un silo nuevo</h1>
            <form action="registroSilo.php" method="post">
                <div>
                  <input type="text" class="form-control" name="n_silo" id="" aria-describedby="helpId" placeholder="Número de silo">
                </div>
                <br>
                <div>
                  <input type="text" class="form-control" name="ubicacion" id="" aria-describedby="helpId" placeholder="Ubicacion del silo">
                </div>
                <div class="flex-btn">
                <a href="administrador.php"><i class="fa-solid fa-person-walking-arrow-loop-left"></i>Volver</a>
                <button type="submit" name="registro_silo">Registrar Silo</button>
                </div>
                
            </form>
          </div>
        </div>
    </div>
    <div class="grid-tabla">
      <div class="tabla">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Número de silo</th>
              <th scope="col">Estado</th>
              <th scope="col">Estado de la asignación</th>
              <th scope="col">Ubicación</th>
              <th scope="col">Fecha de registro</th>
              <th scope="col">Fecha de baja</th>
              <th scope="col">Eliminar</th>
            </tr>
          </thead>
              <?php
              //muestra la lista de usuarios ingresados en la base de datos
              require("../config/conexion.php");
              $query="SELECT * FROM registrosilo";
              $datos= mysqli_query($db_connection,$query);
              while($fila=mysqli_fetch_array($datos))
              {?>
          <tbody>
            <tr>
              <?php if($fila['silo']!=0){ ?>
              <td><?php echo $fila['silo'] ?></td>
              <td><?php echo $fila['estado'] ?></td>
              <td><?php echo $fila['asignacion'] ?></td>
              <td><?php echo $fila['ubicacion'] ?></td>
              <td><?php echo $fila['fec_registro'] ?></td>
              <td><?php echo $fila['fec_baja'] ?></td>
              <td><form action="eliminarRegistroSilo.php" method="POST"> <input type="submit" class="btn btn-danger" value="Dar de baja">    <input type="hidden" class="d-none" name="id" id="id" value="<?php echo $fila['id'];?>"></form></td>
            </tr>
                <?php
              }
                }
                  ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>