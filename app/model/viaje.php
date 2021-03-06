<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 31/10/2016
 * Time: 23:56
 */
class Viaje
{
    //`id_viaje``origen``destino``monto_basico`
    private $id_viaje;
    private $origen;
    private $destino;
    private $monto_basico;

    /**
     * Viaje constructor.
     * @param $array
     */
    private function constructorViaje($array)
    {
        $this->id_viaje = $array["id_viaje"];
        $this->origen = $array["origen"];
        $this->destino = $array["destino"];
        $this->monto_basico = $array["monto_basico"];
    }

    /**
     * Trae todos los datos de un Usuario user_id de la Base de Datos.
     * @param $id_viaje
     * @return bool
     */
    public function dat_Viaje($id_viaje){
        global $baseDatos;
        if ($this->existeViajeID($id_viaje)){
            $sql = "SELECT * FROM `viajes` WHERE `id_viaje` = '$id_viaje'";
            $resultado = $baseDatos->query($sql);
            if ($resultado != false){
                $this->constructorViaje($resultado->fetch_assoc());
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function baja(){
        global $baseDatos;
        $user_id = $this->getIdViaje();
        $sql = "DELETE FROM `viajes` WHERE `viajes`.`id_viaje` = '$user_id'";
        $res = $baseDatos->query($sql);
        return $res;
    }

    /**
     * Devuelve un Array de los Viajes que tenemos.
     * @return Viaje[]|null
     */
    public function listaViajes()
    {
        global $baseDatos;
        if ($this->existeViaje()){
            $sql = "SELECT * FROM `viajes`";
            $arrayUsuarios = array();
            $resultado = $baseDatos->query($sql);
            $arrayConsulta = $resultado->fetch_all(MYSQLI_ASSOC);
            foreach ($arrayConsulta as $res){
                $viaje = new Viaje();
                $viaje->constructorViaje($res);
                $arrayUsuarios[] = $viaje;
            }
            return $arrayUsuarios;
        }else{
            return null;
        }
    }

    /**
     * Verifica si tenemos Viajes
     * true = Si!   --   false = No :C
     * @return bool
     */
    public function existeViaje(){
        global $baseDatos;
        $sql = "SELECT COUNT(*) AS cant FROM `viajes`";
        $results = $baseDatos->query($sql);
        $res = $results->fetch_assoc();
        if ($res["cant"] == 0){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Verifica si tenemos Viajes
     * true = Si!   --   false = No :C
     * @return bool
     */
    public function existeViajeID($id_viaje){
        global $baseDatos;
        $sql = "SELECT COUNT(*) AS cant FROM `viajes` WHERE `id_viaje` = '$id_viaje'";
        $results = $baseDatos->query($sql);
        $res = $results->fetch_assoc();
        if ($res["cant"] == 0){
            return false;
        }else{
            return true;
        }
    }

    /**
     * @return mixed
     */
    public function getIdViaje()
    {
        return $this->id_viaje;
    }

    /**
     * @param mixed $id_viaje
     */
    public function setIdViaje($id_viaje)
    {
        $this->id_viaje = $id_viaje;
    }

    /**
     * @return mixed
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * @param mixed $origen
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;
    }

    /**
     * @return mixed
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * @param mixed $destino
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;
    }

    /**
     * @return mixed
     */
    public function getMontoBasico()
    {
        return $this->monto_basico;
    }

    /**
     * @param mixed $monto_basico
     */
    public function setMontoBasico($monto_basico)
    {
        $this->monto_basico = $monto_basico;
    }

}