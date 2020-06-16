<?php

$respuesta = [
  'errores' => '',
  'post' => $_POST
];

$errores = [];
$info = [
  'localizacion' => '',
  'alojamiento' => '',
  'manana' => '',
  'tarde' => '',
  'noche' => ''
];

if (count($_POST) > 0) {

  gestionaErrores($_POST, $info, $errores);

  if (count($errores) > 0) {
    $respuesta['errores'] = $errores;
  }else{
    $respuesta['errores'] = false;
    
    ItinerarioManager::update(
      $_POST['idItinerario'], 
      $info['localizacion'],
      $info['alojamiento'],
      $info['manana'],
      $info['tarde'],
      $info['noche']
    );
  }
}else{
  $respuesta['errores'] = 'no post';
}

$obj = json_encode($respuesta);
echo $obj;