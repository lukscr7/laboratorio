<?php
/**
 * Created by PhpStorm.
 * User: alumno
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

    public function autos_empresa($id_e){
        global $baseDatos;
        $sql = "SELECT * FROM autos WHERE id_e = $id_e";
        $resultado = $baseDatos->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function auto_conductor($id_c){
        //Continuar 27/10 15:30
    }
}