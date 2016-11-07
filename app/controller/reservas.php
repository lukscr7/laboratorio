<?php

/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 7/11/2016
 * Time: 05:45
 */
class Reserva_Controller
{

    public function formReserva()
    {
        $tp1 = new TemplatePower("template/reserva.html");
        $tp1->prepare();
        $tp1->gotoBlock("_ROOT");

        $viaje = new Viaje();
        $lista = $viaje->listaViajes();
        if ($lista != null) {
            foreach ($lista as $res) {
                $tp1->newBlock("reserva");
                $tp1->assign("id_viaje", $res->getIdViaje());
                $tp1->assign("origen", $res->getOrigen());
                $tp1->assign("destino", $res->getDestino());
                $tp1->assign("costo", $res->getMontoBasico());
            }
        }
        return $tp1->getOutputContent();
    }

    public function agregarReserva()
    {
        print_r($_POST);
        $reserva = new Reserva();
        $us = new Usuario();
        $us->dat_usuario($_SESSION["usuario"]);
        $cond = new Conductor();
        $viaje = new Viaje();
        $viaje->dat_Viaje($_POST["id"]);
        if ($cond->asignar()) {
            $combi = new Combi();
            if ($combi->asignar($_POST["asiento"])) {
                $costo = $viaje->getMontoBasico() + $viaje->getMontoBasico() * ($_POST["asiento"]/100);
                $resultado = $reserva->insert($us->getUserId(),$cond->getIdC(),$_POST["id"],$combi->getIdCombi(),$costo,$_POST["fecha"],$_POST["hora"]);
                if ($resultado){
                    $cond->ocupado();
                    $combi->ocupado();
                    header('Location: index.php?alerta=Reservado');
                }else{
                    header('Location: index.php?alerta=noCombiLibre');
                }
            } else {
                header('Location: index.php?alerta=noCombiLibre');
            }
        } else {
            header('Location: index.php?alerta=noCondLibre');
        }

    }
}