<?php
/**
 * Created by PhpStorm.
 * User: Dario Flores
 * Date: 13/10/2016
 * Time: 13:21
 */

//session_start();
class Vuelos_Controller
{


    private static $menu = array(
        "Registrar Usuario" => "index.php?action=Vuelos::registrar",
        "Vuelos disponibles" => "index.php?action=Ingreso::main",
        "Ver reservas" => "index.php?action=Vuelos::listadoReservas",
        "Eliminar reservas" => "index.php?action=Vuelos::listadoReservasBorrado"
    );

    /**
     * @return stringHTML
     */
    function listado()
    {
        if (isset($_SESSION["usuario"])){
            $tpl = new TemplatePower("Templates/tabla.vuelos.html");
            $tpl->prepare();
            $tpl->gotoBlock("_ROOT");
            $vuelo = new VuelosModel();  //instanciamos la clase Medico_Model
            $results = $vuelo->obtenerVuelos($_POST["origen"], $_POST["destino"],$_POST["fecha"]);  //invocamos al metodo obtener_listado definido en la clase Medico_Model
            if (count($results) > 0) {
                foreach ($results as $res) {
                    $tpl->newblock("listavuelo");
                    $tpl->assign("destino", $vuelo->loc_id($res['destino']));
                    $tpl->assign("origen", $vuelo->loc_id($res['origen']));
                    $tpl->assign("fecS", $res['fec_salida']);
                    $tpl->assign("hrS", $res['hora_salida']);
                    $tpl->assign("fecL", $res['fec_llegada']);
                    $tpl->assign("hrL", $res['hora_llegada']);
                    $tpl->assign("id_vuelo", $res["id_vuelo"]);
                }
            } else $tpl->newBlock("noResult");
            return $tpl->getOutputContent();
        }else{
            return $this->login();
        }


    }

    function listadoReservas()
    {
        if (isset($_SESSION["usuario"])){
            $tpl = new TemplatePower("Templates/tabla.reservas.html");
            $tpl->prepare();
            $tpl->gotoBlock("_ROOT");
            $vuelo = new VuelosModel();  //instanciamos la clase Medico_Model
            $results = $vuelo->obtenerReservas($_SESSION["usuario"]);  //invocamos al metodo obtener_listado definido en la clase Medico_Model
            if (count($results) > 0) {
                foreach ($results as $res) {
                    $tpl->newblock("listavuelo");
                    $viaje = $vuelo->vuelo_id($res["id_vuelo"]);
                    $tpl->assign("destino", $vuelo->loc_id($viaje['destino']));
                    $tpl->assign("origen", $vuelo->loc_id($viaje['origen']));
                    $tpl->assign("fecS", $viaje['fec_salida']);
                    $tpl->assign("hrS", $viaje['hora_salida']);
                    $tpl->assign("fecL", $viaje['fec_llegada']);
                    $tpl->assign("hrL", $viaje['hora_llegada']);
                    $tpl->assign("id_pasaje", $res["id_pasajero"]);
                    $tpl->assign("nomYape", $res["nombre"]." ".$res["apellido"]);
                    $tpl->assign("dni", $res["dni"]);
                    $tpl->assign("nro_silla", $res["nro_silla"]);
                }
            } else $tpl->newBlock("noResult");
            return $tpl->getOutputContent();
        }else{
            return $this->login();
        }

    }

    function listadoReservasBorrado()
    {
        if (isset($_SESSION["usuario"])){
            $tpl = new TemplatePower("Templates/tabla.reservas.borrado.html");
            $tpl->prepare();
            $tpl->gotoBlock("_ROOT");
            $vuelo = new VuelosModel();  //instanciamos la clase Medico_Model
            $results = $vuelo->obtenerReservas($_SESSION["usuario"]);  //invocamos al metodo obtener_listado definido en la clase Medico_Model
            if (count($results) > 0) {
                foreach ($results as $res) {
                    $tpl->newblock("listavuelo");
                    $viaje = $vuelo->vuelo_id($res["id_vuelo"]);
                    $tpl->assign("destino", $vuelo->loc_id($viaje['destino']));
                    $tpl->assign("origen", $vuelo->loc_id($viaje['origen']));
                    $tpl->assign("fecS", $viaje['fec_salida']);
                    $tpl->assign("hrS", $viaje['hora_salida']);
                    $tpl->assign("fecL", $viaje['fec_llegada']);
                    $tpl->assign("hrL", $viaje['hora_llegada']);
                    $tpl->assign("id_pasaje", $res["id_pasajero"]);
                    $tpl->assign("nomYape", $res["nombre"]." ".$res["apellido"]);
                    $tpl->assign("dni", $res["dni"]);
                    $tpl->assign("nro_silla", $res["nro_silla"]);
                    $tpl->assign("id", $res["id_pasajero"]);
                }
            } else $tpl->newBlock("noResult");
            return $tpl->getOutputContent();
        }else{
            return $this->login();
        }
    }


    function borradoPasaje(){
        $vuelo = new VuelosModel();  //instanciamos la clase Medico_Model
        $result = $vuelo->borrarPasajero($_POST["id"]);
        if ($result){
            $vuelo->libre($_POST["nro_silla"]);
            return $this->notificacion("SE ELIMINO CORRECTAMENTE EL PASAJE",true);
        }else{
            return $this->notificacion("PROBLEMAS PARA ELIMINAR PASAJE",false);
        }
    }

