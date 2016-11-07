<?php

/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 6/11/2016
 * Time: 22:58
 */
class Reserva
{
    //`user_id``id_c``id_viaje``id_combi``costo``fecha_hora``id_reserva`
    private $id_reserva;
    private $user_id;
    private $id_c;
    private $id_viaje;
    private $id_combi;
    private $costo;
    private $fecha;
    private $hora;

    /**
     * Reserva constructor.
     * @param $array
     */
    public function constructorReserva($array)
    {
        $this->id_reserva = $array["id_reserva"];
        $this->user_id = $array["user_id"];
        $this->id_c = $array["id_c"];
        $this->id_viaje = $array["id_viaje"];
        $this->id_combi = $array["id_combi"];
        $this->costo = $array["costo"];
        $this->fecha = $array["fecha"];
        $this->hora = $array["hora"];
    }


    /**
     * @param $user_id
     * @param $id_c
     * @param $id_viaje
     * @param $id_combi
     * @param $costo
     * @param $fecha
     * @param $hora
     * @return bool
     */
    public function insert($user_id, $id_c, $id_viaje, $id_combi, $costo, $fecha, $hora)
    {
        global $baseDatos;
        $sql = "INSERT INTO `reservas` (`user_id`, `id_c`, `id_viaje`, `id_combi`, `costo`, `fecha`, `hora`) 
                VALUES ('$user_id', '$id_c', '$id_viaje', '$id_combi', '$costo', '$fecha', '$hora')";
        $result = $baseDatos->query($sql);
        return $result;
    }

    /**
     * Devuelve un Array de los Viajes que tenemos.
     * @param $user_id
     * @return Reserva[]|null
     */
    public function listaReserva($user_id)
    {
        global $baseDatos;
        if ($this->existeReservaUsuario($user_id)) {
            $sql = "SELECT * FROM `reservas` WHERE `user_id` = '$user_id'";
            $arrayUsuarios = array();
            $resultado = $baseDatos->query($sql);
            $arrayConsulta = $resultado->fetch_all(MYSQLI_ASSOC);
            foreach ($arrayConsulta as $res) {
                $reserva = new Reserva();
                $reserva->constructorReserva($res);
                $arrayUsuarios[] = $reserva;
            }
            return $arrayUsuarios;
        } else {
            return null;
        }
    }

    private function existeReservaUsuario($user_id)
    {
        global $baseDatos;
        $sql = "SELECT COUNT(*) AS cant FROM `reservas` WHERE `user_id` = '$user_id'";
        $results = $baseDatos->query($sql);
        $res = $results->fetch_assoc();
        if ($res["cant"] == 0) {
            return false;
        } else {
            return true;
        }
    }

    private function existeReserva($id_reserva)
    {
        global $baseDatos;
        $sql = "SELECT COUNT(*) AS cant FROM `reservas` WHERE `id_reserva` = '$id_reserva'";
        $results = $baseDatos->query($sql);
        $res = $results->fetch_assoc();
        if ($res["cant"] == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Crea un Objeto Conductor a partir de un id_c
     * @param $id_reserva
     * @return bool
     */
    public function reserva_id($id_reserva){
        global $baseDatos;
        if ($this->existeReserva($id_reserva)){
            $sql = "SELECT * FROM `reservas` WHERE `id_reserva` = '$id_reserva'";
            $resultado = $baseDatos->query($sql);
            $con = $resultado->fetch_assoc();
            $this->constructorReserva($con);
            return true;
        }else{
            return false;
        }
    }

    public function baja(){
        global $baseDatos;
        $id_reserva = $this->getIdReserva();
        $sql = "DELETE FROM `reservas` WHERE `reservas`.`id_reserva` = '$id_reserva'";
        $res = $baseDatos->query($sql);
        return $res;
    }

    /**
     * @return mixed
     */
    public function getIdReserva()
    {
        return $this->id_reserva;
    }

    /**
     * @param mixed $id_reserva
     */
    public function setIdReserva($id_reserva)
    {
        $this->id_reserva = $id_reserva;
    }

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
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * @param mixed $costo
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * @param mixed $hora
     */
    public function setHora($hora)
    {
        $this->hora = $hora;
    }

}