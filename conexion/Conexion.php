<?php
//CONEXION A LA BD Y FUNCIONES PARA TRATAR SQL
class Conexion
{
    private $host;
    private $user;
    private $pass;
    private $bbdd;
    public $conexion;
    public $resultado;

    function __construct()
    {
        $this->host='localhost';
        $this->user='root';
        $this->pass='';
        $this->bbdd='bolsaEmpleo';
        $this->conexion = new mysqli($this->host,$this->user,$this->pass,$this->bbdd);
        $this->conexion->set_charset("utf8");
    }

    function consultarBD($consulta)
    {
        return $this->resultado = $this->conexion->query($consulta);
    }

    function consultarBDMulti($consulta)
    {
        return $this->resultado = $this->conexion->multi_query($consulta);
    }

    function devolverFilas()
    {
        return $this->resultado->fetch_array();
    }

    function devolverFilasAssoc()
    {
        return $this->resultado->fetch_assoc();
    }

    function numeroFilas()
    {
        return $this->resultado->num_rows;
    }

    function filasAfectadas()
    {
        return $this->conexion->affected_rows;
    }

    function realEscapeString($dato)
    {
        return $this->conexion->real_escape_string($dato);
    }

    function codificacion()
    {
        return $this->conexion->character_set_name();
    }
}