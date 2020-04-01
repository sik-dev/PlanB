<?php
//error_reporting(0);

if(isset($_POST['suggest']) && !empty($_POST['suggest'])) {
    $sugerencia = $_POST['suggest'];
    $datos = ViajeManager::getAllNames($sugerencia);
    //print_r($datos);
    
    $obj = json_encode($datos);
    echo $obj;
 }

?>
