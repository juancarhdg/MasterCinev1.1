<?php

require_once("BaseDatos.php");

class Carro {

    public $id;
    public $cantidad;
    public $nombre;

    public function actualizarCompra($cant, $sal, $btc) {
        global $bd;
        $cliente = $_SESSION['nick'];
        $nuevaCantidadButacas = $btc - $cant;
        $sq = "SELECT ID, nombre from pelicula where sala = '$sal'";
        $va = $bd->enviar_consulta($sq);
        $filass = $va->fetch_array(MYSQLI_BOTH);
        $sqlComprobar = "select * from carro where id_cliente='$cliente' and id_pelicula='$filass[0]'";
        $comprobar = $bd->enviar_consulta($sqlComprobar);
        //Se comprueba si el cliente ya había comprado entradas para esa sala y si lo hace se actualiza la cantidad
        //if($filasss= $comprobar->fetch_array(MYSQLI_BOTH) == null){
        if ($comprobar->num_rows != 0) {

            $sqlActualizar = "UPDATE CARRO SET CANTIDAD=CANTIDAD+ '$cant' where id_cliente='$cliente' AND id_pelicula='$filass[0]'";
            $sqlSala = "UPDATE SALA SET butacas_disponibles=butacas_disponibles- '$cant' where id='$sal'";
            $resultad = $bd->enviar_consulta($sqlSala);
            $resultado8 = $bd->enviar_consulta($sqlActualizar);
        } else {
            $sql = "INSERT INTO CARRO  VALUES (NULL, '$cliente', '$filass[0]', '$cant', '$filass[1]');";
            $resultado8 = $bd->enviar_consulta($sql);
            $sqlSala = "UPDATE SALA SET butacas_disponibles=butacas_disponibles- '$cant' where id='$sal'";
            $resultad = $bd->enviar_consulta($sqlSala);
        }
    }

    //Función que actualiza los datos del usuario una vez haya finalizado la compra.
    public function completarCompra($usu) {
        global $bd;
        $sq = "SELECT * FROM CARRO WHERE ID_CLIENTE =" . "'$usu'";
        $resultado = $bd->enviar_consulta($sq);
        $nCompras = 0;
        $puntuacion = 0;
        while ($row = $resultado->fetch_row()) {//fetch_row devuelve un array con claves numericas	
            $nCompras = $nCompras + $row[3];
        }
        $puntuacion = 10 * $nCompras / 2;

        $sqlActualiza = "UPDATE USUARIO SET nCompras=nCompras+'$nCompras', puntuacion=puntuacion+'$puntuacion'  where nick='$usu'";
        $sqlEliminar = "delete from carro where id_cliente= '$usu'";
        $actualizar = $bd->enviar_consulta($sqlActualiza);
        $eliminar = $bd->enviar_consulta($sqlEliminar);
    }

    //Función para poder visualizar el contenido del carro de un cliente.
    public function ver_carro($usu) {
        global $bd;
        $sq = "SELECT * FROM CARRO WHERE ID_CLIENTE =" . "'$usu'";
        $resultado = $bd->enviar_consulta($sq);
        echo "<table class='tablaCarro'>";
        echo "<th>Nombre pelicula</th> <th>Cantidad comprada</th>";

        while ($row = $resultado->fetch_row()) {//fetch_row devuelve un array con claves numericas
            echo "<tr>";
            echo "<td>$row[4]</td>";
            echo "<td>$row[3]</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<br/>         
            <table class='tabla_compra'>   
                <tr>
                    <td>
                        <form action='checkout.php' class='form_compra' method='POST'>
                          <h4>Proceder a la compra</h4> <br/>
                           <label for='tipo_tarjeta'>Elija su tarjeta de crédito</label><br/>
                           <select name='tipo_tarjeta' class='opciones'>
                                        <option value='visa' >Visa</option>
                                        <option value='masterCard' >Master Card</option>
                                        <option value='american' >American Express</option>                                   
                           </select><br/><br/>
                           <label for='titular'>Titular de la tarjeta</label><br/><input type='text'  class='opciones'  id='titular' name='titular'><div id='aviso'>Debe introducir un nombre</div><br/>
                           <label for='tarjeta'>Nº de tarjeta</label><br/><input type='password'  class='opciones' id='tarjeta' name='tarjeta'><div id='aviso2'>Debe introducir un número válido</div><br/>
                           <input type='button'  class='boton' value='Validar Datos' id='validar_tarjeta' name='validar'><br/><br/>
                           <input type='submit'  class='boton' value='Comprar' id='aceptar' name='aceptar'>
                        </form><br/>
                   </td>
                </tr>
                <tr>
                    <td>
                        <form action='eliminarCarro.php' method='POST'> <input type='submit'  class='boton' value='Eliminar Compra' name='aceptar'></form>
                    </td>
               </tr>
            </table>";
    }

    public function comprobarEntradas($sala) {
        global $bd;

        $sql = "select butacas_disponibles from sala where id = '" . $sala . "' limit 1";

        $resultado = $bd->enviar_consulta($sql);

        $fila = $resultado->fetch_array(MYSQLI_BOTH);

        return $fila[0];
    }

    //Esta función elimina el carro de un usuario especifico y reestablece las entradas disponibles que el usuario hubiese reservado.
    public function eliminarCarro($usu) {
        session_start();
        global $bd;
        $sq = "SELECT * FROM CARRO WHERE ID_CLIENTE =" . "'$usu'";
        $resultado = $bd->enviar_consulta($sq);
        while ($row = $resultado->fetch_row()) {
            $sqlpelicula = "SELECT SALA FROM PELICULA WHERE ID='$row[2]'";
            $resultadoPelicula = $bd->enviar_consulta($sqlpelicula);
            $fila = $resultadoPelicula->fetch_array(MYSQLI_BOTH);
            $sqlActualizar = "UPDATE SALA SET butacas_disponibles=butacas_disponibles+ '$row[3]' where id='$fila[0]'";
            $resultadoPelicula = $bd->enviar_consulta($sqlActualizar);
        }
        $sql = "delete from carro where id_cliente= '$usu'";
        $resultado = $bd->enviar_consulta($sql);

        header("location:carro.php");
    }

    //Muestra el total de entradas y el precio.
    public function resumen_compra($usu) {
        global $bd;
        $sq = "SELECT * FROM CARRO WHERE ID_CLIENTE =" . "'$usu'";
        $sqlPrecio = "select precio from pelicula";
        $precioEntrada = $bd->enviar_consulta($sqlPrecio);
        $filas = $precioEntrada->fetch_array(MYSQLI_BOTH);
        $resultado = $bd->enviar_consulta($sq);
        $cantidadTotal = 0;
        $precio = 0;
        while ($row = $resultado->fetch_row()) {//fetch_row devuelve un array con claves numericas
            $cantidadTotal = $cantidadTotal + $row[3];
        }
        $precio = $cantidadTotal * $filas[0];
        echo "<p>Cantidad de entradas: '$cantidadTotal'</p>";
        echo "<p>Total: '$precio' €</p>";
    }

}

//$Clase = new Carro();
?>