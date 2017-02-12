<?php

include_once "BaseDatos.php";

function recuperarCarteles() {
    global $bd;

    $sql = "select from pelicula";
    $resultado = $bd->enviar_consulta($sql);

    if ($resultado->num_rows != 0) {
        $fila = $resultado->fetch_array(MYSQLI_BOTH);

        return $fila;
    }
}

recuperarCarteles();
?>
