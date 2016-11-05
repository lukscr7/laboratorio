<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 27/10/2016
 * Time: 02:39 PM
 */

class LugarFavorito{

    //`user_p``nom_lugar``ubicacion``id_lugar``longitud``latitud`
    private $user_p;
    private $lugares = array();

    /*
    private $nom_lugar;
    private $ubicacion;
    private $id_lugar;
    private $longitud;
    private $latitud;
    */



    /**
     * LugarFavorito constructor.
     * @param $user_p
     */
    public function __construct($user_p)
    {
        $this->user_p = $user_p;
        $this->lugares = $this->lugares_usuario($user_p);
    }


    public function lugares_usuario($user_id){
        global $baseDatos;
        $sql = "SELECT id_lugar,nom_lugar,ubicacion,longitud,latitud FROM lugares_favoritos WHERE user_p = '$user_id'";
        $resultado = $baseDatos->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * @return mixed
     */
    public function getUserP()
    {
        return $this->user_p;
    }

    /**
     * @param mixed $user_p
     */
    public function setUserP($user_p)
    {
        $this->user_p = $user_p;
    }

    /**
     * @return array|mixed
     */
    public function getLugares()
    {
        return $this->lugares;
    }

    /**
     * @param array|mixed $lugares
     */
    public function setLugares($lugares)
    {
        $this->lugares = $lugares;
    }
}