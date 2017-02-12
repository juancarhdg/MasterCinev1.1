<?php

session_start();
include_once "BaseDatos.php";
require_once "ClaseCarro.php";
$datosCompra = json_decode(stripslashes($_POST['datosCompra']));
$cantidad = 0;
$hora;
$sala;
$butacasLibres = 0;
$idPeli = 0;



for ($i = 0; $i < count($datosCompra); $i++) {
    $cantidad = $datosCompra[$i]->cantidad;
    $hora = $datosCompra[$i]->hora;
    $sala = $datosCompra[$i]->sala;
    $idPeli = $datosCompra[$i]->idPeli;
}
$carro = new Carro();


$butacasLibres = $carro->comprobarEntradas($sala);


//Comprobamos si quedab butacas libres
if ($butacasLibres >= $cantidad) {

    $carro->actualizarCompra($cantidad, $sala, $butacasLibres); //si quedan llamamos a la función que realiza la compra en la bbdd
 
    //Se envía un 1 para que en el cliente se sepa que hay entradas y se rediriga a la página del carro.
    echo "1";
} else {
    echo "No quedan entradas";
}

//En esta función actualizamos en la tabla sala la cantidad de butacas que quedan después de la compra.
//Recibe como parámetros la cantidad a comprar, el numero de sala y las butacas disponibles
function actualizarCompra($cant, $sal, $btc) {
    global $bd;
    $cliente = $_SESSION['nick'];
    $nuevaCantidadButacas = $btc - $cant;
    $sq = "SELECT ID from pelicula where sala = '$sal'";
    $va = $bd->enviar_consulta($sq);
    $filass = $va->fetch_array(MYSQLI_BOTH);
    $sql = "INSERT INTO CARRO  VALUES (NULL, 'admin', '12', '1');";
    $resultado8 = $bd->enviar_consulta($sql);
}

//echo $butacasLibres;
?>
