<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 15/10/2016
 * Time: 15:53
 */
class Ingreso_Controller{

    public static function main(){

        if (isset($_SESSION["usuario"])){
<<<<<<< HEAD
            if ($_SESSION["permiso"] == "CLIENTE"){
                $perfil = new Perfil_Controller();
                $webapp = $perfil->cliente();
            }
            if ($_SESSION["permiso"] == "ADMIN"){
                $admin = new Administrador_Controller();
                $webapp = $admin->admin();
            }

=======
            $reserva = new Reserva_Controller();
            $webapp = $reserva->formReserva();
>>>>>>> origin/master
        }else{
            $tpl = new TemplatePower("template/login.html");
            $tpl->prepare();
            $tpl->gotoBlock("_ROOT");
            $menu = new Menu_Controller();
            if (isset($_GET["notReg"])){
                $error = $_GET["notReg"];
                $tpl->newBlock("notReg");
                $tpl->assign("mensaje",$menu->notificacion($error));
            }
            if (isset($_GET["notLog"])){
                $error = $_GET["notLog"];
                $tpl->newBlock("notLog");
                $tpl->assign("mensaje",$menu->notificacion($error));
            }
            $webapp = $tpl->getOutputContent();
        }
        return $webapp;
    }
}
?>