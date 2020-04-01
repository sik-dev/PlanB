<?php
error_reporting(0);

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $datos = FavoritosManager::getBy($id);
    $nuevoArray;
    $i = 0;

/*
  echo "<pre>";
  print_r($datos);
  echo '</pre>';
*/
  foreach ($datos as $fila) {
    $nuevoArray[$i]['id'] = $fila->getId();
    $nuevoArray[$i]['idViaje'] = $fila->getIdViaje();
    $nuevoArray[$i++]['idUser'] = $fila->getIdUser();
  }

  $obj = json_encode($nuevoArray, JSON_UNESCAPED_UNICODE);
  echo $obj;
}

?>
