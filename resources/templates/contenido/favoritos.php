<?php

  if (isset($_GET['añadir_favorito']) && $_GET['añadir_favorito'] == 'true'){
    FavoritosManager::insert($_GET['id_viaje'], $_GET['id_user']);
    echo 'EXITO';

  }elseif (isset($_GET['quitar_favorito']) && $_GET['quitar_favorito'] == 'true') {
    FavoritosManager::delete([$_GET['id_viaje'], $_GET['id_user']]);
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
