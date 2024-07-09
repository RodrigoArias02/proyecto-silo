<?php
session_start();
require 'config/conexion.php'; //configuración conexión db
require 'config/login.php';	   //procesos de login


// verifico si el usuario tiene creada la sesion previamente
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/log1.css">
    <link rel="icon" href="img/silo.png">
    <script src="https://kit.fontawesome.com/4989dcb279.js" crossorigin="anonymous"></script>
    <title>Iniciar Sesion</title>
</head>
<body>
<div class=contenedor>
        <div class=cajalogin>
            <div class=grid-parte1>
        <form action="" method="post">
          <div class=flexbox>
            <h1><i class="fa-solid fa-user" style="color:#2887ce;"> </i> ¡Hora de trabajar!</h1>
            <p class=hola >Inicie sesion en su cuenta</p>
            <input type="email" name="form_email" pattern="[a-zA-Z-@-1-2-3-4-5-6-7-8-9-0]+" required id="email" class="form-control" placeholder="Ejemplo@gmail.com">
            <input type="password" name="form_password"minlength="8" required id="clave" class="form-control" placeholder="Contraseña" pattern="[a-zA-Z-1-2-3-4-5-6-7-8-9-0]+">
            <input type="submit" class="boton" value=LOGIN name=btn>
            <?php
            //mensajes de alerta

            //en caso de exito mostrar mensaje exitoso
            if(isset($success_message)){
              echo '<div class="success_message">'.$success_message.'</div>'; 
            }
            //en caso de error mostrar mensaje con error
            if(isset($error_message)){
              echo '<div class="error_message">'.$error_message.'</div>'; 
            }	
            ?>
          </div>
           
        </form>      
      </div>
      <div class=grid-parte2>
        <div class=foto></div>
      </div>
    </div>
  </div>
</body>
</html>