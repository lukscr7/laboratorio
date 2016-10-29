<?php
/**
 * Created by PhpStorm.
 * User: alumno
 * Date: 27/10/2016
 * Time: 02:58 PM
 */

class Condctor{

    //`id_c``user_id_c``descripcion_c``id_e``estado`

    private $id_c;
    private $user_id_c;
    private $descripcion_c;
    private $id_e;
    private $estado;
    private $id_auto;

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
    public function getDescripcionC()
    {
        return $this->descripcion_c;
    }

    /**
     * @param mixed $descripcion_c
     */
    public function setDescripcionC($descripcion_c)
    {
        $this->descripcion_c = $descripcion_c;
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

    public function conductor_id($id_c){
        global $baseDatos;
        $sql = "SELECT * FROM conductores WHERE id_c = $id_c";
        $resultado = $baseDatos->query($sql);
        return $resultado->fetch_assoc();
    }

    public function all_conductores(){
        global $baseDatos;
        $sql = "SELECT * FROM conductores";
        $resultado = $baseDatos->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}