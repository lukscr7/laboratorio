<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 23/10/2016
 * Time: 15:37
 */

class Menu_Controller{

    private static $menu = array(
        "Pedir Avanzado" => "index.php?action=Vuelos::registrar",
        "Perfil" => "index.php?action=Ingreso::main",
        "Pedidos" => "index.php?action=Vuelos::listadoReservas",
        "Sobre" => "index.php?action=Vuelos::listadoReservasBorrado"
    );


    public static function menu()
    {
        $tpl = new TemplatePower("template/menu.html");
        $tpl->prepare();
        $tpl->gotoBlock("_ROOT");

        foreach (Menu_Controller::$menu as $clave => $value) {
            $tpl->newBlock("menu");
            $tpl->assign("ref", $value);
            $tpl->assign("nom", $clave);
        }
        if (isset($_SESSION["usuario"])) {
            $tpl->newBlock("registrado");
            $tpl->assign("usuario", $_SESSION["usuario"]);
        } else {
            $tpl->newBlock("noReg");
        }

        return $tpl->getOutputContent();
    }
}