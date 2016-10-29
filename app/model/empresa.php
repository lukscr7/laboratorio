<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 27/10/2016
 * Time: 02:48 PM
 */

//`id_e``user_e``nom_e``telefono_e``calle_e``num_calle_e`
class Empresa{

    private $id_e;
    private $user_e;
    private $nom_e;
    private $telefono_e;
    private $calle_e;
    private $num_calle_e;

    /**
     * @return mixed
     */
    public function getIdE()
    {
        return $this->id_e;
    }

    /**
     * @param mixed $id_e
     */
    public function setIdE($id_e)
    {
        $this->id_e = $id_e;
    }

    /**
     * @return mixed
     */
    public function getUserE()
    {
        return $this->user_e;
    }

    /**
     * @param mixed $user_e
     */
    public function setUserE($user_e)
    {
        $this->user_e = $user_e;
    }

    /**
     * @return mixed
     */
    public function getNomE()
    {
        return $this->nom_e;
    }

    /**
     * @param mixed $nom_e
     */
    public function setNomE($nom_e)
    {
        $this->nom_e = $nom_e;
    }

    /**
     * @return mixed
     */
    public function getTelefonoE()
    {
        return $this->telefono_e;
    }

    /**
     * @param mixed $telefono_e
     */
    public function setTelefonoE($telefono_e)
    {
        $this->telefono_e = $telefono_e;
    }

    /**
     * @return mixed
     */
    public function getCalleE()
    {
        return $this->calle_e;
    }

    /**
     * @param mixed $calle_e
     */
    public function setCalleE($calle_e)
    {
        $this->calle_e = $calle_e;
    }

    /**
     * @return mixed
     */
    public function getNumCalleE()
    {
        return $this->num_calle_e;
    }

    /**
     * @param mixed $num_calle_e
     */
    public function setNumCalleE($num_calle_e)
    {
        $this->num_calle_e = $num_calle_e;
    }

    public function empresa_id($id_e){
        global $baseDatos;
        $sql = "SELECT * FROM empresas WHERE id_e = $id_e";
        $resultado = $baseDatos->query($sql);
        return $resultado->fetch_assoc();
    }

    public function all_empresas(){
        global $baseDatos;
        $sql = "SELECT * FROM lugares_favoritos";
        $resultado = $baseDatos->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

}