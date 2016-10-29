<?php
/**
 * Created by PhpStorm.
 * User: dario
 * Date: 13/10/2016
 * Time: 14:29
 */
class VuelosModel{

    /**
     * @param $origen
     * @param $destino
     * @return mixed
     */
    function obtenerVuelos($origen, $destino,$fecha){
        global $db; // Indicamos que vamos a utlizar la variable global $db definida en el index.php
        $resultado=$db->query("SELECT *
                                FROM vuelo 
                                WHERE destino = '$destino' AND origen = '$origen' AND fec_salida = '$fecha'
                                ORDER BY fec_salida,hora_salida
                                "); // realizamos la consulta
        return $resultado->fetch_all(MYSQLI_ASSOC); // retornamos el resultado
    }


    /**
     * @return array
     */
    function localidad(){
        global $db; // Indicamos que vamos a utlizar la variable global $db definida en el index.php
        $resultado=$db->query("SELECT loc.id_loc,loc.nom_loc,pro.nom_prov,pais.nom_pais 
                                FROM localidad AS loc, provincia AS pro,pais
                                WHERE loc.id_prov = pro.id_prov AND 
                                      pro.id_pais = pais.id_pais"); // realizamos la consulta

        return $resultado->fetch_all(MYSQLI_ASSOC);// retornamos el resultado
    }


    /**
     * @param $id_localidad
     * @return string
     */
    function loc_id($id_localidad){
        global $db; // Indicamos que vamos a utlizar la variable global $db definida en el index.php
        $resultado=$db->query("SELECT *
                                FROM localidad AS loc, provincia AS pro,pais
                                WHERE loc.id_prov = pro.id_prov AND 
                                      pro.id_pais = pais.id_pais AND 
                                      loc.id_loc = '$id_localidad'"); // realizamos la consulta
        $loc = $resultado->fetch_assoc();
        return $loc["nom_loc"] . ", " . $loc["nom_prov"] . ", " . $loc["nom_pais"]; // retornamos el resultado
    }


    function vuelo_id($id_vuelo){
        global $db; // Indicamos que vamos a utlizar la variable global $db definida en el index.php
        $resultado=$db->query("SELECT * FROM `vuelo` WHERE id_vuelo = '$id_vuelo'"); // realizamos la consulta
        $loc = $resultado->fetch_assoc(); //devuelve la primera fila osea que se la usa para los que sabemos que devuelve una sola fila
        return $loc; // retornamos el resultado
    }


    function insertarReserva($dni,$nombre,$apellido,$sexo,$fec_nac,$id_vuelo,$user){
        //INSERTA AL PASAJERO EN LA BD
        global $db; // Indicamos que vamos a utlizar la variable global $db definida en el index.php
        $result = $db->query("INSERT INTO `pasajero` (`dni`, `nombre`, `apellido`, `sexo`, `fec_nac`, `id_vuelo`, `user`) 
                    VALUES ('$dni','$nombre','$apellido','$sexo','$fec_nac','$id_vuelo','$user')");
        return $result;
    }

    /**
     * @param $user
     * @param $correo
     * @param $pass
     * @param $passr
     * @return array
     */
    function insertarUsuario($user, $correo, $pass, $passr){
        global $db; // Indicamos que vamos a utlizar la variable global $db definida en el index.php
        //VERIFICACION
        $salida = array();
        $validar = new Validacion();
        if ($validar->email($correo)){ //VALIDA CORREO
            if ($validar->pass($pass,$passr)){  //VALIDA QUE SEAN IGUALES LOS PASS
                $user = $db->real_escape_string($user); //ESCAPA LOS CARACTERES ESPECIALES PARA EVITAR INYECCION SQL
                if ($this->existeUsuario($user)){  //VERIFICA QUE NO EXISTA UN MISMO NOMBRE DE USUARIO
                    $correo = $db->real_escape_string($correo); //ESCAPA LOS CARACTERES ESPECIALES PARA EVITAR INYECCION SQL
                    $pass = $db->real_escape_string($pass); //ESCAPA LOS CARACTERES ESPECIALES PARA EVITAR INYECCION SQL
                    $res= $db->query("INSERT INTO usuario (user_id, pass, correo) 
                                       VALUES ('$user', '$pass', '$correo')"); //INSERTA EN LA BASE DE DATOS A EL NUEVO USUARIO
                    if ($res){
                        $salida["bool"] = "bien";
                        $salida["mensaje"] = "Ya eres parte de Aerolineas.";
                        return $salida;
                    }else{
                        $salida["bool"] = "mal";
                        $salida["mensaje"] = "PROBLEMA AL INSERTAR.";
                        return $salida;
                    }

                }else{
                    $salida["bool"] = "mal";
                    $salida["mensaje"] = "USUARIO YA EXISTE";
                    return $salida;
                }
            }else{
                $salida["bool"] = "mal";
                $salida["mensaje"] = "CONTRASEÑA NO COINCIDE";
                return $salida;
            }
        }else{
            $salida["bool"] = "mal";
            $salida["mensaje"] = "CORREO NO VALIDO";
            return $salida;
        }
        //FIN VERIFICACION
    }


    /**
     * @param $user
     * @return bool
     */
    function existeUsuario($user){
        global $db;
        $results = $db->query("SELECT COUNT(*) AS cant FROM usuario WHERE user_id = '$user'");
        $res = $results->fetch_assoc();
        if ($res["cant"] != 0){
            return false;
        }else{
            return true;
        }
    }


    function sesion($user){
        global $db;
        $results = $db->query("SELECT * FROM usuario WHERE user_id = '$user'");
        return $results->fetch_assoc();
    }

    function sillasDisponibles($ubicacion_silla,$clase,$id_vuelo){
        global $db;
        $sillas = $db->query("SELECT * FROM silla 
                             WHERE ubicacion_silla = '$ubicacion_silla' AND 
                                   clase_silla = '$clase' AND 
                                   estado = '$id_vuelo' AND 
                                   id_vuelo = '1'");
        $silla = $sillas->fetch_assoc();
        return $silla;
    }

    function ocupado($nro_silla){
        global $db;
        $resultado = $db->query("UPDATE `silla` SET `estado` = 'OCUPADO' WHERE `silla`.`nro_silla` = '$nro_silla'");
        return $resultado;
    }

    function libre($nro_silla){
        global $db;
        $result = $db->query("UPDATE `silla` SET `estado` = 'LIBRE' WHERE `silla`.`nro_silla` = '$nro_silla'");
        return $result;
    }

    function existSillasLibres($clase,$id_vuelo){
        global $db;
        $result = $db->query("SELECT COUNT(*) AS cant FROM `silla`
                              WHERE `clase_silla` = '$clase' AND 
                                    `id_vuelo` = '$id_vuelo' AND 
                                    `estado` = 'LIBRE'");
        $res = $result->fetch_assoc();
        return $res["cant"];
    }

    function insertarPasajero($dni, $nombre, $apellido, $sexo, $fec_nac, $id_vuelo, $user_id, $nro_silla){
        global $db;
        $result = $db->query("INSERT INTO `pasajero` (`dni`, `nombre`, `apellido`, `sexo`, `fec_nac`, `id_vuelo`, `user_id`, `nro_silla`) 
                              VALUES ('$dni', '$nombre', '$apellido', '$sexo', '$fec_nac', '$id_vuelo', '$user_id', '$nro_silla')");
        return $result;
    }

    function asignarSilla($clase,$ubicacion_silla,$id_vuelo){
        global $db;
        $result = $db->query("SELECT * FROM `silla`
                              WHERE `ubicacion_silla` = '$ubicacion_silla' AND 
                                    `clase_silla` = '$clase' AND 
                                    `id_vuelo` = '$id_vuelo' AND 
                                    `estado` = 'LIBRE'");
        $res = $result->fetch_assoc();
        return $res["nro_silla"];
    }

    function verificarSilla($clase,$ubicacion_silla,$id_vuelo){
        global $db;
        $result = $db->query("SELECT COUNT(*) AS cant FROM `silla`
                              WHERE `ubicacion_silla` = '$ubicacion_silla' AND 
                                    `clase_silla` = '$clase' AND 
                                    `id_vuelo` = '$id_vuelo' AND 
                                    `estado` = 'LIBRE'");
        $res = $result->fetch_assoc();
        if ($res["cant"] == 0){
            return false;
        }
        return true;
    }


    function obtenerReservas($usuario){
        global $db;
        $result = $db->query("SELECT * FROM `pasajero` WHERE `user_id` = '$usuario'");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function borrarPasajero($id_pasaje){
        global $db;
        return $db->query("DELETE FROM pasajero WHERE id_pasajero = '$id_pasaje'");
    }

}


