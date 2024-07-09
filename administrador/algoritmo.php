<?php
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