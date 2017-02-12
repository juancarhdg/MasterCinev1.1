<?php

include_once 'BaseDatos.php';

class Usuario {

    public $nick;
    public $nombre;
    public $apellido;
    public $nCompras;
    public $esAdmin;
    public $segAp;
    public $email;

    function __construct($nick, $nombre, $apellido, $nCompras, $esAdmin, $segAp, $email) {
        $this->nick = utf8_encode($nick);
        $this->nombre = utf8_encode($nombre);
        $this->apellido = utf8_encode($apellido);
        $this->nCompras = $nCompras;
        $this->esAdmin = $esAdmin;
        $this->segAp = utf8_encode($segAp);
        $this->email = utf8_encode($email);
    }

}

function rellenar() {
    global $bd;
    $sqlBest = "SELECT * FROM usuario ORDER BY esAdmin DESC";
    $arr = array();
    $resultado = $bd->enviar_consulta($sqlBest);

    while ($row = $resultado->fetch_row()) {//fetch_row devuelve un array con claves numericas
        $a = new Usuario($row[0], $row[1], $row[2], $row[3], $row[5], $row[6], $row[7]);
        array_push($arr, $a);
    }

    $jsonData = json_encode($arr);
    $jsonError = json_last_error_msg();

    echo $jsonData;
    //print_r($arr);
}

rellenar();
?>
