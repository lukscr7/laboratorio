<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 31/10/2016
 * Time: 23:56
 */
class Viajes{

    //`user_id_p``id_c``origen``destino``tiempo_origen``tiempo_destino``costo``fecha_hora``id_forma_pago``id_viaje``num_auto`
    private $viajes = array();

    /**
     * Viajes constructor.
     * @param $user_id
     */
    public function __construct($user_id)
    {
        $this->viajes = $this->listaViajes($user_id);
    }

    private function listaViajes($user_id){
        //CONTINUAR devolver todos los viajes realizados por el usuario
    }

    /**
     * @return array|void
     */
    public function getViajes()
    {
        return $this->viajes;
    }
}