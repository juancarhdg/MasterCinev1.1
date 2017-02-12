<?php

require_once "BaseDatos.php";
if (isset($_REQUEST['precio'])) {

    $precio = json_decode(stripslashes($_POST['precio'])); //El id de la pelicula
    global $bd;
    $sqlBest = "UPDATE pelicula SET PRECIO='$precio'";
    $resultado = $bd->enviar_consulta($sqlBest);
    $jsonData = json_encode("Precio actualizado");
    $jsonError = json_last_error_msg();
    echo $jsonData;
}
?>