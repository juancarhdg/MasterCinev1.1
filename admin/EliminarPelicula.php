<?php

include_once 'BaseDatos.php';

$id = $_REQUEST["borrado"];
if (!empty($id)) {
    global $bd;
    $sqlBorrarComentarios = "DELETE FROM COMENTARIO WHERE ID_pelicula='$id'";
    $sql = "DELETE FROM PELICULA WHERE ID= '$id'";
    $resultadoB = $bd->enviar_consulta($sqlBorrarComentarios);

    $resultado = $bd->enviar_consulta($sql);
    echo "Pelicula eliminada.";
}
?>