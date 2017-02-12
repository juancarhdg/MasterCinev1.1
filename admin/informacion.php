<?php

require_once "BaseDatos.php";

function actualizar() {
    global $bd;

    $butacasTotal = 0;
    $sql1 = "SELECT butacas_disponibles from sala where id != 0";
    $resultado = $bd->enviar_consulta($sql1);
    while ($row = $resultado->fetch_row()) {
        $butacasTotal = $butacasTotal + $row[0];
    }
    $totalVendidas = 300 - $butacasTotal;
    $sqlPrecioEntrada = "select precio from pelicula";
    $resultado2 = $bd->enviar_consulta($sqlPrecioEntrada);
    $filas = $resultado2->fetch_array(MYSQLI_BOTH);
    $total = $totalVendidas * $filas[0];
    $jsonData = json_encode($total);
    $jsonError = json_last_error_msg();
    echo $jsonData;
}

actualizar();
?>