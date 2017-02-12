<?php

//Aqui devolvemos si el usuario esta logueado
session_start();
if ($_SESSION['nick'] == "admin") {
    echo 2; //Si el usuario logueado es el administrador devolvemos un 2
} else {
    echo $_SESSION['logueado'];
}
?>
