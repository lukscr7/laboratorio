<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 27/10/2016
 * Time: 02:58 PM
 */

class Conductor{
                                //`id_c``nombre``apellido``foto_perfil``telefono``correo``estado`
    private $id_c;
    private $nombre;
    private $apellido;
    private $foto_perfil;
    private $telefono;
    private $correo;
    private $estado;

    /**
     * Asigna los datos
     * @param $array
     */
    private function constructorConductor($array)
    {
        $this->id_c = $array["id_c"];
        $this->nombre = $array["nombre"];
        $this->apellido = $array["apellido"];
        $this->foto_perfil = $array["foto_perfil"];
        $this->telefono = $array["telefono"];
        $this->correo = $array["correo"];
        $this->estado = $array["estado"];
    }

    /**
     * Crea un Objeto Conductor a partir de un id_c
     * @param $id_c
     * @return Conductor|null
     */
    public function conductor_id($id_c){
        global $baseDatos;
        if ($this->existeConductorID($id_c)){
            $conductor = new Conductor();
            $sql = "SELECT * FROM conductores WHERE id_c = '$id_c'";
            $resultado = $baseDatos->query($sql);
            $con = $resultado->fetch_assoc();
            $conductor->constructorConductor($con);
            return $conductor;
        }else{
            return null;
        }
    }

    /**
     * Devuelve un listado de los Conductores
     * @return Conductor[]|null
     */
    public function allConductores(){
        global $baseDatos;
        $listaConductores = array();
        if ($this->existeConductor()){
            $sql = "SELECT * FROM `conductores`";
            $resultado = $baseDatos->query($sql);
            $conductores = $resultado->fetch_all(MYSQLI_ASSOC);
            foreach ($conductores as $con){
                $conductor = new Conductor();
                $conductor->constructorConductor($con);
                $listaConductores[] = $conductor;
            }
            return $listaConductores;
        }else{
            return null;
        }
    }

    /**
     * Consulta si tiene algún Conductor ID
     * @return bool
     */
    public function existeConductorID($id_c){
        global $baseDatos;
        $results = $baseDatos->query("SELECT COUNT(*) AS cant FROM `conductores` WHERE `id_c` = '$id_c'");
        $res = $results->fetch_assoc();
        if ($res["cant"] != 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Consulta si tiene algún Conductor
     * @return bool
     */
    public function existeConductor(){
        global $baseDatos;
        $results = $baseDatos->query("SELECT COUNT(*) AS cant FROM `conductores`");
        $res = $results->fetch_assoc();
        if ($res["cant"] != 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Consulta si tiene algún Conductor LIBRE
     * @return bool
     */
    public function existeConductorLibre(){
        global $baseDatos;
        $results = $baseDatos->query("SELECT COUNT(*) AS cant FROM `conductores` WHERE `estado` = 'LIBRE'");
        $res = $results->fetch_assoc();
        if ($res["cant"] != 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * asigna a un Conductor para un Viaje
     * @return bool
     */
    public function asignar(){
        global $baseDatos;
        if ($this->existeConductorLibre()){
            $sql = "SELECT * FROM conductores WHERE `estado` = 'LIBRE'";
            $resultado = $baseDatos->query($sql);
            $con = $resultado->fetch_assoc();
            $this->constructorConductor($con);
            return true;
        }else{
            return false;
        }
    }

    public function ocupado(){
        global $baseDatos;
        $id_c = $this->getIdC();
        $sql = "UPDATE `conductores` SET `estado` = 'OCUPADO' WHERE `conductores`.`id_c` = '$id_c'";
        $res = $baseDatos->query($sql);
        return $res;
    }

    public function verificarDatos($datPOST, $datFILE){
        global $baseDatos;
        $this->setNombre($baseDatos->real_escape_string($datPOST["nombre"]));
        $this->setApellido($baseDatos->real_escape_string($datPOST["apellido"]));
        $this->setCorreo($baseDatos->real_escape_string($datPOST["email"]));
        $this->setTelefono($baseDatos->real_escape_string($datPOST["telefono"]));
        if (!$datFILE["size"] == 0){
            $ruta = $datFILE["tmp_name"];
            $tipo = substr(strrchr($datFILE['name'], "."), 1);
            $destino = "../recursos/imagen/perfil/conductor".$this->getIdC().".".$tipo;
            copy($ruta,$destino);
            $this->setFotoPerfil($destino);
        }
    }

    public function insert($datPOST, $datFILE){
        $this->verificarDatos($datPOST, $datFILE);
        $nom = $this->getNombre();
        $ape = $this->getApellido();
        $correo = $this->getCorreo();
        $telefono = $this->getTelefono();
        $foto = $this->getFotoPerfil();
        $sql = "INSERT INTO `conductores` ( `nombre`, `apellido`, `foto_perfil`, `telefono`, `correo`, `estado`) 
                VALUES ('$nom', '$ape', '$correo', '$telefono', '$foto', 'LIBRE')";
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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
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
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
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