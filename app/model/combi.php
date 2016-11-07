<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 27/10/2016
 * Time: 03:20 PM
 */

class Combi{
    //`id_combi``patente``marca``modelo``color``cant_asientos``estado`
    private $id_combi;
    private $patente;
    private $marca;
    private $modelo;
    private $color;
    private $cant_asientos;
    private $estado;

    /**
     * Crea un Objeto Auto a partir de un array que surge de una consulta a la base de datos.
     * @param $array
     */
    public function constructorCombi($array)
    {
        $this->id_combi = $array["id_combi"];
        $this->patente = $array["patente"];
        $this->marca = $array["marca"];
        $this->modelo = $array["modelo"];
        $this->color = $array["color"];
        $this->cant_asientos = $array["cant_asientos"];
        $this->estado = $array["estado"];
    }

    /**
     * Trae todos los datos de un Usuario user_id de la Base de Datos.
     * @param $id_combi
     * @return bool
     */
    public function dat_combi($id_combi){
        global $baseDatos;
        if ($this->existeCombiID($id_combi)){
            $sql = "SELECT * FROM `combi` WHERE `id_combi` = '$id_combi'";
            $resultado = $baseDatos->query($sql);
            if ($resultado != false){
                $this->constructorCombi($resultado->fetch_assoc());
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * Consulta si tiene algún Conductor la Empresa con id_e
     * @return bool
     */
    public function existeCombiLibre(){
        global $baseDatos;
        $results = $baseDatos->query("SELECT COUNT(*) AS cant FROM `combi` WHERE `estado` = 'LIBRE'");
        $res = $results->fetch_assoc();
        if ($res["cant"] != 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Consulta si tiene algún Conductor la Empresa con id_e
     * @return bool
     */
    public function existeCombiID($id_combi){
        global $baseDatos;
        $results = $baseDatos->query("SELECT COUNT(*) AS cant FROM `combi` WHERE `id_combi` = '$id_combi'");
        $res = $results->fetch_assoc();
        if ($res["cant"] != 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Consulta si tiene algún Conductor la Empresa con id_e
     * @return bool
     */
    public function existeCombi(){
        global $baseDatos;
        $results = $baseDatos->query("SELECT COUNT(*) AS cant FROM `combi`");
        $res = $results->fetch_assoc();
        if ($res["cant"] != 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * asigna a un Combi para un Viaje
     * @return bool
     */
    public function asignar($silla){
        global $baseDatos;
        if ($this->existeCombiLibre()){
            $sql = "SELECT * FROM combi WHERE `estado` = 'LIBRE' AND `cant_asientos` = '$silla'";
            $resultado = $baseDatos->query($sql);
            $con = $resultado->fetch_assoc();
            $this->constructorCombi($con);
            return true;
        }else{
            return false;
        }
    }

    public function ocupado(){
        global $baseDatos;
        $id_combi = $this->getIdCombi();
        $sql = "UPDATE `combi` SET `estado` = 'OCUPADO' WHERE `combi`.`id_combi` = '$id_combi'";
        $res = $baseDatos->query($sql);
        return $res;
    }

    /**
     * @return Combi[]|null
     */
    public function listaCombis(){
        global $baseDatos;
        if ($this->existeCombi()){
            $sql = "SELECT * FROM `combi`";
            $arrayCombis = array();
            $resultado = $baseDatos->query($sql);
            $arrayConsulta = $resultado->fetch_all(MYSQLI_ASSOC);
            foreach ($arrayConsulta as $res){
                $combi = new Combi();
                $combi->constructorCombi($res);
                $arrayCombis[] = $combi;
            }
            return $arrayCombis;
        }else{
            return null;
        }
    }

    /**
     * Da de BAJA al Usuario referenciado.
     * @return bool
     */
    public function baja(){
        global $baseDatos;
        $id_combi = $this->getIdCombi();
        $sql = "DELETE FROM `combi` WHERE `combi`.`id_combi` = '$id_combi'";
        $res = $baseDatos->query($sql);
        return $res;
    }

    /**
     * @return mixed
     */
    public function getIdCombi()
    {
        return $this->id_combi;
    }

    /**
     * @param mixed $id_combi
     */
    public function setIdCombi($id_combi)
    {
        $this->id_combi = $id_combi;
    }

    /**
     * @return mixed
     */
    public function getPatente()
    {
        return $this->patente;
    }

    /**
     * @param mixed $patente
     */
    public function setPatente($patente)
    {
        $this->patente = $patente;
    }

    /**
     * @return mixed
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * @param mixed $marca
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    /**
     * @return mixed
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * @param mixed $modelo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getCantAsientos()
    {
        return $this->cant_asientos;
    }

    /**
     * @param mixed $cant_asientos
     */
    public function setCantAsientos($cant_asientos)
    {
        $this->cant_asientos = $cant_asientos;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

}