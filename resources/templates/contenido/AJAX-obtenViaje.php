<?php
error_reporting(0);


if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $datos = ViajeManager::getById($id);
    $datosItinerario = ItinerarioManager::getBy($id);

    /*
    echo "<pre>";
    print_r($datos);
    print_r($datosItinerario);
    echo "</pre>";
    */
    for ($i=0; $i < count($datosItinerario); $i++) {
      $datosItinerario[$i]['fotos'] = FotosItinerarioManager::getBy($datosItinerario[$i]['id']);
    }
    $array = [
      'datosViaje'=>$datos,
      'datosItinerario'=>$datosItinerario
    ];
    $obj = json_encode($array, JSON_UNESCAPED_UNICODE);
    echo $obj;
 }

?>
