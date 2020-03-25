<?php

if( !$_SESSION['autentificado'] ){
  header('Location: login.php');
  exit;
}

if( isset($_GET['id']) && $_GET['id'] != null){
  ViajeManager::delete($_GET['id']);
}else{
  header('Location: inicio.php');
  exit;
}
//print_r($_GET);

?>
<link rel="stylesheet" href="/css/borrarViaje.css">
<div class="borrarViaje">
<h2>Viaje Borrado con existo</h2>
<a href="tusViajes.php">Volver tus viajes</a>
</div>
