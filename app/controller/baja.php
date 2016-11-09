<?php

/**
 * Created by PhpStorm.
 * User: LuksCR7
 * Date: 07/11/2016
 * Time: 18:55
 */
class Baja_Controller
{
    public function bajaUsuario(){
        $us = new Usuario();
        $idUsuario = $_POST['user_id'];
        $us->dat_usuario($idUsuario);
        $res = $us ->baja();
        header('Location: index.php');
        if ($res){
            var_dump("dsalajldajljasd");
        }
    }

    public function bajaConductor(){
        $us = new Conductor();
        $idUsuario = $_POST['id_c'];
        $con = $us->conductor_id($idUsuario);
        $res = $con->baja();
        header('Location: index.php');

    }

    public function bajaViaje(){
        $us = new Viaje();
        $idUsuario = $_POST['id_viaje'];
        $us->dat_Viaje($idUsuario);
        $us->baja();
        header('Location: index.php');

    }


}