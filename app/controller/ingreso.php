<?php
/**
 * Created by PhpStorm.
 * User: darioflores
 * Date: 15/10/2016
 * Time: 15:53
 */
class Ingreso_Controller{

    public static function main(){
        $tpl = new TemplatePower("templates/form.vuelos.disponibles.html");
        $tpl->prepare();
        // Instanciamos los links creando un nuevo bloque y cargando las variables.
        $vuelo = new VuelosModel();
        $results = $vuelo->localidad();
        if (count($results) > 0) {
            foreach ($results as $res) {
                $tpl->newBlock("opO");
                $tpl->assign("op", $res["nom_loc"] . ", " . $res["nom_prov"] . ", " . $res["nom_pais"]); //Valle Viejo, Catamarca, Argentina
                $tpl->assign("valor", $res["id_loc"]);
                $tpl->newBlock("opD");
                $tpl->assign("op", $res["nom_loc"] . ", " . $res["nom_prov"] . ", " . $res["nom_pais"]); //Valle Viejo, Catamarca, Argentina
                $tpl->assign("valor", $res["id_loc"]);
            }
        }else{
            $tpl->assign("op","ERROR NO SE CONECTO A DB");
        }
        // Retornamos el objeto template para que se muestre el men�.
        return $tpl->getOutputContent();
    }
}
?>