<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 27/10/2016
 * Time: 02:58 PM
 */

class Condctor{

    private $id_c;
    private $user_id_c;
    private $id_e;
    private $estado;
    private $id_auto;

    /**
     * Crea un Objeto Conductor a partir de un array que surge de una consulta a la base de datos.
     * @param $array
     * @return Condctor
     */
    public function constructorConductor($array)
    {
        $this->id_c = $array["id_c"];
        $this->user_id_c = $array["user_id_c"];
        $this->id_e = $array["id_e"];
        $this->estado = $array["estado"];
        $this->id_auto = $array["id_auto"];
        return $this;
    }


    /**
     * Crea un Objeto Conductor a partir de un id_c
     * @param $id_c
     * @return Condctor
     */
    public function conductor_id($id_c){
        global $baseDatos;
        $sql = "SELECT * FROM conductores WHERE id_c = '$id_c'";
        $resultado = $baseDatos->query($sql);
        $con = $resultado->fetch_assoc();
        return $this->constructorConductor($con);
    }

    /**
     * Devuelve un listado de los Conductores que tiene una Empresa con id_e
     * @param $id_e
     * @return array|null
     */
    public function allConductoresEmpresa($id_e){
        global $baseDatos;
        $listaConductores = array();
        if ($this->existeConductorEmpresa($id_e)){
            $sql = "SELECT * FROM `conductores` WHERE `id_e` = '$id_e'";
            $resultado = $baseDatos->query($sql);
            $conductores = $resultado->fetch_all(MYSQLI_ASSOC);
            foreach ($conductores as $con){
                $conductor = new Condctor();
                $listaConductores[] = $conductor->constructorConductor($con);
            }
            return $listaConductores;
        }else{
            return null;
        }

    }

    /**
     * Consulta si tiene algún Conductor la Empresa con id_e
     * @param $id_e
     * @return bool
     */
    public function existeConductorEmpresa($id_e){
        global $baseDatos;
        $results = $baseDatos->query("SELECT COUNT(*) AS cant FROM `conductores` WHERE `id_e` = '$id_e'");
        $res = $results->fetch_assoc();
        if ($res["cant"] != 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getIdC()
    {
        return $this->id_c;
    }

    /**
     * @param mixed $id_c
     */
    public function setIdC($id_c)
    {
        $this->id_c = $id_c;
    }

    /**
     * @return mixed
     */
    public function getUserIdC()
    {
        return $this->user_id_c;
    }

    /**
     * @param mixed $user_id_c
     */
    public function setUserIdC($user_id_c)
    {
        $this->user_id_c = $user_id_c;
    }

    /**
     * @return mixed
     */
    public function getIdE()
    {
        return $this->id_e;
    }

    /**
     * @param mixed $id_e
     */
    public function setIdE($id_e)
    {
        $this->id_e = $id_e;
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

    /**
     * @return mixed
     */
    public function getIdAuto()
    {
        return $this->id_auto;
    }

    /**
     * @param mixed $id_auto
     */
    public function setIdAuto($id_auto)
    {
        $this->id_auto = $id_auto;
    }

}