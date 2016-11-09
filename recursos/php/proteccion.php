<?php
class Proteccion {

    private $Key;
    public function __construct(){
        $this->Key = "lab15";
    }
    public function encriptar ($input) {
        $output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->Key), $input, MCRYPT_MODE_CBC, md5(md5($this->Key))));
        return $output;
    }

    public function desencriptar ($input) {
        $output = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($this->Key), base64_decode($input), MCRYPT_MODE_CBC, md5(md5($this->Key))), "\0");
        return $output;
    }

    public function html ($input){
        return htmlentities(strip_tags(stripslashes(htmlspecialchars($input))));
    }
}

?>