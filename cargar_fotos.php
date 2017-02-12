<?php

include_once 'BaseDatos.php';

class Pelicula {

    public $nombre;
    public $id;
    public $anno;
    public $puntuacion;
    public $cartel;
    public $sinopsis;
    public $sala;

    function __construct($i, $n, $c, $p, $s, $a, $z) {
        $this->id = $i;
        $this->nombre = utf8_encode($n);
        $this->puntuacion = $p;
        $this->cartel = utf8_encode($c);
        $this->sinopsis = utf8_encode($s);
        $this->anno = $a;
        $this->sala = $z;
    }

}

function rellenar() {
    global $bd;
    $sqlBest = "SELECT * FROM PELICULA ORDER BY PUNTUACION DESC LIMIT 5";

    $arr = array();
    $resultado = $bd->enviar_consulta($sqlBest);

    while ($row = $resultado->fetch_row()) {//fetch_row devuelve un array con claves numericas
        $sqlPuntuacion = "SELECT round(AVG(puntuacion),0) from puntuacion where id_pelicula='$row[0]'";
        $punt = $bd->enviar_consulta($sqlPuntuacion);
        $fila = $punt->fetch_array(MYSQLI_BOTH);
        $a = new Pelicula($row[0], $row[1], $row[5], $fila[0], $row[6], $row[2], $row[4]);

        array_push($arr, $a);
    }

    $jsonData = json_encode($arr);
    $jsonError = json_last_error_msg();

    echo $jsonData;
}

rellenar();
?>
