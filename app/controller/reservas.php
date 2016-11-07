<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 7/11/2016
 * Time: 05:45
 */
class Reserva_Controller{

    public function formReserva(){
        $tp1 =new TemplatePower("template/reserva.html");
        $tp1->prepare();
        $tp1->gotoBlock("_ROOT");

        $viaje = new Viaje();
        $lista = $viaje->listaViajes();
        if ($lista != null){
            foreach ($lista as $res){
                $tp1->newBlock("reserva");
                $tp1->assign("id_viaje",$res->getIdViaje());
                $tp1->assign("origen",$res->getOrigen());
                $tp1->assign("destino",$res->getDestino());
                $tp1->assign("costo",$res->getMontoBasico());
            }
        }
        return $tp1->getOutputContent();
    }

    public function agregarReserva(){
        print_r($_POST);
    }
}