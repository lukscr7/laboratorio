<?php

/**
 * Created by PhpStorm.
 * User: LuksCR7
 * Date: 07/11/2016
 * Time: 3:09
 */
class Administrador_Controller
{
    private static $menu_administrador = array(
        "Usuarios" => "index.php?action=Vuelos::registrar",
        "Viajes" => "index.php?action=Ingreso::main",
        "Conductores" => "index.php?action=Vuelos::listadoReservas",
        "Combi's" => "index.php?action=Vuelos::listadoReservasBorrado"
    );

    public function admin(){
        $tp1 = new TemplatePower("template/administrador.html");
        $tp1->prepare();
        $tp1->gotoBlock("_ROOT");
        return $tp1->getOutputContent();
    }

    public function hacerAdmin(){
        $user_id = $_POST["user_id"];
        $us = new Usuario();
        $us->dat_usuario($user_id);
        $res = $us->hacerAdmin();
        if ($res){
            header('Location: index.php?alerta=ADMIN');
        }else{
            header('Location: index.php?alerta=noADMIN');
        }

    }

}