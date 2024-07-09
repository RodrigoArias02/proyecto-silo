<?php

//Archivo con las consultas para el alta del usuario

//verifico que haya enviado los 3 campos
if(isset($_POST['form_usuario']) && isset($_POST['form_email']) && isset($_POST['form_password'])){

    // Verifico que los campos enviados desde el formulario no esten vacios y quito espacios en blanco
	if(!empty(trim($_POST['form_usuario'])) && !empty(trim($_POST['form_email'])) && !empty($_POST['form_password'])){

		// Escapo posibles caracteres especiales que haya ingresado
		$form_usuario = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['form_usuario']));
		$form_email = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['form_email']));
		$form_apellido=($_POST['apellido']);
		$form_nombre=($_POST['nombre']);
		$form_dni=($_POST['dni']);
		$form_telefono=($_POST['telefono']);
		$form_cargo=($_POST['cargo']);
		$form_direccion=($_POST['direccion']);
		$form_silo=($_POST['silo']);
		$form_ing=($_POST['fec_ing']);
		$vacaciones='no';
		if($form_cargo=='administrador'){
			$form_silo=0;
		}
				//Verifico que el email sea valido, que tenga el formato correcto
				if (filter_var($form_email, FILTER_VALIDATE_EMAIL)) { 
						// Verifico que email no exista previamente en la tabla
						$verifico_email = mysqli_query($db_connection, "SELECT `email` FROM `usuarios` WHERE email = '$form_email'");
						$verificar_dni = mysqli_query($db_connection, "SELECT * FROM `usuarios` WHERE dni = '$form_dni'");
								if(mysqli_num_rows($verifico_email) > 0){    
									$error_message = "El email ingresado ya se encuentra utilizado, utilice otro correo para registrarse.";
								}elseif(mysqli_num_rows($verificar_dni) > 0){
									$error_message = "El DNI ingresado ya se encuentra utilizado.";
								}else{
										// En caso que no exista, procedo a preparar el campo clave para guardarlo
										// Utilizaremos la funcion password_hash ( http://php.net/manual/en/function.password-hash.php )

										// Encripto la clave ingresada desde el formulario
										$usuario_hash_password = password_hash($_POST['form_password'], PASSWORD_DEFAULT);

										$verificar=null;
										// Ahora ingreso los valores previamente preparados
										

										$query = mysqli_query($db_connection, "SELECT * FROM `registrosilo` WHERE silo='$form_silo'");
										$estado=null;
										while($fetch = mysqli_fetch_array($query)){
											$estado = $fetch['estado'];
											$asignacion= $fetch['asignacion'];
										}
										$si='si';
										if($estado=="activo" && $asignacion=="no"){
											$inserto_usuario = mysqli_query($db_connection, "INSERT INTO `usuarios` (apellido,nombre,dni,telefono,cargo,direccion,silo,fec_ing,vacaciones,usuario, email, password) VALUES ('$form_apellido','$form_nombre','$form_dni','$form_telefono','$form_cargo','$form_direccion','$form_silo','$form_ing','$vacaciones','$form_usuario', '$form_email', '$usuario_hash_password')");
											// Verifico errores y preparo mensajes
											if($form_silo > 0){
												$consulta = "UPDATE `registrosilo` SET asignacion='$si' WHERE silo=$form_silo";
												mysqli_query($db_connection, $consulta);
											}
											if($inserto_usuario === TRUE){
												$success_message = "Registro exitoso, ahora puede ingresar.";
											}
											else{
												$error_message = "¡Epa! Algo no salió como esperabamos, error.";
											}
										}else if($estado=="inactivo" || $asignacion=="si"){
											?>
											<script>
												alert("el silo esta inactivo o ya asignado")
												window.location.replace("../administrador/registrarEmpleados.php");
											</script>
											<?php
										}else{
											?>
											<script>
												alert("el silo no fue registrado")
												window.location.replace("../administrador/registrarSilo.php");
											</script>
											<?php
										}
								}
						}
				else {
					// Si el email no es correcto, notifico en el mensaje
					$error_message = "La dirección de email ingresada no es válida.";
				}
		}
	else{
		// Si los campos estan vacios, notifico en el mensaje
		$error_message = "Por favor complete los campos vacios.";
	}

}

?>