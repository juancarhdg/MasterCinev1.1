<?php

require_once "BaseDatos.php";

function actualizar() {
    global $bd;
    $sqlBorrarCarros = "DELETE FROM CARRO";
    $sqlButacas = "UPDATE SALA SET butacas_disponibles=50 where id !=0";

    $resultado1 = $bd->enviar_consulta($sqlBorrarCarros);
    $resultado2 = $bd->enviar_consulta($sqlButacas);

    $jsonData = json_encode("Butacas reestablecidas correctamente");
    $jsonError = json_last_error_msg();
    echo $jsonData;
}

actualizar();
?>