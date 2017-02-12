<?php

include_once 'BaseDatos.php';

class Sala {

    public $sala;
    public $butacas;

    function __construct($sala, $butacas) {
        $this->sala = utf8_encode($sala);
        $this->butacas = utf8_encode($butacas);
    }

}

function rellenar() {
    global $bd;
    $sqlBest = "SELECT * FROM sala";
    $arr = array();
    $resultado = $bd->enviar_consulta($sqlBest);

    while ($row = $resultado->fetch_row()) {//fetch_row devuelve un array con claves numericas
        $a = new Sala($row[0], $row[4]);
        array_push($arr, $a);
    }

    $jsonData = json_encode($arr);
    $jsonError = json_last_error_msg();

    echo $jsonData;
}

rellenar();
?>
