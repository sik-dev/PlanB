<?php

// ha mirar en viajesmanager
/* if(isset($_GET['id_user'])){
    $id=$_GET['id_user'];
} */

//$datosUser = ViajesManager::getInfoUsers($_GET['id_user'])[0];
//$datosViaje = ViajesManager::getViajeUsers($_GET['id_user']);
$datosUser = UsuarioManager::getBy($_GET['id_user']);
$datosViaje = ViajeManager::getByUser($datosUser->getId());
$rutaImgProfile = (explode('.',$datosUser->getFoto())[0] == 'profileDefault'? $datosUser->getFoto():$datosUser->getId().'/'.$datosUser->getFoto());
//$numDatos = count($datosUser);

/* echo "<pre>";
print_r($datosUser);
print_r($datosViaje);
echo "</pre>"; */

?>
<link rel="stylesheet" href="/css/perfilPublico.css">
<div class="fondoPerfilPublico">
  <div class="perfilPublic">
    <h1>Perfil Publico</h1>
    <br><br>
    <img src="imgs/<?=$rutaImgProfile?>" alt="">
    <h2>Nombre: <?=$datosUser->getNombre()?></h2>
    <h3>Descripción:</h3>
    <p><?=$datosUser->getDescripcion()?></p>
    <h4>País: <?=$datosUser->getPais()?></h4>
    <h4>Media Global: <?=$datosUser->getMedia()?></h4>
  </div>
  <div class="mejorValoradosPerfilPublic">
    <h2>Sus viajes: </h2>
    <?php foreach ($datosViaje as $fila) { ?>
      <div class="viaje">
        <h2><?=$fila['viaje']->getCiudadDestino()?></h2>
        <h4><?=$fila['viaje']->getDescripcion()?></h4>
        <a href="viaje.php?id=<?=$fila['viaje']->getId()?>">
          <img id='mejoresValorados' src="imgs/<?=$fila['viaje']->getIdUser().'/'.$fila['viaje']->getFoto()?>" alt="">
        </a>
        <div class="datos">
          <p>Precio: <?=$fila['viaje']->getPrecio()?></p>
          <p>Transporte: <?=$fila['viaje']->getTransporte()?></p>
          <p>Media del viaje: <?=$fila['media']?></p>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
