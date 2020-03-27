<?php
$date = new DateTime('now');
$dateCadena = $date->format('Y-m-d H:i:s');

  if (isset($_GET['añadir_comentario']) && $_GET['añadir_comentario'] == 'true'){
    ComentarioManager::insert($_GET['texto'], $dateCadena, $_GET['id_user'], $_GET['id_viaje']);
    echo 'EXITO';

  }elseif (isset($_GET['quitar_comentario']) && $_GET['quitar_comentario'] == 'true') {
    ComentarioManager::delete($_GET['id']);
    echo 'EXITO';

  }else{
    echo 'ERROR';
  }
/*
if( !$_SESSION['autentificado'] ){
  header('Location: login.php');
  exit;
}

if (isset($_GET['añadir_favorito']) && $_GET['añadir_favorito'] == 'true'){
  FavoritosManager::insert($_GET['id_viaje'], $_GET['id_user']);

  $redirect = "viaje.php?id=" . $_GET['id_viaje'];
  header("Location: $redirect");
  exit;

}elseif (isset($_GET['quitar_favorito']) && $_GET['quitar_favorito'] == 'true') {
  FavoritosManager::delete($_GET['id_viaje']);

  $redirect = "viaje.php?id=" . $_GET['id_viaje'];
  header("Location: $redirect");
  exit;
}
  }else{
    header('Location: inicio.php');
    exit;
  } */

?>
