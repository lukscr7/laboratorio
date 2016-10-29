<?php
// incluimos los archivos y clases generales que el sistema requiere
include("inc.configuration.php");

include("../recursos/php/class.TemplatePower.inc.php");
include("../recursos/php/class.MySQL.php");

// incluimos los controladores y models propios del sistema


include("controller/ingreso.php");
include ("validacion.php");
include("controller/perfil.php");
include("controller/menu.php");
include("controller/login.php");

include ("model/usuario.php");


?>