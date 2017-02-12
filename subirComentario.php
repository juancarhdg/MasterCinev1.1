<?php

session_start();

include_once 'BaseDatos.php';

$texto = $_POST["texto"];
$id = $_POST["id"];
$nick = $_SESSION['nick'];


global $bd;

$sql = "INSERT INTO COMENTARIO(id_pelicula, id, comentario, nick, fecha) values ('$id', NULL, '$texto', '$nick', UTC_DATE() )";

if (!empty($_REQUEST['puntuacion'])) {
    $puntuacion = $_POST['puntuacion'];
    $sql2 = "INSERT INTO PUNTUACION(id, id_pelicula, puntuacion) values (NULL, '$id', '$puntuacion')";
    $bd->enviar_consulta($sql2);
}

$bd->enviar_consulta($sql);

header("Location:peliculaUnica.html");
?>