<?php
$viajeBorrado = false;

if( !$_SESSION['autentificado'] ){
  header('Location: login.php');
  exit;
}

if( isset($_GET['id_user']) && $_GET['id_user'] != null &&
    isset($_GET['id_viaje']) && $_GET['id_viaje'] != null
  ){
  $idViaje = $_GET['id_viaje'];
  $idUser = $_GET['id_user'];
  
  if (ItinerarioManager::getBy($idViaje)) {
    $datosViaje = ViajeManager::getById($idViaje)['viaje'];
  }else{
    $datosViaje = ViajeManager::getById($idViaje, true)['viaje'];
  }
  
  //Si el viaje es del usuario lo borra
  if( $datosViaje->getIdUser() == $idUser){
    ViajeManager::delete($idViaje);
    $viajeBorrado = true;
  }else{  //sino no
    $viajeBorrado = false;
  }

}else{
  header('Location: inicio.php');
  exit;
}
//print_r($_GET);

?>

<link rel="stylesheet" href="/css/borrarViaje.css">
<div class="borrarViaje">

  <div class="imagen">
    <h1>Todos los destinos al alcance de tu mano</h1>
  </div>
  
  <div class='contenedor'>
    <?php if ($viajeBorrado) { ?>
      <h2>Viaje Borrado con existo</h2>
    <?php }else{ ?>
      <h2>No ha sido posible borrar el viaje, vuelva a intentarlo</h2>
    <?php } ?>
    <a href="tusViajes.php">Volver tus viajes</a>
  </div>

</div>
