<?php
	require_once "BaseDatos.php";
	error_reporting(0);
	if(isset($_REQUEST['id'])){
		$id = $_REQUEST["id"];
		global $bd;
		$sqlBest = "select * from pelicula where id='$id'";
		$resultado = $bd->enviar_consulta($sqlBest);
		$filass = $resultado->fetch_array(MYSQLI_BOTH);
	}
	else {
	
	
	}

?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="../Scripts/jquery-1.11.0.js"></script>

        <link rel="stylesheet" type="text/css" href="../css/admin.css">
        <title><?php echo "Editando " . "$id"; ?></title>
        <script>
        if($("#n").val() == null || $("#n").val() == undefined){

        }
        </script>
    </head>
    <body>
        <h2 class='tituloEdPelicula'>Editar Pelicula</h2>
        <form class="editarForm" action="EditarPelicula.php" method="POST">
            <fieldset>
                <div class="item">
                    Nombre<input type="text" name="nombre" id="n" value="<?php echo "$filass[1]" ?>">
                </div>

                <div class="item">
                    Año<input type="text" name="anno" value="<?php echo "$filass[2]" ?>">
                </div>
                <div class="item">
                    Sala<select name="sala">
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                        <option value="6" >6</option>
                        <option value="0" >0</option>

                    </select>
                </div>

                <div class="itemTextarea">
                    Sinopsis<textarea name="sinopsis"><?php echo "$filass[6]" ?></textarea>
                </div>

                <div class="item">
                    Imagen<input type="text" name="ruta" value="<?php echo "$filass[5]" ?>">
                </div>
                <button id="button" class="boton">Subir</button>
                <input type="hidden" NAME="ids" value="<?php echo "$id" ?>">

            </fieldset>
        </form>
        <form action="EliminarPelicula.php" id="formm">
            <input type="submit" value="eliminar" class="boton">
            <input type="hidden" NAME="borrado" value="<?php echo "$id" ?>">
        </form>
    </body>
</html>
<?php
include_once 'BaseDatos.php';

session_start();
if (!empty($_POST["nombre"])) {
    $nombre = $_POST["nombre"];
    $anyo = $_POST["anno"];
    $sala = $_POST["sala"];
    $sinopsis = $_POST["sinopsis"];
    $imagen = $_POST["ruta"];
    $ids = $_REQUEST["ids"];

    global $bd;
    $sql = "UPDATE pelicula SET nombre='$nombre', anyo='$anyo', sala='$sala', cartel='$imagen', sinopsis='$sinopsis' WHERE id='$ids'";
    $bd->enviar_consulta($sql);
}
?>