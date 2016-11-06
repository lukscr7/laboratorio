<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 23/10/2016
 * Time: 18:03
 *
 */

class Login_Controller{

    public function validar_login()
    {
        $usuario = new Usuario();
        echo 'hola';
        // Si el usuario ya pasó por la pantalla inicial y presionó el botón "Ingresar"
        $existeUsuario= $usuario->dat_usuario($_POST['usuario_loguin']);
        if($existeUsuario){   // La variable $ExisteUsuarioyPassoword recibe valor TRUE si el usuario existe y FALSE en caso que no. Este valor lo determina el modelo.
                    $validar = new Validacion();
                    $validacioncorrecta = $validar->pass($_POST['pass_loguin'],$existeUsuario["pass"]);
                    if ($validacioncorrecta==1){
                        echo 'ok';
                    }else{
                        echo 'pone bien dario culiau';
                    }
                    echo "Validacion Ok<br><br><a href=''>Volver</a>";   //   Si el usuario ingresó datos de acceso válido, imprimos un mensaje de validación exitosa en pantalla
        }
        else{   //   Si no logró validar
                    $data['error']="Usuario o password incorrecto/a, por favor vuelva a intentar";
                    $this->load->view('login',$data);   //   Lo regresamos a la pantalla de login y pasamos como parámetro el mensaje de error a presentar en pantalla
        }
    }


    function iniciarsesion(){
        $us = new Usuario();
        $usuario = $_POST["usuario_loguin"];
        $pass = $_POST["pass_loguin"];
        if ($us->verificarUsuario($usuario,$pass)){
            $us->dat_usuario($usuario);
            $_SESSION["usuario"] = $us->getUserId();
            $_SESSION["permiso"] = $us->getPermisos();
            header('Location: index.php');
        }else{
            print "EL usuario o contraseña esta mal";
            header('Location: index.php');
        }
    }

    public function cerrarSesion(){
        session_destroy();
        header('Location: index.php');
    }

    public function pedirSinUsuario(){ //MODIFICARRRR!!
        session_start();
        $us = new Usuario();
        $nombre = $_POST["nombre_sinusuario"];
        $apellido = $_POST["apellido_sinusuario"];
        if($_SESSION["nombre"] == $nombre){
            echo "pedido realizado";
        }else {
            $_SESSION["nombre"] = $nombre;
            $_SESSION["apellido"] = $apellido;
            header('Location: index.php');
            session_destroy();
        }
    }

    //public
    public function registrarUsuario(){//hecho asi nomas.. ya lo modifico..... ahora CALCULO AVANZADO
        $us= new Usuario();


        //$_SESSION["usuario"]=$_POST['nombre_perfil'];
        //$_SESSION["apellido"]=$_POST['apellido_perfil'];
        $array = $_POST;
        $apellido=$_POST['apellido_perfil'];
        $pass=$_POST['apellido_perfil'];
        $pass2=$_POST['apellido_perfil'];
        $nombre=$_POST['nombre_perfil'];
        $usuario=$_POST['usuario_perfil'];
        $correo=$_POST['correo_perfil'];
        $verificarExistencia=$us->existeUsuario($usuario);
        
        if ($verificarExistencia==true){
            $us->constructorUsuario($array);

        }


            echo '<input type="button"  href="index.php" placeholder="completar">volver</input>';



    }


}