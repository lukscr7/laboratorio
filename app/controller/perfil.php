<?php

/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 23/10/2016
 * Time: 10:13
 */
class Perfil_Controller
{

    public function cliente()
    {
        $us = new Usuario(); //PIDO LOS DATOS DEL USUARIO
        $us->dat_usuario($_SESSION["usuario"]);
        $tp1 = new TemplatePower("template/perfil.html");
        $tp1->prepare();
        $tp1->gotoBlock("_ROOT");

        //VALORES DE LA PAGINA
        $tp1->assign("nombre_usuario", $us->getNomUs() . " " . $us->getApeUs());
        $tp1->assign("tipo_usuario", $us->getPermisos());
        $tp1->assign("imagen_pasajero", $us->getFotoPerfil());
        $tp1->assign("titulo_body", "Historial de Reservas");

        $tp1->newBlock("editarPerfil");
        $tp1->newBlock("modalPerfil");
        $tp1->assign("nom", $us->getNomUs());
        $tp1->assign("ape", $us->getApeUs());
        $tp1->assign("email", $us->getCorreo());

        //TARJETAS DE RESERVAS REALIZADAS
        $reserva = new Reserva();
        $lista = $reserva->listaReserva($us->getUserId());
        if ($lista != null) {
            $tp1->newBlock("tarjetaViaje");
            foreach ($lista as $res) {
                $conductor = new Conductor();
                $con = $conductor->conductor_id($res->getIdC());
                $viaje = new Viaje();
                $viaje->dat_Viaje($res->getIdViaje());
                $combi = new Combi();
                $combi->dat_combi($res->getIdCombi());
                $tp1->assign("destino", $viaje->getDestino());
                $tp1->assign("id_cond",$con->getIdC());
                $tp1->assign("imagen", $con->getFotoPerfil());
                $tp1->assign("origen", $viaje->getOrigen());
                $tp1->assign("fecha", $res->getFecha());
                $tp1->assign("hora", $res->getHora());
                $tp1->assign("asientos", $combi->getCantAsientos());
                $tp1->assign("costo", $res->getCosto());
            }
        } else {
            $tp1->newBlock("notarjetaViaje");
        }
        return $tp1->getOutputContent();
    }

    public function editarDatos()
    {
        $us = new Usuario();
        $us->dat_usuario($_SESSION["usuario"]);
        $res = $us->verificarModificacion($_POST, $_FILES["foto"]);
        if ($res) {
            header('Location: index.php?alerta=Update');
        } else {
            header('Location: index.php?alerta=UpdateMal');
        }
    }

    public function conductor()
    {
        $con = new Conductor(); //PIDO LOS DATOS DEL USUARIO
        $con = $con->conductor_id($_GET["id"]);
        $tp1 = new TemplatePower("template/perfil.html");
        $tp1->prepare();
        $tp1->gotoBlock("_ROOT");

        //VALORES DE LA PAGINA
        $tp1->assign("nombre_usuario", $con->getNombre() . " " . $con->getApellido());
        $tp1->assign("imagen_pasajero", $con->getFotoPerfil());
        $tp1->assign("descripcion","Telefono: ".$con->getTelefono()."   Correo: ".$con->getCorreo());

        return $tp1->getOutputContent();
    }
}