<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 23/10/2016
 * Time: 15:37
 */

class Menu_Controller{

    private static $menu_pasajero = array(
        "Pedir Avanzado" => "index.php?action=Vuelos::registrar",
        "Perfil" => "index.php?action=Ingreso::main",
        "Pedidos" => "index.php?action=Vuelos::listadoReservas",
        "Sobre" => "index.php?action=Vuelos::listadoReservasBorrado"
    );

    private static $errores = array(        //Agregar mensajes de error AQUÍ
        "UsuarioMal" => array(
            "mensaje" => "Usuario o Contraseña Incorrecta",
            "condicion" => "Error"          //Correcto: Verde   Error: Rojo     Info: Azul      Cuidado: Amarilo
        ),
        "Update" => array(
            "mensaje" => "Se Modificaron los Datos con Éxito!.",
            "condicion" => "Correcto"       //Correcto: Verde   Error: Rojo     Info: Azul      Cuidado: Amarilo
        ),
        "UpdateMal" => array(
            "mensaje" => "NO Se Modificaron los Datos.",
            "condicion" => "Error"       //Correcto: Verde   Error: Rojo     Info: Azul     Cuidado: Amarilo
        ),
        "Pass" => array(
            "mensaje" => "Error al registrar! las Contraseñas no coinciden, debe ingresar la misma cotraseña para realizar el registro, intentelo NUEVAMENTE",
            "condicion" => "Error"
        ),
        "Existe" => array(
            "mensaje" => "Ups! el nombre de usuario que quiere ingresar ya existe, vuelva a intentarlo con uno diferente",
            "condicion" => "Cuidado"
        ),
        "Verificar" => array(
            "mensaje" => "Felicidades! usted se a registrado con exito",
            "condicion" => "Correcto"
        ),
        "SinDatos" => array(
            "mensaje" => "Para registrarse debe llenar el formulario, Gracias",
            "condicion" => "Info"
        )
    );

    public static function menu()
    {
        if (isset($_SESSION["usuario"])){
            $tpl = new TemplatePower("template/menu.html");
            $tpl->prepare();
            $tpl->gotoBlock("_ROOT");

            foreach (Menu_Controller::$menu_pasajero as $clave => $value) {
                $tpl->newBlock("menu");
                $tpl->assign("ref", $value);
                $tpl->assign("nom", $clave);
            }
            $us = new Usuario();
            $us->dat_usuario($_SESSION["usuario"]);
            $tpl->newBlock("registrado");
            $tpl->assign("usuario", $us->getNomUs()." ".$us->getApeUs());
        }else{
            $tpl = new TemplatePower("template/menu_login.html");
            $tpl->prepare();
            $tpl->gotoBlock("_ROOT");
        }
        return $tpl->getOutputContent();
    }

    public static function notificacion($codigo)
    {
        $tpl = new TemplatePower("template/notificacion.html");
        $tpl->prepare();
        $tpl->gotoBlock("_ROOT");
        $error = Menu_Controller::$errores;
        if (isset($error[$codigo])){
            switch ($error[$codigo]["condicion"]){
                case "Correcto":
                    $tpl->assign("menj", "Muy Bien!");
                    $tpl->assign("tipo", "alert-success");
                    break;
                case "Info":
                    $tpl->assign("menj", "Info!");
                    $tpl->assign("tipo", "alert-info");
                    break;
                case "Error":
                    $tpl->assign("menj", "Upps!");
                    $tpl->assign("tipo", "alert-danger");
                    break;
                case "Cuidado":
                    $tpl->assign("menj", "Warning!");
                    $tpl->assign("tipo", "alert-warning");
                    break;
                default:
                    $tpl->assign("menj", "Info!");
                    $tpl->assign("tipo", "alert-info");
                    break;
            }
            $tpl->assign("mensaje", $error[$codigo]["mensaje"]);
        }else{
            $tpl->assign("menj", "Upps!");
            $tpl->assign("mensaje", "JAJAJA NO ME VAS A HACKEAR");
            $tpl->assign("tipo", "alert-danger");
        }
        return $tpl->getOutputContent();
    }
}