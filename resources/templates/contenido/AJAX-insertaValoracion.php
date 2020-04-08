<?php
//error_reporting(0);

if( isset($_GET['id_user']) && !empty($_GET['id_user']) &&
    isset($_GET['id_viaje']) && !empty($_GET['id_viaje']) &&
    isset($_GET['puntuacion']) && !empty($_GET['puntuacion'])
  ) {

  $id_user = intval($_GET['id_user']);
  $id_viaje = intval($_GET['id_viaje']);
  $puntuacion = intval($_GET['puntuacion']);



  //se borra la valoracion de ese Usuario a ese viaje si la hubiera
  ValoracionManager::delete([$id_user, $id_viaje]);

  //se inserta la valoracion
  ValoracionManager::insert($puntuacion, $id_user, $id_viaje);


  $nuevaMedia = ValoracionManager::getMediaViaje($id_viaje)[0]['media'];

  echo $nuevaMedia;
}else{
  echo 'ERROR';
}

?>
