<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 31/10/2016
 * Time: 23:56
 */
class Viaje
{
    //`user_id_p``id_c``origen``destino``tiempo_origen``tiempo_destino``costo``fecha_hora``id_forma_pago``id_viaje``num_auto`
    private $user_id_p;
    private $id_c;
    private $origen;
    private $destino;
    private $tiempo_origen;
    private $tiempo_destino;
    private $costo;
    private $fecha_hora;
    private $id_forma_pago;
    private $id_viaje;

    /**
     * Viaje constructor.
     * @param $user_id_p
     * @param $id_c
     * @param $origen
     * @param $destino
     * @param $tiempo_origen
     * @param $tiempo_destino
     * @param $costo
     * @param $fecha_hora
     * @param $id_forma_pago
     * @param $id_viaje
     * @return Viaje
     */

    public function newViaje($user_id_p, $id_c, $origen, $destino, $tiempo_origen, $tiempo_destino, $costo, $fecha_hora, $id_forma_pago, $id_viaje)
    {
        $this->user_id_p = $user_id_p;
        $this->id_c = $id_c;
        $this->origen = $origen;
        $this->destino = $destino;
        $this->tiempo_origen = $tiempo_origen;
        $this->tiempo_destino = $tiempo_destino;
        $this->costo = $costo;
        $this->fecha_hora = $fecha_hora;
        $this->id_forma_pago = $id_forma_pago;
        $this->id_viaje = $id_viaje;
        return $this;
    }
                                    //CONTINUAR
    /**
     * @param $user_id
     * @return mixed
     */
    public function listaViajes($user_id)
    {
        global $baseDatos;
        $sql = "SELECT * FROM `viajes` WHERE `user_id_p` = '$user_id'";
        $result = $baseDatos->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function hayViajes($user_id){
        global $baseDatos;
        $results = $baseDatos->query("SELECT COUNT(*) AS cant FROM usuario WHERE user_id = '$user_id'");
        $res = $results->fetch_assoc();
        if ($res["cant"] == 0){
            return false;
        }else{
            return true;
        }
    }
}