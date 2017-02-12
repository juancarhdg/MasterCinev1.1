<?php

include_once 'BaseDatos.php';

session_start();

global $bd;

$nombre = $_POST["nombre"];
$anno = $_POST["anno"];
$sala = $_POST["sala"];
$sinopsis = $_POST["sinopsis"];
$ruta = $_POST["ruta"];

$sql = "INSERT INTO Pelicula (nombre, anyo, sala, sinopsis, cartel) VALUES ('$nombre', '$anno', '$sala', '$sinopsis', '$ruta')";
$bd->enviar_consulta($sql);
header("Location:admin.html");

?>