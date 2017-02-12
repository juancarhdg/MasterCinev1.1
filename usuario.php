<?php

session_start();

include_once "BaseDatos.php";

//Comprobamos los valores que recibe $_POST para saber que opción debemos ejecutar
if (isset($_POST['nombreUsu'])) {
    darseBaja($_POST['nombreUsu']);
} elseif (isset($_POST['nuevaPass'])) {
    cambiarContrasena($_POST['nuevaPass']);
} elseif (isset($_POST['datos'])) {
    consultarDatos();
} elseif (isset($_POST['cerrarSesion'])) {
    cerrarSesion();
}

//Esta función devuelve todos los datos del usuario que se ha logueado
function consultarDatos() {

    global $bd;

    $sql = "select * from usuario where nick='" . $_SESSION['nick'] . "'";
    $resultado = $bd->enviar_consulta($sql);

    if ($resultado->num_rows != 0) {
        $fila = $resultado->fetch_array(MYSQLI_BOTH);
    }

    $arrayDatos = json_encode($fila);

    echo $arrayDatos;
}

//En esta funcion el usuario podrá cmabiar la contraseña que la recibe con un parámetro desde la página de usuario.html
function cambiarContrasena($nuevaContrasena) {
    global $bd;

    //Si esta logueado el usuario hacemos el update
    if (isset($_SESSION['nombre'])) {
        $sql = "update usuario set contrasena = '" . $nuevaContrasena . "' where nick = '" . $_SESSION['nick'] . "'";
        $resultado = $bd->enviar_consulta($sql);

        echo "LA CONTRASEÑA SE ACTUALIZÓ CORRECTAMENTE";
    } else {
        echo "DEBE LOGUEARSE PRIMERO";
    }
}

//Esta función es para darse de baja de la BBDD 
function darseBaja($usuBaja) {
    global $bd;

    //Si el usuario esta logueado ejecutamos el delete para eliminar el usuario
    if (isset($_SESSION['nick'])) {
        $sql2 = "select nick from usuario where nick = '" . $usuBaja . "'"; //Para comprobar si existe el usuario en la BBDD
        $resultado2 = $bd->enviar_consulta($sql2);

        if ($resultado2->num_rows != 0 && $usuBaja == $_SESSION['nick']) { //Si el usuario existe en la bbdd y si el usuario es el nombre escrito es el mismo que el usuario que ha iniciado session
            $fila = $resultado2->fetch_array(MYSQLI_BOTH);

            //Aqui enviamos la sentencia delete para eliminar el usuario de la BBDD
            $sql = "delete from usuario where nick = '" . $usuBaja . "'";
            $resultado = $bd->enviar_consulta($sql);

            echo "El usuario " . $_SESSION['nick'] . " se ha eliminado correctamente";

            cerrarSesion();
        } else {
            echo "NO SE HA PODIO ELIMINAR EL USUARIO";
        }
    } else {
        echo "DEBE LOGUEARSE PRIMERO";
    }
}

//Funcion que cierra la sesion de usuario
function cerrarSesion() {
    echo "SESIÓN CERRADA\n\nGracias por usar nuestra aplicación\n\nHasta pronto sr " . $_SESSION['nombre'];

    session_destroy();
}

?>
