<?php
error_reporting(0);


if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $datos = ViajesManager::getViajesID($id)[0];
    $datosItinerario = ViajesManager::getItinerario($id);
    //print_r(json_encode([$datos, $datosItinerario]));
    //$obj = json_encode([$datos, $datosItinerario));


    for ($i=0; $i < count($datosItinerario); $i++) {
      $datosItinerario[$i]['foto'] = FotosItinerarioManager::getBy($datosItinerario[$i]['id'])[0]['ruta'];
    }
    $array = [
      'datosViaje'=>$datos,
      'datosItinerario'=>$datosItinerario
    ];
    $obj = json_encode($array, JSON_UNESCAPED_UNICODE);
    echo $obj;
 }

?>
