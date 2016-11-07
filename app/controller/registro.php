<?php

/**
 * Created by PhpStorm.
 * User: LuksCR7
 * Date: 07/11/2016
 * Time: 4:50
 */
class Registros_Controller
{

    public function verUsuarios()
    {
        $tp1 = new TemplatePower("template/adm_tabla_usuario.html");
        $tp1->prepare();
        $tp1->gotoBlock("_ROOT");
        $us = new Usuario();
        $lista = $us->all_usuarios();
        if ($lista != null) {
            foreach ($lista as $res) {
                $tp1->newBlock("body");
                $tp1->assign("id_c", $res->getUserId());
                $tp1->assign("pass", $res->getPass());
                $tp1->assign("nombre", $res->getNomUs());
                $tp1->assign("apellido", $res->getApeUs());
                $tp1->assign("correo", $res->getCorreo());
                $tp1->assign("permisos", $res->getPermisos());
                $tp1->assign("foto_perfil",$res->getFotoPerfil());
            }
        }
        return $tp1->getOutputContent();
    }

    public function verViajes()
    {
        $tp1 = new TemplatePower("template/adm_tabla_viaje.html");
        $tp1->prepare();
        $tp1->gotoBlock("_ROOT");
        $viaje = new Viaje();
        $lista = $viaje->listaViajes();
        if ($lista != null) {
            foreach ($lista as $res) {
                $tp1->newBlock("body");
                $tp1->assign("id_viaje", $res->getIdViaje());
                $tp1->assign("origen", $res->getOrigen());
                $tp1->assign("destino", $res->getDestino());
                $tp1->assign("costo", $res->getMontoBasico());
            }
        }
        return $tp1->getOutputContent();
    }

    public function verConductores()
    {
        $tp1 = new TemplatePower("template/adm_tabla_conductor.html");
        $tp1->prepare();
        $tp1->gotoBlock("_ROOT");
        $conductor = new Conductor();
        $lista = $conductor->allConductores();
        if ($lista != null) {
            foreach ($lista as $res) {
                $tp1->newBlock("body");
                $tp1->assign("id_c", $res->getIdC());
                $tp1->assign("nombre", $res->getNombre());
                $tp1->assign("apellido", $res->getApellido());
                $tp1->assign("telefono", $res->getTelefono());
                $tp1->assign("correo", $res->getCorreo());
                $tp1->assign("estado", $res->getCorreo());
                $tp1->assign("foto_perfil", $res->getFotoPerfil());
            }
        }
        return $tp1->getOutputContent();
    }

    public function verCombis()
    {
        $tp1 = new TemplatePower("template/adm_tabla_combi.html");
        $tp1->prepare();
        $tp1->gotoBlock("_ROOT");
        $combi = new Combi();
        $lista = $combi->autos_empresa();
        if ($lista != null) {
            foreach ($lista as $res) {
                $tp1->newBlock("body");
                $tp1->assign("id_combi", $res->);
                $tp1->assign("patente", $res->());
                $tp1->assign("marca", $res->());
                $tp1->assign("modelo", $res->());
                $tp1->assign("color", $res->());
                $tp1->assign("cant_asientos", $res->());
            }
        }
        return $tp1->getOutputContent();
    }
}