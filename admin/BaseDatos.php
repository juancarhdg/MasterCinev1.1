<?php

class BaseDatos {

    public $conexion;
    private $ultima_consulta;
    private $existe_fun_escape;

    function __construct() {
        $this->abrir_conexion();
        $this->existe_fun_escape = function_exists("mysqli_real_escape_string");
    }

    public function abrir_conexion() {
        $this->conexion = new mysqli('localhost', 'root', '', 'master');
        $error = $this->conexion->connect_errno;
        if (!($error == null)) {
            die("No Hemos podido conectarnos a la base de datos: ");
        }
    }

    public function enviar_consulta($sql) {
        $this->ultima_consulta = $sql;
        $resultado = $this->conexion->query($sql);
        $this->verificar_consulta($resultado);
        return $resultado;
    }

    public function fetch_array($resultado) {
        return $resultado->fetch_array(MYSQLI_BOTH);
    }

    public function affected_rows() {
        return $this->conexion->affected_rows;
    }

    public function insert_id() {
        return $this->conexion->insert_id;
    }

    public function num_rows($resultado) {
        return $resultado->num_rows;
    }

    public function preparar_consulta($consulta) {
        if ($this->existe_fun_escape) {
            $consulta = $this->conexion->real_escape_string($consulta);
        }
        return $consulta;
    }

    private function verificar_consulta($consulta) {
        if (!$consulta) {
            $salida = "No se ha podido realizar la consulta: " . $this->conexion->error . " <br />";
            $salida .= "Ultima Consulta SQL: " . $this->ultima_consulta;
            die($salida);
        }
    }

    public function cerrar_conexion() {
        if (isset($this->conexion)) {
            $this->conexion->close();
            unset($this->conexion);
        }
    }

}

$bd = new BaseDatos();
?>