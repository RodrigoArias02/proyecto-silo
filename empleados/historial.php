<?php
    require '../config/conexion.php';
    $silo=$_POST['silo'];
    $query="SELECT * FROM registrosilo WHERE silo='$silo'";
    $datos= mysqli_query($db_connection,$query);
    while($fila=mysqli_fetch_array($datos))
    {
    $inactivo=$fila['estado'];
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/empleaditosh.css">
    <script src="https://kit.fontawesome.com/4989dcb279.js" crossorigin="anonymous"></script>
    <title>Historial & Promedios</title>

</head>
<body>
    <div class="grid-contenedor">
        <div class="grid-fecha">
            <div class="contenedor-fecha">
                <div class="imagen">

                </div>
                <div class="datos">
                    <form action=" " method="post">
                        <input type="hidden" name=silo value="<?php echo $silo ?>">
                        <label>Desde</label>
                        <input type="date" name=date1>
                        <label>Hasta</label>
                        <input type="date" name=date2>
                        <div class="botones">
                        <a href="../inicio.php"><i class="fa-solid fa-person-walking-arrow-loop-left"></i>Volver</a>
                        <button name="filtrar">Filtrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="grid-tabla">
            <div class="tablas">
            <table>
                <thead>
                <tr>
                    <th>Número de silo</th>
                    <th>Temperatura</th>
                    <th>Humedad</th>
                    <th>Gases</th>
                    <th>Fecha de la evaluación</th>
                    <th>Hora de la evaluación</th>
                    <th>Nombre del empleado</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    </tr>  
                </thead>
                <?php
                    require '../config/conexion.php';
                    $acumulador_temperatura=0;
                    $cantidad_temperatura=0;
                    $maximo_temperatura=0;
                    $promedio_temperatura=0;
                    $primer_valor_temperatura=null;
                    $ultimo_valor_temperatura=null;


                    $promedio_humedad=0;
                    $acumulador_humedad=0;
                    $cantidad_humedad=0;
                    $maximo_humedad=0;
                    $primer_valor_humedad=null;
                    $ultimo_valor_humedad=null;

                    $promedio_gases=0;
                    $acumulador_gases=0;
                    $cantidad_gases=0;
                    $maximo_gases=0;
                    $primer_valor_gases=null;
                    $ultimo_valor_gases=null;

                    if(ISSET($_POST['filtrar'])){
                    $silo=$_POST['silo'];
                    $date1 = date("Y-m-d", strtotime($_POST['date1']));
                    $date2 = date("Y-m-d", strtotime($_POST['date2']));
                    $query=mysqli_query($db_connection, "SELECT * FROM `silos` WHERE `fec_evaluacion` BETWEEN '$date1' AND '$date2'") or die(mysqli_error());
                    $row=mysqli_num_rows($query);
                    if($row>0){
                    while($fetch=mysqli_fetch_array($query)){
                    if($fetch['silo']==$silo){
                        $acumulador_temperatura=$acumulador_temperatura + $fetch['temperatura'];
                        $cantidad_temperatura=$cantidad_temperatura+1;
                        if($maximo_temperatura<=$fetch['temperatura']){
                            $maximo_temperatura= $fetch['temperatura'];
                        }
                        if($primer_valor_temperatura==null){
                            $primer_valor_temperatura = $fetch['temperatura'];
                        }
                        $ultimo_valor_temperatura = $fetch['temperatura'];
                            $promedio_temperatura=$acumulador_temperatura/$cantidad_temperatura;

                            $acumulador_humedad=$acumulador_humedad + $fetch['humedad'];
                            $cantidad_humedad=$cantidad_humedad+1;
                            if($maximo_humedad<=$fetch['humedad']){
                                $maximo_humedad= $fetch['humedad'];
                            }
                            $promedio_humedad=$acumulador_humedad/$cantidad_humedad;
        
                            $acumulador_gases=$acumulador_gases + $fetch['gases'];
                            $cantidad_gases=$cantidad_gases+1;
                            if($maximo_gases<=$fetch['gases']){
                                $maximo_gases= $fetch['gases'];
                            }
                            $promedio_gases=$acumulador_gases/$cantidad_gases;

                            if($primer_valor_temperatura==null){
                                $primer_valor_temperatura = $fetch['temperatura'];
                            }
                            if($primer_valor_humedad==null){
                                $primer_valor_humedad = $fetch['humedad'];
                            }
                            if($primer_valor_gases==null){
                                $primer_valor_gases = $fetch['gases'];
                            }
                            $ultimo_valor_temperatura = $fetch['temperatura'];
                            $ultimo_valor_humedad = $fetch['humedad'];
                            $ultimo_valor_gases = $fetch['gases'];
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $fetch['silo']; ?></td>
                        <td><?php echo $fetch['temperatura']; ?></td>
                        <td><?php echo $fetch['humedad']; ?></td>
                        <td><?php echo $fetch['gases']; ?></td>
                        <td><?php echo $fetch['fec_evaluacion']; ?></td>
                        <td><?php echo $fetch['hora_evaluacion']; ?></td>
                        <td><?php echo $fetch['nombre_empleado']; ?></td>
                        <td><form action="editar.php" method="POST"><input type="submit" class="editar"  <?php if($inactivo=="inactivo"){ echo "disabled";}else{} ?> name="actualizar" value=Editar><input type="hidden"  name="id" id="id" value="<?php echo $fetch['id'];?>"><input type="text"  name="silos" hidden value="<?php echo $fetch['silo'] ?>"></form></td>
                        <td><form action="eliminar.php" method="POST"> <input type="submit" class="eliminar" <?php if($inactivo=="inactivo"){ echo "disabled";}else{} ?> value="Eliminar"> <input type="hidden" class="d-none" name="id" id="id" value="<?php echo $fetch['id'];?>"></form></td>
                    </tr>
                </tbody>
                <?php
                    }
                    }
                    }else{
                    echo'
                    <tr>
                        <td colspan = "9"><center>Los registros no existen</center></td>
                    </tr>';
                    }
                    }else{
                    $query=mysqli_query($db_connection, "SELECT * FROM `silos`") or die(mysqli_error());
                    while($fetch=mysqli_fetch_array($query)){
                        if($fetch['silo']==$silo){
                            $acumulador_temperatura=$acumulador_temperatura + $fetch['temperatura'];
                            $cantidad_temperatura=$cantidad_temperatura+1;
                            if($maximo_temperatura<=$fetch['temperatura']){
                                $maximo_temperatura= $fetch['temperatura'];
                            }
                            if($primer_valor_temperatura==null){
                                $primer_valor_temperatura = $fetch['temperatura'];
                            }
                            $ultimo_valor_temperatura = $fetch['temperatura'];
                                $promedio_temperatura=$acumulador_temperatura/$cantidad_temperatura;

                                $acumulador_humedad=$acumulador_humedad + $fetch['humedad'];
                                $cantidad_humedad=$cantidad_humedad+1;
                                if($maximo_humedad<=$fetch['humedad']){
                                    $maximo_humedad= $fetch['humedad'];
                                }
                                $promedio_humedad=$acumulador_humedad/$cantidad_humedad;
            
                                $acumulador_gases=$acumulador_gases + $fetch['gases'];
                                $cantidad_gases=$cantidad_gases+1;
                                if($maximo_gases<=$fetch['gases']){
                                    $maximo_gases= $fetch['gases'];
                                }
                                $promedio_gases=$acumulador_gases/$cantidad_gases;

                                if($primer_valor_temperatura==null){
                                    $primer_valor_temperatura = $fetch['temperatura'];
                                }
                                if($primer_valor_humedad==null){
                                    $primer_valor_humedad = $fetch['humedad'];
                                }
                                if($primer_valor_gases==null){
                                    $primer_valor_gases = $fetch['gases'];
                                }
                                $ultimo_valor_temperatura = $fetch['temperatura'];
                                $ultimo_valor_humedad = $fetch['humedad'];
                                $ultimo_valor_gases = $fetch['gases'];
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $fetch['silo']; ?></td>
                                    <td><?php echo $fetch['temperatura']; ?></td>
                                    <td><?php echo $fetch['humedad']; ?></td>
                                    <td><?php echo $fetch['gases']; ?></td>
                                    <td><?php echo $fetch['fec_evaluacion']; ?></td>
                                    <td><?php echo $fetch['hora_evaluacion']; ?></td>
                                    <td><?php echo $fetch['nombre_empleado']; ?></td>
                                    <td><form action="editar.php" method="POST"><input type="submit" class="editar" name="actualizar" value=Editar><input type="text" hidden name="id" id="id" value="<?php echo $fetch['id'];?>"><input type="text" hidden name="silos" value="<?php echo $fetch['silo'] ?>"></form></td>
                                    <td><form action="eliminar.php" method="POST"> <input type="submit" class="eliminar"  value="Eliminar"> <input type="text" hidden class="d-none" name="id" id="id" value="<?php echo $fetch['id'];?>"></form></td>
                                </tr>
                            </tbody>
                            <?php
                        }
                    }
                }
                
                ?>
            </table>
            </div>
        </div>
        <div class="grid-promedio">
            <div class="contenedor-estadisticas">
                <div class="contenedor-circulo">
                    <div class="circular-progress"></div>
                    <div class="texto">
                        <h5>Promedio <?php echo $promedio_temperatura; ?></h5>
                        <h5>Maxima temperatura: <?php echo $maximo_temperatura; ?></h5>
                    </div>
                </div>
                <div class="contenedor-circulo">
                    <div class="circular-progress-humedad"></div>
                    <div class="texto">
                        <h5>Promedio <?php echo $promedio_humedad; ?></h5>
                        <h5>Maxima humedad <?php echo $maximo_humedad; ?></h5>
                    </div>
                </div>
                <div class="contenedor-circulo">
                    <div class="circular-progress-gases"></div>
                    <div class="texto">
                        <h5>Promedio <?php echo $promedio_gases; ?></h5>
                        <h5>Maximos gases <?php echo $maximo_gases; ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<style>
    <?php
    
    $porcentaje_temperatura=(($primer_valor_temperatura-$ultimo_valor_temperatura)/$primer_valor_temperatura)*100;
    if($primer_valor_temperatura>$ultimo_valor_temperatura){
        $porcentaje_temperatura=$porcentaje_temperatura * (-1);
        $grados_temperatura = ($porcentaje_temperatura*-1)/100*180; 
    }else if($primer_valor_temperatura < $ultimo_valor_temperatura){
        $porcentaje_temperatura=$porcentaje_temperatura*(-1);
        $grados_temperatura = ($porcentaje_temperatura)/100*180; 
    }
    $resultado_temperatura = floor(($porcentaje_temperatura*100))/100;

    $porcentaje_humedad=(($primer_valor_humedad-$ultimo_valor_humedad)/$primer_valor_humedad)*100;

    if($primer_valor_humedad>$ultimo_valor_humedad){
        $porcentaje_humedad=$porcentaje_humedad * (-1);
        $grados_humedad = ($porcentaje_humedad*-1)/100*180; 
    }else if($primer_valor_humedad < $ultimo_valor_humedad){
        $porcentaje_humedad=$porcentaje_humedad*(-1);
        $grados_humedad = ($porcentaje_humedad)/100*180; 
    } 
    $resultado_humedad = floor(($porcentaje_humedad*100))/100;

    $porcentaje_gases=(($primer_valor_gases-$ultimo_valor_gases)/$primer_valor_gases)*100;
    if($primer_valor_gases>$ultimo_valor_gases){
        $porcentaje_gases=$porcentaje_gases * (-1);
        $grados_gases = ($porcentaje_gases*-1)/100*180; 
    }else if($primer_valor_gases < $ultimo_valor_gases){
        $porcentaje_gases=$porcentaje_gases*(-1);
        $grados_gases = ($porcentaje_gases)/100*180; 
    } 
    $resultado_gases = floor(($porcentaje_gases*100))/100;

    ?>
        .circular-progress{
            transform: rotate(<?php echo $grados_temperatura ?>deg);
        }
        .circular-progress::before{
            transform: rotate(-<?php echo $grados_temperatura ?>deg);
        }
        .circular-progress::after{
            transform: rotate(-<?php echo $grados_temperatura ?>deg) scale(1.2);
            content: "<?php echo $resultado_temperatura ?>%";
        }

        .circular-progress-humedad{
            transform: rotate(<?php echo $grados_humedad ?>deg);
        }
        .circular-progress-humedad::before{
            transform: rotate(-<?php echo $grados_humedad ?>deg);
        }
        .circular-progress-humedad::after{
            transform: rotate(-<?php echo $grados_humedad ?>deg) scale(1.2);
            content: "<?php echo $resultado_humedad ?>%";
            
        }

        .circular-progress-gases{
            transform: rotate(<?php echo $grados_gases ?>deg);
        }
        .circular-progress-gases::before{
            transform: rotate(-<?php echo $grados_gases ?>deg);
        }
        .circular-progress-gases::after{
            transform: rotate(-<?php echo $grados_gases ?>deg) scale(1.2);
            content: "<?php echo $resultado_gases ?>%";
            
        }
    </style>

</html>