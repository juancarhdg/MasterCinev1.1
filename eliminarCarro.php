<?php

session_start();
require_once "ClaseCarro.php";
if (!empty($_SESSION['nick'])) {
    $nick = $_SESSION['nick'];
    $carro = new Carro();
    $carro->eliminarCarro($nick);
    echo "Carro eliminado";
} else {
    header("Location:index.html");
}
?>