<?php

if( !$_SESSION['autentificado'] ){
  header('Location: login.php');
  exit;
}

if (isset($_GET['id_comentario']) && $_GET['id_comentario'] != null){
  ComentarioManager::delete($_GET['id_comentario']);
  $redirect = "viaje.php?id=" . $_GET['id_viaje'];
  header("Location: $redirect");
  exit;
}else{
  header('Location: inicio.php');
  exit;
}

?>
