<?php
require_once "BaseDatos.php";
//	error_reporting(0);
if (isset($_REQUEST['nick'])) {
    $nick = $_REQUEST["nick"];
    global $bd;
    
    //Recuperamos los datos de este usuario
    $sqlBest = "select * from usuario where nick='$nick'";
    $resultado = $bd->enviar_consulta($sqlBest);
    $filass = $resultado->fetch_array(MYSQLI_BOTH);
}
?>
<html>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/admin.css">
        <script src="../Scripts/jquery-1.11.0.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <title><?php if(isset($nick)){echo "Editando " . "$nick";} ?></title>

    </head>
    <h2 class="tituloEdPelicula">Editar Usuario</h2>

    <form class="editarForm" action="EditarUsuario.php" method="POST">
        <div class="item">
            Nombre<input type="text" NAME="nombre" id="valor" value="<?php if(isset($filass)){echo $filass[1];} ?>"> <!-- Imprimimos sus datos en los input -->
        </div>

        <div class="item">
            Apellido<input type="text" name="apellido"value="<?php if(isset($filass)){ echo $filass[2];} ?>">
        </div>

        <div class="item">
            Rol<input type="number" min=0 max=1 name="rol" value="0">
        </div>
        <div class="item">
            Segundo Apellido<input type="text" name="sAp" value="<?php if(isset($filass)){echo $filass[6];} ?>">
        </div>       
        <div class="item">
            E-Mail<input type="text" name="mail" value="<?php if(isset($filass)){echo $filass[7];} ?>">
        </div>

        <input type="submit" value="subir" class="boton">
        <input type="hidden" NAME="nicks" value="<?php if(isset($nick)){echo "$nick";} ?>">
    </form>

    <!--Se envía como campo oculto el nick(clave primaria) del usuario a eliminar-->
    <form action="EliminarUsuario.php">
        <input type="submit" value="eliminar" class="boton">
        <input type="hidden" NAME="borrado" value="<?php if(isset($nick)){echo "$nick";} ?>">
    </form>

</html>
<?php
include_once 'BaseDatos.php';

session_start();
if (!empty($_POST["nombre"])) {
    
    //Recogemos los datos que ha introducido el administrador en los input de arriba
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $rol = $_POST["rol"];
    $seg = $_POST['sAp'];
    $email = $_POST['mail'];

    $nicks = $_REQUEST["nicks"];
    //echo $nicks;
    global $bd;
    
    //Actualizamos la bbdd con los nuevos datos
    $sql = "UPDATE USUARIO SET nombre='$nombre', apellido='$apellido', esAdmin='$rol', segundoApellido='$seg', email='$email' WHERE nick='$nicks'";
    $bd->enviar_consulta($sql);
    echo "Usuario actualizado correctamente";
}
?>