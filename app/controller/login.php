<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 23/10/2016
 * Time: 18:03
 *
 */

class Login_Controller{

    function iniciarSesion(){
        $us = new Usuario();
        $usuario = $_POST["usuario_loguin"];
        $pass = $_POST["pass_loguin"];
        if ($us->verificarUsuario($usuario,$pass)){
            $us->dat_usuario($usuario);
            $_SESSION["usuario"] = $us->getUserId();
            $_SESSION["permiso"] = $us->getPermisos();
            header('Location: index.php');
        }else{
            header('Location: index.php?notLog=UsuarioMal#log-in'); //#log-in
        }
    }

    public function cerrarSesion(){
        session_destroy();
        header('Location: index.php');
    }



    //public
    public function registrarUsuario(){//hecho asi nomas.. ya lo modifico..... ahora CALCULO AVANZADO
        $us= new Usuario();

        $validar = new Validacion();
        global $baseDatos;
        $usuario=$baseDatos->real_escape_string($_POST['usuario_perfil']);
        $pass=$baseDatos->real_escape_string($_POST['pass_perfil']);
        $pass2=$baseDatos->real_escape_string($_POST['pass2_perfil']);
        $nombre=$baseDatos->real_escape_string($_POST['nombre_perfil']);
        $apellido=$baseDatos->real_escape_string($_POST['apellido_perfil']);
        $correo=$baseDatos->real_escape_string($_POST['correo_perfil']);

        $verificarExistencia=$us->existeUsuario($usuario);
        $verificarPass = $validar->pass($pass,$pass2);
        if ($verificarExistencia==false) {
            if ($verificarPass == true){
                $verificarInsert = $us->insert($usuario, $pass, $nombre, $apellido, $correo);
                if ($verificarInsert==true){
                    header('Location: index.php?notReg=Verificar#Registro');
                }

            }else {
                header('Location: index.php?notReg=Pass#Registro');
            }
        }else{
            header('Location: index.php?notReg=Existe#Registro');
        }
    }


}