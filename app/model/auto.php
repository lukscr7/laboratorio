<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 27/10/2016
 * Time: 03:20 PM
 */

class Auto{
    //`id_auto``id_e``patente_auto``num_remis_auto``marca_auto``modelo``color``tamaño`

    private $id_auto;
    private $id_e;
    private $patente;
    private $num_remis;
    private $marca;
    private $modelo;
    private $color;
    private $tamaño;

    /**
     * Crea un Objeto Auto a partir de un array que surge de una consulta a la base de datos.
     * @param $array
     * @return $this
     */
    public function constructoAuto($array)
    {
        $this->id_auto = $array["id_auto"];
        $this->id_e = $array["id_e"];
        $this->patente = $array["patente"];
        $this->num_remis = $array["num_remis"];
        $this->marca = $array["marca"];
        $this->modelo = $array["modelo"];
        $this->color = $array["color"];
        $this->tamaño = $array["tamaño"];
        return $this;
    }

    /**
     * retorna una lista de los autos que tiene una empresa $id_e
     * @param $id_e
     * @return array|null
     */
    public function autos_empresa($id_e){
        global $baseDatos;
        $autos_empresa = array();
        //PREGUNTAR SI EXISTE ALGUN AUTO ANTES DE PEDIRLOS SINO PRODUCE ERROR
        if ($this->existeAutoEmpresa($id_e)){
            $sql = "SELECT * FROM autos WHERE id_e = '$id_e'";
            $result = $baseDatos->query($sql);
            $autos = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($autos as $res){
                $auto = new Auto();
                $autos_empresa[] = $auto->constructoAuto($res);//array de Auto que tiene una empresa
            }
            return $autos_empresa;
        }else{
            return null;
        }
    }

    /**
     * Genera un Objeto Auto a partir del id_auto
     * @param $id_auto
     * @return Auto
     */
    public function autoID($id_auto){
        global $baseDatos;
        $sql = "SELECT * FROM `autos` WHERE `id_auto` = '$id_auto'";
        $res = $baseDatos->query($sql);
        $array = $res->fetch_assoc();
        return $this->constructoAuto($array);
    }

    /**
     * Usada para saber si la Empresa id_e tiene algún Auto
     * @param $id_e
     * @return bool
     */
    public function existeAutoEmpresa($id_e){
        global $baseDatos;
        $results = $baseDatos->query("SELECT COUNT(*) AS cant FROM `autos` WHERE `id_e` = '$id_e'");
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
    public function getNumRemis()
    {
        return $this->num_remis;
    }

    /**
     * @param mixed $num_remis
     */
    public function setNumRemis($num_remis)
    {
        $this->num_remis = $num_remis;
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
    public function getTamaño()
    {
        return $this->tamaño;
    }

    /**
     * @param mixed $tamaño
     */
    public function setTamaño($tamaño)
    {
        $this->tamaño = $tamaño;
    }

}