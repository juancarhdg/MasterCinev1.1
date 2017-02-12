<?php

session_start();
require_once "ClaseCarro.php";
if (!empty($_SESSION['nick'])) {
    $nick = $_SESSION['nick'];
    $carro = new Carro();
    $carro->completarCompra($nick);
    echo "Compra realizada";
    header("Location:index.html");
} else {
    header("Location:index.html");
}
?>