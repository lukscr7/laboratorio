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
    private $nom_lugar;
    private $ubicacion;
    private $id_lugar;
    private $longitud;
    private $latitud;

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
     * @return mixed
     */
    public function getNomLugar()
    {
        return $this->nom_lugar;
    }

    /**
     * @param mixed $nom_lugar
     */
    public function setNomLugar($nom_lugar)
    {
        $this->nom_lugar = $nom_lugar;
    }

    /**
     * @return mixed
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * @param mixed $ubicacion
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;
    }

    /**
     * @return mixed
     */
    public function getIdLugar()
    {
        return $this->id_lugar;
    }

    /**
     * @param mixed $id_lugar
     */
    public function setIdLugar($id_lugar)
    {
        $this->id_lugar = $id_lugar;
    }

    /**
     * @return mixed
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * @param mixed $longitud
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
    }

    /**
     * @return mixed
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * @param mixed $latitud
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    }


    public function lugares_usuario($user_id){
        global $baseDatos;
        $sql = "SELECT * FROM lugares_favoritos WHERE user_p = $user_id";
        $resultado = $baseDatos->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}