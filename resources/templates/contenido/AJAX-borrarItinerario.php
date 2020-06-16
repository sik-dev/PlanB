<?php

$respuesta = [
  'error' => '',
  'post' => $_POST
];

if (count($_POST) > 0) {
  ItinerarioManager::delete($_POST['id']);
  $respuesta['error'] = false;
}else{
  $respuesta['error'] = 'post vacio';
}

$obj = json_encode($respuesta);
echo $obj;