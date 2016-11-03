<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 15/10/2016
 * Time: 15:53
 */
class Ingreso_Controller{

    public static function main(){
        $tpl = new TemplatePower("template/loguin.html");
        $tpl->prepare();
        $tpl->gotoBlock("_ROOT");

        return $tpl->getOutputContent();
    }
}
?>