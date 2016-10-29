<?php

class BaseDatos
{
    private $conexion;

    function __construct($host, $user, $pass, $db)
    {
        $this->conexion = new mysqli($host, $user, $pass, $db);
        if (!$this->conexion){
            echo "No se pudo conectar a la Base de Datos";
        }
    }

    function __destruct()
    {
        return $this->conexion->close();
    }

    function consultar($query)
    {



        //extrae datos de la db
        $result = mysqli_query($this->conexion, $query);
        $found = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return array("result" => $result, "found" => $found);
    }

    function liberarBuffer($datos)
    {
        //liberar buffer de memoria
        mysqli_free_result($datos);
    }

    function ejecutar($sql)
    {
        //incluir modificar o elminar en la bd
        mysqli_query($this->conexion, $sql);
    }
}