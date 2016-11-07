<?php
// incluimos los archivos y clases generales que el sistema requiere
include("inc.configuration.php");

include("../recursos/php/class.TemplatePower.inc.php");
include("../recursos/php/class.MySQL.php");

// incluimos los controladores y models propios del sistema

include ("validacion.php");

include("controller/ingreso.php");
include("controller/perfil.php");
include("controller/menu.php");
include("controller/login.php");
include("controller/reservas.php");

include ("model/usuario.php");
include("model/combi.php");
include ("model/conductor.php");
include ("model/viaje.php");
include ("model/reserva.php");


?>