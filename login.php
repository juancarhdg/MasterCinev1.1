<?php

session_start();
include_once 'BaseDatos.php';

$nombre = $_POST['nombre'];
$password = $_POST['pass'];

//Esta función es para comprobar si existe el usuario en la BBDD
function comprobar($nombre, $password) {
    global $bd;

    $sql = "SELECT * FROM usuario WHERE nick = '" . $nombre . "' AND contrasena ='" . $password . "' LIMIT 1";

    $resultado = $bd->enviar_consulta($sql);

    if ($resultado->num_rows != 0) {
        $fila = $resultado->fetch_array(MYSQLI_BOTH);

        //Guardamos los valores de este usuario en variables de sesión para su posterior uso
        $_SESSION['nick'] = $fila[0];
        $_SESSION['nombre'] = $fila[1];
        $_SESSION['apellido1'] = $fila[2];
        $_SESSION['compras'] = $fila[3];
        $_SESSION['contrasena'] = $fila[4];
        $_SESSION['esAdmin'] = $fila[5];
        $_SESSION['apellido2'] = $fila[6];
        $_SESSION['mail'] = $fila[7];
        $_SESSION['puntos'] = $fila[8];
        $_SESSION['logueado'] = 1;
    } else {
        $fila[5] = -1;
    }

    $bd->cerrar_conexion();

    return $fila;
}

$registrado = comprobar($nombre, $password);

echo $registrado[5]; //Devolvemos el nick al index.js para comprobar que tipo de usuario es
?>
