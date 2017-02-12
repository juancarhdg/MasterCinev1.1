<?php

include_once 'BaseDatos.php';

$nick = $_REQUEST["borrado"];
if (!empty($nick)) {
    global $bd;
    $sql = "DELETE FROM usuario WHERE nick= '$nick'";
    $resultado = $bd->enviar_consulta($sql);

    echo "Usuario no eliminado";
}
?>