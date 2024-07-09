<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adminHistorial1.css">
    <script src="https://kit.fontawesome.com/4989dcb279.js" crossorigin="anonymous"></script>
    <title>Historial & Promedios</title>
</head>
<body>
    <div class="caja-flex">
        <div class=imagen>

        </div>
        <div class="datos">
            <h1>Ingrese el rango de fechas que desea consultar</h1>
            <form action="filtroAdministrador.php" method="post">
            <input type="text" name="extra" placeholder="Ingrese nombre del empleado o silo">
                <label>Desde</label>
                <input type="date" name=date1>
                <label>Hasta</label>
                <input type="date" name=date2>
                <button name="filtrar">Filtrar</button>
            </form>
            <div class="btn-contenedor">
                <a href="administrador.php"><i class="fa-solid fa-door-open"></i> Volver</a>
            </div>
        </div>
    </div>
    
</body>
</html>