<?php

/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 26/10/2016
 * Time: 09:13 PM
 */
class Usuario
{

    private $user_id;           //`user_id``pass``nom_us``ape_us``correo``permisos``foto_perfil``bandera`
    private $pass;
    private $nom_us;
    private $ape_us;
    private $correo;
    private $permisos;
    private $foto_perfil;
    private $bandera;

    /**
     * Asigna los datos al objeto Usuario a partir de una consulta a la Base de Datos.
     * @param $array
     */
    private function constructorUsuario($array)
    {
        $this->user_id = $array["user_id"];
        $this->pass = $array["pass"];
        $this->nom_us = $array["nom_us"];
        $this->ape_us = $array["ape_us"];
        $this->correo = $array["correo"];
        $this->permisos = $array["permisos"];
        $this->foto_perfil = $array["foto_perfil"];
        $this->bandera = $array["bandera"];
    }

    /**
     * Consulta si tiene algún Conductor la Empresa con id_e
     * @param $user_id
     * @return bool
     */
    public function existeUsuarioID($user_id)
    {
        global $baseDatos;
        $results = $baseDatos->query("SELECT COUNT(*) AS cant FROM `usuarios` WHERE `user_id` = '$user_id'");
        $res = $results->fetch_assoc();
        if ($res["cant"] != 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Consulta si tiene algún Conductor la Empresa con id_e
     * @return bool
     */
    public function existeUsuario()
    {
        global $baseDatos;
        $results = $baseDatos->query("SELECT COUNT(*) AS cant FROM `usuarios`");
        $res = $results->fetch_assoc();
        if ($res["cant"] != 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Verifica el usuario y contraseña para que se pueda iniciar sesión
     * true = Correcto!   --   false = Incorrecto :C
     * @param $usuario
     * @param $contraseña
     * @return bool
     */
    public function verificarUsuario($usuario, $contraseña)
    {
        $validar = new Validacion();
        $us = new Usuario();
        if ($us->dat_usuario($usuario))
            $pass = $validar->pass($contraseña, $us->getPass()); //PRUEBA QUE LAS DOS CONTRASEÑAS SEAN IGUALES
        if ($us != null && $pass) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Trae todos los datos de un Usuario user_id de la Base de Datos.
     * @param $user_id
     * @return bool
     */
    public function dat_usuario($user_id)
    {
        global $baseDatos;
        if ($this->existeUsuarioID($user_id)) {
            $sql = "SELECT * FROM `usuarios` WHERE `user_id` = '$user_id'";
            $resultado = $baseDatos->query($sql);
            if ($resultado != false) {
                $this->constructorUsuario($resultado->fetch_assoc());
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Retorna un Array de los Usuarios en la Base de Datos.
     * @return Usuario[]
     */
    public function all_usuarios()
    {
        global $baseDatos;
        $arrayUsuarios = array();
        if ($this->existeUsuario()) {
            $sql = "SELECT * FROM `usuarios`";
            $resultado = $baseDatos->query($sql);
            $arrayConsulta = $resultado->fetch_all(MYSQLI_ASSOC);
            foreach ($arrayConsulta as $res) {
                $usuario = new Usuario();
                $usuario->constructorUsuario($res);
                $arrayUsuarios[] = $usuario;
            }
            return $arrayUsuarios;
        } else {
            return null;
        }

    }


    /**
     * Actualiza los datos del Usuario al que hace referencia.
     * @return bool
     */
    public function update()
    {
        global $baseDatos;
        $us = $this->getUserId();
        $nom = $this->getNomUs();
        $ape = $this->getApeUs();
        $correo = $this->getCorreo();
        $foto = $this->getFotoPerfil();
        $sql = "UPDATE `usuarios` 
                SET `nom_us` = '$nom', `ape_us` = '$ape', `correo` = '$correo', `foto_perfil` = '$foto' 
                WHERE `usuarios`.`user_id` = '$us'";
        $resultado = $baseDatos->query($sql);
        return $resultado;
    }

    /**
     *
     * @param $usuario
     * @param $pass
     * @param $nombre
     * @param $apellido
     * @param $correo
     * @return bool
     */
    public function insert($usuario, $pass, $nombre, $apellido, $correo)
    {
        global $baseDatos;
        $sql = "INSERT 
                INTO `usuarios`(`user_id`, `pass`, `nom_us`, `ape_us`, `correo`, `permisos`) 
                VALUES ('$usuario', '$pass', '$nombre', '$apellido', '$correo', 'CLIENTE')";
        $resultado = $baseDatos->query($sql);
        return $resultado;
    }

    /**
     * Verifica si se quiere cambiar la foto de perfil.
     * @param $datPOST
     * @param $datFILE ["foto"]
     * @return bool
     */
    public function verificarModificacion($datPOST, $datFILE)
    {
        global $baseDatos;
        $this->setNomUs($baseDatos->real_escape_string($datPOST["nombre"]));
        $this->setApeUs($baseDatos->real_escape_string($datPOST["apellido"]));
        $this->setCorreo($baseDatos->real_escape_string($datPOST["email"]));
        if (!$datFILE["size"] == 0) {
            $ruta = $datFILE["tmp_name"];
            $tipo = substr(strrchr($datFILE['name'], "."), 1);
            $destino = "../recursos/imagen/perfil/cliente/" . $this->getUserId() . "." . $tipo;
            copy($ruta, $destino);
            $this->setFotoPerfil($destino);
        }
        return $this->update();
    }

    /**
     * Da de BAJA al Usuario referenciado.
     * @return bool
     */
    public function baja(){
        global $baseDatos;
        $user_id = $this->getUserId();
        $sql = "DELETE FROM `usuarios` WHERE `usuarios`.`user_id` = '$user_id'";
        $res = $baseDatos->query($sql);
        return $res;
    }

    /**
     * Hace ADMIN al Usuario referenciado.
     * @return bool
     */
    public function hacerAdmin(){
        global $baseDatos;
        $user_id = $this->getUserId();
        $sql = "UPDATE `usuarios` SET `permisos` = 'ADMIN' WHERE `usuarios`.`user_id` = '$user_id'";
        $res = $baseDatos->query($sql);
        return $res;
    }


    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getNomUs()
    {
        return $this->nom_us;
    }

    /**
     * @param mixed $nom_us
     */
    public function setNomUs($nom_us)
    {
        $this->nom_us = $nom_us;
    }

    /**
     * @return mixed
     */
    public function getApeUs()
    {
        return $this->ape_us;
    }

    /**
     * @param mixed $ape_us
     */
    public function setApeUs($ape_us)
    {
        $this->ape_us = $ape_us;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @return mixed
     */
    public function getPermisos()
    {
        return $this->permisos;
    }

    /**
     * @param mixed $permisos
     */
    public function setPermisos($permisos)
    {
        $this->permisos = $permisos;
    }

    /**
     * @return mixed
     */
    public function getFotoPerfil()
    {
        return $this->foto_perfil;
    }

    /**
     * @param mixed $foto_perfil
     */
    public function setFotoPerfil($foto_perfil)
    {
        $this->foto_perfil = $foto_perfil;
    }

    /**
     * @return mixed
     */
    public function getBandera()
    {
        return $this->bandera;
    }

    /**
     * @param mixed $bandera
     */
    public function setBandera($bandera)
    {
        $this->bandera = $bandera;
    }
}