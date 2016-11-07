<?php

/**
 * Created by PhpStorm.
 * User: LuksCR7
 * Date: 23/10/2016
 * Time: 18:03
 *
 */
class Login_Controller
{

    function iniciarSesion()
    {
        $us = new Usuario();
        $usuario = $_POST["usuario_loguin"];
        $pass = $_POST["pass_loguin"];
        if ($us->verificarUsuario($usuario, $pass)) {
            $us->dat_usuario($usuario);
            $_SESSION["usuario"] = $us->getUserId();
            $_SESSION["permiso"] = $us->getPermisos();
            header('Location: index.php');
        } else {
            header('Location: index.php?notLog=UsuarioMal#log-in'); //#log-in
        }
    }

    public function cerrarSesion()
    {
        session_destroy();
        header('Location: index.php');
    }


    //public
    public function registrarUsuario()
    {//hecho asi nomas.. ya lo modifico..... ahora CALCULO AVANZADO
        $us = new Usuario();
        $vacio = false;
        foreach ($_POST as $key => $value) {
            if (empty($value)) {
                $vacio = true;
            }
        }
        if (!$vacio) {
            $validar = new Validacion();
            global $baseDatos;
            $usuario = $baseDatos->real_escape_string($_POST['usuario_perfil']);
            $pass = $baseDatos->real_escape_string($_POST['pass_perfil']);
            $pass2 = $baseDatos->real_escape_string($_POST['pass2_perfil']);
            $nombre = $baseDatos->real_escape_string($_POST['nombre_perfil']);
            $apellido = $baseDatos->real_escape_string($_POST['apellido_perfil']);
            $correo = $baseDatos->real_escape_string($_POST['correo_perfil']);

            $verificarExistencia = $us->existeUsuarioID($usuario);
            $verificarPass = $validar->pass($pass, $pass2);
            if ($verificarExistencia == false) {
                if ($verificarPass == true) {
                    $verificarInsert = $us->insert($usuario, $pass, $nombre, $apellido, $correo);
                    if ($verificarInsert == true) {
                        header('Location: index.php?notReg=Verificar#Registro');
                    } else {
                        header('Location: index.php?notReg=ErrorInsert#Registro');
                    }

                } else {
                    header('Location: index.php?notReg=Pass#Registro');
                }
            } else {
                header('Location: index.php?notReg=Existe#Registro');
            }
        }else{
            header('Location: index.php?notReg=SinDatos#Registro');
        }

    }

    //public
    public function registrarConductor()
    {//hecho asi nomas.. ya lo modifico..... ahora CALCULO AVANZADO
        $con = new Conductor();
        global $baseDatos;
        $nombre = $baseDatos->real_escape_string($_POST['nombre_con']);
        $apellido = $baseDatos->real_escape_string($_POST['apellido_con']);
        $telefono = $_POST['telefono_con'];
        $correo = $_POST['correo_con'];
        $foto = $_POST['foto_con'];
        $verificarInsert = $con->insert2($nombre, $apellido, $correo, $telefono);
        if ($verificarInsert == true) {
            header('Location: index.php?notReg=ErrorInsert#Registro');
        }

    }

    public function actualizarConductor(){
        $con = new Conductor();
        global $baseDatos;
        $id = $baseDatos->real_escape_string($_POST['id_c']);
        $nombre = $baseDatos->real_escape_string($_POST['nombre_con']);
        $apellido = $baseDatos->real_escape_string($_POST['apellido_con']);
        $telefono = $_POST['telefono_con'];
        $correo = $baseDatos->real_escape_string($_POST['correo_perfil']);
        $foto = $_POST['foto_con'];
        $verificarUpdate = $con->update($id, $nombre, $apellido, $correo, $telefono);
        if ($verificarUpdate == true) {
            header('Location: index.php?notReg=ErrorInsert#Registro');
        }

    }



}