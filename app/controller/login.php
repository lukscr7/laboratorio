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
                    $data['error']="E-mail o password incorrecta, por favor vuelva a intentar";
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


}