    /**
     * @return stringHTML
     */
    public static function menu()
    {
        $tpl = new TemplatePower("Templates/menu.html");
        $tpl->prepare();
        $tpl->gotoBlock("_ROOT");

        foreach (Vuelos_Controller::$menu as $clave => $value) {
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

    function reserva()
    {
        $vuelo = new VuelosModel();
        $tpl = new TemplatePower("Templates/reservar.pasaje.html");
        $tpl->prepare();
        $tpl->gotoBlock("_ROOT");
        $result = $vuelo->vuelo_id($_POST["id"]);
        $tpl->assign("id_vuelo", $result["id_vuelo"]);
        $tpl->assign("destino", $vuelo->loc_id($result["destino"]));
        $tpl->assign("origen", $vuelo->loc_id($result["origen"]));
        $tpl->assign("fecha", $result["fec_salida"]);
        $tpl->assign("hora", $result["hora_salida"]);

        return $tpl->getOutputContent();
    }

    function registrarUser()
    {
        $vuelo = new VuelosModel();
        $tpl = new TemplatePower("Templates/notificacion.html");
        $tpl->prepare();
        $tpl->gotoBlock("_ROOT");
        $valor = $vuelo->insertarUsuario($_POST["nombre"], $_POST["email"], $_POST["pwd"], $_POST["pwdr"]);
        if ($valor["bool"] == "bien") {
            return $this->notificacion($valor["mensaje"], true);
        } else {
            return $this->notificacion($valor["mensaje"], false);
        }
    }

    function notificacion($mensaje, $condicion)
    {
        $tpl = new TemplatePower("Templates/notificacion.html");
        $tpl->prepare();
        $tpl->gotoBlock("_ROOT");
        $tpl->newBlock("notificacion");
        if ($condicion) {
            $tpl->assign("menj", "Muy Bien!");
            $tpl->assign("mensaje", $mensaje);
            $tpl->assign("tipo", "alert-success");
        } else {
            $tpl->assign("menj", "Upps!");
            $tpl->assign("mensaje", $mensaje);
            $tpl->assign("tipo", "alert-danger");
        }
        $tpl->newBlock("notBoton");
        return $tpl->getOutputContent();
    }

    function notificaciones($array)
    {
        $tpl = new TemplatePower("Templates/notificacion.html");
        $tpl->prepare();
        $tpl->gotoBlock("_ROOT");
        foreach ($array as $res){
            $tpl->newBlock("notificacion");
            if ($res["bool"] == "1") {
                $tpl->assign("menj", "Muy Bien!");
                $tpl->assign("mensaje", $res["mensaje"]);
                $tpl->assign("tipo", "alert-success");
            } else {
                $tpl->assign("menj", "Upps!");
                $tpl->assign("mensaje", $res["mensaje"]);
                $tpl->assign("tipo", "alert-danger");
            }
        }
        $tpl->newBlock("notBoton");
        return $tpl->getOutputContent();
    }

    function registrar()
    {
        $tpl = new TemplatePower("Templates/registrar.html");
        $tpl->prepare();
        $tpl->gotoBlock("_ROOT");

        return $tpl->getOutputContent();
    }

    function login()
    {
        $tpl = new TemplatePower("Templates/login.html");
        $tpl->prepare();
        $tpl->gotoBlock("_ROOT");

        return $tpl->getOutputContent();
    }

    function iniciarSesion()
    {
        global $db;
        $user = $db->real_escape_string($_POST["usuario"]);
        $vuelo = new VuelosModel();
        $verif = new Validacion();
        if (!$vuelo->existeUsuario($user)) {
            $usuario = $vuelo->sesion($user);
            if ($verif->pass($_POST["pwd"], $usuario["pass"])) {
                //session_start();
                $_SESSION["usuario"] = $usuario["user_id"];
                $_SESSION["correo"] = $usuario["correo"];
                return $this->notificacion("SE INICIO SESION CORRECTAMENTE", true);
            }
        }
        return $this->notificacion("USUARIO O CONTRASEÑA INCORRECTO", false);
    }

    function cerrarSesion()
    {
        session_destroy();
        return $this->notificacion("SE CERRO LA SESION CON EXITO.", true);
    }


    function reservar()
    {
        $vuelo = new VuelosModel();
        $notificaciones = array();
        $cantLibre = $vuelo->existSillasLibres($_POST["clase"], $_POST["id_vuelo"]);
        if ($_POST["cantidad"] <= $cantLibre) {
            for ($i = 1; $i <= $_POST["cantidad"]; $i++) {
                if ($vuelo->verificarSilla($_POST["clase"],$_POST["ubicacion_silla$i"], $_POST["id_vuelo"])){
                    $nro_silla = $vuelo->asignarSilla($_POST["clase"],$_POST["ubicacion_silla$i"], $_POST["id_vuelo"]);
                    $insert = $vuelo->insertarPasajero($_POST["dni$i"], $_POST["nom$i"], $_POST["ape$i"], $_POST["sexo$i"], $_POST["fecha$i"], $_POST["id_vuelo"], $_SESSION["usuario"], $nro_silla);
                    if ($insert){
                        $notificaciones[$i] = array('mensaje' => "PASAJE SACADO CON EXITO PARA ".$_POST["nom$i"]." ".$_POST["ape$i"],
                            'bool' => "1");
                        $vuelo->ocupado($nro_silla);
                    }else{
                        $notificaciones[$i] = array('mensaje' => "ERROR AL INSERTAR A ".$_POST["nom$i"]." ".$_POST["ape$i"],
                            'bool' => "0");
                    }
                }else{
                    $notificaciones[$i] = array('mensaje' => "ERROR CON EL PASAJE DE ".$_POST["nom$i"]." ".$_POST["ape$i"]." NO HAY SILLA ".$_POST["ubicacion_silla$i"],
                                                'bool' => "0");
                }
            }
            return $this->notificaciones($notificaciones);
        } else {
            return $this->notificacion("SOLO TENEMOS $cantLibre PASAJES PARA ESTE VUELO", false);
        }
    }
}
