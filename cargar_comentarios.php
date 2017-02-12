<?php

include_once 'BaseDatos.php';

class Comentario {

    public $nick;
    public $id;
    public $texto;
    public $fecha;

    function __construct($nick, $id, $texto, $fecha) {
        $this->nick = utf8_encode($nick);
        $this->id = $id;
        $this->texto = $texto;
        $this->fecha = $fecha;
    }

}

function rellenar() {
    global $bd;
    $idPe = json_decode(stripslashes($_POST['id'])); //El id de la pelicula

    $sqlBest = "SELECT * FROM comentario  WHERE id_pelicula='$idPe'";

    $arr = array();
    $resultado = $bd->enviar_consulta($sqlBest);

    while ($row = $resultado->fetch_row()) {//fetch_row devuelve un array con claves numericas
        $a = new Comentario($row[3], $row[0], $row[2], $row[4]);

        array_push($arr, $a);
    }

    $jsonData = json_encode($arr);
    $jsonError = json_last_error_msg();

    echo $jsonData;
}

rellenar();
?>