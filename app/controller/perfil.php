<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 23/10/2016
 * Time: 10:13
 */
class Perfil_Controller{

    public function pasajero(){
        if (isset($_SESSION["user_id"])){  //PREGUNTO SI YA A INICIADO SESION
            $usuario = new Usuario($_SESSION["user_id"]); //PIDO LOS DATOS DEL USUARIO

            $tp1 = new TemplatePower("../template/perfil.html");
            $tp1->prepare();
            $tp1->gotoBlock("_ROOT");

            //VALORES DE LA PAGINA
            $tp1->assign("nombre_usuario",$usuario->getNomUs());
            $tp1->assign("tipo_usuario",$usuario->getPermisos());
            $tp1->assign("imagen_pasajero",$usuario->getFotoPerfil());
            $tp1->assign("descripcion",""); //YA VEMOS SI LE PONEMOS DESCRIPCION AL USUARIO
            $tp1->assign("titulo_body","Historial de Viajes");

            //LUGARES FAVORITOS
            $tp1->newBlock("boton.lugar.favoritos"); // CREO EL BOTON DE LUGARES FAVORITOS
            $tp1->newBlock("modal.lugar.favoritos"); // CREO EL MODEL DEL BOTON DE LUGARES FAVORITOS



        }

    }
}