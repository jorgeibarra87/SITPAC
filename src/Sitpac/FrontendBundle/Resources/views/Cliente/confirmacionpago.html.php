<?php

$mensajeLog .= print_r($_POST,true) . "\r\n";
if(strlen($mensajeLog)>0){
$filename = "pruebconf.txt";
$fp = fopen($filename, "a");
if($fp) {
fwrite($fp, $mensajeLog, strlen($mensajeLog));
fclose($fp);

}
}

?>