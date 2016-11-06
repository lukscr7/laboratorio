<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 23/10/2016
 * Time: 10:13
 */
class Perfil_Controller{

    public function pasajero(){
        $us = new Usuario(); //PIDO LOS DATOS DEL USUARIO
        $us->dat_usuario($_SESSION["usuario"]);
        $tp1 = new TemplatePower("template/perfil.html");
        $tp1->prepare();
        $tp1->gotoBlock("_ROOT");

        //VALORES DE LA PAGINA
        $tp1->assign("nombre_usuario",$us->getNomUs()." ".$us->getApeUs());
        $tp1->assign("tipo_usuario",$us->getPermisos());
        $tp1->assign("imagen_pasajero",$us->getFotoPerfil());
        $tp1->assign("descripcion",$us->getDescripcion()); //YA VEMOS SI LE PONEMOS DESCRIPCIÓN AL USUARIO
        $tp1->assign("titulo_body","Historial de Viajes");

        //LUGARES FAVORITOS
        $tp1->newBlock("boton.lugar.favoritos"); // CREO EL BOTÓN DE LUGARES FAVORITOS
        $tp1->newBlock("modal.lugar.favoritos"); // CREO EL MODEL DEL BOTÓN DE LUGARES FAVORITOS

        //CREACIÓN DE LOS LUGARES FAVORITOS
        $tp1->newBlock("modal.lugar.favoritos");

        //DEBERÍA IR EN OTRO CONTROLLER PERO NAAAA
        $lugaresFavoritos = new TemplatePower("template/lista.lugares.favoritos.html");
        $lugaresFavoritos->prepare();
        $lugaresFavoritos->gotoBlock("_ROOT");
        $lf = new LugarFavorito($us->getUserId());
        if (count($lf->getLugares()) > 0) {
            foreach ($lf->getLugares() as $lugar) {
                $lugaresFavoritos->newBlock("LF");
                $lugaresFavoritos->assign("EtiquetaLF", $lugar["nom_lugar"]);
                $lugaresFavoritos->assign("direccion", $lugar["ubicacion"]);
            }
        }else{
            $lugaresFavoritos->newBlock("noLF");
        }
        //FIN DEBERÍA IR EN OTRO CONTROLLER PERO NAAAA

        $tp1->assign("listaLugaresFavoritos",$lugaresFavoritos->getOutputContent());

        //TARJETAS DE VIAJES REALIZADOS
        //$viajes = new Viaje();
        //$tp1->newBlock();
        return $tp1->getOutputContent();
    }

    public function editarDatos(){

        /*print_r($_POST);
        print_r($_FILES);
        $image = $_FILES["foto_perfil"];
        $imagen = substr(strrchr($image['name'], "."), 1);
        print "<br>Tipo del archivo imagen: .".$imagen;*/
        $us = new Usuario();
        $us->dat_usuario($_SESSION["usuario"]);
        $res = $us->verificarModificacion($_POST,$_FILES["foto"]);
        if ($res){
            header('Location: index.php?alerta=Update');
        }else{
            header('Location: index.php?alerta=UpdateMal');
        }
    }
}