<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 26/10/2016
 * Time: 09:13 PM
 */

class Usuario{

    private $user_id;           //`user_id`,`pass`,`nom_us`,`ape_us`,`correo`,`permisos`,`foto_perfil`,`bandera`
    private $pass;
    private $nom_us;
    private $ape_us;
    private $correo;
    private $permisos;
    private $foto_perfil;
    private $bandera;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getNomUs()
    {
        return $this->nom_us;
    }

    /**
     * @param mixed $nom_us
     */
    public function setNomUs($nom_us)
    {
        $this->nom_us = $nom_us;
    }

    /**
     * @return mixed
     */
    public function getApeUs()
    {
        return $this->ape_us;
    }

    /**
     * @param mixed $ape_us
     */
    public function setApeUs($ape_us)
    {
        $this->ape_us = $ape_us;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @return mixed
     */
    public function getPermisos()
    {
        return $this->permisos;
    }

    /**
     * @param mixed $permisos
     */
    public function setPermisos($permisos)
    {
        $this->permisos = $permisos;
    }

    /**
     * @return mixed
     */
    public function getFotoPerfil()
    {
        return $this->foto_perfil;
    }

    /**
     * @param mixed $foto_perfil
     */
    public function setFotoPerfil($foto_perfil)
    {
        $this->foto_perfil = $foto_perfil;
    }

    /**
     * @return mixed
     */
    public function getBandera()
    {
        return $this->bandera;
    }

    /**
     * @param mixed $bandera
     */
    public function setBandera($bandera)
    {
        $this->bandera = $bandera;
    }
        
    
    public function dat_usuario($user_id){
        global $baseDatos;
        $sql = "SELECT * FROM usuarios WHERE user_id = $user_id";    //PONER COMO SQL
        $resultado = $baseDatos->query($sql);
        return $resultado->fetch_assoc();
    }

    public function all_usuarios(){
        global $baseDatos;
        $sql = "SELECT * FROM usuarios";
        $resultado = $baseDatos->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

}