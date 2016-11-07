<?php

/**
 * Created by PhpStorm.
 * User: LuksCR7
 * Date: 07/11/2016
 * Time: 11:49
 */
class Modificar_Controller
{
    public function modificarConductor()
    {
        $id_conductor = $_POST['id_c'];
        $tp1 = new TemplatePower("template/modificarConductor.html");
        $tp1->prepare();
        $tp1->gotoBlock("_ROOT");
        $conductor = new Conductor();
        $con = $conductor->existeConductorID($id_conductor);
        if ($con != null) {
            $tp1->newBlock("modificarConductor");
            $tp1->assign("nombre", $con->getNombre());
            $tp1->assign("apellido", $con->getApellido());
            $tp1->assign("telefono", $con->getTelefono());
            $tp1->assign("correo", $con->getCorreo());
            $tp1->assign("id_c",$con->existeConductorID());
        }
        return $tp1->getOutputContent();
    }
}