<?php
session_start();
require '../config/conexion.php';	 //conexion a db
require '../config/alta_usuario.php';  //procesos de alta

// verifico si el usuario tiene creada la sesion previamente
if (isset($_SESSION['user_email'])) {
    header('Location: inicio.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registraaa.css">
    <script src="https://kit.fontawesome.com/4989dcb279.js" crossorigin="anonymous"></script>
    <title>Registrar Empleados</title>
</head>

<body>

    <div class="contenedor-flex">
        <div class="grid-caja">
            <div class="grid-imagen">

            </div>
            <div class="grid-registro">
                <div>
                    <h2><i class="fa-solid fa-cow"></i> Registro de Empleados del silo</h2>
                </div>
                <div class="flex-hr">
                    <hr>
                </div>
                <form action="" method="post">
                    <div class="nombre-flex">
                        <input type="text" name="apellido" id="" autofocus required placeholder="Apellido"
                            aria-describedby="helpId" pattern="[a-zA-Z]+" />
                        <input type="text" name="nombre" id="" required placeholder="Nombre" aria-describedby="helpId"
                            pattern="[a-zA-Z]+" />
                    </div>
                    <input type="text" name="dni" id="" class="input-solo" required placeholder="DNI" maxlength="8"
                        minlength="8" pattern="[0-9]+" />
                    <div class="nombre-flex">
                        <input type="tel" name="telefono" id="" required placeholder="Telefono"
                            aria-describedby="helpId" pattern="[1-2-3-4-5-6-7-8-9-0]+" />
                        <input type="text" name="direccion" id="" required placeholder="Direccion"
                            aria-describedby="helpId" pattern="[a-zA-Z-1-2-3-4-5-6-7-8-9-0]+" />
                    </div>
                    <div class="nombre-flex">
                        <input type="text" name="silo" id="" required placeholder=" Número de silo"
                            aria-describedby="helpId" pattern="[1-2-3-4-5-6-7-8-9-0]+" />
                        <select name="cargo" id="">
                            <option value="">Elija el cargo</option>
                            <option value="empleado">Empleado</option>
                            <option value="administrador">Admin</option>
                        </select>
                    </div>
                    <label for="">Fecha ingreso</label>
                    <input type="date" name="fec_ing" id="" class="input-solo" class="form-control" required
                        aria-describedby="helpId" pattern="[1-2-3-4-5-6-7-8-9-0]+" />
                    <div class="nombre-flex">
                        <input type="text" name="form_usuario" id="" class="form-control" required
                            placeholder="Nombre de usuario" aria-describedby="helpId" pattern="[a-zA-Z]+" />
                        <input type="email" name="form_email" required id="email" class="form-control"
                            placeholder="Ejemplo@gmail.com" aria-describedby="helpId"
                            pattern="[a-zA-Z-@-1-2-3-4-5-6-7-8-9-0]+">
                    </div>
                    <input type="password" class="input-solo" name="form_password" required id="clave"
                        class="form-control" minlength="8" placeholder="Contraseña" aria-describedby="helpId"
                        pattern="[a-zA-Z-@-1-2-3-4-5-6-7-8-9-0]+">
                    <div class="contenedor-btn">
                        <button type="submit" name="enviar" class="btn">Registrar</button>
                    </div>

                    <?php
                    //mensajes de alerta
                    //en caso de exito mostrar mensaje exitoso
                    if (isset($success_message)) {
                        echo '<div class="success_message">' . $success_message . '</div>';
                    }
                    //en caso de error mostrar mensaje con error
                    if (isset($error_message)) {
                        echo '<div class="error_message">' . $error_message . '</div>';
                    }
                    ?>
                </form>
            </div>
            <div class="grid-volver">
                <a href="administrador.php"><i class="fa-solid fa-door-open"></i> Volver</a>
            </div>
        </div>
    </div>
</body>

</html>