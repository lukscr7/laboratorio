<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 15/10/2016
 * Time: 15:53
 */
class Ingreso_Controller{

    public static function main(){

        if (isset($_SESSION["permisos"])){
            $perfil = new Perfil_Controller();
            $webapp = $perfil->pasajero();
        }else{
            $tpl = new TemplatePower("template/loguin.html");
            $tpl->prepare();
            $tpl->gotoBlock("_ROOT");
            $webapp = $tpl->getOutputContent();
        }
        return $webapp;
    }
}
?>